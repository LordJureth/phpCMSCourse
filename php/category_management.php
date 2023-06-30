<?php

/*
* This file contains the code used for the categories on the Main Website.
*/


//Function to pull categories from the database and dislay as Navigation
function SelectCategories(){

  //Database Connection String
  global $connection;

  //MySQL Query to select all categories
  $query = "SELECT *
            FROM categories";

  //Send query the Database
  $result = mysqli_query($connection, $query);

  //Validate the query
  if(!$result){
    die("Category Query Failed" . mysqli_error($connection));
  } else {

    //Displaying the query results
    while ($row = mysqli_fetch_assoc($result)){
      $CategoryID = $row['cat_id'];
      $category = $row['cat_title'];
      echo "<li><a href='categories.php?CatID={$CategoryID}'>{$category}</a></li>";
    }
  }
//end of Function to pull categories from the database
}



?>
