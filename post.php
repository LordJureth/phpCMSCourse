
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


      <?php

      /**
        * Depending on the GET Request will determin which of these trigger.
        * Either you are view a specific post or all Posts for an author. Both
        * of these functions can be found within the;
        *
        * root/php/post_management.php
        */
        
      //Show Post Information by ID
      SelectPostInformationByID();

      //Show Post Information by Author
      SelectPostInformationByAuthor();


      ?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/sidebar.php'); ?>



  </div>
  <!-- /.row -->

  <hr>

  <!-- Comments Section -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/comments.php'); ?>




  <!-- Footer -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
