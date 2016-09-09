<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<meta content="index,follow" name="robots" />
<meta content="all" name="audience" />
<meta name="description" content="VSPoster is new revolutional standalone social bookmarking tool." />
<meta name="keywords" content="bookmark, bookmarking, social bookmarking, social bookmarks, standalone" />
<meta name="copyright" content="seomonsters.net" />
<meta name="publisher" content="seomonsters.net" />
<link rel="icon" type="image/png" href="../images/favicon.ico" />

<!--
#########################################################################

- VSPoster standalone                              
- Author: Varun Sharma                        		      
- Version: 1.1                     				      
- License: For personal use only not allowed to sell or offer as service!               				      

#########################################################################
 -->

<title>VSPoster standalone</title>

<link rel="stylesheet" type="text/css" href="../screen.css" />

</head>
<body>

<?php

// Lets get login values to display them
$xml = simplexml_load_file('config.xml');

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

// Create account forms
    echo "<div id='accont'>";
	echo "<div class='toph'>";
	echo '<div class="accback"><a href="../index.php"><img src="../images/back.png" alt="back" /></a></div>';
	echo '<div class="accback" style="float:right;"><a href="clear.php"><img src="../images/errors.png" alt="errors" /></a></div>';
	echo '<div class="accback" style="float:right; margin-right:10px;"><a href="settings.php"><img src="../images/settings.png" alt="settings" /></a></div>';
	echo "</div>";
	
	echo '<form method="post" action="../loginclass.php">';
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.diigo.com/" target="_blank"><img src="../images/diigo.png" alt="diigo" /></a> Diigo<a class="register" href="https://secure.diigo.com/sign-up" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="diigousername" class="username"  value="'.$diigousername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="diigopassword" class="password"  value="'.$diigopassword.'" size="28" /></div>';
	echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.blinklist.com/" target="_blank"><img src="../images/blinklist.png" alt="blinklist" /></a> Blinklist<a class="register" href="http://www.blinklist.com/user/signup" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="blinklistusername" class="username"  value="'.$blinklistusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="blinklistpassword" class="password"  value="'.$blinklistpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";	
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.tumblr.com/" target="_blank"><img src="../images/tumblr.png" alt="tumblr" /></a> Tumblr<a class="register" href="http://www.tumblr.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="tumblrusername" class="username"  value="'.$tumblrusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="tumblrpassword" class="password"  value="'.$tumblrpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://twitter.com/" target="_blank"><img src="../images/twitter.png" alt="twitter" /></a> Twitter<a class="register" href="https://twitter.com/signup" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="twitterusername" class="username"  value="'.$twitterusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="twitterpassword" class="password"  value="'.$twitterpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.mister-wong.com/" target="_blank"><img src="../images/misterwong.png" alt="misterwong" /></a> Mister-Wong<a class="register" href="http://www.mister-wong.com/register/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="misterusername" class="username"  value="'.$misterusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="misterpassword" class="password"  value="'.$misterpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.dzone.com/" target="_blank"><img src="../images/dzone.png" alt="dzone" /></a> DZone<a class="register" href="http://www.dzone.com/links/users/register.html" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="dzoneusername" class="username"  value="'.$dzoneusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="dzonepassword" class="password"  value="'.$dzonepassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.a1-webmarks.com/" target="_blank"><img src="../images/a1.png" alt="a1" /></a> A1-Webmarks<a class="register" href="http://www.a1-webmarks.com/signup.html" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="a1username" class="username"  value="'.$a1username.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="a1password" class="password"  value="'.$a1password.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://url.org/" target="_blank"><img src="../images/urlo.png" alt="urlo" /></a> Url.org<a class="register" href="http://url.org/signup/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="urlousername" class="username"  value="'.$urlousername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="urlopassword" class="password"  value="'.$urlopassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://spotback.com/" target="_blank"><img src="../images/spotback.png" alt="spotback" /></a> Spotback<a class="register" href="http://spotback.com/euregister" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="spotbackusername" class="username"  value="'.$spotbackusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="spotbackpassword" class="password"  value="'.$spotbackpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";

    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.bibsonomy.org/" target="_blank"><img src="../images/bibsonomy.png" alt="bibsonomy" /></a> BibSonomy<a class="register" href="http://www.bibsonomy.org/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="bibsonomyusername" class="username"  value="'.$bibsonomyusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="bibsonomypassword" class="password"  value="'.$bibsonomypassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.jumptags.com/" target="_blank"><img src="../images/jumptags.png" alt="jumptags" /></a> Jumptags<a class="register" href="http://www.jumptags.com/go/signup/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="jumptagsusername" class="username"  value="'.$jumptagsusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="jumptagspassword" class="password"  value="'.$jumptagspassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://searchles.com/" target="_blank"><img src="../images/searchles.png" alt="searchles" /></a> Searchles<a class="register" href="http://searchles.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="searchlesusername" class="username"  value="'.$searchlesusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="searchlespassword" class="password"  value="'.$searchlespassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	

    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://quadriot.com/" target="_blank"><img src="../images/quad.png" alt="quad" /></a> QuadRiot<a class="register" href="http://quadriot.com/signup/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="quadusername" class="username"  value="'.$quadusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="quadpassword" class="password"  value="'.$quadpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://linkarena.com/" target="_blank"><img src="../images/linkarena.png" alt="linkarena" /></a> LinkARENA<a class="register" href="http://linkarena.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="linkarenausername" class="username"  value="'.$linkarenausername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="linkarenapassword" class="password"  value="'.$linkarenapassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.gabbr.com/" target="_blank"><img src="../images/gabbr.png" alt="gabbr" /></a> Gabbr<a class="register" href="http://www.gabbr.com/register/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="gabbrusername" class="username"  value="'.$gabbrusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="gabbrpassword" class="password"  value="'.$gabbrpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.linkagogo.com/" target="_blank"><img src="../images/linkago.png" alt="linkago" /></a> LinkaGoGo<a class="register" href="http://www.linkagogo.com/go/UserInfo" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="linkagousername" class="username"  value="'.$linkagousername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="linkagopassword" class="password"  value="'.$linkagopassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";

    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://faves.com/home/" target="_blank"><img src="../images/faves.png" alt="faves" /></a> Faves<a class="register" href="https://secure.faves.com/signIn?" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="favesusername" class="username"  value="'.$favesusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="favespassword" class="password"  value="'.$favespassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.google.com/" target="_blank"><img src="../images/google.png" alt="google" /></a> Google Bookmarks<a class="register" href="https://www.google.com/accounts/NewAccount" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="googleusername" class="username"  value="'.$googleusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="googlepassword" class="password"  value="'.$googlepassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://delicious.com/" target="_blank"><img src="../images/delicious.png" alt="delicious" /></a> Delicious<a class="register" href="https://edit.yahoo.com/registration?" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="delicioususername" class="username"  value="'.$delicioususername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="deliciouspassword" class="password"  value="'.$deliciouspassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.myspace.com/" target="_blank"><img src="../images/myspace.png" alt="myspace" /></a> MySpace<a class="register" href="http://signups.myspace.com/index.cfm?fuseaction=signup" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="myspaceusername" class="username"  value="'.$myspaceusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="myspacepassword" class="password"  value="'.$myspacepassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.newscola.com/" target="_blank"><img src="../images/newscola.png" alt="newscola" /></a> Newscola<a class="register" href="http://www.newscola.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="newscolausername" class="username"  value="'.$newscolausername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="newscolapassword" class="password"  value="'.$newscolapassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://joontz.com/" target="_blank"><img src="../images/joontz.png" alt="joontz" /></a> Joontz<a class="register" href="http://www.joontz.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="joontzusername" class="username"  value="'.$joontzusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="joontzpassword" class="password"  value="'.$joontzpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.stumbleupon.com/" target="_blank"><img src="../images/stumbleupon.png" alt="stumbleupon" /></a> StumbleUpon<a class="register" href="http://www.stumbleupon.com/sign_up.php" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="stumbleusername" class="username"  value="'.$stumbleusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="stumblepassword" class="password"  value="'.$stumblepassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.filbe.com/" target="_blank"><img src="../images/filbe.png" alt="filbe" /></a> Filbe<a class="register" href="http://www.filbe.com/register/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="filbeusername" class="username"  value="'.$filbeusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="filbepassword" class="password"  value="'.$filbepassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://newsbomber.co.cc/" target="_blank"><img src="../images/newsbomb.png" alt="newsbomb" /></a> NewsBomb<a class="register" href="http://newsbomber.co.cc/register.php" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="newsbombusername" class="username"  value="'.$newsbombusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="newsbombpassword" class="password"  value="'.$newsbombpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.blurpalicious.com/" target="_blank"><img src="../images/blurpalicious.png" alt="blurpalicious" /></a> Blurpalicious<a class="register" href="http://www.blurpalicious.com/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="blurpalicioususername" class="username"  value="'.$blurpalicioususername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="blurpaliciouspassword" class="password"  value="'.$blurpaliciouspassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://identi.ca/" target="_blank"><img src="../images/identi.png" alt="identi" /></a> Identi<a class="register" href="https://identi.ca/main/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="identiusername" class="username"  value="'.$identiusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="identipassword" class="password"  value="'.$identipassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://bookmarkindo.com/" target="_blank"><img src="../images/bookmarkindo.png" alt="bookmarkindo" /></a> Bookmarkindo<a class="register" href="http://bookmarkindo.com/register.php" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="bookmarkindousername" class="username"  value="'.$bookmarkindousername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="bookmarkindopassword" class="password"  value="'.$bookmarkindopassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://youblogged.com/" target="_blank"><img src="../images/youblogged.png" alt="youblogged" /></a> Youblogged<a class="register" href="http://youblogged.com/user/register" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="youbloggedusername" class="username"  value="'.$youbloggedusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="youbloggedpassword" class="password"  value="'.$youbloggedpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.oneview.de/" target="_blank"><img src="../images/oneview.png" alt="oneview" /></a> Oneview<a class="register" href="http://www.oneview.de/registrierung/" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="oneviewusername" class="username"  value="'.$oneviewusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="oneviewpassword" class="password"  value="'.$oneviewpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	
	echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://www.spurl.net/" target="_blank"><img src="../images/spurl.png" alt="spurl" /></a> Spurl<a class="register" href="http://www.spurl.net/newuser.php" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="spurlusername" class="username"  value="'.$spurlusername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="spurlpassword" class="password"  value="'.$spurlpassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";

    echo "<div class='accform'>";
    echo '<div class="accheader"><a href="http://m.www.yahoo.com/" target="_blank"><img src="../images/yahoo.png" alt="yahoo" /></a> Yahoo! Bookmarks<a class="register" href="https://edit.yahoo.com/registration?" target="_blank">Register account</a></div>';
    echo '<div class="userpass">Username: <input type="text" name="yahoousername" class="username"  value="'.$yahoousername.'" size="28" /></div>';
    echo '<div class="userpassw">Password: <input type="text" name="yahoopassword" class="password"  value="'.$yahoopassword.'" size="28" /></div>';
    echo '<input type="submit" class="save" value="" />';
    echo "</div>";
	echo '</div>';
    echo '</form>';
	
?>
	
</body>
</html>