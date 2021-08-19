<?php
include_once "session.php";
$id=$_REQUEST['id'];
$sql="delete from attendance where emp_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from leave_application where employee_id='$id'";
$result=mysqli_query($con,$sql);
$sql="delete from employee where emp_id='$id'";
$result=mysqli_query($con,$sql);
if($result){
	echo "<script>window.location.href='employee.php'
   	alert('Employee Record Deleted Successfully');</script>";
	
}
else{
	
	echo "<script>window.location.href='employee.php'
   	alert('Sorry try again later');</script>";
}
   

?>