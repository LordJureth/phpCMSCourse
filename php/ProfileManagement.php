<?php

//Function to call Logged in user Information

function UserProfile(){

  //Checking for Session information
  if(isset($_SESSION['username'])){

    //Database String
    global $connection;

    $UserID = $_SESSION['user_id'];
    $UserID = mysqli_real_escape_string($connection, $UserID);




    /******* SELECT USER INFO BY ID PART *******/
    //Query to select user by ID
    $CurrentUserInfoQuery = "SELECT
                             users.user_id,
                             users.user_username,
                             users.user_password,
                             users.user_first_name,
                             users.user_last_name,
                             users.user_email,
                             users.user_image,
                             user_roles.user_role_description
                             FROM users
                             LEFT JOIN user_roles ON users.user_role_id = user_roles.user_role_id
                             WHERE users.user_id = $UserID";

    //Send query to the database
    $result = mysqli_query($connection, $CurrentUserInfoQuery);

    if(!$result){
      die("Query to retreive Users failed" . mysqli_error($connection));
    } else {

      //pull results from query
      while($row = mysqli_fetch_assoc($result)){

        //store results into variales
        $Username = $row['user_username'];
        $Password = $row['user_password'];
        $FirstName = $row['user_first_name'];
        $Lastname = $row['user_last_name'];
        $UserEmail = $row['user_email'];


        ?>

        <div class="col-xs-12">
          <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="title">Enter a Username*</label>
              <input class="form-control" type="text" name="username" value="<?php echo "$Username"; ?>">
            </div>

            <div class="form-group">
              <label for="Author">Enter a Password*</label>
              <input class="form-control" type="password" name="password" autocomplete="off" <?php echo "$Password"; ?>>
            </div>

            <div class="form-group">
              <label for="image">Choose an Image*</label>
              <input class="form-control" type="file" name="image">
            </div>

            <div class="form-group">
              <label for="post_tags">Enter your First Name*</label>
              <input class="form-control" type="text" name="first_name" value="<?php echo "$FirstName"; ?>">
            </div>

            <div class="form-group">
              <label for="post_tags">Enter your Last Name*</label>
              <input class="form-control" type="text" name="last_name" value="<?php echo "$Lastname"; ?>">
            </div>


            <div class="form-group">
              <label for="content">Enter your Email address*</label>
              <input class="form-control" type="text" name="email" value="<?php echo "$UserEmail"; ?>">
            </div>

            <div class="form-group">
              <p>* Indicates a required field!</p>
            </div>


            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
            </div>

          </form>
        </div>

        <?php
      }
    }




    /************* UPDATE USER INFORMATION ***************/

    //check for Post
    if(isset($_POST['update_profile'])){

      //Store Post Information

      //store form data
      $UpdateUsername = $_POST['username'];
      $UpdatePassword = $_POST['password'];
      $UpdateFirstname = $_POST['first_name'];
      $UpdateLastname = $_POST['last_name'];
      $UpdateEmail = $_POST['email'];
      $UpdateImage = $_POST['image'];

      $UpdateUsername = mysqli_real_escape_string($connection, $UpdateUsername);
      $UpdatePassword = mysqli_real_escape_string($connection, $UpdatePassword);
      $UpdateFirstname = mysqli_real_escape_string($connection, $UpdateFirstname);
      $UpdateLastname = mysqli_real_escape_string($connection, $UpdateLastname);
      $UpdateEmail = mysqli_real_escape_string($connection, $UpdateEmail);

      //Encrypt the Password
      $UpdatePassword = password_hash($UpdatePassword, PASSWORD_BCRYPT, array('cost' => 12));

      //Image Details
      $Image = $_FILES['image'];
      $ImageName = $_FILES['image']['name'];
      $ImageTempName = $_FILES['image']['tmp_name'];
      $ImageSize = $_FILES['image']['size'];
      $ImageError = $_FILES['image']['error'];
      $ImageType = $_FILES['image']['type'];

      //Clean Image Name
      $ImageName = mysqli_real_escape_string($connection, $ImageName);

      //Images folder
      $ImagesFolder = ($_SERVER['DOCUMENT_ROOT']."/cms/images/{$ImageName}");

      //Move File
      move_uploaded_file($ImageTempName, $ImagesFolder);

      //Query to update User
      $UpdateProfileQuery = "UPDATE users
                             SET users.user_username = '$UpdateUsername',
                             users.user_password = '$UpdatePassword',
                             users.user_first_name = '$UpdateFirstname',
                             users.user_last_name = '$UpdateLastname',
                             users.user_email = '$UpdateEmail',
                             users.user_image = '$ImageName'
                             WHERE users.user_id = $UserID ";



      //Send Query To the Database
      $UpdateResult = mysqli_query($connection, $UpdateProfileQuery);

      //Validate the Query
      if(!$UpdateResult){
        die("Query to Edit Users Failed" . mysqli_error($connection));
      } else {

        session_start();

        //Store Session information
        $_SESSION['username'] = $UpdateUsername;
        $_SESSION['first_name'] = $UpdateFirstname;
        $_SESSION['last_name'] = $UpdateLastname;

        //Define Refresh URL
        $RefreshURL = "./index.php";

        //Instanciate Refresh class
        $Refresh = new Refresh;
        $Refresh->RefreshPage($RefreshURL);

      }
      //End of Update section
    }
  }

//End of Function to call Logged in user Information
}





?>
