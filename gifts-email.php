<?php


//POST variables
//userEmailAddress, typesCount (how many spiritual gifts there are, used in a for loop)
//typeResult1 (where '1' is the first result, there are x amount of these typeResults where x is the total spiritual gifts)

//echo "typesCount: ". $_POST["typesCount"]."<br />";
//echo "email addresses: ".$_POST["userEmailAddress"]."(user), ".$_POST["adminEmail"]."(admin)"."<br />";
//echo "site title:".$_POST["siteTitle"]."<br />";
ob_start();

// Check to see if the SPAM field is filled in
if($_POST['anotherField'] == '') {
    //A real human filled in this form, congrats!
    
    // Contact subject
    $subject ="Spiritual Gifts Survey"; 
    // Headers
    $headers = "From: " . strip_tags($_POST['userName']) . " <" . strip_tags($_POST['userEmailAddress']) . ">\r\n";
    $headers .= "Reply-To: ". strip_tags($_POST['userEmailAddress']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // Enter your email address
    $to = $_POST["adminEmail"].", ".$_POST["userEmailAddress"];
    // Message Details
    // This is where all the variables from the form are passed (except the email addresses)
    $message = "<div style='font-family: Sans-Serif; width: 100%; background: #cccccc'><div style='height: 30px; max-width: 600px; margin: 0 auto; padding-top: 5px; color: #888888; text-align: center'>&nbsp;</div><div style='max-width: 600px; padding: 15px; margin: 0 auto; background: #ffffff; border: 15px solid #cccccc'>";
    
    $message .= "<p><h1 style='background: #222222; color: white; text-align: center; padding: 15px'>Spiritual Gifts Survey</h1></p>";
    
    $message .= "<p>Thank you " . strip_tags($_POST['userName']) . " for taking the Spiritual Gifts Survey.  We will try to get in touch with you soon to discuss how your gifts may used in our ministry.</p>";
    
    //list Spiritual gifts.  The for loop goes through all the individual results
    if($_POST['shape'] != 'false') {
        $message .= "<p><h2 style='background: #555555; color: white; text-align: center; padding: 10px'>[S]piritual Gifts</h2></p>";
    } else {
        $message .= "<br />";
    }
    $message .= "<b>Here is how your spiritual gifts scored:</b><br /><br />";
    //gifts loop
    for($i=0;$i<$_POST["typesCount"];$i++) {
        $message .= "<p><div style='display: inline-block; width: 110px'>".$_POST["typeTitle".$i]." </div>".$_POST["typeResult".$i]."</p>";
    }
    
    if($_POST['shape'] != 'false') {
    //[S]piritual Gifts
    $message .= "<p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>#1 Gift, ".$_POST["top_1"]." (".$_POST["topScore_1"].")</div></p>";
    $message .= "<p><b>I see this gift evident in my life in the following ways:</b><br />".$_POST["topreason1_text"]."</p>";
    $message .= "<p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>#2 Gift, ".$_POST["top_2"]." (".$_POST["topScore_2"].")</div></p>";
    $message .= "<p><b>I see this gift evident in my life in the following ways:</b><br />".$_POST["topreason2_text"]."</p>";
    $message .= "<p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>#3 Gift, ".$_POST["top_3"]." (".$_POST["topScore_3"].")</div></p>";
    $message .= "<p><b>I see this gift evident in my life in the following ways:</b><br />".$_POST["topreason3_text"]."</p>";
    
    //[H]eart
    $message .= "<p><h2 style='background: #555555; color: white; text-align: center; padding: 10px'>[H]eart</h2></p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Three things I love to do:</div></p>
    <p>1. ".$_POST["heart1_text"]."</p>
    <p>2. ".$_POST["heart2_text"]."</p>
    <p>3. ".$_POST["heart3_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Who I love to work with most, and the age or type of people:</div></p>
    <p>".$_POST["heart4_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Church issues, ministries, or possible needs that excite or concern me the most:</div></p>
    <p>".$_POST["heart5_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>If I knew I couldn't fail, this is what I would attempt to do for God with my life:</div></p>
    <p>".$_POST["heart6_text"]."</p>";
    
    //[A]bilities
    $message .= "<p><h2 style='background: #555555; color: white; text-align: center; padding: 10px'>[A]bilities</h2></p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>My current vocation:</div></p>
    <p>".$_POST["abilities1_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Other jobs I have experience in:</div></p>
    <p>".$_POST["abilities2_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Special talents/skills that I have:</div></p>
    <p>".$_POST["abilities3_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>I have taught a class or seminar on:</div></p>
    <p>".$_POST["abilities4_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>I feel my most valuable personal asset is:</div></p>
    <p>".$_POST["abilities5_text"]."</p>";
    
    //[P]ersonality
    $message .= "<p><h2 style='background: #555555; color: white; text-align: center; padding: 10px'>[P]ersonality</h2></p>
    <p><div style='font-weight: bold'>The personality traits that best fit me are:</div></p>
    <p>".$_POST["personality_1"]."</p>
    <p>".$_POST["personality_2"]."</p>
    <p>".$_POST["personality_3"]."</p>
    <p>".$_POST["personality_4"]."</p>
    <p>".$_POST["personality_5"]."</p>
    ";
    
    //[E]xperience
    $message .= "<p><h2 style='background: #555555; color: white; text-align: center; padding: 10px'>[E]xperience</h2></p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>My Testimony of how I became a Christian:</div></p>
    <p>".$_POST["experience1_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Other significant spiritual experiences that stand out in my life are:</div></p>
    <p>".$_POST["experience2_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>These are the kinds of trials or problems I could relate to and encourage a fellow Christian in:</div></p>
    <p>".$_POST["experience3_text"]."</p>
    <p><div style='background: #aaaaaa; text-align: center; color: white; padding: 5px; font-weight: normal'>Ministry Experience (Where I have served in the past, if applicable, including Church Name, City/State, Position, Years Involved)</div></p>
    <p>".$_POST["experience4_text"]."</p>
    <p>".$_POST["experience5_text"]."</p>
    <p>".$_POST["experience6_text"]."</p>
    <p>".$_POST["experience7_text"]."</p>
    ";
    }
    //end email body div
    $message .= "</div><div style='height: 35px; max-width: 600px; text-align: center; margin: 0 auto; padding-top: 8px'><a href='http://gifts.mynamedia.net' target='_blank' style='text-decoration: none; color: #888888'>G</a></div></div>";
    
    echo "to: ".$to."<br /><br />subject: ".$subject."<br /><br />header: ".$headers."<br /><br />message: <br />".$message;
    //print_r($_POST);
    
    
    $send_contact=mail($to,$subject,$message,$headers);
    
    if($send_contact){
        header( 'Location: '.$_SERVER['HTTP_REFERER'].'?submitted' ) ;
    } else {
        echo "ERROR";
    }
} else {
    //A spam bot filled in this form, boo!
    header( 'Location: '.$_SERVER['HTTP_REFERER'].'?spam' ) ;
}
ob_end_flush();

?>