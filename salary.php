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
Employee Monthly Salary
</div>
<div class="card-body">
<?php
$sql="select department.dep_id, department.dep_name, leaves.id, leaves.pay_scale, employee.emp_id, employee.name, employee.gender, employee.salary, employee.created_on from employee inner join department ON department.dep_id=employee.dep_id INNER JOIN leaves on leaves.id=employee.scale_id where emp_id='".$employee['emp_id']."'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);
?>
<button class="btn btn-info float-right mb-3" onClick="printsalary('table')">Print</button>
<div class="table-responsive" id="table">
<table class="table table-bordered">
<tr>
<th>Employee ID</th>
<td><?php echo $row['emp_id'];?></td>
</tr>
<th>Employee Name</th>
<td><?php echo $row['name'];?></td>
</tr>
<th>Department</th>
<td><?php echo $row['dep_name'];?></td>
</tr>
<tr>
<th>Pay Scale</th>
<td><?php echo $row['pay_scale'];?></td>
</tr>
<th>Net Pay</th>
<td>Rs. <?php echo $row['salary'];?></td>
</tr>
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
function printsalary(e1){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(e1).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML=restorepage;
}

</script>