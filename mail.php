<?php


//POST variables
//userFirstName, userLastName, userEmailAddress, link, adminEmail, siteTitle

//echo "typesCount: ". $_POST["typesCount"]."<br />";
//echo "email addresses: ".$_POST["userEmailAddress"]."(user), ".$_POST["adminEmail"]."(admin)"."<br />";
//echo "site title:".$_POST["siteTitle"]."<br />";
//ob_start();

// Contact subject
$subject ="Email for Link: ".$_POST["siteTitle"]; 
// Headers
$headers = "From: " . strip_tags($_POST['adminEmail']) . "\r\n";
$headers .= "Reply-To: ". strip_tags($_POST['adminEmail']) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$to = $_POST["userEmailAddress"];
// Message Details
// This is where all the variables from the form are passed (except the email addresses)

$message .= "<p>".$_POST["userFirstName"]." ".$_POST["userLastName"].",<br />Thank you for signing up on our form, here is the link: ".$_POST["link"]."</p>";

//echo "to: ".$to."<br /><br />subject: ".$subject."<br /><br />header: ".$headers."<br /><br />message: <br />".$message;
//print_r($_POST);

$adminTo = $_POST["adminEmail"];
$adminSubject = "Email Signup for Link Submission";
$adminMessage = $_POST["userFirstName"]." ".$_POST["userLastName"]." ( ". $_POST["userEmailAddress"]." ) signed up to receive the following link: ".$_POST["link"];
mail($adminTo, $adminSubject, $adminMessage, $headers);





$send_contact = mail($to,$subject,$message,$headers);

if($send_contact){
    header( 'Location: '.$_SERVER['HTTP_REFERER'].'?submitted' ) ;
} else {
    echo "ERROR";
}

//ob_end_flush();

?>