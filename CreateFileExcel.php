<?php
$array  = array(
    'student1' => array(
        'name' => 'Dung',
        'age'   => '25',
        'chua vo' => 'yes'
    ),
    'student2' => array(
        'name' => 'Thien',
        'age'   => '29',
        'chua vo' => 'no'
    ),
);


// Submission from
$filename = "test.xls";		 
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
ExportFile($array);
		

function ExportFile($records) {
	$heading = false;
		if(!empty($records))
		  foreach($records as $row) {
			if(!$heading) {
			  // display field/column names as a first row
			  echo implode("\t", array_keys($row)) . "\n";
			  $heading = true;
			}
			echo implode("\t", array_values($row)) . "\n";
		  }
		exit;
}