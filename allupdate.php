<?php
set_time_limit(0);
include "update.php";
  function allupdate()
  {
    $allcourselist=searchforcoursetyepe2("","",'allcourselist');
    $courselist=array();
    for($i=0;$i<sizeof($allcourselist);$i++)
    {
    	if(!array_key_exists($allcourselist[$i]['subject'],$courselist))
    	{
    		//$courselist[$allcourselist[$i]['subject']]=array();
    		$courselist[$allcourselist[$i]['subject']][]=$allcourselist[$i]['catalog_number'];
    	}
    	else
    	{
    		$courselist[$allcourselist[$i]['subject']][]=$allcourselist[$i]['catalog_number'];
    	}
    }
    $num=0;
    foreach ($courselist as $key => $value) {
      # code...
      $subject=$key;
      for($i=0;$i<sizeof($value);$i++)
      {
        echo "will update $key and $value[$i]";
        echo "<br>";
        $num++;
        $string="update".$key."and".$value[$i];
        $filename="update.txt";

        $handle=fopen($filename,"a+");

        $str=fwrite($handle,$string);
        $str=fwrite($handle,"\n");

         fclose($handle);
        update($key,$value[$i],'1165');
      }
    }
    echo "total update $num courses";
  }
allupdate();
  ?>
