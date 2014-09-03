<?php
$profpic = "images/sign-up-btn.gif";
session_start();
if(!isset($_SESSION['session_user_id']) || !isset($_SESSION['permission']) || trim($_SESSION['permission']) != '0'){
	header('location: index.php');
}
// Create connection

$con=mysqli_connect("localhost","root","","Paper_Website");

function does_not_have_reviewers($arg_1, $arg_2){
  $con=mysqli_connect("localhost","root","","Paper_Website"); 
  $result = mysqli_num_rows(mysqli_query($con,"SELECT `reviewers_assigned1` FROM `Paper` WHERE `paperid` = '$arg_1' or `paperid` = '$arg_2'"));     
  return $result == 0;
}
?>
<?php

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$paper_reviewers_already_assigned = 0;
$paper_selected_comments = 0;
$paper_selected_download = 0;
$paper_selected_author = 0;
if (isset($_POST['comments'])) {
    $paper_selected_comments = $_POST['all_papers'];
    $_SESSION['paper_selected_paperid'] = $_POST['all_papers'];
    unset($_POST['comments']);    
  }
if (isset($_POST['download'])) {
    $paper_selected_download = $_POST['all_papers'];
    //include_file "afdsfadsfadsafdsdfasfdsa.php";//I assume you can use this to call and download a paper.
    unset($_POST['download']);    
  }
if (isset($_POST['reviewers'])) {
    $paper_selected_author = $_POST['all_papers'];
    $_SESSION['paper_selected_paperid'] = $_POST['all_papers'];
    unset($_POST['reviwers']);    
  }
?>

<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="jquery-1.11.0.js"></script>
<script type="text/javascript"> 
$().ready(function() {

 $('#add').click(function() {  
  if(($('#reviewers_to_assign option').size() < 3) && ($('#reviewers_select option:selected').size() < 3)){
    if(($('#reviewers_to_assign option').size() <2 ) && ($('#reviewers_select option:selected').size() < 2)){
      !$('#reviewers_select option:selected').remove().appendTo('#reviewers_to_assign');
      if($('#reviewers_to_assign option').size() == 2){
         $('#confirm_reviewers').removeAttr("disabled");
      }
      return $("#reviewers_to_assign option:selected").prop("selected", false);
    } 
  }
 });

 $('#remove').click(function() {
  $('#confirm_reviewers').attr("disabled", "disabled");
  return !$('#reviewers_to_assign option:selected').remove().appendTo('#reviewers_select');
 });

 $("input[name='all_papers']").click(function() {  
    $('#download').removeAttr("disabled");
    if($(this).attr('id') == "0"){  
      $('#reviewers').removeAttr("disabled");  
    } 
    else{
      $('#reviewers').attr("disabled", "disabled");
    }   
    $('#comments').removeAttr("disabled"); 
   });

 $('#confirm_reviewers').click(function() {
   $('#reviewers_to_assign option').prop('selected', true);
  });
  $('#logout').click(function() {  
    window.location.href = "logout.php";
 });
});

</script>
</head>

<style>
table,th,td
{
border:1px solid black;
}
</style>

<body>
	<div class = "AuthorDiv" style="float: left;bottom:-50px">
		<label style="left: 27%;"> Editor Page </label>
		<input type="button" id="logout" value="Logout" style="float: right;">
	</div>
	<div class = "AuthorDiv" style="float: left;">
		<div class = "EditorDiv2" style="float: left; bottom: 10px">
			<form action="" method="post">
			<table class="tablesmall" style="float: left; position:relative; width:100%;">
				<th COLSPAN="6">
					<h3><br>All Papers</h3>
				</th>
				<tr>
					<td width="30%">Title</td>
					<td width="15%">Author</td>
					<td width="15%">Date Submitted</td>
					<td width="15%">Reviewers Assigned</td>
					<td width="15%">Status Assigned</td>
					<td width="10%">Selected</td>

				<?php  $result = mysqli_query($con,"SELECT * FROM `Paper`,`User` WHERE `Paper`.`userid` = `User`.`userid`");

				        while($row = mysqli_fetch_array($result)){ ?>
					  <tr>
					    <td><?php echo $row['title'];?></td>
					    <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
					    <td><?php echo $row['date'];?></td>
					    <td name='reviewer_assigned'><?php switch ($row['reviewers_assigned1']){
								case 0:
								  echo "NO";								  
								  break;
								default:
								  echo "Yes";
								  $reviewers_already_assigned = 1;
								} ?></td>
					    <td><?php switch ($row['status']){
								case 1:
								  echo "approved";
								  break;
								case 2:
								  echo "rejected";
								  break;
								default:
								  echo "pending";
								} ?></td>
						<td>
							<input type="radio"<?php if(($row['paperid'] == $paper_selected_comments) or ($paper_selected_author == $row['paperid']) or ($paper_selected_download == $row['paperid'])){echo "checked";}?> name="all_papers" id=<?php if(is_null($row['reviewers_assigned1'])){echo "0";}else{echo "1";}; ?> value=<?php echo $row['paperid']; ?>><br>							
						</td>
					  </tr>
					<?php } ?>				
			
			</table>			
				<input type="submit"<?php if(($paper_selected_comments == 0) and ($paper_selected_download == 0) and ($paper_selected_author == 0)){echo "Disabled";}?> id='download' value="Download" name='download'>
				<input type="submit"<?php if(($paper_selected_comments == 0) and ($paper_selected_download == 0) and ($paper_selected_author == 0)){echo "Disabled";}?> value="View Comments" id='comments' name='comments'>
				<input type="submit"<?php if((($paper_selected_comments == 0) and ($paper_selected_download == 0) and ($paper_selected_author == 0))){echo "Disabled";}?> value="Assign Reviewers" id='reviewers' name='reviewers'>
			</form>
			<form action="Update_Status.php" method="get">
			<table class="tablesmall" style="float: left; position:relative; table-layout: fixed;">
				<tr>
					<th COLSPAN="3"><h3>Reviewer Comments</h3>
					</th>
				</tr>
				<tr>
					<th width="20%">Reviewer</th>
					<th width="10%">Rating</th>
					<th width="70%">Comment</th>
				</tr>
				<tr ALIGN="CENTER">
				<?php $review = mysqli_query($con,"SELECT * FROM `User`,`Reviews` WHERE `User`.`userid` = `Reviews`.`userid` and `Reviews`.`paperid` = " . $paper_selected_comments); 
				        while($row = mysqli_fetch_array($review)){?>
					  <tr>
					    <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
					    <td><?php echo $row['rating'];?></td>
					    <td style="word-wrap: break-word"><?php echo $row['comment'];?></td>
					  </tr>
					<?php } ?>
			</table>	
                                <label>Accept Paper </label><input type="radio" value="1" name='decision'>
                                <label> Reject Paper </label><input type="radio" value="2" name='decision'>		
				<input type="submit"<?php if(mysqli_num_rows($review) != 2){echo "disabled";} ?> value="Confirm" name='status'>
			</form>
		</div>
                <div class="AuthorDiv3" style="<?php if($paper_selected_author == 0){echo "visibility:hidden;";}?>float: left; position: relative; bottom: 10px">
		<div class="EditorDiv" style="float: left; left:2px; bottom: 20px">		
				<label class="table" style="float: left; position:relative; width:100%">Reviewers</label>
				<select multiple id="reviewers_select" class="table" size=15 style="float: left; position:relative; width:100%">				
				<?php  
					$result = mysqli_query($con, "SELECT `userid` FROM `Paper` WHERE `paperid` = " . $paper_selected_author);
					$author_userid = 0;
					while($row = mysqli_fetch_array($result)){
						$author_userid = $row['userid'];
					}
					$result = mysqli_query($con,"SELECT * FROM `User` WHERE `permission` = 2 and `userid` != " . $author_userid);
				        while($row = mysqli_fetch_array($result)){ ?>					  
					    <option value=<?php echo $row['userid']; ?>><?php echo $row['fname'] . " " . $row['lname'];?></option>					
					<?php } ?>
				</select>						
		</div>		
			<input style="float: left; position:relative; bottom: -250px; left: 15px; text-align:center" type="button" value=">" id="add">		
			<input style="float: left; position:relative; bottom: -280px; right: 13px; text-align:center" type="button" value="<" id="remove">
		
		<div class="EditorDiv" style="float: left; left:2px; bottom: 20px">		
			<form name="input" action="Assign_Reviewers.php" method="get" name="selected_reviewers"> <!-- this is where the reviewers submission php file goes -->
			  <label class="table" style="float: left; position:relative; width:100%">Reviewers to Assign</label>
			  <select multiple name="reviewers_to_assign[]" id='reviewers_to_assign' class="table" size=15 style="float: left; position:relative; width:100%">	
			  </select>			
		          <input type="submit"Disabled id='confirm_reviewers' style="position: relative; left: 27%; bottom: -10px;"value="Confirm Reviewers">
			</form>
		</div>
	</div>
        </div>	
</body>
