<?php
// Create connection
$con=mysqli_connect("localhost","root","","Paper_Website");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else{
    echo "success asshole";
    echo "<br>";
  }
date_default_timezone_set('GMT');
$date = date("Y-m-d");
echo $date;
$result = mysqli_query($con,"UPDATE `Paper_Website`.`Reviews` SET `date_reviewed` = '$date' WHERE `Reviews`.`reviewid` = 54322;"); 
echo mysqli_num_rows(mysqli_query($con,"SELECT `reviewers_assigned1` FROM `Paper` WHERE `paperid` = 11111 or `paperid` = 0"));
//$paper_selected = 0;
//if (isset($_POST['view_comments'])) {
    //$paper_selected = $_POST['papers'];
    //unset($_POST['view_comments']);    
 // }
//echo $paper_selected;
?>
<!--
			<form action="" method="post">
				<table class="table" style="position:relative; width:100%;">
					<th COLSPAN="4">
						<h3><br>Your Posted</h3>
					</th>
					<tr>
						<td width="60%">Title</td>
						<td width="15%">Date</td>
						<td width="15%">Status</td>
						<td width="10%">Selected</td>					
					<?php $result = mysqli_query($con,"SELECT * FROM `Paper` WHERE `userid` = 12345");
					      $counter = 0;
						while($row = mysqli_fetch_array($result)){ ?>
						  <tr>						
  							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['date']; ?></td>		
							<td><?php switch ($row['status']){
									case 1:
									  echo "approved";
									  break;
									case 2:
									  echo "rejected";
									  break;
									default:
									  echo "pending";
									} ?> </td>
							<td>							
								<input name= "papers" value= <?php echo $row['paperid']; ?> type="radio"><br>							
							</td>
						  </tr>
 						 <?php 
							$counter++;		
							} ?>										
				</table>
				<input type = 'submit' name = 'view_comments' value = "View Reviews">
			</form>

<div class="AuthorDiv2" style="float: left; left:2px; bottom: 10px">
			<table class="table" style="position:relative; width:100%">
				<tr>
					<th COLSPAN="3"><h3>Reviewer Comments</h3>
					</th>
				</tr>
				<tr>
					<th width="20%">Reviewer</th>
					<th width="10%">Rating</th>
					<th width="70%">Comment</th>
				</tr>
				<?php 
					if($paper_selected != 0){

					$reviewers[] = array();
					$count = 0;
					$getReviewers = mysqli_query($con, "SELECT `paperid`,`reviewers_assigned1`,`reviewers_assigned2` FROM `Paper` WHERE `paperid` = " . $paper_selected);
					while($row = mysqli_fetch_array($getReviewers)){
						$reviewers[0] = $row['reviewers_assigned1'];
						$reviewers[1] = $row['reviewers_assigned2'];
					}				
					$review = mysqli_query($con,"SELECT * FROM `Reviews`,`User` WHERE `Reviews`.`written_to` = 12345 and `Reviews`.`paperid` = ". $paper_selected ." and ((`Reviews`.`userid` = " . $reviewers[0] . " and `User`.`userid` = " . $reviewers[0] . ") or (`Reviews`.`userid` = " . $reviewers[1] . " and `User`.`userid` = " . 								       $reviewers[1] . "))"); 
				        while($row = mysqli_fetch_array($review)){?>
					  <tr>
					    <td><?php echo $row['fname'] . " " . $row['lname'];?></td>
					    <td><?php echo $row['rating'];?></td>
					    <td><?php echo $row['review'];?></td>
					  </tr>
					<?php   }
					      } ?> 		
				
			</table>
		</div>-->
<!-- SELECT * FROM `Reviews`,`User`,`Paper` WHERE `Reviews`.`written_to` = 12345 and `User`.`userid` != 12345 and `Paper`.`userid` != 12345 and `Reviews`.`paperid` = 11111 and ((`Paper`.`reviewers_assigned1` = `Reviews`.`userid`) or (`Paper`.`reviewers_assigned2` = `Reviews`.`userid`))-->
