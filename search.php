<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/header.php'); ?>


<!-- Navigation -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/navigation.php'); ?>


<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <h1 class="page-header">
        Welcome to My Blog Website <small><?php WelcomeName(); ?></small>
      </h1>

      <!--
        Handles and shows the search engine results. This can be found
        within the;

        root/php/search_engine.php
      -->

      <?php SearchEngine();?>
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/sidebar.php'); ?>



  </div>
  <!-- /.row -->

  <hr>

  <!-- Footer -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
