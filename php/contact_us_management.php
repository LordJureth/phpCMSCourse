<?php

//function to control the contact us form
function ContactUs(){



  if(isset($_POST['submit'])){

  //Databse string
  global $connection;

  /******* Store Form Details Section ******/

  $ContactUsEmail = $_POST['email'];
  $ContactUsSubject = $_POST['subject'];
  $ContactUsBody = $_POST['body'];

  //Send email too address
  $SendEmailTo = "toby_loudon@hotmail.co.uk";

  //Clean the data

  $ContactUsEmail = mysqli_real_escape_string($connection, $ContactUsEmail);
  $ContactUsSubject = mysqli_real_escape_string($connection, $ContactUsSubject);
  $ContactUsBody = mysqli_real_escape_string($connection, $ContactUsBody);

  /****** End of Store Form Details Section ******/



  // the message
  $msg = "This Email has been sent from $ContactUsEmail\n
          The Email Subject is $ContactUsSubject\n
          They have emailed over; $ContactUsBody ";

  // use wordwrap() if lines are longer than 70 characters
  $msg = wordwrap($msg,70);

  // send email
  mail("$SendEmailTo","$ContactUsSubject",$msg,"FROM: $ContactUsEmail");


  }
}


?>
