<?php

session_start();
ob_start();

$con=mysqli_connect("localhost","root","","Paper_Website");
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$myusername = strtolower($_POST['myusername']);
$mypassword = $_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = hash('md5', $mypassword);


$result = mysqli_query($con,"SELECT * FROM `User` WHERE `email` = '$myusername'");
while($row = mysqli_fetch_array($result)){
	if(is_null($row['userid'])){
	  header('Location: index.php'); //failed attempt to login username not found		
	}
        if($row['password'] != $mypassword){
	  header('Location: index.php');	
	}
	else{
	  session_regenerate_id();
	  $_SESSION['session_user_id'] = $row['userid']; 
	  $_SESSION['session_user_name'] = $row['email'];
	  $_SESSION['permission'] = $row['permission'];
	  $permission = $row['permission'];
	  switch($permission)
	  {
		case 0:
			header('Location: Editor.php');
			break;
		case 1:
			header('Location: Author.php');
			break;
		case 2:
			header('Location: Reviewer.php');
			break;
		default:
			header('Location: index.php');
	  }
        }
}

?>
