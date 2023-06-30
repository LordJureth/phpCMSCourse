<!--
  This form allows us to create new users. The CreateUser Function can be
  found within the;

  root/admin/php/UsersPage.php
-->

<?php CreateUser(); ?>


<div class="col-xs-12">
<form action="" method="post" enctype="multipart/form-data">

  <!-- Username -->
  <div class="form-group">
    <label for="title">Enter a Username*</label>
    <input class="form-control" type="text" name="username">
  </div>


  <!-- Password -->
  <div class="form-group">
    <label for="Author">Enter a Password*</label>
    <input class="form-control" type="password" name="password" autocomplete="off">
  </div>


  <!-- Image -->
  <div class="form-group">
    <label for="image">Choose an Image*</label>
    <input class="form-control" type="file" name="image">
  </div>


  <!-- First Name -->
  <div class="form-group">
    <label for="post_tags">Enter your First Name*</label>
    <input class="form-control" type="text" name="first_name">
  </div>

  <!-- Last Name -->
  <div class="form-group">
    <label for="post_tags">Enter your Last Name*</label>
    <input class="form-control" type="text" name="last_name">
  </div>


  <!-- Email Address -->
  <div class="form-group">
    <label for="content">Enter your Email address*</label>
    <input class="form-control" type="text" name="email">
  </div>


  <!-- Use Role -->
  <div class="form-group">
    <label for="content">Enter your Role</label>
    <select class="form-control" name="role">

      <!--
        This function will allow you to select the availble user roles.
        This can be found within;

        root/admin/php/AdminClass.php
      -->

      <?php $UserRoles = new Admin; $UserRoles->SelectUserRoles(); ?>
      
    </select>
  </div>

  <div class="form-group">
    <p>* Indicates a required field!</p>
  </div>

  <!-- Submit -->
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Create User">
  </div>

</form>
</div>
