<?php
session_start();
$con=mysqli_connect("localhost","root","","Paper_Website");

$result = mysqli_query($con,"SELECT * FROM `Paper` WHERE `Paper`.`paperid` = " . $_SESSION['paper_selected_review']);
$paper_row = mysqli_fetch_array($result);
$written_by = $paper_row['userid'];

$result = mysqli_query($con,"SELECT COUNT(`reviewid`) FROM `Reviews`"); 
$row = mysqli_fetch_array($result);
$review_id = 10000 + $row['COUNT(`reviewid`)'];

date_default_timezone_set('GMT');
$date = date("Y-m-d");
$review = $_GET['review'];
$comment = $_GET['comment'];
$rating = $_GET['rating'];
$userid = $_SESSION['session_user_id'];
$paperid = $_SESSION['paper_selected_review'];


$result = mysqli_query($con,"INSERT INTO `Reviews`(`reviewid`, `rating`, `written_to`, `review`, `comment`, `userid`, `paperid`, `date_reviewed`) VALUES ('$review_id', '$rating' ,'$written_by','$review', '$comment','$userid','$paperid','$date')");

header('Location: Reviewer.php');
?>
