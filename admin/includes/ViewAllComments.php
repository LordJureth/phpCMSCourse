<!--
  This will populate the view_comments.php page. The function below will retrieve
  the comment information from the database and display inline with the table.
  This function can be found within the;

  root/admin/php/CommentsPage.php
-->


<!-- Comments Table -->
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Post Title</th>
      <th>Author</th>
      <th>Email</th>
      <th>Content</th>
      <th>Status</th>
      <th>Date</th>
      <th colspan="3">Options</th>
    </tr>
  </thead>


  <tbody>
    <?php CallAllComments(); ?>
  </tbody>



</table>
