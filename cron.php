<?php
//th message
$msg = "This is simple test script for send mail through cron job";

//use wrodwrap() if lines are longer than 70 characters

$msg = wordwrap($msg,70);

//send email

mail("nguyenphudung93.dn@gmail.com","My subject",$msg);