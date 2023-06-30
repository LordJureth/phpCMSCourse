
<?php


// Header
include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/header.php');

?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/navigation.php');?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <h1 class="page-header">
          Welcome to My Blog Website <small><?php WelcomeName(); ?></small>
        </h1>


      <?php UserProfile(); ?>


      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->


    <!-- Footer -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php');?>
