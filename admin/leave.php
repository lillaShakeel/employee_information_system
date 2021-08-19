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
Add Leave
</div>
<div class="card-body">
<form method="post">
<label>Pay Scale</label>
<input type="number" name="scale" required class="form-control mb-2">
<label>Total Leave</label>
<input type="number" name="leave" required class="form-control mb-2">
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8">
<div class="card">
<div class="card-header">
View Leave
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Pay Scale</th>
<th>Leave</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from leaves";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $row['pay_scale'];?></td>
<td><?php echo $row['leaves'];?></td>
<td><a href="update_leave.php?id=<?php echo $row['id'];?>"><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></a></td>
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
	$scale=$_POST['scale'];
	$leave=$_POST['leave'];
	$sql="insert into leaves values('','$scale','$leave')";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='leave.php'
		alert('Leave Added Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='leave.php'
		alert('Sorry try again later')</script>";
	}
}
?>