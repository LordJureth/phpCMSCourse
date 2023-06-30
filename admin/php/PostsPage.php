<?php


// SWITCH Statement for Post CRUD Management
function PostCRUD(){
  //check for CRUD Get Request
  if(isset($_GET['source'])){

    //Database Connection
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
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/CreatePosts.php');
    break;

    //Return Update Post Page
    case "Update";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/UpdatePosts.php');
    break;

    //Return Delete Post Page
    case "Delete";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/PostManagement.php');
    break;

    //return default, Read Posts
    case "Approve";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/PostManagement.php');
    break;

    //return default, Read Posts
    case "Reject";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/PostManagement.php');
    break;

    //return default, Read Posts
    case "View";
    include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/ViewAllPosts.php');
    break;
  }
// End of Function for POST CRUD
}





//Function to Manage Comments
function PostManagement(){

  if(isset($_GET['source'])){

    //Global Database Connection
    global $connection;

    //Store GET request string
    $source = $_GET['source'];
    $PostID = $_GET['PostID'];

    $source = mysqli_real_escape_string($connection, $source);
    $PostID = mysqli_real_escape_string($connection, $PostID);



    //Source Validation
    switch($source){

      case "Approve";
      $Query = "UPDATE posts
                SET posts.post_status_id = 2
                WHERE posts.post_id = '$PostID'";
      break;

      case "Reject";
      $Query = "UPDATE posts
                SET posts.post_status_id = 3
                WHERE posts.post_id = '$PostID'";
      break;

      case "Delete";
      $Query = "DELETE FROM posts
                WHERE posts.post_id = '$PostID'";
      break;
    //End of Source Validation
    }

    //Sent Query to Database
    $result = mysqli_query($connection, $Query);

    //Validate Query
    if(!$result){
      die("Approve Query Failed" . mysqli_error($connection));
    } else {
      //Refresh the Page
      $RefreshPostURL = "View_Posts.php";
      $RefreshPost = new Refresh;
      $RefreshPost->RefreshPage($RefreshPostURL);
    }
  }
//End of Function to Manage Posts
}





//Function to Create Posts
function AdminCreatePosts(){


  //Check if the post has been submitted
  if(isset($_POST['create_post'])){

    //Database Connection
    global $connection;

    //Store Post Results within Variables
    $PostTitle = $_POST['title'];
    $PostCat = $_POST['CatID'];
    $PostAuthor = $_POST['Author'];
    $PostStatus = $_POST['status'];
    $PostTags = $_POST['post_tags'];
    $PostContent = $_POST['content'];
    $PostDate = date('d-m-y');
    $PostUserID = $_POST['user'];

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
        $RefreshPostURL = "View_Posts.php";
        $refreshPostPage = new Refresh;
        $refreshPostPage->RefreshPage($RefreshPostURL);


      }
    }
  //End of Function to Create Posts
  }


  //READ Part of the CRUD

  //Function to call Posts into View All Posts page

  function ViewAllPosts(){


    //Global Database connection
    global $connection;

    //SQL Query to Select Post Information
    $query = "SELECT posts.post_id,
              categories.cat_title AS 'post_category',
              posts.post_title,
              posts.post_author,
              posts.post_date,
              posts.post_image,
              posts.post_content,
              posts.post_tags,
              (SELECT count(*)
              FROM comments
              WHERE posts.post_id = comments.comment_post_id) AS 'post_comment_count',
              users.user_username AS 'post_username',
              post_status.ps_status_description AS 'post_status'
              FROM posts
              LEFT JOIN categories ON categories.cat_id = posts.post_category_id
              LEFT JOIN post_status ON post_status.ps_id = posts.post_status_id
              LEFT JOIN users ON users.user_id = posts.post_user_id";

    //Pass the Query to the Database
    $result = mysqli_query($connection, $query);

    //Validate Query
    if(!$result){
      die("Query to Select Post Information Failed" . mysqli_error($connection));
    }
    else {
      while ($row = mysqli_fetch_assoc($result)){


        //Store Query Results
        $PostID = $row['post_id'];
        $PostAuthor = $row['post_author'];
        $PostTitle = $row['post_title'];
        $PostCat = $row['post_category'];
        $PostStatus = $row['post_status'];
        $PostContent = $row['post_content'];
        $PostImage = $row['post_image'];
        $PostTags = $row['post_tags'];
        $PostCommentCount = $row['post_comment_count'];
        $PostDate = $row['post_date'];
        $PostUsername = $row['post_username'];


        //Populate Table Row with Query Results
        echo "<tr>";
        echo "<td><input class='checkBoxes' name='checkBoxArray[]' type='checkbox' value='{$PostID}'></td>";
        echo "<td>{$PostID}</td>";
        echo "<td>{$PostAuthor}</td>";
        echo "<td>{$PostUsername}";
        echo "<td><a href='../post.php?PostID={$PostID}' target='_blank'>{$PostTitle}</a></td>";
        // echo "<td>{$PostTitle}</td>";
        echo "<td>{$PostCat}</td>";
        echo "<td>{$PostStatus}</td>";
        echo "<td>{$PostContent}</td>";
        echo "<td><img class='img-responsive' src='../images/{$PostImage}' alt='{$PostImage}'</td>";
        echo "<td>{$PostTags}</td>";
        echo "<td><a href='./view_comments.php?source=ID&PostID={$PostID}' target='_blank'>{$PostCommentCount}</a></td>";
        echo "<td>{$PostDate}</td>";
        echo "<td><a href='View_Posts.php?source=Approve&PostID={$PostID}'>Approve</a></td>";
        echo "<td><a href='View_Posts.php?source=Reject&PostID={$PostID}'>Reject</a></td>";
        echo "<td><a href='View_Posts.php?source=Update&PostID={$PostID}'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you wish to delete these record(s)'); \" href='View_Posts.php?source=Delete&PostID={$PostID}'>Delete</a></td>";
        echo "</tr>";
      }
    }
  //End of Function to call Posts into View All Posts page
  }









  //Function to update Posts
  function AdminUpdatePosts(){

    /****GET REQUEST PART***/
    //check for GET Request Submitted from the above ViewAllPosts();
    if(isset($_GET['PostID'])){

      //Global Database connection
      global $connection;

      //Store Post ID
      $CurrentPostID = $_GET['PostID'];
      $CurrentPostID = mysqli_real_escape_string($connection, $CurrentPostID);



      //SQL Query to Select Post Information
      $query = "SELECT posts.post_id,
                categories.cat_title AS 'post_category',
                posts.post_title,
                posts.post_author,
                posts.post_date,
                posts.post_image,
                posts.post_content,
                posts.post_tags,
                posts.post_comment_count,
                post_status.ps_status_description AS 'post_status'
                FROM posts
                LEFT JOIN categories ON categories.cat_id = posts.post_category_id
                LEFT JOIN post_status ON post_status.ps_id = posts.post_status_id
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
          $PostID = $row['post_id'];
          $PostAuthor = $row['post_author'];
          $PostTitle = $row['post_title'];
          $PostCat = $row['post_category'];
          $PostStatus = $row['post_status'];
          $PostContent = $row['post_content'];
          $PostImage = $row['post_image'];
          $PostTags = $row['post_tags'];
          $PostCommentCount = $row['post_comment_count'];
          $PostDate = $row['post_date'];

          ?>

          <div class="col-xs-12">
          <form action="" method="post" enctype="multipart/form-data">

          <div class="form-group">
          <label for="title">Enter a Post Title*</label>
          <input class="form-control" type="text" name="title" value="<?php echo "$PostTitle"; ?>">
          </div>

          <div class="form-group">
            <label for="status">Choose a Post User*</label>
            <br>
            <select class="form-control" name="user">
              <?php
               $SelectPostUsername = new Admin;
               $SelectPostUsername->SelectPostUser();
             ?>
            </select>
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
          <label for="Author">Enter a Post Author*</label>
          <input class="form-control" type="text" name="Author" value="<?php echo"$PostAuthor"; ?>">
          </div>

          <div class="form-group">
            <label for="status">Choose a Post User*</label>
            <br>
            <select class="form-control" name="user">
              <?php
                $SelectPostUser = new Admin;
                $SelectPostUser->SelectPostUser();
              ?>
            </select>
          </div>

          <div class="form-group">
          <label for="status">Choose a Post Status*</label>
          <br>
          <select class="form-control" name="status">
            <?php
              $SelectCategory = new Admin;
              $SelectCategory->SelectPostStatus();
            ?>
          </select>
          </div>

          <div class="form-group">
          <label for="image">Choose an Image*</label>
          <br>
          <img src="../Images/<?php echo $PostImage; ?>" alt="<?php echo $PostImage; ?>">
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

        }
      }
      //End of GET Request Section
    }

    /****POST REQUEST PART***/
    //Check if the post has been submitted
    if(isset($_POST['edit_post'])){

      //Store Post Results within Variables
      $EditPostTitle = $_POST['title'];
      $EditPostCat = $_POST['CatID'];
      $EditPostAuthor = $_POST['Author'];
      $EditPostStatus = $_POST['status'];
      $EditPostTags = $_POST['post_tags'];
      $EditPostContent = $_POST['content'];
      $EditPostUser = $_POST['user'];

      $EditPostTitle = mysqli_real_escape_string($connection, $EditPostTitle);
      $EditPostCat = mysqli_real_escape_string($connection, $EditPostCat);
      $EditPostAuthor = mysqli_real_escape_string($connection, $EditPostAuthor);
      $EditPostStatus = mysqli_real_escape_string($connection, $EditPostStatus);
      $EditPostTags = mysqli_real_escape_string($connection, $EditPostTags);
      $EditPostContent = mysqli_real_escape_string($connection, $EditPostContent);
      $EditPostUser = mysqli_real_escape_string($connection, $EditPostUser);

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
                         posts.post_author = '$EditPostAuthor',
                         posts.post_image = '$ImageName',
                         posts.post_content = '$EditPostContent',
                         posts.post_tags = '$EditPostTags',
                         posts.post_status_id = '$EditPostStatus',
                         posts.post_user_id = '$EditPostUser'
                    WHERE posts.post_id = '$CurrentPostID'";

        //Pass Query to Database
        $EditResult = mysqli_query($connection, $EditQuery );

        //Validate Query
        if(!$EditResult){
          die("Add Post Query Failed" . mysqli_error($connection));
        }  else {
          //Refresh the Page
          $RefreshPostURL = "View_Posts.php";
          $RefreshPost = new Refresh;
          $RefreshPost->RefreshPage($RefreshPostURL);
        }
        //END OF POST request Section
      }
  //END of the Update Posts Function
}





  //Function To Delete Posts
  function DeletePosts(){

    start_session();

    if(isset($_SESSION['username'])){

      $RoleID = $_SESSION['user_role_id'];

      if($RoleID == 1){
        //check for GET Request sent from ViewAllPosts();
        if(isset($_GET['PostID'])){

          //Global Database Connection
          global $connection;

          //Store Post ID
          $PostID = $_GET['PostID'];
          $PostID = mysqli_real_escape_string($connection, $PostID);


          //Query to Delete Posts
          $query = "DELETE FROM posts
          WHERE posts.post_id = $PostID";

          //Pass the Query to the Database
          $result = mysqli_query($connection, $query);

          //validate Query
          if(!$result){
            die("Delete Posts Query Failed" . mysqli_error($connection));
          } else {
            //Refresh the Page
            $RefreshPostURL = "View_Posts.php";
            $RefreshPost = new Refresh;
            $RefreshPost->RefreshPage($RefreshPostURL);
          }
      //End of Post ID Check
      }
    //End of Role ID = 1 Check
  } else {
    //Refresh the Page
    $RefreshPostURL = "../index.php";
    $RefreshPost = new Refresh;
    $RefreshPost->RefreshPage($RefreshPostURL);
  }
 //End of Username Session Check
 }
//End of Delete Posts Function
}



  //Function to update status en mass
  function MassUpdatePosts(){


    //check for POST request
    if(isset($_POST['checkBoxArray'])){

      //Database Connection String
      global $connection;

      if(isset($_POST['bulk_options'])){

        //Store the Post Status ID
        $OptionID = $_POST['bulk_options'];
        $OptionID = mysqli_real_escape_string($connection, $OptionID);


        //check to ensure there is a Post status ID
        if($OptionID < 0){


          //Refresh the Page
          $RefreshPostURL = "View_Posts.php";
          $RefreshPost = new Refresh;
          $RefreshPost->RefreshPage($RefreshPostURL);

        }

        //If 0 then we delete the Post
        elseif($OptionID == 0){

          foreach ($_POST['checkBoxArray'] as $key) {

            $query = "DELETE FROM posts
                      WHERE posts.post_id = '$key'";

            //Pass the Query to the Database
            $result = mysqli_query($connection, $query);

            //validate Query
            if(!$result){
              die("Update Pos Status Query Failed" . mysqli_error($connection));
            } else {

              //Refresh the Page
              $RefreshPostURL = "View_Posts.php";
              $RefreshPost = new Refresh;
              $RefreshPost->RefreshPage($RefreshPostURL);
            }
          }
        }
        //Update the Post Status if it passes the above
        else {
          foreach ($_POST['checkBoxArray'] as $key) {

            $query = "UPDATE posts
                      SET posts.post_status_id = '$OptionID'
                      WHERE posts.post_id = '$key'";

            //Pass the Query to the Database
            $result = mysqli_query($connection, $query);

            //validate Query
            if(!$result){
              die("Update Pos Status Query Failed" . mysqli_error($connection));
            } else {

              //Refresh the Page
              $RefreshPostURL = "View_Posts.php";
              $RefreshPost = new Refresh;
              $RefreshPost->RefreshPage($RefreshPostURL);

            }
          }
        }
      }
    }
    //End of Function to update status en mass
  }




?>
