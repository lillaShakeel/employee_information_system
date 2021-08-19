<?php
include_once "admin/dbc.php";
session_start();
if(!isset($_SESSION['employee'])){
	header('location:index.php');
}
$sql="select * from employee where emp_id='".$_SESSION['employee']."'";
$result=mysqli_query($con,$sql);
$employee=mysqli_fetch_array($result);


?>