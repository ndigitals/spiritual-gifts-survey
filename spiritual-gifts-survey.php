<?php
/*
Plugin Name: Spiritual Gifts Survey (and optional S.H.A.P.E survey)
Plugin URI: http://gifts.mynamedia.net
Description: Spiritual Gifts and Strengths survey to help church members find their place of service in the local church and other service organizations.
Version: 0.9.10
Author: Dave Koenig
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
add_action('admin_menu', 'spiritual_gifts_create_submenu');

function spiritual_gifts_create_submenu() {
    //create new submenu
    add_options_page('Spiritual Gifts Survey', 'Spiritual Gifts Survey', 'manage_options', 'spiritual_gifts_edit_menu', 'spiritual_gifts_settings_page');
}
// draw the options page
function spiritual_gifts_settings_page() { /*I have to exit PHP to write all the HTML*/ ?> 
    <div class="wrap">
        <h2>Spiritual Gifts Survey</h2>
        <h3>Adding the Spiritual Gifts Survey to a Page</h3>
        All you have to do to get the survey working on your website is include the <code>[spiritual_gifts]</code> shortcode on the page where you wish the survey to appear.
        <h3>Options</h3>
        <p>Use <code>[spiritual_gifts <b>email="your@email.com"</b>]</code> if you wish to specify the target email address, otherwise the admin email <span style="font-style: italic"><?php print get_bloginfo( 'admin_email', 'Display'); ?></span> will be used.</p>
        <p>Use <code>[spiritual_gifts <b>shape="false"</b>]</code> if you wish to disable the S.H.A.P.E. portion of the survey.</p>

        <h3>Materials</h3>
        The following materials can both equip the minister and the church member, and while the plugin developer is not affiliated with these listed items, if you purchase the materials on Amazon using the following links, a portion of the sales will go to help the developer keep this plugin up to date.  Thank you for your support!<br />
        <h4>Spiritual Gifts Materials</h4>
        <iframe src="http://rcm.amazon.com/e/cm?t=shapesurvey-20&o=1&p=8&l=as1&asins=159052344X&nou=1&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=545454&bc1=FFFFFF&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        <iframe src="http://rcm.amazon.com/e/cm?t=shapesurvey-20&o=1&p=8&l=as1&asins=0307458709&nou=1&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=545454&bc1=FFFFFF&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        <iframe src="http://rcm.amazon.com/e/cm?t=shapesurvey-20&o=1&p=8&l=as1&asins=0785272879&nou=1&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=545454&bc1=FFFFFF&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        <iframe src="http://rcm.amazon.com/e/cm?t=shapesurvey-20&o=1&p=8&l=as1&asins=1425973507&nou=1&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=545454&bc1=FFFFFF&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        
        <h4>S.H.A.P.E. Materials</h4>
        S.H.A.P.E. is Saddleback Church's training on using the spiritual gifts.  According to their website, their training is for discovering how your spiritual gifts, heart, abilities, personality, and experiences (S.H.A.P.E.) in life can be used by God to mold you for service.  Erik Rees was commissioned to write this book on their training.<br />
        <iframe src="http://rcm.amazon.com/e/cm?t=shapesurvey-20&o=1&p=8&l=as1&asins=B0064XB5VA&nou=1&ref=tf_til&fc1=000000&IS2=1&lt1=_blank&m=amazon&lc1=545454&bc1=FFFFFF&bg1=FFFFFF&f=ifr" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        <h3>Donate</h3>
        In addition to purchasing SHAPE materials from the listed Amazon links, you may donate directly here.  Thank you again for your support!
        <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="hosted_button_id" value="3Y7AT2Y8JBWTS">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>


    </div> <?php
}

// [spiritual_gifts email="email@address.com"]
function spiritual_gifts_shortcode_func( $atts ) {
//    echo "referrer: ".$_SERVER['HTTP_REFERER']."<br />";
//    echo "current: ".mm_curPageURL();
    /*
    Checks to see if the form was just submitted.  This plugin calls the file 'gifts-email.php'
    which sends the email then redirects the user back to the original survey page.
    This if/else statement tests to see whether this redirect has already happened (meaning the form
    had already been submitted), and if so, sends a "thank you" message.  If not, the survey form is
    drawn up.  This way only one Wordpress page needs to be made, rather than having them create one
    page for the form and another for the thank you.
    
    An additional SPAM filter was added, with ?spam added onto the URL
    */
    if (mm_curPageURL() == $_SERVER['HTTP_REFERER']."?spam" ) {
        // spam bot, boo!
        return "You filled in a hidden field that is only viewable to spam bots.  If you have received this message in error, please contact us!";
    } else if (mm_curPageURL() == $_SERVER['HTTP_REFERER']."?submitted" ) {
        return "Thank you, your survey has been submitted.  <a href='".$_SERVER['HTTP_REFERER']."'>Take it again</a>?";
    } else {
        extract( shortcode_atts( array(
            'email' => get_bloginfo( 'admin_email', 'Display'),
            'shape' => 'true',
        ), $atts ) );
        return spiritual_gifts_write_form( $email, $shape );
    }
}
add_shortcode( 'spiritual_gifts', 'spiritual_gifts_shortcode_func' );

//write the form
function spiritual_gifts_write_form( $email, $shape ) {
    $return_var = "";
    $my_arr = spiritual_gifts_create_array();
    $my_types_arr = spiritual_gifts_create_types();
    
    //write styles
    $return_var .= "<style>
        .even{
            background-color: #eaeaea;
        }
        .odd{
            background-color: #f7f7f7;
        }
        .even, .odd {
            padding: 15px;
            margin: 0px;
        }
        .ratings {
            text-align: right;
        }
        .preview_button {
            margin: 2 2 2 auto;
        }
        div#thisPreviewResults {
            padding: 15px;
        }
        .rightBox {
        }
        textarea {
            width: 99%;
            min-height: 50px;
        }";
        if($shape == "false") {
            $return_var .= ".shape-related { display: none; }";
        } else {
            $return_var .= ".no-shape-related { display: none; }";
        }
    $return_var .= "</style>
    <script type='text/javascript'>
        function spiritual_gifts_part_one () {
            document.getElementById('spiritual-gifts').style.display = 'block';
            document.getElementById('gifts-results').style.display = 'none';
            document.getElementById('shape-survey').style.display = 'none';
            document.getElementById('submit-form').style.display = 'none';
            scroll(0,0);
        }
        function spiritual_gifts_part_two () {
            document.getElementById('spiritual-gifts').style.display = 'none';
            document.getElementById('gifts-results').style.display = 'block';
            document.getElementById('shape-survey').style.display = 'block';
            document.getElementById('submit-form').style.display = 'block';
            scroll(0,0);
        }
        //updates the fields with the correct numbers
        function previewResults(typeCount) {
            var sortVal = new Array();
            var keyName;
            for (i = 0; i < typeCount; i++) {
                surveyPreview = document.getElementById('typeResult'+i);
                theScore = calculateScore(i,typeCount);
                maxScore = ".count($my_arr)."/typeCount * 4;
				scoreValue = parseInt(theScore*(100/maxScore));
                surveyPreview.value = scoreValue +'%';
                keyName = document.getElementById('typeTitle'+i).value;
                //sortVal[keyName] = parseInt(theScore*(100/maxScore))+'%';
                sortVal[i] = new Array(2);
                sortVal[i][0] = scoreValue;
                sortVal[i][1] = keyName;
//                document.getElementById('typeTitle'+i).value += keyName;
            }
            sortVal.sort(function(a,b){return ((a[0] > b[0]) ? -1 : ((a[0] < b[0]) ? 1 : 0))});
            document.getElementById('top_1').value = sortVal[0][1];
            document.getElementById('top_2').value = sortVal[1][1];
            document.getElementById('top_3').value = sortVal[2][1];
            document.getElementById('topScore_1').value = sortVal[0][0] + '%';
            document.getElementById('topScore_2').value = sortVal[1][0] + '%';
            document.getElementById('topScore_3').value = sortVal[2][0] + '%';
            document.getElementById('topreason_1').innerHTML = sortVal[0][1] + ': ';
            document.getElementById('topreason_2').innerHTML = sortVal[1][1] + ': ';
            document.getElementById('topreason_3').innerHTML = sortVal[2][1] + ': ';
        }
        //adds the correct fields together for the type (missions, etc) score
        function calculateScore(catNum,typeCount) {
            catScore = 0;
            for (j = catNum; j < ".count($my_arr)."; j+=typeCount) {
                catScore += parseInt(getCheckedValue(document.forms['mySurvey'].elements['strength_'+j]));
            }
            return catScore;
        }
        
        // return the value of the radio button that is checked
        // return an empty string if none are checked, or
        // there are no radio buttons
        // code donated by http://www.somacon.com/p143.php
        function getCheckedValue(radioObj) {
                if(!radioObj)
                        return '';
                var radioLength = radioObj.length;
                if(radioLength == undefined)
                        if(radioObj.checked)
                                return radioObj.value;
                        else
                                return '';
                for(var i = 0; i < radioLength; i++) {
                        if(radioObj[i].checked) {
                                return radioObj[i].value;
                        }
                }
                return '';
        }
    </script>";
    
    //start body of survey page
    $url = plugins_url('spiritual-gifts-survey/gifts-email.php');
    $return_var .= "<form name='mySurvey' action='$url' method='post' >
<div id='spiritual-gifts'>
    <p>Rate how often each statement is reflected in your life:</p>";
    
    for($i=0; $i<count($my_arr); $i++) {
        if ($i%2 == 1){ 
            $class = "even";
        } else {
            $class = "odd";
        }
        $return_var .= "<div class='".$class."'>".$my_arr[$i].
            "<div class='ratings' onClick='previewResults(".count($my_types_arr).")'>Rarely
            <input type='radio' id ='strength_".$i."_1' name='strength_".$i."' value='0' />
            <input type='radio' id ='strength_".$i."_2' name='strength_".$i."' value='1' />
            <input type='radio' id ='strength_".$i."_3' name='strength_".$i."' value='2' checked />
            <input type='radio' id ='strength_".$i."_4' name='strength_".$i."' value='3' />
            <input type='radio' id ='strength_".$i."_5' name='strength_".$i."' value='4' />
            Often</div></div>";
    }

    $return_var .= "
</div> <!-- spiritual-gifts -->
<div id='gifts-results'>
    <h3 style='text-align: center'>Spiritual Gifts Scores</h3>
    <div id='thisPreviewResults'>";
    
    for($i = 0; $i < count($my_types_arr); $i++) {
        $return_var .= "<div style='display: inline-block'><input type='text' id='typeTitle".$i."' name='typeTitle".$i."' style='width: 100px; display: inline-block; margin-left: 12px; border: 0px' readonly='readonly' value='".$my_types_arr[$i]."' /><input type='text' id='typeResult".$i."' name='typeResult".$i."' style='display: inline-block; margin-left: 12px; width: 50px; border: 0px' readonly='readonly' value='0'/></div>";
    }
    $return_var .= "</div>
</div> <!-- gifts-results -->
<div id='shape-survey' class='shape-related'>    
    <h2 style='text-align: center'>S.H.A.P.E. Survey</h2>
    <h2>[S]piritual Gifts</h2>
    Top 3 Spiritual Gifts from Spiritual Gifts Survey<br />
    <span style='font-style: italic; color: #aaaaaa; font-size: 9pt'>Note: click the 'see/update results of survey' button above if these 3 results are empty.</span><br />
    1. <input type='text' readonly='readonly' id='top_1' name='top_1' style='border: 0px' /><input type='text' readonly='readonly' id='topScore_1' name='topScore_1' style='border: 0px' /><br />
    2. <input type='text' readonly='readonly' id='top_2' name='top_2' style='border: 0px' /><input type='text' readonly='readonly' id='topScore_2' name='topScore_2' style='border: 0px' /><br />
    3. <input type='text' readonly='readonly' id='top_3' name='top_3' style='border: 0px' /><input type='text' readonly='readonly' id='topScore_3' name='topScore_3' style='border: 0px' /><br />
    <br />
    I feel I have these gifts because<br />
    <div id='topreason_1'></div>
    <textarea name='topreason1_text'></textarea>
    <div id='topreason_2'></div>
    <textarea name='topreason2_text'></textarea>
    <div id='topreason_3'></div>
    <textarea name='topreason3_text'></textarea>
<br /><br />   
    <h2>[H]eart</h2>
    Three things I love to do:<br />
    <textarea name='heart1_text'></textarea><br />
    <textarea name='heart2_text'></textarea><br />
    <textarea name='heart3_text'></textarea><br />
    <br />
    Who I love to work with most, and the age or type of people:<br />
    <textarea name='heart4_text'></textarea><br />
    <br />
    Church issues, ministries, or possible needs that excite or concern me the most:<br />
    <textarea name='heart5_text'></textarea><br />
    <br />
    If I knew I couldn't fail, this is what I would attempt to do for God with my life:<br />
    <textarea name='heart6_text'></textarea><br />
    <br /><br />
    <h2>[A]bilities</h2>
    My current vocation:
    <textarea name='abilities1_text'></textarea>
    Other jobs I have experience in:
    <textarea name='abilities2_text'></textarea>
    Special talents/skills that I have:
    <textarea name='abilities3_text'></textarea>
    I have taught a class or seminar on:
    <textarea name='abilities4_text'></textarea>
    I feel my most valuable personal asset is:
    <textarea name='abilities5_text'></textarea>

    <style>
    .left-personality {
        width: 70px;
        display: inline-block;
        font-size: 9pt;
    }
    .right-personality {
        display: inline-block;
        margin-left: 10px;
    }
    .personality-container {
    }
    </style>

    <br /><br />
    <h2>[P]ersonality</h2>
    Select where you lean in these differing personality traits:<br />
    <div class='personality-container'><div class='left-personality'>Extroverted</div>
            <input type='radio' id ='personality_1_1' name='personality_1' value='Extroverted' />
            <input type='radio' id ='personality_1_2' name='personality_1' value='Introverted' />
            <div class='right-personality'>Introverted</div></div>

    <div class='personality-container'><div class='left-personality'>Thinker</div>
            <input type='radio' id ='personality_2_1' name='personality_2' value='Thinker' />
            <input type='radio' id ='personality_2_2' name='personality_2' value='Feeler' />
            <div class='right-personality'>Feeler</div></div>

    <div class='personality-container'><div class='left-personality'>Routine</div>
            <input type='radio' id ='personality_3_1' name='personality_3' value='Routine' />
            <input type='radio' id ='personality_3_2' name='personality_3' value='Variety' />
            <div class='right-personality'>Variety</div></div>

    <div class='personality-container'><div class='left-personality'>Reserved</div>
            <input type='radio' id ='personality_4_1' name='personality_4' value='Reserved' />
            <input type='radio' id ='personality_4_2' name='personality_4' value='Expressive' />
            <div class='right-personality'>Expressive</div></div>

    <div class='personality-container'><div class='left-personality'>Cooperative</div>
            <input type='radio' id ='personality_5_1' name='personality_5' value='Cooperative' />
            <input type='radio' id ='personality_5_2' name='personality_5' value='Competitive' />
            <div class='right-personality'>Competitive</div></div>
            
    <br /><br />
    <h2>[E]xperience</h2>
    My Testimony of how I became a Christian
    <textarea name='experience1_text'></textarea>
    Other significant spiritual experiences that stand out in my life are:
    <textarea name='experience2_text'></textarea>
    These are the kinds of trials or problems I could relate to and encourage a fellow Christian in:
    <textarea name='experience3_text'></textarea>
    Ministry Experience (Where I have served in the past, if applicable, including Church Name, City/State, Position, Years Involved)
    <textarea name='experience4_text'></textarea>
    <textarea name='experience5_text'></textarea>
    <textarea name='experience6_text'></textarea>
    <textarea name='experience7_text'></textarea>
</div><!-- shape-survey -->
<div id='submit-form'>
    <h2 style='margin-top: 20px'>Submit Information</h2>
    Thank you for taking the time to fill out this survey.  A copy will be sent to you as well as a staff member who will be able to help you find your place of service with us and/or in the community.
    <p style='text-align: center'>Your Name:<br />
    <input type='text' name='userName' /></p>
    <p style='text-align: center'>Your Email Address:<br />
    <input type='text' name='userEmailAddress' /></p>

    <p style='text-align: center; position: absolute; margin-left: -9999px'>I am a spam bot if I fill in the following field:<br />
    <input type='text' name='anotherField' /></p>

    <p style='text-align: center'><input type='submit' value='Submit Form!' /></p>
    <script type='text/javascript'>previewResults(".count($my_types_arr).");</script>

</div><!-- submit-form -->";

    //hidden variables that need to be passed to 'gifts-email.php'
    $return_var .= "<input type='hidden' name='typesCount' value='".count($my_types_arr)."' />";
    $return_var .= "<input type='hidden' name='adminEmail' value='".$email."' />";
    $return_var .= "<input type='hidden' name='siteTitle' value='".get_bloginfo('name')."' />";
    $return_var .= "<input type='hidden' name='shape' value='".$shape."' />";

    $return_var .= "</form>";

    return $return_var;
}

//create the array spiritual_gifts_array and populate it with the 128 S questions
function spiritual_gifts_create_array() {
$s_text = "1. I am willing and able to learn executive skills such as planning, organizing, and delegating.	
2. I am warm towards and cooperate in my church's foreign missions emphasis.	
3. There are times I sense that a particular teaching is unbiblical.	
4. I enjoy sharing the message of the Gospel as I understand it.	
5. I am accepting of persons deeply troubled or in crisis.	
6. I have assurance that God answers prayers.	
7. I feel deeply moved when confronted with the urgent financial needs of others.	
8. I get much satisfaction from hosting persons who need ministry at my home.	
9. I am concerned to read, study and learn Biblical truths.	
10. I find it easy to motivate others to follow through on a ministry project.	
11. I hurt for others who are poverty-stricken, physically sick, a stranger, or imprisoned.	
12. I am concerned to verbalize Biblical truths which build, encourage, and comforts groups of believers.	
13. I am ready to commit myself to care for the spiritual welfare of a group of young Christians.	
14. I usually have a readiness to take on helping roles.	
15. I have a strong conviction that Biblical truths should be understood accurately and be applied to current living.	
16. I have a reverence for God and His will for my life.	
17. I do well in evaluating results from studies on the effectiveness of a major church program.	
18. I am frustrated when there is little opportunity to minister to those of different customs or language.	
19. I receive affirmation from mature Christians that I am able to distinguish spiritual untruth from supernatural insights.	
20. I wish to relate to non-Christians so I can share my faith.	
21. I am sensitive and sympathetic to persons who seem to be suffering or mentally ill.	
22. I feel joy in persisting in prayer for specific needs.	
23. I am willing to maintain a lower standard of living to benefit God's Word.	
24. I am comfortable with opening my home to others regardless of how neat or clean it is.	
25. Paul's concern (Col. 1:10) that I be 'increasing in the knowledge of God' is something I take seriously.	
26. I would enjoy guiding a group of people to achieve their desired ends.	
27. I desire to do acts of love and kindness for those who cannot or will not return them.	
28. I enjoy sharing a hymn, lesson or Bible interpretation so that all believers present may learn.	
29. I sense a need to select disciples and equip them to serve one another.	
30. I would rather be a supportive background person than a 'performer.'	
31. I enjoy knowing the meaning of key words in Scripture.	
32. I effectively solve problems using Biblical principles.	
33. I am able to organize ideas, people, things and time for more effective ministry.	
34. I am concerned to take part in starting a new local church.	
35. I am able to differentiate between demonic influence and mental illness.	
36. I am at ease in sharing how Christ is my Savior and Lord.	
37. I am willing to be called alongside another person seeking my encouragement, challenge, or advice.	
38. I depend upon God's resources and guidance to an unusual degree.	
39. I consider all that I own or am as resources for stewardship to God.	
40. I am willing to use my home furnishings and personal belongings to serve others outside my immediate family.	
41. I am moved to study Scriptures so as to be unashamed in accurately handling it.	
42. I often assume responsibility when no official leaders are designated.	
43. I am content to serve the suffering or undeserving.	
44. I prefer congregational preaching which explains and applies Biblical truths.	
45. I enjoy having responsibility for the growth of a group of Christians.	
46. I am satisfied to express my skills by helping others in charge.	
47. I believe that the teaching-learning process is vital to local church growth.	
48. Others often ask me for workable ideas or alternatives.	
49. I am able to lead a committee or group in making decisions together.	
50. I desire to serve in a cross-cultural situation.	
51. I see the difference between truth and error.	
52. I am concerned to communicate my personal relationship with Christ to others.	
53. I have compassion towards those who are broken hearted, addicted or oppressed.	
54. I am comfortable around people who pray a lot for others.	
55. I am concerned that the money I give be used as efficiently as possible for God.	
56. I take pleasure with an open heart in using our home to serve people in need of shelter or healing.	
57. I long to share with others the Biblical insights I discover.	
58. I am willing to persuade others to move towards Biblical objectives.	
59. I am cheerful, available and involved in hospital, prison, or similar visitation.	
60. I am not afraid to speak boldly about evil in worldly systems, such as government.	
61. I am concerned to guard my group of Christian followers from those who name themselves as enemies of Christians.	
62. I am content to perform menial jobs or jobs considered unimportant by other people.	
63. I have a strong concern to relate Biblical truths to life.	
64. I am concerned that interpersonal relationships be peaceable, reasonable, and without partiality of hypocrisy.	
65. I am able to recruit Christians to express their strengths or fits in service.	
66. I enjoy soul winning or witnessing in an unfamiliar setting.	
67. I judge well between the inadequate and the acceptable, or between evil and good.	
68. I enjoy being an instrument of God in 'drawing the net' so that unbelievers receive Christ as Savior.	
69. I verbally encourage the weak, wavering or troubled.	
70. I trust in the presence and power of God for the apparently impossible.	
71. I give cheerfully that God's work be extended and helped.	
72. I am happy to add someone to our family temporarily in order to provide a helping or healing ministry.	
73. I learn Biblical truths easily.	
74. I usually know where I am going and can influence other Christians in that direction.	
75. I work joyfully with persons ignored by the majority.	
76. 'Telling forth' for God by instructing and warning large numbers of His people is my style.	
77. It is important to me to know and be well-known by followers I serve and guide.	
78. I enjoy typing, filing, recording minutes, or similar church-related tasks.	
79. I have the ability to concisely instruct listeners in the precise meaning of words and passages in Scripture.	
80. I apply Biblical truths effectively in my life.	
81. I am effective in delegating responsibility to others.	
82. I adapt well in a different culture in order to evangelize, to minister the Word, or to be a support person to such ministers.	
83. I have insights that help me discern any errors in a Biblical interpretation given by another.	
84. I share joyfully what Christ has done for me.	
85. I verbally challenge the spiritually apathetic.	
86. I have a conviction that God is active in my daily affairs.	
87. I give things freely and with delight because I love God.	
88. I have a knack for helping strangers feel at home.	
89. I readily acquire and master facts and principles of Biblical truths.	
90. Normally my Christian character, lifestyle and behavior seem to motivate others to follow me.	
91. I would enjoy visiting in hospitals or elderly homes and being an agent of blessing to others.	
92. I communicate truths of God in a clear compelling fashion to large audiences.	
93. I sacrificially give of myself for young or straying Christians.	
94. Ushering, cleaning , or supporting tasks in a church-related facility suits me well.	
95. I explain well the New Testament to others.	
96. I make what appears to be correct decisions for my life.	
97. I am able to plan action goals for ministry with others.	
98. I have or could learn another language well enough to help start a church.	
99. I am able to identify that which is false to Christ's teachings.	
100. Unbelievers understand when I explain what it means that Jesus is the Christ.	
101. I would feel comfortable being an instrument for dislodging the complacent and redirecting the wayward in face-to-face encounters.
102. I believe God will keep his promises in spite of circumstances.	
103. I am able to earn much money for giving to the Lord's work.	
104. I am comfortable with graciously providing food and lodging to those in need.	
105. I have the ability to discover Biblical principles for myself.	
106. Others follow me because I have knowledge or skills effectively used in serving my church.	
107. I have the ability to spare other persons from punishment or penalties they justly deserve.	
108. I proclaim God's truth in an inspiring and enthusiastic way.	
109. I am able to feed followers in Christ by guiding them through selected Bible passages.	
110. I am able to be a teacher's aide in a class, or to do a similar helping task.	
111. When I communicate Biblical truths to others, it affects changes in knowledge, attitudes, values or conduct.	
112. The choices I make for activities in Christian service usually work well.	
113. I can win wide acceptance from church members for major changes involving effective procedures.	
114. I am able to help in starting new churches in a different language and culture.	
115. I can see through phonies before their falseness is clearly evident to others.	
116. I would remain spiritually strong in the company of unbelievers and would use every opportunity to win some to Christ.	
117. I am able to counsel effectively the perplexed, guilty or addicted.	
118. I have received from God an unusual assurance that he would fulfill some purpose.	
119. I manage money well in order to give liberally to God's work.	
120. I show a genuine graciousness towards and appreciation of each guest at my/our home.	
121. I have insights into Biblical truths that bring conviction to my mind and heart.	
122. I am able to adjust my leadership style so it is appropriate for the maturity of those working with me.	
123. I am able to talk cheerfully with prisoners, or lonely shut-ins.	
124. I have been able to reveal God's future events in general terms through Bible teaching.	
125. I am able to restore persons who have wandered away from Christian community.	
126. I can assist key leaders who 'pray and minister the word' (Acts 5) by taking some of their other responsibilities.	
127. I can make difficult Biblical truths understandable to others.	
128. My nominations for church positions often prove to be good selections.";

// Here we split it into lines
$s_statements = explode("\n", $s_text);
return $s_statements;
}

function spiritual_gifts_create_types() {
    $s_typetext = "Administration
Missions
Discernment
Evangelism
Exhortation
Faith
Giving
Hospitality
Knowledge
Leadership
Mercy
Prophecy
Shepherding
Helps/Service
Teaching
Wisdom";
// Here we split it into lines
$s_types = explode("\n", $s_typetext);
return $s_types;
}
//grabs current page url
//echo mm_curPageURL();
function mm_curPageURL() {
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