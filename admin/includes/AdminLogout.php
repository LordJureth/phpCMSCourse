<?php

/**
  * This Page handles the Logging out of Users. The Function can be found on
  * Root/admin/php/AdminLogonManagement.php script.
  */

//Required files
include($_SERVER['DOCUMENT_ROOT'].'/cms/admin/includes/AdminScripts.php');


//Destroy session and redirect to home page
AdminLogout();

?>
