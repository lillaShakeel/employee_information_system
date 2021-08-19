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
Manage Account
</div>
<div class="card-body">
<form method="post">
<label>Name</label>
<input type="text" name="name" value="<?php echo $admin['name'];?>" required class="form-control mb-2">
<label>Username</label>
<input type="text" name="username" value="<?php echo $admin['username'];?>" required class="form-control mb-2">
<label>Email</label>
<input type="email" name="email" value="<?php echo $admin['email'];?>" required class="form-control mb-2">
<label>Password</label>
<input type="password" name="password" value="<?php echo $admin['password'];?>" required class="form-control mb-2">
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
	$username=$_POST['username'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$_SESSION['admin']=$username;
	$sql="update admin set name='$name', username='$username', email='$email', password='$password' where id='".$admin['id']."'";
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