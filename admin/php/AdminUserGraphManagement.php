<?php


//Function to populate Graph Data
function PopulateUserGraph(){

  //Database Connection string
  global $connection;

  /******* POSTS *******/
  //query to pull post count
  $ActivePostQuery = "SELECT * FROM posts WHERE posts.post_status_id = 2";
  $DraftPostQuery = "SELECT * FROM posts WHERE posts.post_status_id = 1";

  //send query to the database
  $ActivePostResult = mysqli_query($connection, $ActivePostQuery);
  $DraftPostResult = mysqli_query($connection, $DraftPostQuery);

  //Validate the query
  if(!$ActivePostResult || !$DraftPostResult){
    die ("Query to retrieve post information failed" . mysqli_error($connection));
  } else {

    //count the rows
    $ActivePostCount = mysqli_num_rows($ActivePostResult);
    $DraftPostCount = mysqli_num_rows($DraftPostResult);
  }


  /******* Comments ****/
  //query to pull Comments
  $ActiveCommentQuery = "SELECT * FROM comments WHERE comments.comment_status_id = 2";
  $DraftCommentQuery = "SELECT * FROM comments WHERE comments.comment_status_id = 1";

  //send query to the database
  $ActiveCommentResult = mysqli_query($connection, $ActiveCommentQuery);
  $DraftCommentResult = mysqli_query($connection, $DraftCommentQuery);

  //Validate the query
  if(!$ActiveCommentResult || !$DraftCommentResult){
    die ("Query to retrieve Comment information failed" . mysqli_error($connection));
  } else {

    //count the rows
    $ActiveCommentCount = mysqli_num_rows($ActiveCommentResult);
    $DraftCommentCount = mysqli_num_rows($DraftCommentResult);
  }



  /****** Users *******/

  //query to pull posts
  $UserQuery = "SELECT * FROM users";

  //send query to the database
  $UserResult = mysqli_query($connection, $UserQuery);

  //Validate the query
  if(!$UserResult){
    die ("Query to retrieve user information failed" . mysqli_error($connection));
  } else {
    //count the rows
    $UserCount = mysqli_num_rows($UserResult);
  }


  /****** Categories ******/
  //query to pull posts
  $CategoryQuery = "SELECT * FROM categories";

  //send query to the database
  $CategoryResult = mysqli_query($connection, $CategoryQuery);

  //Validate the query
  if(!$CategoryResult){
    die ("Query to retrieve category information failed" . mysqli_error($connection));
  } else {
    //count the rows
    $CategoryCount = mysqli_num_rows($CategoryResult);
  }






  //Array to hold Static Information
  $ColumnHeaders = array('Active Posts', 'Draft Posts', 'Active Comments', 'Draft Comments', 'Users', 'Categories');

  //Count the Array Elements
  $ColumHeaderCount = count($ColumnHeaders);

  //Array to Store Dynamic Data
  $ColumnValues = array($ActivePostCount, $DraftPostCount, $ActiveCommentCount, $DraftCommentCount, $UserCount, $CategoryCount);

  //Count the Array Elements
  $ColumnValuesCount = count($ColumnValues);


  //Validate the Header and Values to ensure they match
  if(!$ColumHeaderCount == $ColumnValuesCount){
    die ("Graph Header and Value Element mismatch");
  } else {
    //Graph Values loop
    for ($i = 0; $i <= 5; $i++){

      $header = $ColumnHeaders[$i];
      $value = $ColumnValues[$i];

      echo "['{$header}',{$value}],";
    }
  }
  //End of Function to populate Graph Values
}

?>
