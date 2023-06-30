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

            <h1>Contact Us</h1>

            <!--
              Handles the Contact us form submition, found within the;
              root/php/contact_us_management.php.
            -->
            <?php ContactUs(); ?>

            <!-- Contact Us Form -->
            <form role="form" action="contact_us.php" method="post">

              <!-- Email -->
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>

              <!-- Subject -->
              <div class="form-group">
                <label for="subject" class="sr-only">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject name here.">
              </div>

              <!-- Body -->
              <div class="form-group">
                <label for="body" class="sr-only">Body</label>
                <textarea name="body" rows="8" cols="80" class="form-control" placeholder="Enter your query here."></textarea>
              </div>

              <!-- Submit Button -->
              <input type="submit" name="submit" class="btn btn-custom btn-lg btn-block" value="Submit">



            </form>
          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>

  <!-- Footer -->
  <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/footer.php'); ?>
