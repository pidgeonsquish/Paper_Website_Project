<?php 
session_start();
$con=mysqli_connect("localhost","root","","Paper_Website");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//$temp = explode('.', $_FILES['file']['name']); need to do something with file

$userid = $_SESSION['session_user_id'];
$title = $_POST['title'];


date_default_timezone_set('GMT');
$date = date("Y-m-d");
$result = mysqli_query($con,"SELECT COUNT(`paperid`) FROM `Paper`");
$row = mysqli_fetch_array($result);
$paperid = 10000 + $row['COUNT(`paperid`)'];


$paper_pdf = $title . $paperid;

move_uploaded_file($_FILES["file"]["tmp_name"],"pdf/" . $paper_pdf);

$result = mysqli_query($con,"INSERT INTO `Paper`(`userid`, `title`, `paperid`, `reviewers_assigned1`, `paper_pdf`, `status`, `reviewers_assigned2`, `date`) VALUES ('$userid','$title','$paperid',NULL,'$paper_pdf', 0,NULL, '$date')");



header('location: Author.php');


?>
