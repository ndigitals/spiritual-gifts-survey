<?php
/*
Plugin Name: Email Signup for Link
Plugin URI: http://email-link.mynamedia.net
Description: This is a simple plugin with a shortcode that requires users to input their first & last name and email address to get access to a link (which will be emailed to them automatically).  This link could be to a file download, for example.  The site admin's email (or an alternate email) is notified with the signup information, which allows for collection of user information in return for a free link.
Version: 0.9.0
Author: Dave Koenig of Myna Media
Author URI: http://mynamedia.com
License: GPLv2

Copyright 2013  PLUGIN_AUTHOR_NAME  (email : dave@mynamedia.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// create a submenu under the "settings" menu option
add_action('admin_menu', 'email_for_link_create_submenu');

//--------------------------------------------------
//--------------SUBMENU-----------------------------
//--------------------------------------------------
function email_for_link_create_submenu() {
    add_options_page('Email for Link', 'Email for Link', 'manage_options', 'email_for_link_edit_menu', 'email_for_link_settings_page');
}
//--------------------------------------------------
//--------------OPTIONS PAGE------------------------
//--------------------------------------------------
function email_for_link_settings_page() { /*I have to exit PHP to write all the HTML*/ ?> 
    <div class="wrap">
        <h2>Email for Link Form</h2>
        <h3>Adding the Email for Link form to a Page</h3>
        All you have to do to get the form working on your website is include the <code>[email_link link="http://yourwebsite.com/link"]</code> shortcode on the page where you wish the form to appear.
        <h3>Options</h3>
        <p>Use <code><b>email="you@email.com"</b></code> if you wish to specify the target email address, otherwise the admin email <span style="font-style: italic"><?php print get_bloginfo( 'admin_email', 'Display'); ?></span> will be used.
        <br />For example, <code>[email_link link="http://yourwebsite.com/link" <b>email="you@email.com"</b>]</code></p>
    </div> <?php
}

//--------------------------------------------------
//--------------IF SURVEY COMPLETED-----------------
//--------------------------------------------------

// [email_link link="email@address.com"]
function email_link_shortcode_func( $atts ) {
//    echo "referrer: ".$_SERVER['HTTP_REFERER']."<br />";
//    echo "current: ".email_link_curPageURL();
    /*
    Checks to see if the form was just submitted.  This plugin calls the file 'mail.php'
    which sends the email then redirects the user back to the original page.
    This if/else statement tests to see whether this redirect has already happened (meaning the form
    had already been submitted), and if so, sends a "thank you" message.  If not, the form is
    drawn up.  This way only one Wordpress page needs to be made, rather than having them create one
    page for the form and another for the thank you.
    */
    if (email_link_curPageURL() == $_SERVER['HTTP_REFERER']."?submitted" ) {
        return "Thank you, the link will be emailed to the address you provided.  <a href='".$_SERVER['HTTP_REFERER']."'>Enter another email address</a>?";
    } else {
        extract( shortcode_atts( array(
            'email' => get_bloginfo( 'admin_email', 'Display'),
            'link' => 'http://mynamedia.com',
        ), $atts ) );
        return email_link_write_form( $email, $link );
    }
}

//--------------------------------------------------
//--------------ADD SHORTCODE FUNCTIONALITY---------
//--------------------------------------------------
add_shortcode( 'email_link', 'email_link_shortcode_func' );

//--------------------------------------------------
//--------------WRITE THE FORM----------------------
//--------------------------------------------------
function email_link_write_form( $email, $link ) {
    $return_var = "";
    
    //write styles
    $return_var .= <<<EOD
	<style>
	#efl_body {
		margin: 0px;
	}
	.efl_field {
		margin-bottom: 0px !important;
		padding: 10px;
	}
	.efl_field input {
		width: 75%;
	}
	.efl_label {
		width: 20%;
		font-size: 8pt;
		display: inline-block;
		margin-bottom: 0px;
		padding: 0px;
	}
	.efl_submit {
		margin-top: 10px;
		float: right;
		margin-right: 4%;
	}
	.efl_first { background: #eeeeee; }
	.efl_second { background: #e6e6e6; }
	.efl_third { background: #eeeeee; }
	</style>
EOD;
    
    //start body of page
    $url = plugins_url('email-signup-for-link/mail.php');
    $return_var .= <<<EOD
		<form name='mySurvey' action='$url' method='post' >
		<div id='efl_body'>
			
		
			<h4 style='margin-bottom: 5px'>Submit Information</h4>
			<p class="efl_field efl_first"><span class="efl_label">First Name:</span>
			<input type='text' name='userFirstName' /></p>
			<p class="efl_field efl_second"><span class="efl_label">Last Name:</span>
			<input type='text' name='userLastName' /></p>
			<p class="efl_field efl_third"><span class="efl_label">Email Address:</span>
			<input type='text' name='userEmailAddress' /></p>
			<input type='submit' value='Submit Form!' class="efl_submit" /><br /></p>
		</div><!-- submit-form -->
EOD;

    //hidden variables that need to be passed to 'gifts-email.php'
    $return_var .= "<input type='hidden' name='adminEmail' value='".$email."' />";
    $return_var .= "<input type='hidden' name='link' value='".$link."' />";
    $return_var .= "<input type='hidden' name='siteTitle' value='".get_bloginfo('name')."' />";
    $return_var .= "</form>";

    return $return_var;
}

//grabs current page url
//echo email_link_curPageURL();
function email_link_curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
?>