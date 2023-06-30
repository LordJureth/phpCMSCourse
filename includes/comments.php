<?php

/**
  * All Functions on this page can be Found witin the;
  *
  * root/admin/php/UsersPage.php
  *
  * The functions will format the Comments section within the posts page.
  */


?>


  <!-- handle the creation of comments -->
  <?php CreateComments(); ?>


  <!-- Comment form Section -->
  <?php AddCommentsForm(); ?>

  <hr>

  <!-- Display Comments -->
  <div class="media">
      <?php CallAllPostComments(); ?>
  </div>
