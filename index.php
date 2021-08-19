<?php
session_start();
if(isset($_SESSION['employee'])){
	header('location:home.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Employee Information System</title>
<meta name="viewport" content="device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="section">
<div class="container">
<div class="row">
<div class="col-md-12">
<h2 class="text-center text-white">Employee Information System</h2>
</div>
<div class="col-md-5 m-auto">
<div class="card">
<div class="card-body">
<form method="post">
<label>Employee ID</label>
<input type="text" name="id" class="form-control mb-2">
<label>Password</label>
<input type="password" name="password" class="form-control mb-2">
<button type="submit" name="submit" class="btn btn-info mt-3">Login <i class="fa fa-sign-in"></i></button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
<?php
include_once "admin/dbc.php";
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$password=$_POST['password'];
	$sql="select * from employee where emp_id='$id' AND password='$password'";
	$result=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	if($row){
		$_SESSION['employee']=$id;
		header('location:home.php');
	}
	else{
		echo "<script>alert('Invalid employee ID or password')</script>";	
	}
	
	
}

?>