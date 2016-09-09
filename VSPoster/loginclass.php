<?php

// Get login details from form
// Get Diigo logins
$diigousername = $_POST['diigousername'];
$diigopassword = $_POST['diigopassword'];

// Get Blinklist logins
$blinklistusername = $_POST['blinklistusername'];
$blinklistpassword = $_POST['blinklistpassword'];

// Get Tumblr logins
$tumblrusername = $_POST['tumblrusername'];
$tumblrpassword = $_POST['tumblrpassword'];

// Get Twitter logins
$twitterusername = $_POST['twitterusername'];
$twitterpassword = $_POST['twitterpassword'];

// Get Mister-Wong logins
$misterusername = $_POST['misterusername'];
$misterpassword = $_POST['misterpassword'];

// Get Dzone logins
$dzoneusername = $_POST['dzoneusername'];
$dzonepassword = $_POST['dzonepassword'];

// Get A1-Webmarks logins
$a1username = $_POST['a1username'];
$a1password = $_POST['a1password'];

// Get Url.org logins
$urlousername = $_POST['urlousername'];
$urlopassword = $_POST['urlopassword'];

// Get Spotback logins
$spotbackusername = $_POST['spotbackusername'];
$spotbackpassword = $_POST['spotbackpassword'];

// Get Bibsonomy logins
$bibsonomyusername = $_POST['bibsonomyusername'];
$bibsonomypassword = $_POST['bibsonomypassword'];

// Get Jumptags logins
$jumptagsusername = $_POST['jumptagsusername'];
$jumptagspassword = $_POST['jumptagspassword'];

// Get Searchles logins
$searchlesusername = $_POST['searchlesusername'];
$searchlespassword = $_POST['searchlespassword'];

// Get QuadRiot logins
$quadusername = $_POST['quadusername'];
$quadpassword = $_POST['quadpassword'];

// Get LinkArena logins
$linkarenausername = $_POST['linkarenausername'];
$linkarenapassword = $_POST['linkarenapassword'];

// Get Gabbr logins
$gabbrusername = $_POST['gabbrusername'];
$gabbrpassword = $_POST['gabbrpassword'];

// Get LinkaGoGo logins
$linkagousername = $_POST['linkagousername'];
$linkagopassword = $_POST['linkagopassword'];

// Get Faves logins
$favesusername = $_POST['favesusername'];
$favespassword = $_POST['favespassword'];

// Get Google logins
$googleusername = $_POST['googleusername'];
$googlepassword = $_POST['googlepassword'];

// Get Delicious logins
$delicioususername = $_POST['delicioususername'];
$deliciouspassword = $_POST['deliciouspassword'];

// Get MySpace logins
$myspaceusername = $_POST['myspaceusername'];
$myspacepassword = $_POST['myspacepassword'];

// Get Newscola logins
$newscolausername = $_POST['newscolausername'];
$newscolapassword = $_POST['newscolapassword'];

// Get Yahoo logins
$yahoousername = $_POST['yahoousername'];
$yahoopassword = $_POST['yahoopassword'];

// Get Joontz logins
$joontzusername = $_POST['joontzusername'];
$joontzpassword = $_POST['joontzpassword'];

// Get StumbleUpon logins
$stumbleusername = $_POST['stumbleusername'];
$stumblepassword = $_POST['stumblepassword'];

// Get Filbe logins
$filbeusername = $_POST['filbeusername'];
$filbepassword = $_POST['filbepassword'];

// Get NewsBomb logins
$newsbombusername = $_POST['newsbombusername'];
$newsbombpassword = $_POST['newsbombpassword'];

// Get Blurpalicious logins
$blurpalicioususername = $_POST['blurpalicioususername'];
$blurpaliciouspassword = $_POST['blurpaliciouspassword'];

// Get Identi logins
$identiusername = $_POST['identiusername'];
$identipassword = $_POST['identipassword'];

// Get Bookmarkindo logins
$bookmarkindousername = $_POST['bookmarkindousername'];
$bookmarkindopassword = $_POST['bookmarkindopassword'];

// Get Youblogged logins
$youbloggedusername = $_POST['youbloggedusername'];
$youbloggedpassword = $_POST['youbloggedpassword'];

// Get Oneview logins
$oneviewusername = $_POST['oneviewusername'];
$oneviewpassword = $_POST['oneviewpassword'];

// Get Spurl logins
$spurlusername = $_POST['spurlusername'];
$spurlpassword = $_POST['spurlpassword'];

// Lets write logins to database
$fh = fopen("db/config.xml", "w");

$line = '<?xml version="1.0" encoding="utf-8"?>
<logins status="ok">
<options>
<diigousername>'.$diigousername.'</diigousername>
<diigopassword>'.$diigopassword.'</diigopassword>
<blinklistusername>'.$blinklistusername.'</blinklistusername>
<blinklistpassword>'.$blinklistpassword.'</blinklistpassword>
<tumblrusername>'.$tumblrusername.'</tumblrusername>
<tumblrpassword>'.$tumblrpassword.'</tumblrpassword>
<twitterusername>'.$twitterusername.'</twitterusername>
<twitterpassword>'.$twitterpassword.'</twitterpassword>
<misterusername>'.$misterusername.'</misterusername>
<misterpassword>'.$misterpassword.'</misterpassword>
<dzoneusername>'.$dzoneusername.'</dzoneusername>
<dzonepassword>'.$dzonepassword.'</dzonepassword>
<a1username>'.$a1username.'</a1username>
<a1password>'.$a1password.'</a1password>
<urlousername>'.$urlousername.'</urlousername>
<urlopassword>'.$urlopassword.'</urlopassword>
<spotbackusername>'.$spotbackusername.'</spotbackusername>
<spotbackpassword>'.$spotbackpassword.'</spotbackpassword>
<bibsonomyusername>'.$bibsonomyusername.'</bibsonomyusername>
<bibsonomypassword>'.$bibsonomypassword.'</bibsonomypassword>
<jumptagsusername>'.$jumptagsusername.'</jumptagsusername>
<jumptagspassword>'.$jumptagspassword.'</jumptagspassword>
<searchlesusername>'.$searchlesusername.'</searchlesusername>
<searchlespassword>'.$searchlespassword.'</searchlespassword>
<quadusername>'.$quadusername.'</quadusername>
<quadpassword>'.$quadpassword.'</quadpassword>
<linkarenausername>'.$linkarenausername.'</linkarenausername>
<linkarenapassword>'.$linkarenapassword.'</linkarenapassword>
<gabbrusername>'.$gabbrusername.'</gabbrusername>
<gabbrpassword>'.$gabbrpassword.'</gabbrpassword>
<linkagousername>'.$linkagousername.'</linkagousername>
<linkagopassword>'.$linkagopassword.'</linkagopassword>
<favesusername>'.$favesusername.'</favesusername>
<favespassword>'.$favespassword.'</favespassword>
<googleusername>'.$googleusername.'</googleusername>
<googlepassword>'.$googlepassword.'</googlepassword>
<delicioususername>'.$delicioususername.'</delicioususername>
<deliciouspassword>'.$deliciouspassword.'</deliciouspassword>
<myspaceusername>'.$myspaceusername.'</myspaceusername>
<myspacepassword>'.$myspacepassword.'</myspacepassword>
<newscolausername>'.$newscolausername.'</newscolausername>
<newscolapassword>'.$newscolapassword.'</newscolapassword>
<yahoousername>'.$yahoousername.'</yahoousername>
<yahoopassword>'.$yahoopassword.'</yahoopassword>
<joontzusername>'.$joontzusername.'</joontzusername>
<joontzpassword>'.$joontzpassword.'</joontzpassword>
<stumbleusername>'.$stumbleusername.'</stumbleusername>
<stumblepassword>'.$stumblepassword.'</stumblepassword>
<filbeusername>'.$filbeusername.'</filbeusername>
<filbepassword>'.$filbepassword.'</filbepassword>
<newsbombusername>'.$newsbombusername.'</newsbombusername>
<newsbombpassword>'.$newsbombpassword.'</newsbombpassword>
<blurpalicioususername>'.$blurpalicioususername.'</blurpalicioususername>
<blurpaliciouspassword>'.$blurpaliciouspassword.'</blurpaliciouspassword>
<identiusername>'.$identiusername.'</identiusername>
<identipassword>'.$identipassword.'</identipassword>
<bookmarkindousername>'.$bookmarkindousername.'</bookmarkindousername>
<bookmarkindopassword>'.$bookmarkindopassword.'</bookmarkindopassword>
<youbloggedusername>'.$youbloggedusername.'</youbloggedusername>
<youbloggedpassword>'.$youbloggedpassword.'</youbloggedpassword>
<oneviewusername>'.$oneviewusername.'</oneviewusername>
<oneviewpassword>'.$oneviewpassword.'</oneviewpassword>
<spurlusername>'.$spurlusername.'</spurlusername>
<spurlpassword>'.$spurlpassword.'</spurlpassword>
</options>
</logins>';

fputs($fh, $line);
fclose($fh);

//lets get back to the page we were

echo '
<html>
<head>
<script language="JavaScript">
function goback()
{
 document.location.href="db/bmp.php";
}
</script>
</head>
<body onload="goback()">
</body>
</html>';


?>