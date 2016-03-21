<!DOCTYPE html>
<html>

<?php

include "sql.php";
$allcourselist=searchforcoursetyepe2("","",'allcourselist');
//print_r($allcourselist);
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
$coursenumber=6;

//print_r($courselist);


?>



<?php
function createsubjectoption($number,$courselist)
{
	?>
	<select name="subject<?php echo $number;?>" onchange="createcatalogoption(this.value,'<?php echo $number;?>')">
		<?php
		foreach ($courselist as $key => $value) {
			?>
			<option value="<?php echo $key;?>" > <?php echo $key;?></option>
			<?php
		}?>
	</select>
	<select name="catalog_number<?php echo $number;?>"></select>
	<?php
}
?>
<head>
	<title>Welcome to uw course schedule
		Please choose your courses</title>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script type="text/javascript">
			var arraylist=JSON.parse('<?php echo json_encode($courselist);?>');
			function createcatalogoption(subject,number)
			{
				console.log("add clled");
				console.log(subject);
				console.log(number);
				var name="catalog_number"+number;
				var new_option;
				console.log(name);

				document.getElementsByName(name)[0].options.length = 0;
    //document.getElementById(name).options.length = idarray.length;
    console.log("length is ");
    console.log(arraylist[subject].length);
    for(var i =0;i<arraylist[subject].length;i++)
    {
    	new_option=new Option(arraylist[subject][i],arraylist[subject][i]);
    	document.getElementsByName(name)[0].options.add(new_option);
    }
    var op=document.getElementsByName(name)[0].options;
    op[0].selected=true;

}

</script>
</head>

<body >
<form action=displaylist.php method=post>
	<p>Welcome to uw course schedule Please choose your term and courses</p>
	Pick the term
	<select name="sess">
		<option value="1159">1159</option>
		<option value="1161">1161</option>
		<option value="1165" selected="">1165</option>
		<option value="1169">1169</option>
	</select>
	<ol>
		<?php


		for($i=0;$i<$coursenumber;$i++)
		{
			?>

			<li class= "courses">
				Choose the subject: 
				<?php 
				createsubjectoption($i,$courselist);?>


			</li>

			<?php
		}
		?>
	</ol>
		<input type="submit" action="displaylist.php" value="Submit" /><br>
	</form>

</body>

</html>
