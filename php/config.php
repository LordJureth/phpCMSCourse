<?php

/*
 * This file contains the MySQL Database Connection details
 */


//Connection Detail Array
$staging = array("host" => 'localhost',
                 "user" => 'root',
                 "password" => '',
                 "database" => 'cms');

//Ensure all values are uppercase
foreach($staging as $key => $value){
  define(strtoupper($key), $value);
}


//Defining the connection string
$connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);


//Validte the Connection string
if(!$connection){
  die("Connection to Database failed" . mysqli_error($connection));
}


?>
