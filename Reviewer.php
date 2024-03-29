<?php
  $profpic = "images/sign-up-btn.gif";
  session_start();
  if(!isset($_SESSION['session_user_id']) || !isset($_SESSION['permission']) || trim($_SESSION['permission']) != '2'){
    header('location: index.php');
  }
?>
<?php
  // Create connection
  $con=mysqli_connect("localhost","root","","Paper_Website");

  // Check connection
  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $paper_selected_download = 0;
  $paper_selected_review = 0;
  $paper_selected_comments = 0;
  if (isset($_POST['Download'])) {
    $paper_selected_download = $_POST['awaiting_papers'];
    $_SESSION['paper_selected_download'] = $_POST['awaiting_papers'];
    header("location: download.php");
    unset($_POST['Download']);    
  }
  if (isset($_POST['Review'])) {
    $paper_selected_review = $_POST['awaiting_papers'];
    $_SESSION['paper_selected_review'] = $_POST['awaiting_papers'];
    unset($_POST['Review']);    
  }
  if (isset($_POST['comments'])) {
    $paper_selected_comments = $_POST['completed_papers'];
    unset($_POST['comments']);  
  }
?>

<head>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <script src="jquery-1.11.0.js"></script>
  <script type="text/javascript"> 
  $().ready(function() {
    $('#to_author').click(function() {  
      window.location.href = "Author.php";
   });
  $('#logout').click(function() {  
    window.location.href = "logout.php";
   });
  $("input[name='completed_papers']").click(function() {  
    $('#comment').removeAttr("disabled");
   });
  $("input[name='awaiting_papers']").click(function() {  
    $('#download').removeAttr("disabled");  
    $('#review').removeAttr("disabled");  
   });
  
  });
  </script>
</head>

<style>
  table,th,td{
    border:1px solid black;
  }
</style>

<body>	
  <div class = "AuthorDiv" style="float: left;bottom:-50px;">
    <input type="button" id="to_author" value="To Author Page" style="float: left;">
    <label style="left: 27%;"> Reviewer Page </label>
    <input type="button" id="logout" value="Logout" style="float: right;">
  </div>
  <div class = "AuthorDiv" style="float: left;"> 
      <div class = "AuthorDiv2" style="float: left; bottom: 10px">
        <form action="" method="post">
          <table class="tablesmall" style="position:relative; width:100%;">
            <th COLSPAN="4">
              <h3><br>Awaiting Review</h3>
            </th>
            <tr>
              <td width="60%">Title</td>
              <td width="15%">Date</td>					
              <td width="10%">Selected</td>
              <?php  $result = mysqli_query($con,"SELECT * FROM (SELECT * FROM `Paper` WHERE `Paper`.`paperid` NOT IN(SELECT `Paper`.`paperid` FROM `Reviews`,`Paper` WHERE `Paper`.`paperid` = `Reviews`.`paperid` and `Reviews`.`userid` = ". $_SESSION['session_user_id'] . ")) tab WHERE "."((tab.`reviewers_assigned1` = " . $_SESSION['session_user_id'] . ") or (tab.`reviewers_assigned2` = " . $_SESSION['session_user_id'] . "))");
                     while($row = mysqli_fetch_array($result)){ ?>
                       <tr>
                         <td><?php echo $row['title'];?></td>
                         <td><?php echo $row['date'];?></td>
                         <td>						
                           <input type="radio"<?php if(($row['paperid'] == $paper_selected_comments) or ($paper_selected_review == $row['paperid']) or ($row['paperid'] == $paper_selected_download)){echo "checked";}?> name="awaiting_papers" id='awaiting_review' value=<?php echo $row['paperid']; ?>><br>							
                         </td>
                       </tr>
              <?php } ?>				
          </table>
            <input type="submit"<?php if(($paper_selected_review == 0) and ($paper_selected_download == 0)){echo "Disabled";}?> value="Download" id='download' name = 'Download'>
            <input type="submit"<?php if(($paper_selected_review == 0) and ($paper_selected_download == 0)){echo "Disabled";}?> value="Review" id='review' name = 'Review'>
        </form>	
        <form action="" method="post" class="tablesmall">			
          <table class="table" style="position:relative; width:100%;">
            <th COLSPAN="4">
              <h3><br>Completed Review</h3>
            </th>
            <tr>
              <td width="60%">Title</td>
              <td width="15%">Date</td>
              <td width="15%">Status</td>
              <td width="10%">Selected</td>
            <?php  
	      $result2 = mysqli_query($con,"SELECT * FROM `Reviews`,`Paper` WHERE `Reviews`.`userid` = " . $_SESSION['session_user_id'] . " and `Reviews`.`paperid` = `Paper`.`paperid` and "."((`Paper`.`reviewers_assigned1` = " . $_SESSION['session_user_id'] . ") or(`Paper`.`reviewers_assigned2` = " . $_SESSION['session_user_id'] . "))");
              while($row = mysqli_fetch_array($result2)){ ?>
                <tr>
                  <td><?php echo $row['title'];?></td>
                  <td><?php echo $row['date_reviewed'];?></td>
                  <td><?php switch ($row['status']){
		              case 1:
                                echo "approved";
                                break;
                              case 2:
                                echo "rejected";
                                break;
                              default:
                                echo "pending";
                            } ?> 
                  </td>
                  <td>						
                    <input type="radio"<?php if(($row['paperid'] == $paper_selected_comments) or ($paper_selected_review == $row['paperid'])){echo "checked";}?> name="completed_papers" id='completed_review' value=<?php echo $row['paperid']; ?>><br>							
                  </td>
                </tr>
              <?php } ?>			
          </table>
            <input type="submit"<?php if($paper_selected_comments == 0){echo "disabled";}?> value="View Comment" id='comment' style="" name='comments'>
        </form>
      </div>
      <?php  
        $result2 = mysqli_query($con,"SELECT * FROM `Reviews` WHERE `Reviews`.`userid` = " . $_SESSION['session_user_id'] . " and `Reviews`.`paperid` = " . $paper_selected_comments);
        $review_row = mysqli_fetch_array($result2); ?>
      <form style ="<?php if($paper_selected_comments == 0 and $paper_selected_review == 0){echo "visibility:hidden;";}?>" name="input" action="Submit_Review.php" method="get"><!-- Dis where for sends to php file-->
        <div class="AuthorDiv2" style="float: left; left:2px; bottom: 10px">			
          Rating: 1 <input type="radio"<?php if($review_row['rating'] == 1){echo "checked";}?> name="rating" value="1"> 2<input type="radio"<?php if($review_row['rating'] == 2){echo "checked";}?>  name="rating" value="2"> 3<input type="radio"<?php if($review_row['rating'] == 3){echo "checked";}?>  name="rating" value="3" > 4<input type="radio"<?php if($review_row['rating'] == 4){echo "checked";}?>  name="rating" value="4"> 5<input type="radio"<?php if($review_row['rating'] == 5){echo "checked";}?>  name="rating" value="5">
          </br>			
          Review to Author: </br>
          <textarea rows="15" cols="72" name='review'><?php echo $review_row['review'];?></textarea></br>
          Comment to Editor: </br>
          <textarea rows="15" cols="72" name='comment'><?php echo $review_row['comment'];?></textarea></br>			
          <input type="submit" value="Submit Review">			
        </div>
      </form>
    </div>
</body>
