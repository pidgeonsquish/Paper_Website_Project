<?php
$con=mysqli_connect("localhost","root","","Paper_Website");
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$email = strtolower($_GET['email']);
$result = mysqli_query($con,"SELECT COUNT(`userid`) FROM `User`"); 
$row = mysqli_fetch_array($result);
$user_id = 10000 + $row['COUNT(`userid`)'];
$permission = 1;
if(!is_null($_GET['permission'])){
  $permission = 2;
}
$password = hash('md5', $_GET['password']);

$result = mysqli_query($con,"INSERT INTO `User`(`userid`, `lname`, `fname`, `email`, `password`, `permission`) VALUES ('$user_id','$lname','$fname','$email','$password','$permission')");

header('Location: index.php');
?>
