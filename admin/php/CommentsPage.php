<?php


// SWITCH Statement for Comments CRUD Management
function CommentsCRUD(){

  //Database Connection
  global $connection;

  //check for CRUD Get Request
  if(isset($_GET['source'])){

    //Store the Source into a variable
    $source = $_GET['source'];

    $source = mysqli_real_escape_string($connection, $source);
  } else {
    $source = "View";
  }


  //Case to return desired source page
  switch($source){

    //Return Create Post Page
    case "Create";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CreateComments.php');
    break;

    //Return Update Post Page
    case "Approve";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CommentManagement.php');
    break;

    //Return Delete Post Page
    case "Delete";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CommentManagement.php');
    break;

    //return default, Read Posts
    case "Reject";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CommentManagement.php');
    break;

    //return default, Read Posts
    case "View";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/ViewAllComments.php');
    break;

    case "ID";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/ViewAllCommentsByID.php');
    break;


  }



  // End of Function for Comments CRUD
}



//Function to view all Comments
function CallAllComments(){


  //GLobal Database Connection
  global $connection;

  //Query to Select Comments
  $query = "SELECT comments.comment_id,
            posts.post_id AS 'comment_post_id',
            posts.post_title AS 'comment_post_title',
            comments.comment_author,
            comments.comment_email,
            comments.comment_content,
            comment_status.comment_status_description AS 'comment_status',
            comments.comment_date
            FROM comments
            LEFT JOIN comment_status ON comment_status.comment_status_id = comments.comment_status_id
            LEFT JOIN posts ON posts.post_id = comments.comment_post_id
            ORDER BY comments.comment_id DESC";

  //Passing query to the Database
  $result = mysqli_query($connection, $query);

  //Valiate Query
  if(!$result){
    die("Query to Select Comments Failed" . mysqli_error($connection));
  } else {

    //review results
    while($row = mysqli_fetch_assoc($result)){

      //store results as variables
      $CommentID = $row['comment_id'];
      $CommentPostID = $row['comment_post_id'];
      $CommentPostTitle = $row['comment_post_title'];
      $CommentAuthor = $row['comment_author'];
      $CommentEmail = $row['comment_email'];
      $CommentContent = $row['comment_content'];
      $CommentStatus = $row['comment_status'];
      $CommentDate = $row['comment_date'];

      //echo results into table data elements
      echo "<tr>";
      echo "<td>{$CommentID}</td>";
      echo "<td><a href='../post.php?PostID={$CommentPostID}' target='_blank'>{$CommentPostTitle}</td>";
      echo "<td>{$CommentAuthor}</td>";
      echo "<td>{$CommentEmail}</td>";
      echo "<td>{$CommentContent}</td>";
      echo "<td>{$CommentStatus}</td>";
      echo "<td>{$CommentDate}</td>";
      echo "<td><a href='./view_comments.php?source=Approve&CommentID={$CommentID}'>Approve</a></td>";
      echo "<td><a href='./view_comments.php?source=Reject&CommentID={$CommentID}'>Reject</a></td>";
      echo "<td><a onClick=\"javascript: return confirm('Are you sure you wish to delete these record(s)'); \" href='./view_comments.php?source=Delete&CommentID={$CommentID}&PostID={$CommentPostID}'>Delete</a></td>";
      echo "</tr>";
    }
  }

//End of Function to view all Comments
}


//Function to Manage Comments
function CommentManagement(){

  //Database Connection
  global $connection;


  if(isset($_GET['source'])){

    //Store GET request string
    $source = $_GET['source'];
    $CommentID = $_GET['CommentID'];

    $source = mysqli_real_escape_string($connection, $source);
    $CommentID = mysqli_real_escape_string($connection, $CommentID);


    //Global Database Connection
    global $connection;

    session_start();

    //Source Validation
    switch($source){

      case "Approve";


        if(isset($_SESSION['username'])){

          $RoleID = $_SESSION['user_role_id'];

          if($RoleID == 1){$Query = "UPDATE comments
                    SET comments.comment_status_id = 2
                    WHERE comments.comment_id = '$CommentID'";

          //End of RoleID Check
          }
          //End of Session Username Check
        } else {
          $query = "void";
        }
      break;



      case "Reject";
        if(isset($_SESSION['username'])){

          $RoleID = $_SESSION['user_role_id'];

          if($RoleID == 1){$Query = "UPDATE comments
                      SET comments.comment_status_id = 3
                      WHERE comments.comment_id = '$CommentID'";

          //End of RoleID Check
          }
          //End of Session Username Check
        } else {
          $query = "void";
        }
      break;



      case "Delete";

      if(isset($_SESSION['username'])){

        $RoleID = $_SESSION['user_role_id'];

        if($RoleID == 1){$Query = "DELETE FROM comments
                  WHERE comments.comment_id = '$CommentID'";

        //End of RoleID Check
        }
        //End of Session Username Check
      } else {
        $query = "void";
      }
      break;
    //End of Source Validation
    }


    if($query == "void"){
      //Refresh the Page
      $RefreshPostURL = "../index.php";
      $RefreshPost = new Refresh;
      $RefreshPost->RefreshPage($RefreshPostURL);
    } else {
      //Sent Query to Database
      $result = mysqli_query($connection, $Query);

      //Validate Query
      if(!$result){
        die("Approve Query Failed" . mysqli_error($connection));
      } else {

        $RefreshCommentsPageURL = "view_comments.php";
        $ApproveRefresh = new Refresh;
        $ApproveRefresh->RefreshPage($RefreshCommentsPageURL);

        $UpdateCount = new Admin;
        $UpdateCount->UpdateCommentCount();
        }
      }
    }

//End of Function to Manage Comments
}



//Function to view all Comments by Post ID
function CallAllCommentsByID(){


  //GLobal Database Connection
  global $connection;

  if(isset($_GET['PostID'])){

    $CommentPostID = $_GET['PostID'];
    $CommentPostID = mysqli_real_escape_string($connection, $CommentPostID);

    //Query to Select Comments
    $query = "SELECT comments.comment_id,
              posts.post_id AS 'comment_post_id',
              posts.post_title AS 'comment_post_title',
              comments.comment_author,
              comments.comment_email,
              comments.comment_content,
              comment_status.comment_status_description AS 'comment_status',
              comments.comment_date
              FROM comments
              LEFT JOIN comment_status ON comment_status.comment_status_id = comments.comment_status_id
              LEFT JOIN posts ON posts.post_id = comments.comment_post_id
              WHERE comments.comment_post_id = $CommentPostID
              ORDER BY comments.comment_id DESC";

    //Passing query to the Database
    $result = mysqli_query($connection, $query);

    //Valiate Query
    if(!$result){
      die("Query to Select Comments Failed" . mysqli_error($connection));
    } else {

      //review results
      while($row = mysqli_fetch_assoc($result)){

        //store results as variables
        $CommentID = $row['comment_id'];
        $CommentPostID = $row['comment_post_id'];
        $CommentPostTitle = $row['comment_post_title'];
        $CommentAuthor = $row['comment_author'];
        $CommentEmail = $row['comment_email'];
        $CommentContent = $row['comment_content'];
        $CommentStatus = $row['comment_status'];
        $CommentDate = $row['comment_date'];

        //echo results into table data elements
        echo "<tr>";
        echo "<td>{$CommentID}</td>";
        echo "<td><a href='../post.php?PostID={$CommentPostID}' target='_blank'>{$CommentPostTitle}</td>";
        echo "<td>{$CommentAuthor}</td>";
        echo "<td>{$CommentEmail}</td>";
        echo "<td>{$CommentContent}</td>";
        echo "<td>{$CommentStatus}</td>";
        echo "<td>{$CommentDate}</td>";
        echo "<td><a href='./view_comments.php?source=Approve&CommentID={$CommentID}'>Approve</a></td>";
        echo "<td><a href='./view_comments.php?source=Reject&CommentID={$CommentID}'>Reject</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you wish to delete these record(s)'); \" href='./view_comments.php?source=Delete&CommentID={$CommentID}&PostID={$CommentPostID}'>Delete</a></td>";
        echo "</tr>";
      }
    }

  }
//End of Function to view all Comments by Post ID
}


  ?>
