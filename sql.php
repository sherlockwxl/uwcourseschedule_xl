	<?php
	//name is courses;
	set_time_limit(0);
	function clearrecord($tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
		$sql = "DELETE FROM $tablename";
		if ($conn->query($sql) === TRUE) {
			echo "Database deleted successfully";
		} else {
			echo "Error creating database: " . $conn->error;
		}



	}
	//clearrecord('courses');
	//clearrecord('allcourselist');


	//loadarray is used for change second level to one level
	function loadarray($dataarray,$num)
	{
		$temparray=array();
		for($i=0;$i<sizeof($dataarray[$num]);$i++)
		{
			$temparray[]=$dataarray[$num][$i];
		}
			//print_r($temparray);
		return $temparray;


	}

	//list array need another load array because of the name is not num
	function loadarraytype2($dataarray,$num)
	{
		$temparray=array();
			foreach ($dataarray[$num] as $key => $value) {
				# code...
				if($key!='units')
				$temparray[]=$value;
			}
			//print_r($temparray);
		return $temparray;


	}
	//add the record to sql
	function addrecord($dataarray,$tablename)
	{

		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$temparray=loadarray($dataarray,0);




		$sql = "INSERT INTO $tablename (id, coursepre ,
		coursenumber ,
		coursetype ,
		courselecnum ,
		coursetime ,
		coursedate ,
		coursename ,
		courselocation ,
		courselocationbuilding ,
		courselocationbuildingroomnumber,
		courseinstructors ,
		enrollment_capacity ,
		enrollment_total ,
		waiting_capacity ,
		waiting_total)
		VALUES ('$temparray[0]','$temparray[1]','$temparray[2]','$temparray[3]','$temparray[4]','$temparray[5]','$temparray[6]','$temparray[7]','$temparray[8]','$temparray[9]','$temparray[10]','$temparray[11]','$temparray[12]','$temparray[13]','$temparray[14]','$temparray[15]');";




		for($i=1;$i<sizeof($dataarray);$i++)
		{
			$temparray=loadarray($dataarray,$i);
			//echo "multi called ";
			//print_r($temparray);
			$sql .= "INSERT INTO $tablename (id, coursepre ,
			coursenumber ,
			coursetype ,
			courselecnum ,
			coursetime ,
			coursedate ,
			coursename ,
			courselocation ,
			courselocationbuilding ,
			courselocationbuildingroomnumber,
			courseinstructors ,
			enrollment_capacity ,
			enrollment_total ,
			waiting_capacity ,
			waiting_total)
			VALUES('$temparray[0]','$temparray[1]','$temparray[2]','$temparray[3]','$temparray[4]','$temparray[5]','$temparray[6]','$temparray[7]','$temparray[8]','$temparray[9]','$temparray[10]','$temparray[11]','$temparray[12]','$temparray[13]','$temparray[14]','$temparray[15]');";
		}


		//print_r ($sql);
		if ($conn->multi_query($sql) === TRUE) {
			echo "New records created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}





	}


	function searchforcourse($coursepre,$coursenumber,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$sql = "SELECT * FROM $tablename WHERE coursepre='$coursepre' AND coursenumber='$coursenumber' ";
		$result = $conn->query($sql);
		;
		if ($result->num_rows > 0) {
	    // 输出每行数据
			$returnarray=array();
			while($row = $result->fetch_assoc()) {
			//	print_r($row);
				$returnarray[]=$row;
			}
			return $returnarray;
		} else {
			return false;
		}
		$conn->close();
	}
	//searchforcourse('CS','251','courses');
	$testarray=array(
		array(
			'5980','CS','246','LEC','001',"13:00-14:20",'TTh','Object-Oriented Software Development','UWU','B1','271','Buhr,Peter A','110','126','0','0'
			)
		);
	//addrecord($testarray,'courses');
	//print_r($testarray);
	//function search($)
	//addrecordforlist will add all course list into database named allcourselist
	function addrecordforlist($dataarray,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		/*$temparray=loadarraytype2($dataarray,0);




		$sql = "INSERT INTO $tablename (subject,
		catalog_number ,
		title)
		VALUES ('$temparray[0]','$temparray[1]','$temparray[2]');";*/



	$sql="";
		for($i=0;$i<sizeof($dataarray);$i++)
		{
			$temparray=loadarraytype2($dataarray,$i);
			//echo "multi called ";
			//print_r($temparray);
			$sql .= "INSERT INTO $tablename (subject,
		catalog_number,
		title)VALUES('$temparray[0]','$temparray[1]','$temparray[2]');";
			if($i%10==0)
			{

				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
				$sql="";
					mysqli_close($conn);
					$dbname = "myDB";
					$conn = mysqli_connect("localhost","root","root",$dbname);
			}
		}


				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
				}
		//print_r ($sql);


	}


	//search for course in all list

	function searchforcoursetyepe2($coursepre,$coursenumber,$tablename)
	{
		$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}

		$sql = "SELECT * FROM $tablename WHERE 1=1";
		$result = $conn->query($sql);
		//print_r(mysqli_fetch_array($result));
		$num=0;
		if ($result->num_rows > 0)
			{
				$returnarray=array();
			while($row = $result->fetch_assoc()) {
				//print_r($row);
				$num++;
				$returnarray[]=$row;
			}
		//	echo "total have $num";
					return $returnarray;
		} else {
			return false;
		}
		$conn->close();
	}

	//searchforcoursetyepe2('CS','246','allcourselist');
	//add this because wowan's
/*	$dbname = "myDB";
		$conn = mysqli_connect("localhost","root","root",$dbname);
		if (!$conn)
		{
			die('Could not connect: ' . mysqli_error());
		}
	$sql="INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','443W','International Finl Mgt (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','447W','Advanced Auditing (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','452W','Marketing Strategy (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','453W','Working Capital Management(WLU');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','463W','Adv Corporate Finance (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','466W','Advanced Taxation (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','467W','Advanced Management Acct (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','470W','Brand Communication (WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','472W','Marketing Communications(WLU)');INSERT INTO allcourselist (subject, catalog_number, title)VALUES('BUS','473W','Investment Management (WLU)');";

				if ($conn->multi_query($sql) === TRUE) {
				echo "New records created successfully";
				} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			};*/
	?>
