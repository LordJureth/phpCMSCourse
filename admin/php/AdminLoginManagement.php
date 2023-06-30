<?php

//Function to handle Login
function AdminLogin(){

  //check for Login Submition
  if(isset($_POST['admin_login'])){


    //Database String
    global $connection;


    //Store Login Credentials
    $LoginFormUsername = $_POST['username'];
    $LoginFormPassword = $_POST['password'];

    //Clean up the Form Submition
    $LoginFormUsername = mysqli_real_escape_string($connection, $LoginFormUsername);
    $LoginFormPassword = mysqli_real_escape_string($connection, $LoginFormPassword);



    //Query to pull User information
    $GetDataBaseUserInfoQuery = "SELECT
                                 users.user_id,
                                 users.user_username,
                                 users.user_password,
                                 users.user_first_name,
                                 users.user_last_name,
                                 users.user_email,
                                 users.user_role_id,
                                 user_roles.user_role_description
                                 FROM users
                                 LEFT JOIN user_roles ON user_roles.user_role_id = users.user_role_id
                                 WHERE users.user_username = '$LoginFormUsername' ";

    //Send Query to the Database
    $UserInformationResults = mysqli_query($connection, $GetDataBaseUserInfoQuery);

    //Validate Query
    if(!$UserInformationResults){
      die("Unable to get user information from the Database" . mysqli_error($connection));
    } else {

      //run through results
      while($row = mysqli_fetch_assoc($UserInformationResults)){

        $DatabaseUserID = $row['user_id'];
        $DatabaseUsername = $row['user_username'];
        $DatabasePassword = $row['user_password'];
        $DatabaseFirstName = $row['user_first_name'];
        $DatabaseLastName = $row['user_last_name'];
        $DatabaseEmail = $row['user_email'];
        $DatabaseUserRoleID = $row['user_role_id'];
        $DatabaseUserRole = $row['user_role_description'];

      }
    }

    //Validate The Login Credentials
   if(password_verify($LoginFormPassword, $DatabasePassword)) {

        session_start();

        //Store Session information
        $_SESSION['user_id'] = $DatabaseUserID;
        $_SESSION['username'] = $DatabaseUsername;
        $_SESSION['first_name'] = $DatabaseFirstName;
        $_SESSION['last_name'] = $DatabaseLastName;
        $_SESSION['user_role'] = $DatabaseUserRole;
        $_SESSION['user_role_id'] = $DatabaseUserRoleID;
        $_SESSION['user_email'] = $DatabaseEmail;


        //Redirect Back to home page
        $RedirectURL = "../index.php";

        //instantiate Refresh Class
        $Refresh = new Refresh;
        $Refresh->RefreshPage($RedirectURL);
    } else {
      //Redirect Back to home page
      $RedirectURL = "../AdminLogin.php";

      //instantiate Refresh Class
      $Refresh = new Refresh;
      $Refresh->RefreshPage($RedirectURL);
    }
  //End if Login Post Check
  }
//End oF Login Function
}


//Function to check if user Session Login exists
Function CheckForlogin(){


$url = $_SERVER['REQUEST_URI'];
$uri = "/cms/Admin/AdminLogin.php";
$logout = "/cms/Admin/includes/AdminLogout.php";



 if($url == $uri || $url == $logout){
   $safe = 1;

 } else {
   $safe = 0;
 }


if($safe == 0){
  if(!isset($_SESSION['username'])){

    //Redirect Back to home page
    $RedirectURL = "./AdminLogin.php";

    //instantiate Refresh Class
    $Refresh = new Refresh;
    $Refresh->RefreshPage($RedirectURL);

  }  elseif ($_SESSION['user_role_id'] != 1) {

    //Redirect Back to home page
    $RedirectURL = "./AdminLogin.php";

    //instantiate Refresh Class
    $Refresh = new Refresh;
    $Refresh->RefreshPage($RedirectURL);
  }
}





//End of Function to check for User Session Logon
}




//Function to handle logout
function AdminLogout(){

session_start();
session_destroy();


//Redirect Back to home page
$RedirectURL = "../AdminLogin.php";

//instantiate Refresh Class
$Refresh = new Refresh;
$Refresh->RefreshPage($RedirectURL);

}










?>
