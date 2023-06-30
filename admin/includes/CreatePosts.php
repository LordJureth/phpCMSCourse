<!--

  This page holds the Create Posts Form and functions accosiated with it.
  The AdminCreatePosts function can be found within the;

  root/admin/php/PostsPage.php
-->


<?php AdminCreatePosts(); ?>


<div class="col-xs-12">
<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Enter a Post Title*</label>
    <input class="form-control" type="text" name="title">
  </div>

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

  <div class="form-group">
    <label for="Author">Enter a Post Author*</label>
    <input class="form-control" type="text" name="Author">
  </div>

  <div class="form-group">
    <label for="status">Choose a Post User*</label>
    <br>
    <select class="form-control" name="user">

      <!--
        Calling the Admin Class found within;  root/cms/php/AdminClass.php

        This is to show the Available users, this will allow us to add a post
        on a users behalf.
      -->

      <?php
        $SelectPostUser = new Admin;
        $SelectPostUser->SelectPostUser();
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="status">Choose a Post Status*</label>
    <br>
    <select class="form-control" name="status">

      <!--
        Calling the Admin Class found within;  root/cms/php/AdminClass.php

        This is to show the Available Post Status used for Users Posts.
      -->

      <?php
        $SelectPostStatus = new Admin;
        $SelectPostStatus->SelectPostStatus();
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="image">Choose an Image*</label>
    <input class="form-control" type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Enter your Post tags*</label>
    <input class="form-control" type="text" name="post_tags">
  </div>

<!-- ID was added to handle some JavaScript Widget -->
  <div class="form-group">
    <label for="content">Enter your Post Content*</label>
    <textarea class="form-control" id="body" name="content" rows="10" cols="30">
    </textarea>
  </div>

  <div class="form-group">
    <p>* Indicates a required field!</p>
  </div>


  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>
</div>
