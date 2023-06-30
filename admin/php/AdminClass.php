<?php
class Admin {

  //Function for Selecing Category ID's POST Management

  public function SelectPostCat(){

    //call database connecction string
    global $connection;

    //Query to call categories
    $query = "SELECT *
              FROM categories";

    //Send query to Database
    $result = mysqli_query($connection, $query);

    //validate Query
    if(!$result){
      die("Call Category query failed!" . mysqli_error($connection));
    } else {
      //loop through results and display in table
      while($row = mysqli_fetch_assoc($result)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<option value='{$cat_id}'>{$cat_title}</option> ";
      }
    }
  // End of Function for Selecing Category ID's POST create form
  }





  //Function for Selecing The Post Status for POST Management

  public function SelectPostStatus(){

    //call database connecction string
    global $connection;

    //Query to call categories
    $query = "SELECT *
              FROM post_status";

    //Send query to Database
    $result = mysqli_query($connection, $query);

    //validate Query
    if(!$result){
      die("Call Category query failed!" . mysqli_error($connection));
    } else {
      //loop through results and display in table
      while($row = mysqli_fetch_assoc($result)){
        $StatusID = $row['ps_id'];
        $StatusDescription = $row['ps_status_description'];

        echo "<option value='{$StatusID}'>{$StatusDescription}</option> ";
      }
    }
  // End of Function for Selecing The Post Status for POST create form
  }





//function to select User Roles
public function SelectUserRoles(){

  //Database String
  global $connection;

  //Query to Select User Rols
  $query = "SELECT * FROM user_roles";

  //Send QUery to Database
  $result = mysqli_query($connection, $query);

  //Validate Query
  if(!$result){
    die("Select User Roles Failed" . mysqli_error($connection));
  }  else {

    //work through results
    while ($row = mysqli_fetch_assoc($result)){

      //Store Results into Variables
      $RoleID = $row['user_role_id'];
      $RoleDescription = $row['user_role_description'];

      echo "<option value='{$RoleID}'>{$RoleDescription}</option>";
    }
  }
  //End of function to select User Roles
}



//Function for Selecing User ID's POST create form

Public function SelectPostUser(){

  //call database connecction string
  global $connection;

  //Query to call categories
  $query = "SELECT *
            FROM users";

  //Send query to Database
  $result = mysqli_query($connection, $query);

  //validate Query
  if(!$result){
    die("Select Users query failed!" . mysqli_error($connection));
  } else {
    //loop through results and display in table
    while($row = mysqli_fetch_assoc($result)){
      $user_id = $row['user_id'];
      $username = $row['user_username'];

      echo "<option value='{$user_id}'>{$username}</option> ";
    }
  }
// End of Function for Selecing User ID's POST create form
}




//Function to Count Online Users
Public function CountOnlineUsers(){

  //Database String
  global $connection;

  //Store Session Details
  $SessionID = session_id();
  $SessionTime = time();

  //TIme out in Seconds
  $SessionTimeout = 300;

  //Calcualte Time out
  $TimeOut =  $SessionTime - $SessionTimeout;

  //Query to pull all user_online records
  $query = "SELECT *
  FROM users_online
  WHERE users_online.usersonline_session = '$SessionID'";

  //Send Query To Database
  $result = mysqli_query($connection, $query);

  //Validate The Result
  if(!$result){

    die("Unable to pull user_online records" . mysqli_error($connection));
  } else {
    // Count the Rows
    $count = mysqli_num_rows($result);
  }


  //Check for Session ID
  if($count == NULL || $count == 0 ){

    //If no Session ID then create Record within the Database. This is to add new users.
    $InsertQuery = "INSERT INTO users_online(users_online.usersonline_session, users_online.usersonline_time)
    VALUES ('$SessionID', '$SessionTime')";

    //Send Query to the Database
    $InsertQueryResult = mysqli_query($connection, $InsertQuery);

  } else {

    //Query to Update Existing records with upto date Session Information
    $UpdateQuery = "UPDATE users_online
    SET users_online.usersonline_session = '$SessionID', users_online.usersonline_time = '$SessionTime'
    WHERE users_online.usersonline_session = '$SessionID'";

    //Send Query to the Database
    $UpdateQueryResult = mysqli_query($connection, $UpdateQuery);

    //Validate the Query
    if(!$UpdateQueryResult){
      die("Unable to update existing user_online records" . mysqli_error($connection));
    }
  }

  //Check for users that have logged out
  $TimeoutQuery = "SELECT *
  FROM users_online
  WHERE users_online.usersonline_time > '$TimeOut'";


  //Send Query to the Database
  $TimeoutQueryResult = mysqli_query($connection, $TimeoutQuery);

  //Validate the query
  if(!$TimeoutQueryResult){
    die("Time Out Check Failed" . mysqli_error($connection));
  } else {
    // count the rows
    $UserCount = mysqli_num_rows($TimeoutQueryResult);

    //Outout the Count of Active Users
    echo $UserCount;

  }
//End of Function to Count Online Users
}



//End of Class
}

?>
