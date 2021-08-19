<?php
include_once "header.php";
?>
<div class="container-fluid">
<div class="row">
<?php
include_once "navbar.php";
?>
<div class="col-10 data-container">

<div class="row">
<div class="col-4">
<div class="card">
<div class="card-header">
Add Employee
</div>
<div class="card-body">
<form method="post" enctype="multipart/form-data">
<label>Employee ID</label>
<input type="text" name="id" required class="form-control mb-2">
<label>Employee Name</label>
<input type="text" name="name" required class="form-control mb-2">
<label>Email</label>
<input type="email" name="email" required class="form-control mb-2">
<label>Department</label>
<select name="department" required class="form-control mb-2">
<option value="">- Select -</option>
<?php
$sql="select * from department";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
?>
<option value=<?php echo $row['dep_id'];?>""><?php echo $row['dep_name'];?></option>
<?php } ?>
</select>
<label>Scale</label>
<select name="scale" required class="form-control mb-2">
<option value="">- Select -</option>
<?php
$sql="select * from leaves";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
?>
<option value=<?php echo $row['id'];?>""><?php echo $row['pay_scale'];?> Scale</option>
<?php } ?>
</select>
<label>Monthly Salary</label>
<input type="number" name="salary" required class="form-control mb-2">
<label>Gender</label>
<select name="gender" required class="form-control mb-2">
<option value="">- Select -</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
<label>Image</label>
<input type="file" name="img" required class="form-control mb-2">
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8">
<div class="card">
<div class="card-header">
View Employee
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>Employee&nbsp;ID</th>
<th>Name</th>
<th>Department</th>
<th>Gender</th>
<th>Created&nbsp;On</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select department.dep_name, employee.emp_id, employee.name, employee.gender, employee.created_on from employee inner join department ON department.dep_id=employee.dep_id";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $row['emp_id'];?>
<a href="share_credentials.php?id=<?php echo $row['emp_id'];?>"><i class="badge badge-info">Share Credentials</i></a>
</td>
<td><?php echo $row['name'];?></td>
<td><?php echo $row['dep_name'];?></td>
<td><?php echo $row['gender'];?></td>
<td><?php echo $row['created_on'];?></td>
<td><a href="update_employee.php?id=<?php echo $row['emp_id'];?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a><a href="delete_employee.php?id=<?php echo $row['emp_id'];?>"><button class="btn btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></button></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</body>
</html>
<script>
$(document).ready(function(){
$('#data').DataTable();
});
</script>
<?php
if(isset($_POST['submit'])){
	function password_generate($chars){
		$data='1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		return substr(str_shuffle($data),0,$chars);
		
	}
	$id=$_POST['id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$department=$_POST['department'];
	$scale=$_POST['scale'];
	$salary=$_POST['salary'];
	$gender=$_POST['gender'];
	$password=password_generate(8);
	move_uploaded_file($_FILES['img']['tmp_name'],"../image/".$_FILES['img']['name']);
	$img=$_FILES['img']['name'];
	date_default_timezone_set("Asia/Karachi");
	$date=date('Y-m-d');
	$sql="insert into employee values('$id','$department','$scale','$name','$email','$salary','$gender','$password','$img','$date')";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='employee.php'
		alert('Employee Added Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='employee.php'
		alert('Sorry try again later')</script>";
	}
}
?>