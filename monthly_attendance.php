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

<div class="col-10">
<div class="card">
<div class="card-header">
Monthly Attendance
</div>
<div class="card-body">
<div class="row">
<div class="col-12">
<form method="post">
<label>Month:</label>
<div class="input-group mb-4">
<input type="month" name="month" class="form-control" required>
<div class="input-group-append">
<button type="submit" name="submit" class="input-group-text btn btn-info">View</button>
</div>
</div>
</form>
</div>
</div>
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
if(isset($_POST['submit'])){
$month=$_POST['month'];
}
else{
	$month=date('Y-m');	
}
$i=0;
$sql="select * from attendance where emp_id='".$employee['emp_id']."' AND (date_format(date,'%Y-%m')='$month' AND status='1')";
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