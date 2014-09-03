<?php
session_start();
$con=mysqli_connect("localhost","root","","Paper_Website");
$reviewers[] = array();
$count = 0;
foreach ($_GET['reviewers_to_assign'] as $selectedOption){
  $reviewers[$count] = $selectedOption;
  $count++;
}

$result = mysqli_query($con, "UPDATE `Paper_Website`.`Paper` SET `reviewers_assigned1` = " . $reviewers[0] . " WHERE `Paper`.`paperid` = ". $_SESSION['paper_selected_paperid']);
if($result == false){
	//error
}
else{
  $result = mysqli_query($con, "UPDATE `Paper_Website`.`Paper` SET `reviewers_assigned2` = " . $reviewers[1] . " WHERE `Paper`.`paperid` = ". $_SESSION['paper_selected_paperid']);
  if($result == false){
    //error
  }
  header('Location: Editor.php');
}
?>
