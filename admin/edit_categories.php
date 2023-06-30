
<?php

// Header
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminHeader.php');


/**
  * All Functions on this page can be Found witin the;
  *
  * root/admin/php/CategoryPage.php
  */

  
EditCategories();

?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminNavigation.php');?>




  <!-- Page Heading -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome to the Admin Panel
            <br>
            <small>Category Management</small>
          </h1>


          <!-- Add Category Form -->
          <div class="col-xs-6">

            <!-- Edit Category Form -->
            <form action="" method="post">

              <label for="edit_cat_title">Enter New Category Title</label>
              <div class="form-group">
                <input class="form-control" type="text" name="edit_cat_title"
                placeholder="update to all the new things">
              </div>

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="edit_cat_submit" value="Edit Category">
              </div>

            </form>
          </div>


        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminFooter.php');?>
