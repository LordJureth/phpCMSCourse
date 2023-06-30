<?php

//Function to Register users
function RegisterUser(){

  //Check for Form Submition
  if(isset($_POST['submit'])){

    //Database Connection String
    global $connection;

    $RegisterUsername = $_POST['username'];
    $RegisterEmail = $_POST['email'];
    $RegisterPassword = $_POST['password'];

    //validate the provided information
    if(!empty($RegisterUsername) && !empty($RegisterEmail) && !empty($RegisterPassword)){


      $RegisterUsername = mysqli_real_escape_string($connection, $RegisterUsername);
      $RegisterEmail = mysqli_real_escape_string($connection, $RegisterEmail);
      $RegisterPassword = mysqli_real_escape_string($connection, $RegisterPassword);

      //check if username exists
      $CheckUserExistsQuery = "SELECT users.user_username FROM users WHERE users.user_username = '$RegisterUsername'";

      //Send to Database
      $CheckUserExistsQueryResult = mysqli_query($connection, $CheckUserExistsQuery);

      //Count results
      $UsernameCount = mysqli_num_rows($CheckUserExistsQueryResult);

      if($UsernameCount > 0) {
        echo "Username Already Exists, please choose another" . "<br>";
      }

      //check if Email exists
      $CheckEmailExistsQuery = "SELECT users.user_email FROM users WHERE users.user_email = '$RegisterEmail'";

      //Send to Database
      $CheckEMailExistsQueryResult = mysqli_query($connection, $CheckEmailExistsQuery);

      //Count results
      $EmailCount = mysqli_num_rows($CheckEMailExistsQueryResult);

      if($EmailCount > 0) {
        echo "Email Already Exists, please choose another" . "<br>";
      }

      //Check Password
      $PasswordCharacterCount = strlen($RegisterPassword);
      echo "$PasswordCharacterCount" . "<br>";

      if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $RegisterPassword)
        || !preg_match('/[A-Z]/', $RegisterPassword)
        || !preg_match('/[0-9]/', $RegisterPassword)
        || $PasswordCharacterCount < 8)
            {
              $PasswordCheck = 0;

              echo "Password must contain at least one uppercase letter, one special character, one number and at least 8 characters long";
            } else {
              $PasswordCheck = 1;
            }


      if($UsernameCount == 0 && $EmailCount == 0 && $PasswordCheck == 1){

        //Encrypt the Password
        $RegisterPassword = password_hash($RegisterPassword, PASSWORD_BCRYPT, array('cost' => 12));

         //Query to Insert the User
         $AddUserQuery = "INSERT INTO users (users.user_username, users.user_password, users.user_email, users.user_role_id)
                          VALUES ('{$RegisterUsername}','{$RegisterPassword}','{$RegisterEmail}', 2)";

         //Send Query to the Database
         $AddUserQueryResult = mysqli_query($connection, $AddUserQuery);

         //Validate Query
         if(!$AddUserQueryResult){

           //Refresh URL
           $RefreshURL = "./registration.php";
           $RefreshPage = new Refresh;
           $RefreshPage->RefreshPage($RefreshURL);

         } else {

          /***** Log User IN *****/

          //Query to pull User information
          $LoginQuery = "SELECT
                                       users.user_id,
                                       users.user_username,
                                       users.user_password,
                                       users.user_first_name,
                                       users.user_last_name,
                                       users.user_role_id,
                                       user_roles.user_role_description
                                       FROM users
                                       LEFT JOIN user_roles ON user_roles.user_role_id = users.user_role_id
                                       WHERE users.user_username = '$RegisterUsername' ";

          //Send Query to the Database
          $LoginResults = mysqli_query($connection, $LoginQuery);

          //Validate Query
          if(!$LoginResults){
            die("Unable to get user information from the Database" . mysqli_error($connection));
          } else {

            //run through results
            while($row = mysqli_fetch_assoc($LoginResults)){

              $DatabaseUserID = $row['user_id'];
              $DatabaseUsername = $row['user_username'];
              $DatabasePassword = $row['user_password'];
              $DatabaseFirstName = $row['user_first_name'];
              $DatabaseLastName = $row['user_last_name'];
              $DatabaseUserRoleID = $row['user_role_id'];
              $DatabaseUserRole = $row['user_role_description'];

            }
          }

          session_start();

          //Store Session information
          $_SESSION['user_id'] = $DatabaseUserID;
          $_SESSION['username'] = $DatabaseUsername;
          $_SESSION['user_role'] = $DatabaseUserRole;
          $_SESSION['user_role_id'] = $DatabaseUserRoleID;
          $_SESSION['first_name'] = $DatabaseFirstName;
          $_SESSION['last_name'] = $DatabaseLastName;

           //Refresh URL
           $RefreshURL = "./index.php";
           $RefreshPage = new Refresh;
           $RefreshPage->RefreshPage($RefreshURL);
         }
        }
      }
    }
//End of Function to Register users
}



?>
