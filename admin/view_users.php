
<?php


// Header
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminHeader.php');

/**
  * All Functions on this page can be Found witin the;
  *
  * root/admin/php/UsersPage.php
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
            User Management
          </h1>

          <!-- Controls what User Information will be displayed -->
          <?php  UsersCRUD(); ?>

      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminFooter.php');?>
