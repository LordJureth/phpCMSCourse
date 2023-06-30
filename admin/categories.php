
<?php

// Header
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminHeader.php');

/**
  * All Functions on this page can be Found witin the;
  *
  * root/admin/php/CategoryPage.php
  */


AddCategory();

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
            Category Management
          </h1>


          <!-- Add Category Form -->
          <div class="col-xs-6">
            <form action="" method="post">

              <label for="cat_title">Enter New Category Title</label>
              <div class="form-group">
                <input class="form-control" type="text" name="cat_title"
                placeholder="Add all the new things">
              </div>

              <div class="form-group">
                <input class="btn btn-primary" type="submit" name="cat_submit" value="Add Category">
              </div>
          </div>


          <!-- Display and Delete Category Table -->
          <div class="col-xs-6">
            <table class="table table-bordered table-hover">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Title</th>
                  <th colspan="2">Options</th>
                </tr>
              </thead>

              <tbody>
                <?php
                DeleteCategories();
                CallCategories();
                ?>

              </tbody>

            </table>
          </div>


        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminFooter.php');?>
