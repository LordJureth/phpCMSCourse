<?php

/*
 * this file contains a list of script files used throughout the admin panel.
 */


//Script files

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/CategoryPage.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/PostsPage.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/CommentsPage.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/UsersPage.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/ProfileManagement.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminGraphManagement.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminWidgetManagement.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminUserGraphManagement.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminUserWidgetManagement.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminLoginManagement.php');



//Database
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/config.php');

//Class files
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminRefreshClass.php');

include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminClass.php');





?>
