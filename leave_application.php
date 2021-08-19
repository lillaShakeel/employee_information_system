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
Add Leave Application
</div>
<div class="card-body">
<form method="post" enctype="multipart/form-data">
<label>From</label>
<input type="date" name="from" min="<?php echo date('Y-m-d');?>" required class="form-control mb-2">
<label>To</label>
<input type="date" name="to" min="<?php echo date('Y-m-d');?>" required class="form-control mb-2">
<label>Reason</label>
<textarea name="reason" required rows="4" class="form-control mb-2"></textarea>
<button type="submit" name="submit" class="btn btn-info mt-3">Save</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8">
<div class="card">
<div class="card-header">
View Leave Application
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>From&nbsp;Date</th>
<th>To&nbsp;Date</th>
<th>Posted&nbsp;Date</th>
<th>Reason</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from leave_application where employee_id='".$employee['emp_id']."'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo date('M d, Y',strtotime($row['from_date']));?></td>
<td><?php echo date('M d, Y',strtotime($row['to_date']));?></td>
<td><?php echo date('M d, Y',strtotime($row['posted_date']));?></td>
<td><?php echo $row['reason'];?></td>
<td><?php
if($row['status']=='pending'){
	echo "<i class='badge badge-warning'>Pending</i>";
}
else if($row['status']=='accept'){
	echo "<i class='badge badge-info'>Accepted</i>";
}
if($row['status']=='reject'){
	echo "<i class='badge badge-danger'>Rejected</i>";
}
 
 ?></td>
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
	$from=$_POST['from'];
	$to=$_POST['to'];
	$reason=$_POST['reason'];
	date_default_timezone_set("Asia/Karachi");
	$date=date('Y-m-d');
	$status="pending";
	$sql="insert into leave_application values('','".$employee['emp_id']."','$from','$to','$date','$reason','$status')";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='leave_application.php'
		alert('Leave Application Added Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='leave_application.php'
		alert('Sorry try again later')</script>";
	}
}
?>