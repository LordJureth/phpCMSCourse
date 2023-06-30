<?php

/*
 * this file contains a list of required files
 */



//Script files
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/category_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/comment_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/post_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/search_engine.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/login_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/registration_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/contact_us_management.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/ProfileManagement.php');

//Database
include($_SERVER['DOCUMENT_ROOT'].'/cms/php/config.php');

//Class files
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminRefreshClass.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/php/AdminClass.php');



?>
