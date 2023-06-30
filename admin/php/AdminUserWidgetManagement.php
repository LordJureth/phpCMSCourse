<?php

class UserWidget{

  //Function to display count of Posts
  public function WidgetUserPostCount(){

    //Database Connection string
    global $connection;

    $UserID = $_SESSION['user_id'];

    //query to pull posts
    $query = "SELECT *
              FROM posts
              WHERE posts.post_status_id = 2
              AND posts.post_user_id = $UserID";

    //send query to the database
    $result = mysqli_query($connection, $query);

    //Validate the query
    if(!$result){
      die ("Query to retrieve post information failed" . mysqli_error($connection));
    } else {

      //count the rows
      $PostCount = mysqli_num_rows($result);

      //display the count
      echo $PostCount;
    }
  //End of Function to display count of Posts
  }

  //Function to display count of Comments
  public function WidgetUserCommentCount(){

    //Database Connection string
    global $connection;

    $UserID = $_SESSION['user_id'];

    //query to pull posts
    $query = "SELECT *
              FROM comments
              JOIN posts ON posts.post_id = comments.comment_post_id
              WHERE comments.comment_status_id = 2
              AND posts.post_user_id = $UserID";

    //send query to the database
    $result = mysqli_query($connection, $query);

    //Validate the query
    if(!$result){
      die ("Query to retrieve post information failed" . mysqli_error($connection));
    } else {

      //count the rows
      $CommentCount = mysqli_num_rows($result);

      //display the count
      echo $CommentCount;
    }
  //End of Function to display count of Comments
  }
//End of Class
}

?>
