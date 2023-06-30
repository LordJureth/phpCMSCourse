<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php" target="_blank">Home Page</a>
    </div>




    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">

      <!-- Users Online -->
      <!-- This function  can be found within the root/admin/php/AdminClass.php -->
      <li class="navbar-brand">Users Online: <?php $c = new Admin; $c->CountOnlineUsers(); ?></li>


        <!-- Profile Drop Down-->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>

            <ul class="dropdown-menu">
                <li>
                    <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>

                <li class="divider"></li>

                <li>
                    <a href="./includes/AdminLogout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>





    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">

            <!-- Dashboard -->
            <li>
                <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>


            <!-- Users Dashboard -->
            <li>
                <a href="user_dashboard.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $_SESSION['username']; ?>'s Dashboard</a>
            </li>


            <!-- Posts Drop Down -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#post_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>

                <ul id="post_dropdown" class="collapse">
                    <li>
                        <a href="./View_Posts.php">View All Posts</a>
                    </li>


                    <li>
                        <a href="./View_Posts.php?source=Create">Add Posts</a>
                    </li>
                </ul>
            </li>


            <!-- Categories -->
            <li>
                <a href="categories.php"><i class="fa fa-fw fa-wrench"></i> Categories Page</a>
            </li>


            <!-- Comments -->
            <li>
              <a href="./view_comments.php"><i class="fa fa-fw fa-file"></i>View All Comments</a>
            </li>


            <!-- Users -->
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users_dropdown"><i class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="users_dropdown" class="collapse">
                    <li>
                        <a href="./view_users.php">View All Users</a>
                    </li>
                    <li>
                        <a href="./view_users.php?source=Create">Add Users</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
