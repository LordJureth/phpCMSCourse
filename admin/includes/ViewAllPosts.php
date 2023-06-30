

<form class="" action="" method="post">


  <!-- Posts Table -->
  <table class="table table-bordered table-hover">

    <!--
      This funciton controls the mass update of post information based of
      the below form. This can be found within the;

      root/admin/php/PostsPage.php

      We can then mass change the post status or delete Posts.
    -->
    <?php MassUpdatePosts(); ?>


    <div id="bulkoptioncontainer" class="col-xs-4">
      <select class="form-control" name="bulk_options">
        <option>Select option</option>

        <!--
          Calling the Admin Class found within;  root/cms/php/AdminClass.php

          This is to show the Available Post Status used for Users Posts.
        -->

        <?php
          $SelectPostStatus = new Admin;
          $SelectPostStatus->SelectPostStatus();
        ?>

        <!-- Delete the Post option -->
        <option value="0">Delete Posts</option>

      </select>
    </div>

    <!-- Button to apply the changes on Mass -->
    <div class="col-xs-6">
      <input class="btn btn-success" type="submit" name="update_status" value="Apply Changes">

      <!-- Link to add a new post -->
      <a class="btn btn-primary" href="View_Posts.php?source=Create">Add new Post</a>
    </div>



<br>
<hr>

<!--
  This will populate the view_posts.php page. The function below will retrieve
  the Post information from the database and display inline with the table.
  This function can be found within the;

  root/admin/php/PostsPage.php
-->

    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>ID</th>
        <th>Author</th>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Content</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comment Count</th>
        <!-- <th>Comments</th> -->
        <th>Date</th>
        <th colspan="4">Options</th>
      </tr>
    </thead>


    <tbody>
      <?php

      //View all post information
      ViewAllPosts();

      //handle the View_Posts.php display
      PostManagement();

      ?>

    </tbody>



  </table>
</form>
