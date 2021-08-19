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
<?php
$id=$_REQUEST['id'];
$sql="select department.dep_id, department.dep_name, leaves.id, leaves.pay_scale, employee.emp_id, employee.name, employee.email, employee.gender, employee.salary, employee.created_on from employee inner join department ON department.dep_id=employee.dep_id INNER JOIN leaves on leaves.id=employee.scale_id where emp_id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
?>
<form method="post" enctype="multipart/form-data">
<label>Employee Name</label>
<input type="text" name="name" value="<?php echo $row['name'];?>" required class="form-control mb-2">
<label>Email</label>
<input type="email" name="email" value="<?php echo $row['email'];?>" required class="form-control mb-2">
<label>Department</label>
<select name="department" required class="form-control mb-2">
<option value="<?php echo $row['dep_id'];?>"><?php echo $row['dep_name'];?></option>
<?php
$sql1="select * from department";
$result1=mysqli_query($con,$sql1);
while($row1=mysqli_fetch_array($result1)){
?>
<option value=<?php echo $row1['dep_id'];?>""><?php echo $row1['dep_name'];?></option>
<?php } ?>
</select>
<label>Scale</label>
<select name="scale" required class="form-control mb-2">
<option value="<?php echo $row['id'];?>"><?php echo $row['pay_scale'];?> Scale</option>
<?php
$sql1="select * from leaves";
$result1=mysqli_query($con,$sql1);
while($row1=mysqli_fetch_array($result1)){
?>
<option value=<?php echo $row1['id'];?>""><?php echo $row1['pay_scale'];?> Scale</option>
<?php } ?>
</select>
<label>Monthly Salary</label>
<input type="number" name="salary" value="<?php echo $row['salary'];?>" required class="form-control mb-2">
<label>Gender</label>
<select name="gender" required class="form-control mb-2">
<option value="Male" <?php if($row['gender']=='Male') echo "selected";?>>Male</option>
<option value="Female" <?php if($row['gender']=='Female') echo "selected";?>>Female</option>
</select>
<button type="submit" name="submit" class="btn btn-info mt-3">Update</button>
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
<td><?php echo $row['emp_id'];?></td>
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
	$name=$_POST['name'];
	$email=$_POST['email'];
	$department=$_POST['department'];
	$scale=$_POST['scale'];
	$salary=$_POST['salary'];
	$gender=$_POST['gender'];
	$sql="update employee set dep_id='$department', scale_id='$scale', name='$name', email='$email', salary='$salary', gender='$gender' where emp_id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='employee.php'
		alert('Employee Updated Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='employee.php'
		alert('Sorry try again later')</script>";
	}
}
?>