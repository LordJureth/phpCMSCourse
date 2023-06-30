<?php

//Function to Create Comments
function CreateComments(){

  //Database Connection
  global $connection;


  //Check for Post
  if(isset($_POST['create_comment'])){

    //Check for GET
    if(isset($_GET['PostID'])){

      //Store POST ID from the GET Request
      $PostID = $_GET['PostID'];
      $PostID = mysqli_real_escape_string($connection, $PostID);


      $CommentAuthor = $_SESSION['username'];
      $CommentEmail = $_SESSION['user_email'];
      $CommentContent = $_POST['comment_content'];
      $CommentUserID = $_SESSION['user_id'];



      $CommentAuthor = mysqli_real_escape_string($connection, $CommentAuthor);
      $CommentEmail = mysqli_real_escape_string($connection, $CommentEmail);
      $CommentContent = mysqli_real_escape_string($connection, $CommentContent);
      $CommentUserID = mysqli_real_escape_string($connection, $CommentUserID);

      $query = "INSERT INTO comments (comment_post_id,
                                      comment_author,
                                      comment_content,
                                      comment_email,
                                      comment_status_id,
                                      comment_user_id)
                VALUES ($PostID,
                       '$CommentAuthor',
                       '$CommentContent',
                       '$CommentEmail',
                       2,
                       '$CommentUserID')";

      //Send Query to Database
      $result = mysqli_query($connection, $query);

      //validate query
      if(!$result){
        die("Comment failed to upload" . mysqli_error($connection));
      } else {

        //Refresh the page
        $RefreshPage = new Refresh;
        $RefreshURL = "post.php?PostID=$PostID";
        $RefreshPage->RefreshPage($RefreshURL);
      }
    }
  }
  //End of Function to Create Comments
}


//Function to view all Post Releated Comments
function CallAllPostComments(){

  //Check for GET
  if(isset($_GET['PostID'])){

    //GLobal Database Connection
    global $connection;

    //Store POST ID from the GET Request
    $PostID = $_GET['PostID'];
    $PostID = mysqli_real_escape_string($connection, $PostID);


    //Query to Select Comments
    $query = "SELECT
              comments.comment_author,
              comments.comment_content,
              comments.comment_date,
              users.user_image AS 'comment_image'
              FROM comments
              JOIN users ON users.user_id = comments.comment_user_id
              WHERE comments.comment_post_id = {$PostID}
              AND comments.comment_status_id = 2
              ORDER BY comments.comment_date DESC";

    //Passing query to the Database
    $result = mysqli_query($connection, $query);

    //Valiate Query
    if(!$result){
      die("Query to Select Comments Failed" . mysqli_error($connection));
    } else {

      //review results
      while($row = mysqli_fetch_assoc($result)){

        //store results as variables
        $CommentAuthor = $row['comment_author'];
        $CommentContent = $row['comment_content'];
        $CommentDate = $row['comment_date'];
        $CommentImage = $row['comment_image'];


        //echo results into table data elements
        ?>

        <a class="pull-left" href="post.php?PostID=<?php echo $PostID; ?>">
          <img class="media-object" width="64" height="64" src="./images/<?php echo $CommentImage; ?>" alt="<?php echo $ImageFilePath; ?>">
        </a>

        <div class="media-body">

          <h4 class="media-heading"><?php echo "{$CommentAuthor}"; ?>
            <small><?php echo "{$CommentDate}"; ?></small>
          </h4>

          <pre><?php echo "{$CommentContent}"; ?></pre>

          <hr>
        </div>
        <?php
      }
    }
  }
  //End of Function to view all Post Releated Comments
}


//Function to hide the Add Comment Feature if not logged in
function AddCommentsForm(){

  if(isset($_GET['PostID'])){
    if(isset($_SESSION['username'])){

      ?>
      <!-- Comments Form -->
      <div class="well">
          <h4>Leave a Comment:</h4>
          <form action="" method="post" role="form">


              <div class="form-group">
                  <label for="comment">Your Comment</label>
                  <textarea name="comment_content" class="form-control" rows="3"></textarea>
              </div>

              <button type="submit" name="create_comment" class="btn btn-primary">Submit*</button>

          </form>
      </div>

      <?php
    } else {

      ?>

      <h2>Login to leave a comment!</h2>

      <?php
    }
  }

//End of Function to hide the Add Comment Feature if not logged in
}



?>
