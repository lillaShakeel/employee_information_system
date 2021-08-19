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
Mark Attendance
</div>
<div class="card-body">
<form method="post">
<label>Mark Attendance</label>
<select name="status" required class="form-control mb-2">
<option value="">- Select -</option>
<option value="in">Time In</option>
<option value="out">Time Out</option>
</select>
<button type="submit" name="submit" class="btn btn-info mt-3">Mark</button>
<button type="reset" class="btn btn-light mt-3 ml-2">Cancel</button>
</form>
</div>
</div>
</div>

<div class="col-8">
<div class="card">
<div class="card-header">
View Attendance
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Time In</th>
<th>Time Out</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND status='1'";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo date('M d, Y',strtotime($row['date']));?></td>
<td><?php echo date('h:i A',strtotime($row['time_in']));?></td>
<td><?php echo date('h:i A',strtotime($row['time_out']));?></td>
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
	$status=$_POST['status'];
	date_default_timezone_set("Asia/Karachi");
	$date=date('Y-m-d');
	$time=date('H:i:s');
	if($status=='in'){
		$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND date='$date'";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
			echo "<script>alert('You already time in')</script>";
		}
		else{
		$status=0;
		$sql="insert into attendance values('','".$employee['emp_id']."','$date','$time','$status','')";
		$result=mysqli_query($con,$sql);
		if($result){
			echo "<script>window.location.href='attendance.php'
			alert('You time in Successfully')</script>";
					}
		else{
			echo "<script>window.location.href='attendance.php'
			alert('Sorry try again later')</script>";
			}
		}
		
	}
	else if($status=='out'){
		$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND date='$date'";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)<1){
			echo "<script>alert('Please time in first')</script>";
		}
		else{
		$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND (date='$date' AND status='1')";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
			echo "<script>alert('You already time out')</script>";
		}
		else{
		$status=1;
		$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND (date='$date' AND time_out='00:00:00')";
		$result=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($result);
		$sql="update attendance set status='$status', time_out='$time' where id='".$row['id']."'";
		$result=mysqli_query($con,$sql);
		if($result){
			echo "<script>window.location.href='attendance.php'
			alert('You time out Successfully')</script>";
					}
		else{
			echo "<script>window.location.href='attendance.php'
			alert('Sorry try again later')</script>";
			}
			
		}
			
			
		}
		
		
	}
}
?>