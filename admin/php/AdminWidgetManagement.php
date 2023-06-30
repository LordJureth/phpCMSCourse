<?php

class Index{

  //Function to display count of Posts
  public function WidgetPostCount(){

    //Database Connection string
    global $connection;

    //query to pull posts
    $query = "SELECT * FROM posts WHERE posts.post_status_id = 2";

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
  public function WidgetCommentCount(){

    //Database Connection string
    global $connection;

    //query to pull posts
    $query = "SELECT * FROM comments WHERE comments.comment_status_id = 2";

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


  //Function to display count of Users
  public function WidgetUserCount(){

    //Database Connection string
    global $connection;

    //query to pull posts
    $query = "SELECT * FROM users";

    //send query to the database
    $result = mysqli_query($connection, $query);

    //Validate the query
    if(!$result){
      die ("Query to retrieve user information failed" . mysqli_error($connection));
    } else {

      //count the rows
      $UserCount = mysqli_num_rows($result);

      //display the count
      echo $UserCount;
    }
  //End of Function to display count of Users
  }


  //Function to display count of Categories
  public function WidgetCategoryCount(){

    //Database Connection string
    global $connection;

    //query to pull posts
    $query = "SELECT * FROM categories";

    //send query to the database
    $result = mysqli_query($connection, $query);

    //Validate the query
    if(!$result){
      die ("Query to retrieve category information failed" . mysqli_error($connection));
    } else {

      //count the rows
      $CategoryCount = mysqli_num_rows($result);

      //display the count
      echo $CategoryCount;
    }
  //End of Function to display count of Categories
  }

//End of Class
}

?>
