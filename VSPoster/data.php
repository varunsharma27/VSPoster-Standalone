<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="icon" type="image/png" href="images/favicon.ico" />

<!--
#########################################################################

- VSPoster standalone                              
- Author: Varun Sharma                        		      
- Version: 1.1                     				      
- License: For personal use only not allowed to sell or offer as service!               				      

#########################################################################
 -->

<title>VSPoster standalone</title>

<link rel="stylesheet" type="text/css" href="screen.css" />

</head>
<body>

<?php

//Lets set timezone
date_default_timezone_set('UTC');

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/db/settings.xml');

set_time_limit(299);

include_once ('modules/urlo.php');
include_once ('modules/tumblr.php');
include_once ('modules/diigo.php');
include_once ('modules/twitter.php');
include_once ('modules/quad.php');
include_once ('modules/blinklist.php');
include_once ('modules/dzone.php');
include_once ('modules/bibsonomy.php');
include_once ('modules/searchles.php');
include_once ('modules/linkarena.php');
include_once ('modules/a1.php');
include_once ('modules/spotback.php');
include_once ('modules/jumptags.php');
include_once ('modules/misterwong.php');
include_once ('modules/gabbr.php');
include_once ('modules/linkago.php');
include_once ('modules/faves.php');
include_once ('modules/google.php');
include_once ('modules/delicious.php');
include_once ('modules/myspace.php');
include_once ('modules/yahoo.php');
include_once ('modules/newscola.php');
include_once ('modules/joontz.php');
include_once ('modules/stumbleupon.php');
include_once ('modules/filbe.php');
include_once ('modules/newsbomb.php');
include_once ('modules/blurpalicious.php');
include_once ('modules/identi.php');
include_once ('modules/bookmarkindo.php');
include_once ('modules/youblogged.php');
include_once ('modules/oneview.php');
include_once ('modules/spurl.php');


// Get necessary information
    $title = $_POST['title'];
	$link = $_POST['link'];
	$text = $_POST['descript'];
	$tags = $_POST['tags'];
	
// Lets get login values details
$xml = simplexml_load_file('db/config.xml');

// Get Diigo logins
$diigousername = $xml->options->diigousername;
$diigopassword = $xml->options->diigopassword;

// Get Blinklist logins
$blinklistusername = $xml->options->blinklistusername;
$blinklistpassword = $xml->options->blinklistpassword;

// Get Tumblr logins
$tumblrusername = $xml->options->tumblrusername;
$tumblrpassword = $xml->options->tumblrpassword;

// Get Twitter logins
$twitterusername = $xml->options->twitterusername;
$twitterpassword = $xml->options->twitterpassword;

// Get Mister-Wong logins
$misterusername = $xml->options->misterusername;
$misterpassword = $xml->options->misterpassword;

// Get Dzone logins
$dzoneusername = $xml->options->dzoneusername;
$dzonepassword = $xml->options->dzonepassword;

// Get A1-Webmarks logins
$a1username = $xml->options->a1username;
$a1password = $xml->options->a1password;

// Get Url.org logins
$urlousername = $xml->options->urlousername;
$urlopassword = $xml->options->urlopassword;

// Get Spotback logins
$spotbackusername = $xml->options->spotbackusername;
$spotbackpassword = $xml->options->spotbackpassword;

// Get Bibsonomy logins
$bibsonomyusername = $xml->options->bibsonomyusername;
$bibsonomypassword = $xml->options->bibsonomypassword;

// Get Jumptags logins
$jumptagsusername = $xml->options->jumptagsusername;
$jumptagspassword = $xml->options->jumptagspassword;

// Get Searchles logins
$searchlesusername = $xml->options->searchlesusername;
$searchlespassword = $xml->options->searchlespassword;

// Get QuadRiot logins
$quadusername = $xml->options->quadusername;
$quadpassword = $xml->options->quadpassword;

// Get LinkArena logins
$linkarenausername = $xml->options->linkarenausername;
$linkarenapassword = $xml->options->linkarenapassword;

// Get Gabbr logins
$gabbrusername = $xml->options->gabbrusername;
$gabbrpassword = $xml->options->gabbrpassword;

// Get LinkaGoGo logins
$linkagousername = $xml->options->linkagousername;
$linkagopassword = $xml->options->linkagopassword;

// Get Faves logins
$favesusername = $xml->options->favesusername;
$favespassword = $xml->options->favespassword;

// Get Google logins
$googleusername = $xml->options->googleusername;
$googlepassword = $xml->options->googlepassword;

// Get Delicious logins
$delicioususername = $xml->options->delicioususername;
$deliciouspassword = $xml->options->deliciouspassword;

// Get MySpace logins
$myspaceusername = $xml->options->myspaceusername;
$myspacepassword = $xml->options->myspacepassword;

// Get Newscola logins
$newscolausername = $xml->options->newscolausername;
$newscolapassword = $xml->options->newscolapassword;

// Get Yahoo logins
$yahoousername = $xml->options->yahoousername;
$yahoopassword = $xml->options->yahoopassword;

// Get Joontz logins
$joontzusername = $xml->options->joontzusername;
$joontzpassword = $xml->options->joontzpassword;

// Get StumbleUpon logins
$stumbleusername = $xml->options->stumbleusername;
$stumblepassword = $xml->options->stumblepassword;

// Get Filbe logins
$filbeusername = $xml->options->filbeusername;
$filbepassword = $xml->options->filbepassword;

// Get NewsBomb logins
$newsbombusername = $xml->options->newsbombusername;
$newsbombpassword = $xml->options->newsbombpassword;

// Get Blurpalicious logins
$blurpalicioususername = $xml->options->blurpalicioususername;
$blurpaliciouspassword = $xml->options->blurpaliciouspassword;

// Get Identi logins
$identiusername = $xml->options->identiusername;
$identipassword = $xml->options->identipassword;

// Get Bookmarkindo logins
$bookmarkindousername = $xml->options->bookmarkindousername;
$bookmarkindopassword = $xml->options->bookmarkindopassword;

// Get Youblogged logins
$youbloggedusername = $xml->options->youbloggedusername;
$youbloggedpassword = $xml->options->youbloggedpassword;

// Get Oneview logins
$oneviewusername = $xml->options->oneviewusername;
$oneviewpassword = $xml->options->oneviewpassword;

// Get Spurl logins
$spurlusername = $xml->options->spurlusername;
$spurlpassword = $xml->options->spurlpassword;
	
	//Lets define cookiefile
	 $tmp = (dirname (__FILE__).'/tmp');
	 $cookiefile = tempnam($tmp,'COO');
	
// Start bookmarking

echo '<div id="report">';
echo '<div class="toprep">';
echo '<div class="accback"><a href="index.php"><img src="images/back.png" alt="back" /></a></div>';
echo '</div>';
echo '<div class="repbody">';

$i = 0;
$ucount = strlen($linkagousername);
if ($ucount > $i + 1){
    linkagobookmark($title,$link,$text,$tags,$cookiefile,$linkagousername,$linkagopassword);
	}
	
$ucount = strlen($urlousername);
if ($ucount > $i + 1){
    urlobookmark($title,$link,$text,$tags,$cookiefile,$urlousername,$urlopassword);
	}

$ucount = strlen($diigousername);
if ($ucount > $i + 1){	
	diigobookmark($title,$link,$text,$tags,$diigopassword,$diigousername);
	}
	
$ucount = strlen($tumblrusername);
if ($ucount > $i + 1){	
	tumblrbookmark($title,$link,$text,$cookiefile,$tumblrusername,$tumblrpassword);
	}
	
$ucount = strlen($twitterusername);
if ($ucount > $i + 1){	
	twitterbookmark($title,$link,$twitterusername,$twitterpassword);
	}
	
$ucount = strlen($quadusername);
if ($ucount > $i + 1){	
	quadbookmark($title,$link,$text,$tags,$cookiefile,$quadusername,$quadpassword);
	}
	
$ucount = strlen($blinklistusername);
if ($ucount > $i + 1){	
	blinklistbookmark($title,$link,$text,$tags,$cookiefile,$blinklistusername,$blinklistpassword);
	}
	
$ucount = strlen($dzoneusername);
if ($ucount > $i + 1){	
	dzonebookmark($title,$link,$text,$cookiefile,$dzoneusername,$dzonepassword);
	}
	
$ucount = strlen($bibsonomyusername);
if ($ucount > $i + 1){	
	bibsonomybookmark($title,$link,$text,$tags,$cookiefile,$bibsonomyusername,$bibsonomypassword);
	}
	
$ucount = strlen($searchlesusername);
if ($ucount > $i + 1){
	searchlesbookmark($title,$link,$text,$tags,$cookiefile,$searchlesusername,$searchlespassword);
	}
	
$ucount = strlen($linkarenausername);
if ($ucount > $i + 1){
	linkarenabookmark($title,$link,$text,$tags,$cookiefile,$linkarenausername,$linkarenapassword);
	}
	
$ucount = strlen($a1username);
if ($ucount > $i + 1){
	a1bookmark($title,$link,$text,$tags,$cookiefile,$a1username,$a1password);
	}
	
$ucount = strlen($spotbackusername);
if ($ucount > $i + 1){
	spotbackbookmark($title,$link,$text,$tags,$cookiefile,$spotbackusername,$spotbackpassword);
	}
	
$ucount = strlen($jumptagsusername);
if ($ucount > $i + 1){
	jumptagsbookmark($title,$link,$text,$tags,$cookiefile,$jumptagsusername,$jumptagspassword);
    }

$ucount = strlen($misterusername);
if ($ucount > $i + 1){
    misterbookmark($title,$link,$text,$tags,$cookiefile,$misterusername,$misterpassword);
	}
	
$ucount = strlen($gabbrusername);
if ($ucount > $i + 1){
	gabbrbookmark($title,$link,$text,$tags,$cookiefile,$gabbrusername,$gabbrpassword);
	}
	
$ucount = strlen($favesusername);
if ($ucount > $i + 1){
	favesbookmark($title,$link,$text,$tags,$favesusername,$favespassword);
	}
	
$ucount = strlen($googleusername);
if ($ucount > $i + 1){
	googlebookmark($title,$link,$text,$tags,$cookiefile,$googleusername,$googlepassword);
	}
	
$ucount = strlen($delicioususername);
if ($ucount > $i + 1){
	deliciousbookmark($title,$link,$text,$tags,$cookiefile,$delicioususername,$deliciouspassword);
	}
	
$ucount = strlen($myspaceusername);
if ($ucount > $i + 1){
	myspacebookmark($title,$link,$text,$cookiefile,$myspaceusername,$myspacepassword);
	}
	
$ucount = strlen($yahoousername);
if ($ucount > $i + 1){
	yahoobookmark($title,$link,$text,$tags,$cookiefile,$yahoousername,$yahoopassword);
	}
	
$ucount = strlen($newscolausername);
if ($ucount > $i + 1){
	newscolabookmark($title,$link,$text,$cookiefile,$newscolausername,$newscolapassword);
	}
	
$ucount = strlen($joontzusername);
if ($ucount > $i + 1){
	joontzbookmark($title,$link,$text,$tags,$cookiefile,$joontzusername,$joontzpassword);
	}
	
$ucount = strlen($stumbleusername);
if ($ucount > $i + 1){
	stumblebookmark($title,$link,$text,$tags,$cookiefile,$stumbleusername,$stumblepassword);
	}
	
$ucount = strlen($filbeusername);
if ($ucount > $i + 1){
	filbebookmark($title,$link,$text,$tags,$cookiefile,$filbeusername,$filbepassword);
	}
	
$ucount = strlen($newsbombusername);
if ($ucount > $i + 1){
	newsbombbookmark($title,$link,$text,$tags,$cookiefile,$newsbombusername,$newsbombpassword);
	}
	
$ucount = strlen($blurpalicioususername);
if ($ucount > $i + 1){
	blurpaliciousbookmark($title,$link,$text,$tags,$cookiefile,$blurpalicioususername,$blurpaliciouspassword);
	}
	
$ucount = strlen($identiusername);
if ($ucount > $i + 1){
	identibookmark($title,$link,$identiusername,$identipassword);
	}
	
$ucount = strlen($bookmarkindousername);
if ($ucount > $i + 1){
	bookmarkindobookmark($title,$link,$text,$tags,$cookiefile,$bookmarkindousername,$bookmarkindopassword);
	}
	
$ucount = strlen($youbloggedusername);
if ($ucount > $i + 1){
	youbloggedbookmark($title,$link,$text,$cookiefile,$youbloggedusername,$youbloggedpassword);
	}
	
$ucount = strlen($oneviewusername);
if ($ucount > $i + 1){
	oneviewbookmark($title,$link,$text,$tags,$cookiefile,$oneviewusername,$oneviewpassword);
	}
	
$ucount = strlen($spurlusername);
if ($ucount > $i + 1){
	spurlbookmark($title,$link,$text,$tags,$cookiefile,$spurlusername,$spurlpassword);
	}
	
	
echo '<br /> <span class="finished">FINISHED</span>';
	
/* Lets clean cookies */

foreach (glob("tmp/COO*") as $filename) {
   "$filename size " . filesize($filename) . "\n";
   unlink($filename);
}

echo '</div>';	
echo '</div>';
	
?>

</body>
</html>