<?php
session_start();
if(!(isset($_SESSION['permission']))){
	header('location: index.php');
}
$con=mysqli_connect("localhost","root","","Paper_Website");
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$paperid = $_SESSION['paper_selected_download'];

$result = mysqli_query($con, "SELECT * FROM `Paper` WHERE `paperid` = '$paperid'");

$row = mysqli_fetch_array($result);
if(!is_null($row)){
	
	$file_name = $_SERVER['DOCUMENT_ROOT'] . '/paper/pdf/' . $row['paper_pdf']; //change the middle part to what it is on your computer 
	if(file_exists($file_name)){

		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Length: ' . filesize($file_name));
		readfile($file_name);
	}
	
}

?>
