<?php

// SWITCH Statement for Users CRUD Management
function UsersCRUD(){
  //check for CRUD Get Request
  if(isset($_GET['source'])){

    global $connection;

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
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CreateUsers.php');
    break;

    //Return Update Post Page
    case "Update";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/UpdateUsers.php');
    break;

    //Return Delete Post Page
    case "Delete";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/DeleteUser.php');
    break;

    //return default, Read Posts
    case "View";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/ViewAllUsers.php');
    break;
  }
  // End of Function for POST CRUD
}






//Function to Create Users
function CreateUser(){

  if(isset($_POST['create_user'])){

    //Database Connection String
    global $connection;

    //store form data
    $PostUsername = $_POST['username'];
    $PostPassword = $_POST['password'];
    $PostFirstname = $_POST['first_name'];
    $PostLastname = $_POST['last_name'];
    $PostEmail = $_POST['email'];
    $PostRole = $_POST['role'];
    $PostImage = $_POST['image'];

    $PostUsername = mysqli_real_escape_string($connection, $PostUsername);
    $PostPassword = mysqli_real_escape_string($connection, $PostPassword);
    $PostFirstname = mysqli_real_escape_string($connection, $PostFirstname);
    $PostLastname = mysqli_real_escape_string($connection, $PostLastname);
    $PostEmail = mysqli_real_escape_string($connection, $PostEmail);
    $PostRole = mysqli_real_escape_string($connection, $PostRole);
    $PostImage = mysqli_real_escape_string($connection, $PostImage);





    /******** Password Encryption ********/

    /**
     * Salt has depreciated in Version 7. Leaving this section within the code as an example.
     *  //Query to pull down Randsalt for Password Encryption
     *  $RandSaltQuery = "SELECT DISTINCT users.user_randSalt
     *                    FROM users";
     *
     *  //Send Query to the Database
     *  $RandSaltQueryResult = mysqli_query($connection, $RandSaltQuery);
     *
     *  //Validate Query
     *  if(!$RandSaltQueryResult){
     *    die("RandSalt Query Failed" . mysqli_error($connection));
     *  } else {
     *    //Pull Value from the query
     *    $row = mysqli_fetch_assoc($RandSaltQueryResult);
     *
     *  //store the salt value
     *    $salt = $row['user_randSalt'];
     *
     *    //Encrypt the password
     *    $PostPassword = crypt($PostPassword, $salt);
     *
     *  }
     */

     //Encrypt the password
     $PostPassword = password_hash($PostPassword, PASSWORD_BCRYPT, array('cost' => 12));

      /******** End of Password Encryption ********/



    //Query to insert Users
    $query = "INSERT INTO users(
      user_username,
      user_password,
      user_first_name,
      user_last_name,
      user_email,
      user_image,
      user_role_id)

      VALUES (
        '$PostUsername',
        '$PostPassword',
        '$PostFirstname',
        '$PostLastname',
        '$PostEmail',
        '$PostImage',
        '$PostRole')";

        //Send query to Database
        $result = mysqli_query($connection, $query);

        //Validate the query
        if(!$result){
          die("Query to Create Users Failed" . mysqli_error($connection));
        } else {

          //Define Refresh URL
          $RefreshURL = "view_users.php";

          //Instanciate Refresh class
          $Refresh = new Refresh;
          $Refresh->RefreshPage($RefreshURL);
        }
      }
      //End of Function to Create Users
    }







    //Function to view all users
    function ViewAllUsers(){

      //Database String
      global $connection;

      //Query to select users
      $query = "SELECT
                users.user_id,
                users.user_username,
                users.user_first_name,
                users.user_last_name,
                users.user_email,
                users.user_image,
                user_roles.user_role_description
                FROM users
                LEFT JOIN user_roles ON users.user_role_id = user_roles.user_role_id";

      //Send query to the database
      $result = mysqli_query($connection, $query);

      if(!$result){
        die("Query to retreive Users failed" . mysqli_error($connection));
      } else {

        //pull results from query
        while($row = mysqli_fetch_assoc($result)){

          //store results into variales
          $UserID = $row['user_id'];
          $Username = $row['user_username'];
          $FirstName = $row['user_first_name'];
          $Lastname = $row['user_last_name'];
          $UserEmail = $row['user_email'];
          $UserImage = $row['user_image'];
          $UserRole = $row['user_role_description'];

          echo "<tr>";
          echo "<td>{$Username}</td>";
          echo "<td>{$FirstName}</td>";
          echo "<td>{$Lastname}</td>";
          echo "<td>{$UserEmail}</td>";
          echo "<td>{$UserImage}</td>";
          echo "<td>{$UserRole}</td>";
          echo "<td><a href='view_users.php?source=Update&UserID={$UserID}'>Edit</a></td>";
          echo "<td><a  onClick=\"javascript: return confirm('Are you sure you wish to delete these record(s)'); \" href='view_users.php?source=Delete&UserID={$UserID}'>Delete</a></td>";
          echo "</tr>";
        }
      }
      //End of Function to view all Users.
    }






    //Function to Edit users
    function UpdateUser(){

      //Database String
      global $connection;

      //check for Get User ID
      if(isset($_GET['UserID'])){

        $GetUserID = $_GET['UserID'];
        $GetUserID = mysqli_real_escape_string($connection, $GetUserID);


        /******* SELECT USER INFO BY ID PART *******/
        //Query to select user by ID
        $CurrentUserInfoQuery = "SELECT
                                  users.user_id,
                                  users.user_username,
                                  users.user_first_name,
                                  users.user_last_name,
                                  users.user_email,
                                  users.user_image,
                                  user_roles.user_role_description
                                  FROM users
                                  LEFT JOIN user_roles ON users.user_role_id = user_roles.user_role_id
                                  WHERE users.user_id = $GetUserID";

        //Send query to the database
        $result = mysqli_query($connection, $CurrentUserInfoQuery);

        if(!$result){
          die("Query to retreive Users failed" . mysqli_error($connection));
        } else {

          //pull results from query
          while($row = mysqli_fetch_assoc($result)){

            //store results into variales
            $Username = $row['user_username'];
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
                  <input class="form-control" type="password" name="password" autocomplete="off">
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
                  <label for="content">Enter your Role</label>
                  <select class="form-control" name="role">
                    <?php $UserRoles = new Admin; $UserRoles->SelectUserRoles(); ?>
                  </select>
                </div>

                <div class="form-group">
                  <p>* Indicates a required field!</p>
                </div>


                <div class="form-group">
                  <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
                </div>

              </form>
            </div>

            <?php
          }
          //End of Get User Info by ID
        }
      } else {

        //Reidrect the user
        $RedirectURL = "./index.php";
        $Redirect = new Refresh;
        $Redirect->RefreshPage($RedirectURL);
      }


      /************* UPDATE USER INFORMATION ***************/

      //check for Post
      if(isset($_POST['update_user'])){

        //Store Post Information

        //store form data
        $UpdateUsername = $_POST['username'];
        $UpdatePassword = $_POST['password'];
        $UpdateFirstname = $_POST['first_name'];
        $UpdateLastname = $_POST['last_name'];
        $UpdateEmail = $_POST['email'];
        $UpdateRole = $_POST['role'];
        $UpdateImage = $_POST['image'];

        $UpdateUsername = mysqli_real_escape_string($connection, $UpdateUsername);
        $UpdatePassword = mysqli_real_escape_string($connection, $UpdatePassword);
        $UpdateFirstname = mysqli_real_escape_string($connection, $UpdateFirstname);
        $UpdateLastname = mysqli_real_escape_string($connection, $UpdateLastname);
        $UpdateEmail = mysqli_real_escape_string($connection, $UpdateEmail);
        $UpdateRole = mysqli_real_escape_string($connection, $UpdateRole);
        $UpdateImage = mysqli_real_escape_string($connection, $UpdateImage);



        /******** Password Encryption ********/

        /**
         * Salt has depreciated in Version 7. Leaving this section within the code as an example.
         *  //Query to pull down Randsalt for Password Encryption
         *  $RandSaltQuery = "SELECT DISTINCT users.user_randSalt
         *                    FROM users";
         *
         *  //Send Query to the Database
         *  $RandSaltQueryResult = mysqli_query($connection, $RandSaltQuery);
         *
         *  //Validate Query
         *  if(!$RandSaltQueryResult){
         *    die("RandSalt Query Failed" . mysqli_error($connection));
         *  } else {
         *    //Pull Value from the query
         *    $row = mysqli_fetch_assoc($RandSaltQueryResult);
         *
         *    //store the salt value
         *    $salt = $row['user_randSalt'];
         *
         *    //Encrypt the password
         *    $UpdatePassword = crypt($UpdatePassword, $salt);
         *
         *  }
         */

         //Encrypt the password
         $UpdatePassword = password_hash($UpdatePassword, PASSWORD_BCRYPT, array('cost' => 12));


          /******** End of Password Encryption ********/



        //Query to update User
        $UpdateUserQuery = "UPDATE users
                            SET users.user_username = '$UpdateUsername',
                            users.user_password = '$UpdatePassword',
                            users.user_first_name = '$UpdateFirstname',
                            users.user_last_name = '$UpdateLastname',
                            users.user_email = '$UpdateEmail',
                            users.user_role_id = '$UpdateRole',
                            users.user_image = '$UpdateImage'
                            WHERE users.user_id = $GetUserID ";

        //Send Query To the Database
        $UpdateResult = mysqli_query($connection, $UpdateUserQuery);

        //Validate the Query
        if(!$UpdateResult){
          die("Query to Edit Users Failed" . mysqli_error($connection));
        } else {

          //Define Refresh URL
          $RefreshURL = "view_users.php";

          //Instanciate Refresh class
          $Refresh = new Refresh;
          $Refresh->RefreshPage($RefreshURL);

        }
        //End of Update section
      }
      //End of Function to Edit Users.
    }

    //Function to delete Users
    function DeleteUsers(){

      if(isset($_GET['UserID'])){

        //Database Connection String
        global $connection;

        $DeleteUserID = $_GET['UserID'];
        $DeleteUserID = mysqli_real_escape_string($connection, $DeleteUserID);

        //Query to Delete Users
        $query = "DELETE FROM users WHERE users.user_id = $DeleteUserID";

        //Send Query to the Database
        $result = mysqli_query($connection, $query);

        //Validate Query
        if(!$result){
          die("Delete User Query Failed" . mysqli_error($connection));
        } else {
          //Define Refresh URL
          $RefreshURL = "view_users.php";

          //Instanciate Refresh class
          $Refresh = new Refresh;
          $Refresh->RefreshPage($RefreshURL);

        }
      }
      //End Function to delete Users
    }




    ?>
