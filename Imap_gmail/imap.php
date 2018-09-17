<?php
 echo '<h1>Test Imap Gmail</h1>';
 $attachments = array();
 if (! function_exists('imap_open')) {
    echo "IMAP is not configured.";
    exit();
} else {
    echo 'It is runing';
}
    /* Connecting Gmail server with IMAP */
    $conn = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'dev.tester.dn2018@gmail.com', 'test123@123') or die('Cannot connect to Gmail: ' . imap_last_error());
    $emails = imap_search($conn,'ALL');
    rsort($emails);
    
    foreach($emails as $email_number) {
        // $overview = imap_fetchbody($conn,$email_number,'1');
        // // $message = imap_fetchbody($conn,$email_number, 1);
        // /* get mail structure */
        // // var_dump(base64_decode($overview));
        // foreach($overview as $result){
        //     var_dump($result);
        // }
        $s = imap_fetchstructure($conn, $email_number);
        foreach ($s->parts as $partno0=>$p){
            getpart($conn,$email_number,$p,$partno0+1);
        
        }
        print_r($data);
    }

    imap_close($conn);


    //function read email
    function getpart($mbox,$mid,$p,$partno) {
        // $partno = '1', '2', '2.1', '2.1.3', etc for multipart, 0 if simple
        global $htmlmsg,$plainmsg,$charset,$attachments,$data;

        // DECODE DATA
        $data = ($partno)?
            imap_fetchbody($mbox,$mid,$partno):  // multipart
            imap_body($mbox,$mid);  // simple
        // Any part may be encoded, even plain text messages, so check everything.
        if ($p->encoding==4)
            $data = quoted_printable_decode($data);
        elseif ($p->encoding==3)
            $data = base64_decode($data);

        // PARAMETERS
        // get all parameters, like charset, filenames of attachments, etc.
        $params = array();
        if ($p->parameters)
            foreach ($p->parameters as $x)
                $params[strtolower($x->attribute)] = $x->value;
        if ($p->dparameters)
            foreach ($p->dparameters as $x)
                $params[strtolower($x->attribute)] = $x->value;

        // ATTACHMENT
        // Any part with a filename is an attachment,
        // so an attached text file (type 0) is not mistaken as the message.
        if ($params['filename'] || $params['name']) {
            // filename may be given as 'Filename' or 'Name' or both
            $filename = ($params['filename'])? $params['filename'] : $params['name'];
            // filename may be encoded, so see imap_mime_header_decode()
            $attachments[$filename] = $data;  // this is a problem if two files have same name
        }

        // TEXT
        if ($p->type==0 && $data) {
            // Messages may be split in different parts because of inline attachments,
            // so append parts together with blank row.
        if (strtolower($p->subtype)=='plain')
            $plainmsg = $plainmsg . trim($data) . "\n\n";
        else
            $htmlmsg = $htmlmsg . $data . "<br><br>";
        $charset = $params['charset'];  // assume all parts are same charset
        }

        // EMBEDDED MESSAGE
        // Many bounce notifications embed the original message as type 2,
        // but AOL uses type 1 (multipart), which is not handled here.
        // There are no PHP functions to parse embedded messages,
        // so this just appends the raw source to the main message.
        elseif ($p->type==2 && $data) {
            $plainmsg = $plainmsg . $data . "\n\n";
        }

        // SUBPART RECURSION
        if ($p->parts) {
            foreach ($p->parts as $partno0=>$p2)
                getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1));  // 1.2, 1.2.1, etc.
        }
    }