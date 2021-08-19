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
<div class="col-12">
<div class="card">
<div class="card-header">
View Leave Application
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>Employee&nbsp;ID</th>
<th>Name</th>
<th>Date</th>
<th>From&nbsp;Date</th>
<th>To&nbsp;Date</th>
<th>Reason</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select employee.emp_id, employee.name, leave_application.appk_id, leave_application.posted_date, leave_application.from_date, leave_application.to_date, leave_application.reason, leave_application.status from leave_application INNER JOIN employee on employee.emp_id=leave_application.employee_id";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $row['emp_id'];?></td>
<td><?php echo $row['name'];?></td>
<td><?php echo date('M d, Y',strtotime($row['posted_date']));?></td>
<td><?php echo date('M d, Y',strtotime($row['from_date']));?></td>
<td><?php echo date('M d, Y',strtotime($row['to_date']));?></td>
<td><?php echo $row['reason'];?></td>
<td><?php
if($row['status']=='pending'){
	echo "<i class='badge badge-warning'>Pending</i>";
	?>
    <form method="post">
  <input type="hidden" name="id" value="<?php echo $row['appk_id'];?>">
 <button type="submit" name="submit" value="accept" class="btn btn-sm btn-info mt-2">Accept</button>
 <button type="submit" name="submit" value="reject" class="btn btn-sm btn-danger mt-2">Reject</button>
 </form>
    
    <?php
}
else if($row['status']=='accept'){
	echo "<i class='badge badge-info'>Accepted</i>";
}
if($row['status']=='reject'){
	echo "<i class='badge badge-danger'>Rejected</i>";
}
 
 ?>
 </td>
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
	$status=$_POST['submit'];
	$id=$_POST['id'];
	$sql="update leave_application set status='$status' where appk_id='$id'";
	$result=mysqli_query($con,$sql);
	if($result){
		echo "<script>window.location.href='leave_application.php'
		alert('Leave Application Status Updated Successfully')</script>";
	}
	else{
		echo "<script>window.location.href='leave_application.php'
		alert('Sorry try again later')</script>";
	}
}
?>
