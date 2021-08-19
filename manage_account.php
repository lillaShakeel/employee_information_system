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
<div class="col-6">
<div class="card">
<div class="card-header">
Manage Account
</div>
<div class="card-body">
<form method="post" enctype="multipart/form-data">
<label>Name</label>
<input type="text" name="name" value="<?php echo $employee['name'];?>" required class="form-control mb-2">
<label>Email</label>
<input type="email" name="email" value="<?php echo $employee['email'];?>" required class="form-control mb-2">
<label>Password</label>
<input type="password" name="password" value="<?php echo $employee['password'];?>" required class="form-control mb-2">
<label>Gender</label>
<select name="gender" required class="form-control mb-2">
<option value="Male" <?php if($employee['gender']=='Male') echo "checked"; ?>>Male</option>
<option value="Female" <?php if($employee['gender']=='Female') echo "checked"; ?>>Female</option>
</select>
<label>Image</label>
<input type="file" name="img" class="form-control">
<span>Choose image if you want to update</span><br>
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8">

</div>

</div>

</div>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$gender=$_POST['gender'];
	if(isset($_FILES['img']['name'])){
		move_uploaded_file($_FILES['img']['tmp_name'],"image/".$_FILES['img']['name']);
		$img=$_FILES['img']['name'];
	}
	if($img==''){
		$img=$employee['img'];
	}
	$sql="update employee set name='$name', email='$email', password='$password', gender='$gender', img='$img' where emp_id='".$employee['emp_id']."'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='manage_account.php'
		alert('Profile Update Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='manage_account.php'
		alert('Sorry try again later')</script>";
	}
}
?>