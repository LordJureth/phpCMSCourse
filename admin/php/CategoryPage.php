<?php



// Create Part of the CRUD

//Add Category Function
function AddCategory(){
  if(isset($_POST['cat_submit'])){

    //pull in database connection string
    global $connection;

    //store category submition in a variable
    $CatTitle = $_POST['cat_title'];

    $CatTitle = mysqli_real_escape_string($connection, $CatTitle);

    //validate submition then submit request
    if($CatTitle == "" || empty($CatTitle)){
      echo "Please enter Category Name you wish to enter" . "<br>";
    } else {

      //SQL Query to add in category
      $query = "INSERT INTO categories (cat_title)
      VALUES ('{$CatTitle}')";

      //pass query to the database
      $result = mysqli_query($connection, $query);

      //Validate Query
      if(!$result){
        die("Query failed" . mysqli_error($connection));
      } else {
        //Refresh Page function via class
        $RefreshCatPageURL = "categories.php";
        $refreshAddCatPage = new Refresh;
        $refreshAddCatPage->RefreshPage($RefreshCatPageURL);
      }
    }
  }
  //End of Category Function
}







//READ PART OF THE CRUD



//Function to select Categories from Database

function CallCategories(){

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

      echo "
      <tr>
      <td>$cat_id</td>
      <td>$cat_title</td>
      <td><a href='edit_categories.php?update={$cat_id}'>Update</a></td>
      <td><a onClick=\"javascript: return confirm('Are you sure you wish to delete these record(s)'); \" href='categories.php?delete={$cat_id}'>Delete</a></td>
      </tr>";
    }
  }
  //End of Calling Categories Funcation
}


// UPDATE PART PF THE CRUD


//Function to update Categories
function EditCategories(){

  //check for POST Request
  if(isset($_POST['edit_cat_submit'])){

    global $connection;

    //store ID into a variable
    $CatTitleNew = $_POST['edit_cat_title'];

    $CatTitleNew = mysqli_real_escape_string($connection, $CatTitleNew);

    //store ID from Get Request
    if(!isset($_GET['update'])){
      die("GET Request for Cat ID Missing");
    } else {
      $CatTitleID = $_GET['update'];

      $CatTitleID = mysqli_real_escape_string($connection, $CatTitleID);
    }

    //Update MySQL Query
    $query = "UPDATE categories
              SET categories.cat_title = '$CatTitleNew'
              WHERE categories.cat_id = $CatTitleID";


    //Pass query to database
    $result = mysqli_query($connection, $query);

    //Validate GET Request
    if(!$result){
      die("Update Query Failed" . mysqli_error($connection));
    } else {

      //Refresh Page function via class
      $RefreshCatPageURL = "categories.php";
      $refreshAddCatPage = new Refresh;
      $refreshAddCatPage->RefreshPage($RefreshCatPageURL);
    }
  }
  //End of Update Category Function
}




//DELETE PART OF THE CRUD


//Function to delete Categories
function DeleteCategories(){


  if(isset($_SESSION['username'])){

    $RoleID = $_SESSION['user_role_id'];

    if($RoleID == 1){
      //check for GET Request
      if(isset($_GET['delete'])){

        //store id as variable
        $DeleteCat = $_GET['delete'];

        $DeleteCat = mysqli_real_escape_string($connection, $DeleteCat);

        //pull in database connection string
        global $connection;

        //Query to Delete Categories
        $query = "DELETE FROM categories
                  WHERE categories.cat_id = $DeleteCat";

        //Send the query to the database
        $result = mysqli_query($connection, $query);

        //Valiate query
        if(!$result) {
          die("Deletion Failed" . mysqli_error($connection));
        } else{

          //Refresh Page function via class
          $RefreshCatPageURL = "categories.php";
          $refreshAddCatPage = new Refresh;
          $refreshAddCatPage->RefreshPage($RefreshCatPageURL);
        }
      //End of Delete GET check
      }
    //End of Role ID Check
    }
  //End of Session Username Check
  }
//End of Category Delete Function
}



 ?>
