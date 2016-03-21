<?php
	$filename="allcourse.txt";
	$mydata = fopen($filename, "r") or die("Unable to open filedata1!");
	$mydata_1 = fread($mydata,filesize($filename));
	fclose($mydata);
	$json=json_decode($mydata_1,true);
	//print_r($json);
	echo sizeof($json['data']);
	?>