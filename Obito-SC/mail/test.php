

<?php

   $to_email = $_POST['email']; 
   $subject = $_POST['subject']; 
   $body = $_POST['message'];
   $se1 =  $_POST['se'];
   $headers = "From: $se1";
 
   if ( mail($to_email, $subject, $body, $headers)) {
      echo("Email successfully sent to $to_email...");
   } else {
      echo("Email sending failed...reasons: daily quota filled");
   }
?>