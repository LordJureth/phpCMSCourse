<?php

//Function to handle Login
function Login(){

  //check for Login Submition
  if(isset($_POST['login'])){


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

    }
  //End if Login Post Check
  }
//End oF Login Function
}





//Function to hide the Register Form once Logged in
function RegisterButton(){

  if(!isset($_SESSION['username'])){

    ?>

    <li><a href='./registration.php'>Register</a></li>

    <?php
  }
//End of Function to hide the Register Form once Logged in
}


//Function to hide the Register Form once Logged in
function LoginButton(){

  if(!isset($_SESSION['username'])){

    ?>

    <li><a href='./login.php'>Login</a></li>

    <?php
  }
//End of Function to hide the Register Form once Logged in
}



//Function to Show Profile Dropdown when logged in
function ProfileDropDown(){


  if(isset($_SESSION['username'])){
    ?>

    <!-- Profile Drop Down-->
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
       <?php

        $Username = $_SESSION['username'];

        echo "$Username";

        ?>
        <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>

            <li class="divider"></li>

            <li>
                <a href="./includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>

    <?php


  }
//End of Function to Show Profile Dropdown when logged in
}



//Function to handle logout
function logout(){

session_start();
session_destroy();


//Redirect Back to home page
$RedirectURL = "../index.php";

//instantiate Refresh Class
$Refresh = new Refresh;
$Refresh->RefreshPage($RedirectURL);

}



//Function to control Add Posts
function CreatePost(){

  if(isset($_SESSION['username'])){

    ?>

    <li>
        <a href="./CreatePosts.php"><i class="fa fa-fw fa-dashboard"></i>Create Posts</a>
    </li>

    <?php
  }
//Function to control Add Posts
}



//Function to toggle Page Welcome Name
function WelcomeName(){

  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $FirstName = $_SESSION['first_name'];
    $LastName =   $_SESSION['last_name'];

    if(empty($FirstName)){
      echo "$username";
    } else {
      echo $FirstName . " " . $LastName;
    }

  } else {
    echo "Guest";
  }
//Function to toggle index welcome
}



?>
