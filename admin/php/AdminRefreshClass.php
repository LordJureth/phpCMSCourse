<?php

/**
  * This Class was made to easy create a redirection link within functions
  * spread throughout the website.
  */


//Refresh / Redirect class
class Refresh {

  //Dynamic Refresh
  public function RefreshPage($DynamicRefresh){

    //Refresh Page
    header("Location: $DynamicRefresh");
    exit;

  //End of ReFreshPage Function
  }


  
//End of Refresh Class
}


?>
