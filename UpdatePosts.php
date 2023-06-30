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
        Welcome to the Post Update Page:
        <small><?php echo $_SESSION['username']; ?></small>
      </h1>

      <!--
        This function will allow you to update posts. It will retrieve the post information
        and display witin a form. You can then amend this form and submit it to send back
        to the databse to update it.  This can be found within the;

        root/php/post_management.php
      -->
      
      <?php UpdatePosts(); ?>


<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
