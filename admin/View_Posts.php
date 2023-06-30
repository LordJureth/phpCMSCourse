
<?php


// Header
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminHeader.php');

/**
  * All Functions on this page can be Found witin the;
  *
  * root/admin/php/PostsPage.php
  */

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
            Post Management
          </h1>

          <!-- Handles what Post information will be displayed -->
          <?php PostCRUD(); ?>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminFooter.php');?>
