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
View Attendance
</div>
<div class="card-body">
<div class="table-responsive">
<table id="data" class="table table-bordered table-hover">
<thead>
<tr>
<th>Employee&nbsp;ID</th>
<th>Name</th>
<th>Date</th>
<th>Time&nbsp;In</th>
<th>Time&nbsp;Out</th>
</tr>
</thead>
<tbody>
<?php
$i=0;
$sql="select employee.emp_id, employee.name, attendance.date, attendance.time_in, attendance.time_out from employee INNER JOIN attendance on employee.emp_id=attendance.emp_id AND attendance.status=1";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
$i++;
?>
<tr>
<td><?php echo $row['emp_id'];?></td>
<td><?php echo $row['name'];?></td>
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
