<?php
include_once "session.php";
require 'PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;


$id=$_REQUEST['id'];
$sql="select * from employee where emp_id='$id'";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_array($result);




//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'junaidqazi6438@gmail.com';                 // SMTP username
$mail->Password = 'mute.6438.#';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('junaidqazi6438@gmail.com', 'Junaid Ahmad');
$mail->addAddress($row['email'], $row['name']);     // Add a recipient 
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Employee Information System';
$mail->Body    = '<b>Dear '.$row['name'].' your login credentials is:<br>Employee ID:</b> '.$row['emp_id'].'<br><b>Password:</b> '.$row['password'].'';
$mail->AltBody = '<b>Dear '.$row['name'].' your login credentials is:<br>Employee ID:</b> '.$row['emp_id'].'<br><b>Password:</b> '.$row['password'].'';
	if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo "<script>window.location.href='employee.php'
   alert('Employee Login Credentials Sent Successfully');</script>";
}

?>