<?php
$to_email = "jsiddhesh70@gmail.com";
$subject = "Sudarshan is testing the send email via php";
$body = "Hii just for testing purpose..!! dont take is seriously";
$headers = "From: snivalkar1998@gmail.com";

if(mail($to_email,$subject,$body,$headers)){

    echo "Email Sucessfully sent to $to_email";
}else{
    echo "Email Sending failed";
}
?>