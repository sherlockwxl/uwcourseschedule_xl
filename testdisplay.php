<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel='stylesheet' href='./fullcalendar/fullcalendar.css' />
<script src='./fullcalendar/lib/jquery.min.js'></script>
<script src='./fullcalendar/lib/moment.min.js'></script>
<script src='./fullcalendar/fullcalendar.js'></script>
<script type="text/javascript">
var eventarray=[
        {
            title  : 'event1',
            start  : '2016-03-03'
        },
        {
            title  : 'event2',
            start  : '2016-03-05',
            end    : '2016-03-06'
        },
        {
            title  : 'event3',
            start  : '2016-03-04T12:30:00',
            allDay : false // will make the time show
        }
    ];
    var startdate='2016-02-29';
    var enddate='2016-03-04';
	$(document).ready(function() {

    // page is now ready, initialize the calendar...

    $('#calendar').fullCalendar({
        // put your options and callbacks here
        header: {
        left: 'prev,next today myCustomButton',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'

    },
    eventSources:[eventarray],
	eventOverlap:true,
    });
    $('#calendar').fullCalendar( 'changeView', 'agendaWeek');


});
function updateevent()
{
	var newevent=
        {
            title  : 'event4',
            start  : '2016-03-01'
        };
	eventarray={
    events: [
        {
            title: 'Event1',
            start: '2016-03-04T12:30:00',
            end:'2016-03-04T12:45:00',
        },
        {
            title: 'Event2',
            start: '2016-03-04T12:30:00',
               end:'2016-03-04T13:45:00',
        }
        // etc...
    ],

};
	console.log(eventarray);
	$('#calendar').fullCalendar('removeEvents');
	$('#calendar').fullCalendar('addEventSource', eventarray);
	$('#calendar').fullCalendar('rerenderEvents');
}
function isOverlapping(event){
    // "calendar" on line below should ref the element on which fc has been called
    var array = calendar.fullCalendar('clientEvents');
    for(i in array){
        if (event.end >= array[i].start && event.start <= array[i].end){
           return true;
        }
    }
    return false;
}

//for select use
function showconetnt(id)
{
	document.getElementById(id).style.display="inline";
	console.log("id is ");
	console.log(id);
	console.log("function called");
}
function hidecontent(id)
{
	console.log(document.getElementById(id).style.color);
	if(document.getElementById(id).style.color=="black"||document.getElementById(id).style.color==""){
	document.getElementById(id).style.display="none";}
	console.log("hide called");
}
function courseselect(id,date,time)
{
	console.log(id);
	console.log(" course get clicked");
	console.log("date is ");
	console.log(date);
	console.log("time is ");
	console.log(time);
	if(document.getElementById(id).style.color=="black"||document.getElementById(id).style.color=="")
	{
		document.getElementById(id).style.color="blue";}
	else {
		document.getElementById(id).style.color="black";
	}
}
function addintocourse()
{}
function deletecourse()
{}
</script>
<style>
	.clearFloat { clear: both; }

	#calendar
	{
		float:left;
		position:relative;
	}
	.course{
		position:relative;
		left: 5px;
		margin:20px;
		width:250px;
		float:left;



	}

	.lec
	{
		float:left;
		position:relative;
	}
	.tut
	{
		float:left;
		position:relative;
	}
	.tst
	{
		float:left;
		position:relative;
	}

	.lec:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.tut:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.tst:hover {
		background:rgba(0,0,100,0.5);
		transition: 0.2s;
	}
	.coursename{
		float:left;
		position:relative;
		left: 2px;
		width:400px;
		font-size: 15pt;
		font-weight:bold;


	}
	.coursenumber{
		float:left;
		position:relative;
		left: 2px;
		width: 125px;


	}
	.time{
		float:left;
		position:relative;
		left: 2px;
		width: 125px;


	}
	.location
	{
		margin-left: 125px;
		float:left;
		position:relative;
		left: 2px;
		width: 125px;
	}
	.else
	{
		margin-left: 125px;
		float:left;
		position:relative;
		left: 2px;
		width: 125px;
	}
	.hidden{
		display:none;
	}



</style>
</head>
<body>
<?php
$displaynumber=0;

$coursearray=$_SESSION['courses'];
//print_r($coursearray);
displaymain($coursearray);
function displaymain($coursearray)
{
//	echo "display main called ";
	global $displaynumber;
	foreach ($coursearray as $key => $value) {
		# code...
		?>
		<div class="course">
			<?php
			displaycourse($value);
			//$displaynumber++;
			?>
		</div>
		<?php
	}
}
function displaycourse($array)
{
	global $displaynumber;
	?>

	<div class="coursename">
		<?php
		$name= $array[0]['coursepre'].$array[0]['coursenumber'];
		echo $name;
		?>
	</div>
	<?php
	for($i=0;$i<sizeof($array);$i++){
		$displaynumber++;
		$tempcoursetype=$array[$i]['coursetype'];
		switch ($tempcoursetype) {
			case 'LEC':

			$value=$array[$i];
			$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
			$date=$value['coursedate'];
			?>
			<div class="lec" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" onclick="courseselect(<?php echo $displaynumber;?>,<?php echo "/".$date."/";?>,<?php echo "/".$time."/";?>)">
				<div class="coursenumber">
					<?php
					echo $tempcoursetype;
					echo "  ";
					echo sprintf("%03d", $value['courselecnum']);?>
				</div>
				<div class="time">
					<?php

					echo $time;
					echo "   ";

					echo $value['coursedate'];
					?>
				</div>
				<div id=<?php echo $displaynumber;?> class="hidden">
				<div class="location" >
					<?php
					echo "Campus: ";
					echo $value['courselocation'];
					echo "<br>";
					echo "Building name: ";
					echo $value['courselocationbuilding'];
					echo "<br>";
					echo "Room number: ";
					echo $value['courselocationbuildingroomnumber'];
					echo "<br>";?>
				</div>
				<div class="else" >
					<?php
					$temp=$value['courseinstructors'];
					echo "Instructor :  $temp";
					echo "<br>";
					$temp1=$value['enrollment_capacity'];
					$temp2=$value['enrollment_total'];
					$remain=$temp1-$temp2;
					echo "remaining seats : $remain";
					echo "<br>";
					$temp=$value['waiting_total'];
					echo "waiting list : $temp";?>
				</div>
				</div>
				<div class="clearFloat"></div>
			</div>

			<?php
			break;
			case 'TUT':

			$value=$array[$i];
			$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
			$date=$value['coursedate'];
			?>
			<div class="tut" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" onclick="courseselect(<?php echo $displaynumber;?>,<?php echo "/".$date."/";?>,<?php echo "/".$time."/";?>)">
				<div class="coursenumber">
					<?php
					echo $tempcoursetype;
					echo "  ";
					echo sprintf("%03d", $value['courselecnum']);?>
				</div>
				<div class="time">
					<?php

					echo $time;
					echo "   ";

					echo $value['coursedate'];
					?>
				</div>
			  <div id=<?php echo $displaynumber;?> class="hidden">
				<div class="location" >
					<?php
					echo "Campus: ";
					echo $value['courselocation'];
					echo "<br>";
					echo "Building name: ";
					echo $value['courselocationbuilding'];
					echo "<br>";
					echo "Room number: ";
					echo $value['courselocationbuildingroomnumber'];
					echo "<br>";?>
				</div>
				<div class="else" >
					<?php
					$temp=$value['courseinstructors'];
					echo "Instructor :  $temp";
					echo "<br>";
					$temp1=$value['enrollment_capacity'];
					$temp2=$value['enrollment_total'];
					$remain=$temp1-$temp2;
					echo "remaining seats : $remain";
					echo "<br>";
					$temp=$value['waiting_total'];
					echo "waiting list : $temp";?>
				</div>
			</div>
				<div class="clearFloat"></div>
			</div>
			<?php
			break;
			case 'TST':

			$value=$array[$i];
			$time=substr($value['coursetime'],0,5)."-".substr($value['coursetime'],-5);
								$date=$value['coursedate'];
			?>
			<div class="tst" onmouseover="showconetnt(<?php echo $displaynumber;?>)" onmouseout="hidecontent(<?php echo $displaynumber;?>)" >
				<div class="coursenumber">
					<?php
					echo $tempcoursetype;
					echo "  ";
					echo sprintf("%03d", $value['courselecnum']);?>
				</div>
				<div class="time">
					<?php

					echo $time;
					echo "   ";

					echo $value['coursedate'];
					?>
				</div>
				<div id=<?php echo $displaynumber;?> class="hidden">
				<div class="location" >
					<?php
					echo "Campus: ";
					echo $value['courselocation'];
					echo "<br>";
					echo "Building name: ";
					echo $value['courselocationbuilding'];
					echo "<br>";
					echo "Room number: ";
					echo $value['courselocationbuildingroomnumber'];
					echo "<br>";?>
				</div>
				<div class="else" >
					<?php
					$temp=$value['courseinstructors'];
					echo "Instructor :  $temp";
					echo "<br>";
					$temp1=$value['enrollment_capacity'];
					$temp2=$value['enrollment_total'];
					$remain=$temp1-$temp2;
					echo "remaining seats : $remain";
					echo "<br>";
					$temp=$value['waiting_total'];
					echo "waiting list : $temp";?>
				</div>
			</div>
				<div class="clearFloat"></div>
			</div>
			<?php
			break;


		}
	}




}
?>


<div id='calendar'></div>
<!<input type="button" onclick="updateevent()" value="Add new table">

</body>
</html>
