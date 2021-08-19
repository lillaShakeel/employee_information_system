<?php
include_once "session.php";
$id=$_REQUEST['id'];

$i=0;
$sql="select * from employee where dep_id='$id'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
	$emp_id[$i]=$row['emp_id'];
	$i++;
}

for($j=0;$j<$i;$j++){
	$sql="delete from attendance where emp_id='".$emp_id[$j]."'";
	$result=mysqli_query($con,$sql);
	$sql="delete from leave_application where employee_id='".$emp_id[$j]."'";
	$result=mysqli_query($con,$sql);
}
$sql="delete from employee where dep_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from department where dep_id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='department.php'
   	alert('Department Deleted Successfully');</script>";
	
}
else{
	
	echo "<script>window.location.href='department.php'
   	alert('Sorry try again later');</script>";
}
   

?>