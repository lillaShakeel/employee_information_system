<?php
include_once "header.php";
?>
<div class="container-fluid">
<div class="row">
<?php
include_once "navbar.php";
?>
<div class="col-10 data-container">
<div class="card">
<div class="card-body">
Welcome Back <?php echo $employee['name'];?>!
<hr>
<?php
date_default_timezone_set("Asia/Karachi");
$year=date('Y');
$sql="select leaves from leaves INNER JOIN employee ON leaves.id=employee.scale_id where emp_id='".$employee['emp_id']."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
$total=$row['leaves'];
$sql="select * from leave_application where employee_id='".$employee['emp_id']."' AND (date_format(posted_date,'%Y')='$year' AND (status='pending' OR status='accept'))";
$result=mysqli_query($con,$sql);
$a=0;
while($row=mysqli_fetch_array($result)){
$days=strtotime($row['to_date'])-strtotime($row['from_date']);
$days=($days+86400)/86400;
$a+=$days;
}
?>
Your Available Leave <i class="badge badge-info badge-pill"><?php echo $total-$a;?></i>
</div>
</div>
</div>
</div>
</div>
</body>
</html>