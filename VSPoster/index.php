<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<meta content="index,follow" name="robots" />
<meta content="all" name="audience" />
<meta name="description" content="VSPoster is new revolutional standalone social bookmarking tool." />
<meta name="keywords" content="VSPoster" />
<meta name="copyright" content="seomonsters.net" />
<meta name="publisher" content="seomonsters.net" />
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

<script type="text/javascript">
<!--
function validate() {

if (document.bookmark.title.value.length < 10)
{
alert("Please enter title at least 10 characters!");
return false;
} 
if (document.bookmark.descript.value.length < 30)
{
alert("Please enter description at least 30 characters!");
return false;
}
if (document.bookmark.link.value.length < 12)
{
alert("Please enter a valid link!");
return false;
}
if (document.bookmark.tags.value.length < 3)
{
alert("Please enter at least one tag!");
return false;
}
}
//-->
</script>

</head>
<body>



<?php
$xml = simplexml_load_file('db/config.xml');
// Get Diigo user
$diigousername = $xml->options->diigousername;
// Get Blinklist user
$blinklistusername = $xml->options->blinklistusername;
// Get Tumblr user
$tumblrusername = $xml->options->tumblrusername;
// Get Twitter user
$twitterusername = $xml->options->twitterusername;
// Get Mister-Wong user
$misterusername = $xml->options->misterusername;
// Get Dzone user
$dzoneusername = $xml->options->dzoneusername;
// Get A1-Webmarks user
$a1username = $xml->options->a1username;
// Get Url.org user
$urlousername = $xml->options->urlousername;
// Get Spotback user
$spotbackusername = $xml->options->spotbackusername;
// Get Bibsonomy user
$bibsonomyusername = $xml->options->bibsonomyusername;
// Get Jumptags user
$jumptagsusername = $xml->options->jumptagsusername;
// Get Searchles user
$searchlesusername = $xml->options->searchlesusername;
// Get QuadRiot user
$quadusername = $xml->options->quadusername;
// Get LinkArena user
$linkarenausername = $xml->options->linkarenausername;
// Get Gabbr user
$gabbrusername = $xml->options->gabbrusername;
// Get LinkaGoGo user
$linkagousername = $xml->options->linkagousername;
// Get Faves user
$favesusername = $xml->options->favesusername;
// Get Google user
$googleusername = $xml->options->googleusername;
// Get Delicious user
$delicioususername = $xml->options->delicioususername;
// Get MySpace user
$myspaceusername = $xml->options->myspaceusername;
// Get Newscola user
$newscolausername = $xml->options->newscolausername;
// Get Yahoo user
$yahoousername = $xml->options->yahoousername;
// Get Joontz user
$joontzusername = $xml->options->joontzusername;
// Get StumbleUpon user
$stumbleusername = $xml->options->stumbleusername;
// Get Filbe user
$filbeusername = $xml->options->filbeusername;
// Get NewsBomb user
$newsbombusername = $xml->options->newsbombusername;
// Get Blurpalicious logins
$blurpalicioususername = $xml->options->blurpalicioususername;
// Get Identi logins
$identiusername = $xml->options->identiusername;
// Get Bookmarkindo logins
$bookmarkindousername = $xml->options->bookmarkindousername;
// Get Youblogged logins
$youbloggedusername = $xml->options->youbloggedusername;
// Get Oneview logins
$oneviewusername = $xml->options->oneviewusername;
// Get Spurl logins
$spurlusername = $xml->options->spurlusername;

// Get Tubmlr user from login email
$tumblruser = $tumblrusername;
$firstp = explode("@", $tumblruser);
$tumblruser = $firstp[0];

// Get Delicious user from login email
$delicioususer = $delicioususername;
$firstp = explode("@", $delicioususer);
$delicioususer = $firstp[0];

	echo "<div id='container'>";
    echo "<div class='topicbody'>";
	echo '<center style="margin-top:10px;"><a href="http://seomonsters.net/"><img src="images/VSPoster.png" border="0" alt="VSPoster" /></a></center>';
	echo '<form method="post" action="data.php" name="bookmark" onsubmit="return validate()">';
    echo '<div class="form">Link: <input type="text" name="link" class="link" size="95" /></div>';
	echo '<div class="form">Title: <input type="text" name="title" class="title" size="95" /></div>';	
    echo '<div class="form">Description: <textarea name="descript" class="descript" cols="92" rows="6"> </textarea></div>';
	echo '<div class="form">Tags (separated with space): <input type="text" name="tags" class="tags" size="95" /></div>';
	echo '<input type="submit" name="send" class="submit" value="" />';
	echo '</form>';
    echo '</div>';
	
	echo '<div class="menutop" style="margin-top:10px;">';
	echo '<center><a href="db/bmp.php">Configure Accounts</a></center>';
	echo '</div>';
	echo '<div class="menu">';
	echo '<div class="active">';
	echo '<center>Currently active accounts</center>';
	echo '</div>';
$i = 0;
$ucount = strlen($diigousername);
if ($ucount > $i + 1){
	echo '<a href="http://www.diigo.com/user/'.$diigousername.'" target="_blank"><img src="images/diigo.png" alt="diigo" /> Check your post from Diigo</a><br />';
	}
$ucount = strlen($tumblrusername);
if ($ucount > $i + 1){
	echo '<a href="http://'.$tumblruser.'.tumblr.com/" target="_blank"><img src="images/tumblr.png" alt="tumblr" /> Check your post from Tumblr</a><br />';
	}
$ucount = strlen($twitterusername);
if ($ucount > $i + 1){
	echo '<a href="http://twitter.com/'.$twitterusername.'" target="_blank" ><img src="images/twitter.png" alt="twitter" /> Check your post from Twitter</a><br />';
	}
$ucount = strlen($misterusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.mister-wong.com/user/'.$misterusername.'/" target="_blank"><img src="images/misterwong.png" alt="misterwong" /> Check your post from M.-W.</a><br />';
	}
$ucount = strlen($dzoneusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.dzone.com/links/users/profile/'.$dzoneusername.'.html" target="_blank" ><img src="images/dzone.png" alt="dzone" /> Check your post from Dzone</a><br />';
	}
$ucount = strlen($a1username);
if ($ucount > $i + 1){
    echo '<a href="http://www.a1-webmarks.com/links-'.$a1username.'.html" target="_blank"><img src="images/a1.png" alt="a1" /> Check your post from A1-W.</a><br />';
	}
$ucount = strlen($urlousername);
if ($ucount > $i + 1){
	echo '<a href="http://url.org/bookmarks/'.$urlousername.'" target="_blank" ><img src="images/urlo.png" alt="urlo" /> Check your post from Url.org</a><br />';
	}
$ucount = strlen($spotbackusername);
if ($ucount > $i + 1){
    echo '<a href="http://spotback.com/users/'.$spotbackusername.'" target="_blank"><img src="images/spotback.png" alt="spotback" /> Check your post from Spotback</a><br />';
	}
$ucount = strlen($jumptagsusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.jumptags.com/'.$jumptagsusername.'/" target="_blank"><img src="images/jumptags.png" alt="jumptags" /> Check your post from Jumptags</a><br />';
	}
$ucount = strlen($searchlesusername);
if ($ucount > $i + 1){
	echo '<a href="http://searchles.com/people/show/'.$searchlesusername.'/posts" target="_blank" ><img src="images/searchles.png" alt="searchles" /> Check your post from Searchles</a><br />';
	}
$ucount = strlen($quadusername);
if ($ucount > $i + 1){
	echo '<a href="http://quadriot.com/user/'.$quadusername.'/" target="_blank"><img src="images/quad.png" alt="quadriot" /> Check your post from Quadriot</a><br />';
	}
$ucount = strlen($linkarenausername);
if ($ucount > $i + 1){
	echo '<a href="http://'.$linkarenausername.'.linkarena.com/" target="_blank" ><img src="images/linkarena.png" alt="linkarena" /> Check your post from LinkArena</a><br />';
	}
$ucount = strlen($gabbrusername);
if ($ucount > $i + 1){
    echo '<a href="http://www.gabbr.com/bookmarks/" target="_blank"><img src="images/gabbr.png" alt="gabbr" /> Check your post from Gabbr</a><br />';
	}
$ucount = strlen($favesusername);
if ($ucount > $i + 1){
	echo '<a href="http://faves.com/users/'.$favesusername.'" target="_blank" ><img src="images/faves.png" alt="faves" /> Check your post from Faves</a><br />';
	}
$ucount = strlen($delicioususername);
if ($ucount > $i + 1){
	echo '<a href="http://delicious.com/'.$delicioususer.'" target="_blank" ><img src="images/delicious.png" alt="delicious" /> Check your post from Delicious</a><br />';
	}
$ucount = strlen($blinklistusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.blinklist.com/'.$blinklistusername.'" target="_blank" ><img src="images/blinklist.png" alt="blinklist" /> Check your post from Blinklist</a><br />';
	}
$ucount = strlen($bibsonomyusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.bibsonomy.org/user/'.$bibsonomyusername.'" target="_blank" ><img src="images/bibsonomy.png" alt="bibsonomy" /> Check your post from Bibsonomy</a><br />';
	}
$ucount = strlen($linkagousername);
if ($ucount > $i + 1){
	echo '<a href="http://www.linkagogo.com/go/Members/'.$linkagousername.'/Home" target="_blank" ><img src="images/linkago.png" alt="linkago" /> Check your post from LinkaGoGo</a><br />';
	}
$ucount = strlen($googleusername);
if ($ucount > $i + 1){
	echo '<a href="https://www.google.com/bookmarks" target="_blank" ><img src="images/google.png" alt="google" /> Check your post from Google</a><br />';
	}
$ucount = strlen($myspaceusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.myspace.com/" target="_blank" ><img src="images/myspace.png" alt="myspace" /> Check your post from MySpace</a><br />';
	}
$ucount = strlen($yahoousername);
if ($ucount > $i + 1){
	echo '<a href="http://bookmarks.yahoo.com/" target="_blank" ><img src="images/yahoo.png" alt="yahoo" /> Check your post from Yahoo</a><br />';
	}
$ucount = strlen($newscolausername);
if ($ucount > $i + 1){
	echo '<a href="http://www.newscola.com/user/'.$newscolausername.'/history/" target="_blank" ><img src="images/newscola.png" alt="newscola" /> Check your post from Newscola</a><br />';
	}
$ucount = strlen($joontzusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.joontz.com/user/history/'.$joontzusername.'" target="_blank" ><img src="images/joontz.png" alt="joontz" /> Check your post from Joontz</a><br />';
	}
$ucount = strlen($stumbleusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.stumbleupon.com/stumbler/'.$stumbleusername.'/reviews/" target="_blank" ><img src="images/stumbleupon.png" alt="stumbleupon" /> Check your post from S.Upon</a><br />';
	}
$ucount = strlen($filbeusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.filbe.com/user/history/'.$filbeusername.'/" target="_blank" ><img src="images/filbe.png" alt="filbe" /> Check your post from Filbe</a><br />';
	}
$ucount = strlen($newsbombusername);
if ($ucount > $i + 1){
	echo '<a href="http://newsbomber.co.cc/user.php?login='.$newsbombusername.'&view=history" target="_blank" ><img src="images/newsbomb.png" alt="newsbomb" /> Check your post from NewsBomb</a><br />';
	}
$ucount = strlen($blurpalicioususername);
if ($ucount > $i + 1){
	echo '<a href="http://www.blurpalicious.com/user/history/'.$blurpalicioususername.'" target="_blank" ><img src="images/blurpalicious.png" alt="blurpalicious" /> Check your post from Blurpalic.</a><br />';
	}
$ucount = strlen($identiusername);
if ($ucount > $i + 1){
	echo '<a href="http://identi.ca/'.$identiusername.'/all" target="_blank" ><img src="images/identi.png" alt="identi" /> Check your post from Identi</a><br />';
	}
$ucount = strlen($bookmarkindousername);
if ($ucount > $i + 1){
	echo '<a href="http://bookmarkindo.com/user.php?login='.$bookmarkindousername.'&view=history" target="_blank" ><img src="images/bookmarkindo.png" alt="bookmarkindo" /> Check your post from Bookmarki.</a><br />';
	}
$ucount = strlen($youbloggedusername);
if ($ucount > $i + 1){
	echo '<a href="http://youblogged.com/user/" target="_blank" ><img src="images/youblogged.png" alt="youblogged" /> Check your post from Youblogged</a><br />';
	}
$ucount = strlen($oneviewusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.oneview.de/user/'.$oneviewusername.'/" target="_blank" ><img src="images/oneview.png" alt="oneview" /> Check your post from Oneview</a><br />';
	}
$ucount = strlen($spurlusername);
if ($ucount > $i + 1){
	echo '<a href="http://www.spurl.net/discover/user/'.$spurlusername.'/" target="_blank" ><img src="images/spurl.png" alt="spurl" /> Check your post from Spurl</a><br />';
	}
	
	echo '</div>';
	echo "<div class='indexer'>";
	echo '<center style="margin-top:30px;"><img src="images/indexer.png" border="0" alt="indexer" /></center>';
	echo '<form method="post" action="indexer.php" name="indexer">';
    echo '<div class="form">Domain: <input type="text" name="link" class="link" size="95" /></div>';
	echo '<input type="submit" name="index" class="submit" value="" />';
	echo '</form>';
	echo '<div style="float:left; width:490px; font-size:14px; font-weight:bold; padding-top:20px; color:#555555;">';
	echo '<center>Indexer shoots your domain to 24 websites like aboutus.org, alexa.com, domaintools.com and so on.</center>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
	
?>

</body>
</html>