<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search for a Blog</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
            </button>
            </span>
        </div>
      </form>
        <!-- /.input-group -->
    </div>



    <!-- Admin login form Well -->
    <?php // AdminLogonFormToggle(); ?>




    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <!--
                    Call categories from database, found within
                    root/php/category_management.php
                  -->
                  <?php SelectCategories(); ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>





    <!-- Side Widget Well -->
    <?php include($_SERVER['DOCUMENT_ROOT'].'/cms/includes/widget.php'); ?>

</div>
