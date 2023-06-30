<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/header.php'); ?>


<!-- Navigation -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/navigation.php'); ?>

<!--
  This Page handles the Creation of the Posts from a non admin user. This can be
  found within the root/php/post_management.php
-->

<?php CreatePosts(); ?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <h1 class="page-header">
        Welcome to the Post Creation Page:
        <small><?php echo $_SESSION['username']; ?></small>
      </h1>

      <div class="form-group">
        <p>Posts will be sumbmitted for review. Once approved it will show</p>
      </div>
    </div>

<!-- Create Posts Form -->
<div class="col-md-8">
<form action="" method="post" enctype="multipart/form-data">

  <!-- Post Title -->
  <div class="form-group">
    <label for="title">Enter a Post Title*</label>
    <input class="form-control" type="text" name="title">
  </div>

  <!-- Post Category -->
  <div class="form-group">
    <label for="CatID">Choose a Category*</label>
    <br>
    <select class="form-control" name="CatID">

      <!--
        Calling the Admin Class found within;  root/cms/php/AdminClass.php

        This is to show the Categories used for Users Posts.
      -->

      <?php
        $SelectPostCat = new Admin;
        $SelectPostCat->SelectPostCat();
      ?>
    </select>
  </div>


  <!-- Post Image -->
  <div class="form-group">
    <label for="image">Choose an Image*</label>
    <input class="form-control" type="file" name="image">
  </div>

  <!-- Post Tags -->
  <div class="form-group">
    <label for="post_tags">Enter your Post tags*</label>
    <input class="form-control" type="text" name="post_tags">
  </div>

  <!-- Post Content -->
  <div class="form-group">
    <label for="content">Enter your Post Content*</label>
    <textarea class="form-control" id="body" name="content" rows="10" cols="30">
    </textarea>
  </div>

  <div class="form-group">
    <p>* Indicates a required field!</p>
  </div>

  <!-- Submit Button -->
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>



</form>
</div>

<!-- Blog Sidebar Widgets Column -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/sidebar.php'); ?>



</div>
<!-- /.row -->


<!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
