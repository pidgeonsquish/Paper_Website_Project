<?php
session_start();
$con=mysqli_connect("localhost","root","","Paper_Website");
$paperid = $_GET['decision'];
$result = mysqli_query($con, "UPDATE `Paper_Website`.`Paper` SET `status` = '$paperid' WHERE `Paper`.`paperid` = ". $_SESSION['paper_selected_paperid']);
if($result == false){
	//error
}
?>
