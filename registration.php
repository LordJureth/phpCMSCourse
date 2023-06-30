<!-- Header -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/header.php'); ?>


<!-- Navigation -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/navigation.php'); ?>


<!-- Page Content -->
<div class="container">

  <!-- Registration form -->
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">

            <h1>Registration Form</h1>

            <!--
              Handles the Registration of the User based on the form below. This
              can be found within the;

              root/php/registration_management.php
            -->
            <?php RegisterUser(); ?>

            <!-- Registration form -->
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

              <!-- Username -->
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
              </div>

              <!-- Email -->
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>

              <!-- Password -->
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                <p>Password must contain at least one uppercase letter, one special character, one number and at least 8 characters long</p>
              </div>


              <!-- Submit Button -->
              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">



            </form>
          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>

  <!-- Footer -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
