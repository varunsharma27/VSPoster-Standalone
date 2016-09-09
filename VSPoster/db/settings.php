<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<meta content="index,follow" name="robots" />
<meta content="all" name="audience" />
<meta name="description" content=" is new revolutional standalone social bookmarking tool." />
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

// Lets get timeout values to display them
$xml = simplexml_load_file('settings.xml');

// Get Diigo times
$diigotime = $xml->settings->diigotime;

// Get Blinklist times
$blinklisttime = $xml->settings->blinklisttime;

// Get Tumblr times
$tumblrtime = $xml->settings->tumblrtime;

// Get Twitter times
$twittertime = $xml->settings->twittertime;

// Get Mister-Wong times
$mistertime = $xml->settings->mistertime;

// Get Dzone times
$dzonetime = $xml->settings->dzonetime;

// Get A1-Webmarks times
$a1time = $xml->settings->a1time;

// Get Url.org times
$urlotime = $xml->settings->urlotime;

// Get Spotback times
$spotbacktime = $xml->settings->spotbacktime;

// Get Bibsonomy times
$bibsonomytime = $xml->settings->bibsonomytime;

// Get Jumptags times
$jumptagstime = $xml->settings->jumptagstime;

// Get Searchles times
$searchlestime = $xml->settings->searchlestime;

// Get QuadRiot times
$quadtime = $xml->settings->quadtime;

// Get LinkArena times
$linkarenatime = $xml->settings->linkarenatime;

// Get Gabbr times
$gabbrtime = $xml->settings->gabbrtime;

// Get LinkaGoGo times
$linkagotime = $xml->settings->linkagotime;

// Get Faves times
$favestime = $xml->settings->favestime;

// Get Google times
$googletime = $xml->settings->googletime;

// Get Delicious times
$delicioustime = $xml->settings->delicioustime;

// Get MySpace times
$myspacetime = $xml->settings->myspacetime;

// Get Newscola times
$newscolatime = $xml->settings->newscolatime;

// Get Yahoo times
$yahootime = $xml->settings->yahootime;

// Get Joontz times
$joontztime = $xml->settings->joontztime;

// Get StumbleUpon times
$stumbletime = $xml->settings->stumbletime;

// Get Filbe times
$filbetime = $xml->settings->filbetime;

// Get NewsBomb times
$newsbombtime = $xml->settings->newsbombtime;

// Get Blurpalicious times
$blurpalicioustime = $xml->settings->blurpalicioustime;

// Get Identi times
$identitime = $xml->settings->identitime;

// Get Bookmarkindo times
$bookmarkindotime = $xml->settings->bookmarkindotime;

// Get Youblogged times
$youbloggedtime = $xml->settings->youbloggedtime;

// Get Oneview times
$oneviewtime = $xml->settings->oneviewtime;

// Get Spurl times
$spurltime = $xml->settings->spurltime;

// Get Referer
$referer = $xml->settings->referer;

// Create account forms
    echo '<form method="post" action="settingsclass.php">';
    echo "<div id='set'>";
	echo "<div class='topset'>";
	echo '<div class="accback"><a href="bmp.php"><img src="../images/back.png" alt="back" /></a></div>';
	echo '<div style="float:left;font-weight:bold;margin-left:185px;color:#000044;">Timeout values should stay between 1-30 seconds.</div>';
	echo '<input type="submit" class="timeouts" value="" />';
	echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/diigo.png" alt="diigo" /> Diigo</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="diigotime" class="time"  value="'.$diigotime.'" size="2" /></div>';	
    echo "</div>";
	
	echo "<div class='settings' style='width:602px;padding:6px;'>";
    echo '<div class="setheader" style="color:red;"> Set your referrer</div>';
    echo '<div class="timeout" style="float:left;">Referrer: <input type="text" name="referer" class="time"  value="'.$referer.'" size="30" />Example http://www.google.com/</div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/blinklist.png" alt="blinklist" /> Blinklist</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="blinklisttime" class="time"  value="'.$blinklisttime.'" size="2" /></div>';    
    echo "</div>";	
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/tumblr.png" alt="tumblr" /> Tumblr</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="tumblrtime" class="time"  value="'.$tumblrtime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/twitter.png" alt="twitter" /> Twitter</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="twittertime" class="time"  value="'.$twittertime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/misterwong.png" alt="misterwong" /> Mister-Wong</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="mistertime" class="time"  value="'.$mistertime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/dzone.png" alt="dzone" /> DZone</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="dzonetime" class="time"  value="'.$dzonetime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/a1.png" alt="a1" /> A1-Webmarks</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="a1time" class="time"  value="'.$a1time.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/urlo.png" alt="urlo" /> Url.org</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="urlotime" class="time"  value="'.$urlotime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/spotback.png" alt="spotback" /> Spotback</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="spotbacktime" class="time"  value="'.$spotbacktime.'" size="2" /></div>';    
    echo "</div>";

    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/bibsonomy.png" alt="bibsonomy" /> BibSonomy</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="bibsonomytime" class="time"  value="'.$bibsonomytime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/jumptags.png" alt="jumptags" /> Jumptags</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="jumptagstime" class="time"  value="'.$jumptagstime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/searchles.png" alt="searchles" /> Searchles</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="searchlestime" class="time"  value="'.$searchlestime.'" size="2" /></div>';    
    echo "</div>";
	

    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/quad.png" alt="quad" /> QuadRiot</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="quadtime" class="time"  value="'.$quadtime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/linkarena.png" alt="linkarena" /> LinkArena</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="linkarenatime" class="time"  value="'.$linkarenatime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/gabbr.png" alt="gabbr" /> Gabbr</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="gabbrtime" class="time"  value="'.$gabbrtime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/linkago.png" alt="linkago" /> LinkaGoGo</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="linkagotime" class="time"  value="'.$linkagotime.'" size="2" /></div>';   
    echo "</div>";

    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/faves.png" alt="faves" /> Faves</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="favestime" class="time"  value="'.$favestime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/google.png" alt="google" /> Google Bookmarks</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="googletime" class="time"  value="'.$googletime.'" size="2" /></div>';   
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/delicious.png" alt="delicious" /> Delicious</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="delicioustime" class="time"  value="'.$delicioustime.'" size="2" /></div>';    
    echo "</div>";
	
    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/myspace.png" alt="myspace" /> MySpace</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="myspacetime" class="time"  value="'.$myspacetime.'" size="2" /></div>';    
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/newscola.png" alt="newscola" /> Newscola</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="newscolatime" class="time"  value="'.$newscolatime.'" size="2" /></div>';    
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/joontz.png" alt="joontz" /> Joontz</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="joontztime" class="time"  value="'.$joontztime.'" size="2" /></div>';   
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/stumbleupon.png" alt="stumbleupon" /> StumbleUpon</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="stumbletime" class="time"  value="'.$stumbletime.'" size="2" /></div>';   
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/filbe.png" alt="filbe" /> Filbe</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="filbetime" class="time"  value="'.$filbetime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/newsbomb.png" alt="newsbomb" /> NewsBomb</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="newsbombtime" class="time"  value="'.$newsbombtime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/blurpalicious.png" alt="blurpalicious" /> Blurpalicious</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="blurpalicioustime" class="time"  value="'.$blurpalicioustime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/identi.png" alt="identi" /> Identi</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="identitime" class="time"  value="'.$identitime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/bookmarkindo.png" alt="bookmarkindo" /> Bookmarkindo</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="bookmarkindotime" class="time"  value="'.$bookmarkindotime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/youblogged.png" alt="youblogged" /> Youblogged</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="youbloggedtime" class="time"  value="'.$youbloggedtime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/oneview.png" alt="oneview" /> Oneview</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="oneviewtime" class="time"  value="'.$oneviewtime.'" size="2" /></div>';
    echo "</div>";
	
	echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/spurl.png" alt="spurl" /> Spurl</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="spurltime" class="time"  value="'.$spurltime.'" size="2" /></div>';
    echo "</div>";

    echo "<div class='settings'>";
    echo '<div class="setheader"><img src="../images/yahoo.png" alt="yahoo" /> Yahoo! Bookmarks</div>';
    echo '<div class="timeout">Timeout: <input type="text" name="yahootime" class="time"  value="'.$yahootime.'" size="2" /></div>';
    echo "</div>";
	echo '</div>';
    echo '</form>';
	
?>
	
</body>
</html>