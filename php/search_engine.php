<?php

/*
* This file contains the code used for the search engine on the Main Website.
*/


//Search Engine function
function SearchEngine(){

  //validate post submission
  if(isset($_POST['submit'])){

    //bring through variable for database connection
    global $connection;

    //store search text as variable
    $SearchText = $_POST['search'];
    $SearchText = mysqli_real_escape_string($connection, $SearchText);

    //SQL to query search tags within the post table
    $query = "SELECT *
              FROM posts
              WHERE posts.post_tags LIKE '%$SearchText%'";



    //Connect to the database and run the query
    $result = mysqli_query($connection, $query);

    //validate results
    if(!$result){
      die("Search Query Failed" . mysqli_error($connection));
    } else {
      //checking results returned by the query
      $count = mysqli_num_rows($result);

      //Return Posts that match the search
      if($count > 0){

        //Query the Database
        $result = mysqli_query($connection, $query);

        //Validate query
        if(!$result){
          die("Search Engine Query Failed" . mysqli_error($connection));
        } else {

          //showing query results to display in navigation
          while ($row = mysqli_fetch_assoc($result)){
            $PostTitle = $row['post_title'];
            $PostAuthor = $row['post_author'];
            $PostDate = $row['post_date'];
            $PostImage = $row['post_image'];
            $PostContent = substr($row['post_content'],0,150);
            ?>

            <!-- Blog Post -->
            <h2>
              <a href="#"><?php echo $PostTitle; ?></a>
            </h2>
            <p class="lead">
              by <a href="index.php"><?php echo $PostAuthor; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $PostDate; ?></p>
            <hr>
            <img class="img-responsive" src="./images/<?php echo $PostImage; ?>" alt="Post Image">
            <hr>
            <pre><?php echo $PostContent; ?></pre>
            <a class="btn btn-primary" href="post.php?PostID=<?php echo $PostID; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php
          }
        }
      }
    }
  }
  //end of Search Engine function
}


?>
