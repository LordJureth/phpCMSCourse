<?php

//Function to pull post imformation from the database
function SelectPostInformation(){

  //Connection variable pulled in from config.php
  global $connection;


  /******  Pagination ******/

  //Number of Posts Per Page
  $PostsPerPage = 5;

  //Pagination Get Request
  if(isset($_GET['Page'])){

    //store Page Number
    $Page = $_GET['Page'];
  } else {

    //default the Page Nuber
    $Page = "";
  }

  if($Page == "" || $Page == 1){

    $PageLimit = 0;
  } else {

    $PageLimit = ($Page * $PostsPerPage) - $PostsPerPage;
  }




  //MySQL Query to select Posts
  $query = "SELECT *
            FROM posts
            WHERE posts.post_status_id = 2
            LIMIT $PageLimit, $PostsPerPage";

  //Query the Database
  $result = mysqli_query($connection, $query);

  //Validate query
  if(!$result){
    die("Select POST Info failed" . mysqli_error($connection));
  } else {

    //Check Number of Rows
    $NumberofRows = mysqli_num_rows($result);

    if($NumberofRows == 0) {
      echo "<h1 class='text-center'>Sorry no Approved Posts to show";
    } else {

      //showing query results to display in navigation
      while ($row = mysqli_fetch_assoc($result)){
        $PostID = $row['post_id'];
        $PostTitle = $row['post_title'];
        $PostAuthor = $row['post_author'];
        $PostDate = $row['post_date'];
        $PostImage = $row['post_image'];
        $PostContent = substr($row['post_content'],0,150);
        ?>

        <!-- Blog Post -->
        <h2>
          <a href="post.php?PostID=<?php echo $PostID; ?>"><?php echo $PostTitle; ?></a>
        </h2>

        <p class="lead">
          by <a href="post.php?Author=<?php echo $PostAuthor; ?>"><?php echo $PostAuthor; ?></a>
        </p>

        <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $PostDate; ?></p>

        <hr>

        <a href="post.php?PostID=<?php echo $PostID; ?>" title="post.php?PostID=<?php echo $PostID; ?>">
          <img class="img-responsive" src="./images/<?php echo $PostImage; ?>" alt="Post Image">
        </a>

        <hr>

        <pre><?php echo $PostContent; ?></pre>
        
        <a class="btn btn-primary" href="post.php?PostID=<?php echo $PostID; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        <?php
      }
    }
  }
  //end of Function to pull post imformation from the database
}



//Function to handle Pagination
function SelectPostInformationPagination(){

  //Connection variable pulled in from config.php
  global $connection;

  //Pagination Get Request
  if(isset($_GET['Page'])){

    //store Page Number
    $Page = $_GET['Page'];
  } else {

    //default the Page Nuber
    $Page = "1";
  }

  $PostsPerPage = 5;


  //MySQL Query to select Posts
  $query = "SELECT *
            FROM posts
            WHERE posts.post_status_id = 2";

  //Query the Database
  $result = mysqli_query($connection, $query);

  //Validate query
  if(!$result){
    die("Select POST Info failed" . mysqli_error($connection));
  } else {

    //Check Number of Rows
    $NumberofRows = mysqli_num_rows($result);
    $count = ceil($NumberofRows / $PostsPerPage);

    for($i = 1; $i <= $count; $i++){

      if($i == $Page) {

      echo "<li class='active_link'><a href='./index.php?Page={$i}'>{$i}</a></li>";

      } else {
      echo "<li><a href='./index.php?Page={$i}'>{$i}</a></li>";
      }

    }
  }
//End of Function to handle Pagination
}





//Function to pull post imformation from the database by ID
function SelectPostInformationByID(){

  //Detect GET Request
  if(isset($_GET['PostID'])) {
    $GetPostID = $_GET['PostID'];



    //Connection variable pulled in from config.php
    global $connection;

    //MySQL Query to select categories
    $query = "SELECT *
              FROM posts
              WHERE posts.post_id = $GetPostID";

    //Query the Database
    $result = mysqli_query($connection, $query);

    //Validate query
    if(!$result){
      die("Select POST Info failed" . mysqli_error($connection));
    } else {
      //showing query results to display in navigation
      while ($row = mysqli_fetch_assoc($result)){
        $PostID = $row['post_id'];
        $PostTitle = $row['post_title'];
        $PostAuthor = $row['post_author'];
        $PostDate = $row['post_date'];
        $PostImage = $row['post_image'];
        $PostContent = $row['post_content'];
        ?>

        <!-- Blog Post -->
        <h2>
          <a href="post.php?PostID=<?php echo $PostID; ?>"><?php echo $PostTitle; ?></a>
        </h2>
        <p class="lead">
          by <a href="post.php?Author=<?php echo $PostAuthor; ?>"><?php echo $PostAuthor; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $PostDate; ?></p>
        <hr>
        <a href="post.php?PostID=<?php echo $PostID; ?>" title="post.php?PostID=<?php echo $PostID; ?>">
          <img class="img-responsive" src="./images/<?php echo $PostImage; ?>" alt="Post Image">
        </a>
        <hr>
        <pre><?php echo $PostContent; ?></pre>

        <?php

          if(isset($_SESSION['username'])){
            $SessionUserID = $_SESSION['user_id'];
            echo "<a class='btn btn-primary' href='./UpdatePosts.php?PostID={$PostID}&User={$SessionUserID}'>Edit Post<span class='glyphicon glyphicon-chevron-right'></span></a>";
        } ?>

        <hr>
        <?php
      }
    }
  }
  else {

    //Redirect back to index
    $RefreshURL = "./index.php";
    $RefreshPage = new Refresh;
    $RefreshPage->RefreshPage($RefreshURL);
  }

  //end of Function to pull post imformation from the database by ID
}













//Function to pull post imformation from the database by Category
function SelectPostInformationByCat(){

  //Detect GET Request
  if(isset($_GET['CatID'])) {
    $GetCatID = $_GET['CatID'];



    //Connection variable pulled in from config.php
    global $connection;

    //MySQL Query to select categories
    $query = "SELECT *
              FROM posts
              WHERE posts.post_category_id = $GetCatID
              AND posts.post_status_id = 2";

    //Query the Database
    $result = mysqli_query($connection, $query);

    $NumberofRows = mysqli_num_rows($result);

    //Validate query
    if(!$result){
      die("Select POST Info failed" . mysqli_error($connection));
    } elseif ($NumberofRows < 1) {
      echo "<h1 class='text-center'>Sorry no  Approved Posts to show</h1>";
    }  else {
      //showing query results to display in navigation
      while ($row = mysqli_fetch_assoc($result)){
        $PostID = $row['post_id'];
        $PostTitle = $row['post_title'];
        $PostAuthor = $row['post_author'];
        $PostDate = $row['post_date'];
        $PostImage = $row['post_image'];
        $PostContent = substr($row['post_content'],0,150);
        ?>

        <!-- Blog Post -->
        <h2>
          <a href="post.php?PostID=<?php echo $PostID; ?>"><?php echo $PostTitle; ?></a>
        </h2>
        <p class="lead">
          by <a href="post.php?Author=<?php echo $PostAuthor; ?>"><?php echo $PostAuthor; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $PostDate; ?></p>
        <hr>
        <a href="post.php?PostID=<?php echo $PostID; ?>" title="post.php?PostID=<?php echo $PostID; ?>">
          <img class="img-responsive" src="./images/<?php echo $PostImage; ?>" alt="Post Image">
        </a>
        <hr>
        <pre><?php echo $PostContent; ?></pre>
        <a class="btn btn-primary" href="post.php?PostID=<?php echo $PostID; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        <?php
      }
    }
  }
  //end of Function to pull post imformation from the database by Category
}


//Function to pull post imformation from the database by Author
function SelectPostInformationByAuthor(){

  //Detect GET Request
  if(isset($_GET['Author'])) {
    $GetPostAuthor = $_GET['Author'];

    //Connection variable pulled in from config.php
    global $connection;

    //MySQL Query to Select Posts by Author
    $query = "SELECT *
              FROM posts
              WHERE posts.post_author = '$GetPostAuthor'";

    //Query the Database
    $result = mysqli_query($connection, $query);

    $NumberofRows = mysqli_num_rows($result);

    //Validate query
    if(!$result){
      die("Select POST Info failed" . mysqli_error($connection));
    } elseif ($NumberofRows < 1) {
      echo "<h1 class='text-center'>Sorry no  Approved Posts to show</h1>";
    }  else {
      //showing query results to display in navigation
      while ($row = mysqli_fetch_assoc($result)){
        $PostID = $row['post_id'];
        $PostTitle = $row['post_title'];
        $PostAuthor = $row['post_author'];
        $PostDate = $row['post_date'];
        $PostImage = $row['post_image'];
        $PostContent = substr($row['post_content'],0,150);
        ?>

        <!-- Blog Post -->
        <h2>
          <a href="post.php?PostID=<?php echo $PostID; ?>"><?php echo $PostTitle; ?></a>
        </h2>
        <p class="lead">
          by <a href="post.php?Author=<?php echo $PostAuthor; ?>"><?php echo $PostAuthor; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $PostDate; ?></p>
        <hr>
        <a href="post.php?PostID=<?php echo $PostID; ?>" title="post.php?PostID=<?php echo $PostID; ?>">
          <img class="img-responsive" src="./images/<?php echo $PostImage; ?>" alt="Post Image">
        </a>
        <hr>
        <pre><?php echo $PostContent; ?></pre>
        <a class="btn btn-primary" href="post.php?PostID=<?php echo $PostID; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        <?php
      }
    }
  }
  //end of Function to pull post imformation from the database by Author
}





//Function to Create Posts
function CreatePosts(){


  //Check if the post has been submitted
  if(isset($_POST['create_post'])){

    //Database Connection
    global $connection;

    //Store Post Results within Variables
    $PostTitle = $_POST['title'];
    $PostCat = $_POST['CatID'];
    $PostAuthor = $_SESSION['username'];
    $PostStatus = 1;
    $PostTags = $_POST['post_tags'];
    $PostContent = $_POST['content'];
    $PostDate = date('d-m-y');
    $PostUserID = $_SESSION['user_id'];

    $PostTitle = mysqli_real_escape_string($connection, $PostTitle);
    $PostCat = mysqli_real_escape_string($connection, $PostCat);
    $PostAuthor = mysqli_real_escape_string($connection, $PostAuthor);
    $PostStatus = mysqli_real_escape_string($connection, $PostStatus);
    $PostTags = mysqli_real_escape_string($connection, $PostTags);
    $PostContent = mysqli_real_escape_string($connection, $PostContent);
    $PostUserID = mysqli_real_escape_string($connection, $PostUserID);

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


    //Query to Insert into the Database
    $query = "INSERT INTO posts (post_category_id,
      post_title,
      post_author,
      post_date,
      post_image,
      post_content,
      post_tags,
      post_status_id,
      post_user_id)

      VALUES ($PostCat,
        '$PostTitle',
        '$PostAuthor',
        '$PostDate',
        '$ImageName',
        '$PostContent',
        '$PostTags',
        '$PostStatus',
        '$PostUserID'
      )";

      //Pass Query to Database
      $result = mysqli_query($connection, $query);

      //Validate Query
      if(!$result){
        die("Add Post Query Failed" . mysqli_error($connection));
      } else {

        //Refresh the page
        $RefreshPostURL = "./index.php";
        $refreshPostPage = new Refresh;
        $refreshPostPage->RefreshPage($RefreshPostURL);


      }
    }
  //End of Function to Create Posts
  }



  //Function to update Posts
  function UpdatePosts(){

    //Global Database connection
    global $connection;

    //Check the User Logged in matches the User who made the post
    if(isset($_GET['User'])){

      //User ID
      $GetUserID = $_GET['User'];

      //Clean the UserID
      $GetUserID = mysqli_real_escape_string($connection, $GetUserID);

      if(isset($_GET['PostID'])){

        //Store Post ID
        $CurrentPostID = $_GET['PostID'];

        //Clean the Data
        $CurrentPostID = mysqli_real_escape_string($connection, $CurrentPostID);

        //query to pull post information
        //SQL Query to Select Post Information
        $UserPostCheckQuery = "SELECT posts.post_id,
                  posts.post_user_id
                  FROM posts
                  WHERE posts.post_id = $CurrentPostID";

        //Pass the Query to the Database
        $UserPostCheckResult = mysqli_query($connection, $UserPostCheckQuery);

        //Validate Query
        if(!$UserPostCheckResult){
          die("Query to Select Post Information Failed" . mysqli_error($connection));
        } else {


          while ($CheckRow = mysqli_fetch_assoc($UserPostCheckResult)){

            $UserCheckPostID = $CheckRow['post_id'];
            $UserCheckUserID = $CheckRow['post_user_id'];
          }


        if($GetUserID != $UserCheckUserID){


          //Refresh the page
          $RefreshPostURL = "./post.php?PostID={$CurrentPostID}";
          $refreshPostPage = new Refresh;
          $refreshPostPage->RefreshPage($RefreshPostURL);

        } else {
          //SQL Query to Select Post Information
          $query = "SELECT
                    posts.post_title,
                    posts.post_image,
                    posts.post_content,
                    posts.post_tags
                    FROM posts
                    WHERE posts.post_id = $CurrentPostID";

          //Pass the Query to the Database
          $result = mysqli_query($connection, $query);

          //Validate Query
          if(!$result){
            die("Query to Select Post Information Failed" . mysqli_error($connection));
          }
          else {
            while ($row = mysqli_fetch_assoc($result)){


              //Store Query Results
              $PostTitle = $row['post_title'];
              $PostContent = $row['post_content'];
              $PostImage = $row['post_image'];
              $PostTags = $row['post_tags'];

              ?>

              <div class="col-xs-12">
              <form action="" method="post" enctype="multipart/form-data">

              <div class="form-group">
              <label for="title">Enter a Post Title*</label>
              <input class="form-control" type="text" name="title" value="<?php echo "$PostTitle"; ?>">
              </div>

              <div class="form-group">
              <label for="CatID">Choose a Category*</label>
              <br>
              <select class="form-control" name="CatID">
                <?php
                  $SelectCategory = new Admin;
                  $SelectCategory->SelectPostCat();
                ?>
              </select>
              </div>


              <div class="form-group">
              <label for="image">Choose an Image*</label>
              <br>
              <img src="./admin/Images/<?php echo $PostImage; ?>" alt="<?php echo $PostImage; ?>">
              <br>
              <br>
              <input class="form-control" type="file" name="image" value="<?php echo "$PostImage"; ?>">
              </div>



              <div class="form-group">
              <label for="post_tags">Enter your Post tags*</label>
              <input class="form-control" type="text" name="post_tags" value="<?php echo $PostTags; ?>">
              </div>


              <div class="form-group">
              <label for="content">Enter your Post Content*</label>
              <textarea class="form-control" id="body" name="content" rows="10" cols="30" value="">
                  <?php echo $PostContent ?>
              </textarea>
              </div>

              <div class="form-group">
              <p>* Indicates a required field!</p>
              </div>


              <div class="form-group">
              <input class="btn btn-primary" type="submit" name="edit_post" value="Edit Post">
              </div>

              </form>
              </div>
              <?php

            //End of while ($row = mysqli_fetch_assoc($result)) section
            }
          //End of $result ELSE statement
          }
        //End of   if($GetUserID != $UserCheckUserID) ELSE statement
        }
        //End of $UserPostCheckResult Query Check
        }
      //End of Post ID Get Request
      }
    //End of User GET Request
    }


    /****POST REQUEST PART***/
    //Check if the post has been submitted
    if(isset($_POST['edit_post'])){

      //Store Post Results within Variables
      $EditPostTitle = $_POST['title'];
      $EditPostCat = $_POST['CatID'];
      $EditPostTags = $_POST['post_tags'];
      $EditPostContent = $_POST['content'];

      $EditPostTitle = mysqli_real_escape_string($connection, $EditPostTitle);
      $EditPostCat = mysqli_real_escape_string($connection, $EditPostCat);
      $EditPostTags = mysqli_real_escape_string($connection, $EditPostTags);
      $EditPostContent = mysqli_real_escape_string($connection, $EditPostContent);


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

      //Query to Insert into the Database
      $EditQuery = "UPDATE posts
                    SET  posts.post_category_id = '$EditPostCat',
                         posts.post_title = '$EditPostTitle',
                         posts.post_image = '$ImageName',
                         posts.post_content = '$EditPostContent',
                         posts.post_tags = '$EditPostTags'
                    WHERE posts.post_id = '$CurrentPostID'";

        //Pass Query to Database
        $EditResult = mysqli_query($connection, $EditQuery );

        //Validate Query
        if(!$EditResult){
          die("Add Post Query Failed" . mysqli_error($connection));
        }  else {

          //Refresh the page
          $RefreshPostURL = "./post.php?PostID={$CurrentPostID}";
          $refreshPostPage = new Refresh;
          $refreshPostPage->RefreshPage($RefreshPostURL);
        }
      //END OF POST request Section
      }
  //END of the Update Posts Function
  }

?>
