<!--
  This will populate the view_users.php page. The function below will retrieve
  the users information from the database and display inline with the table.
  This function can be found within the;

  root/admin/php/UsersPage.php
-->



<!-- Users  Table -->
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Username</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Profile Picture</th>
      <th>Role</th>
      <th colspan="2">Options</th>
    </tr>
  </thead>


  <tbody>
    <?php ViewAllUsers(); ?>
  </tbody>



</table>
