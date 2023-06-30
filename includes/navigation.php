<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">


    <!-- This section controls the Navigation Toggle on smaller screens -->
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="Index.php">Home</a>
    </div>


    <!-- Top Navigation Panel -->
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav">
        <!-- These functions can be found within root/php/login_management.php -->
        <?php // SelectCategories(); ?>
        <?php RegisterButton(); ?>
        <?php CreatePost(); ?>
        <?php LoginButton(); ?>
        <li><a href='contact_us.php'>Contact Us</a></li>
        <?php ProfileDropDown(); ?>

      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>
