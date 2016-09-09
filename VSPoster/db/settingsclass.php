<?php

// Get Diigo timeout
$diigotime = $_POST['diigotime'];

// Get Blinklist timeout
$blinklisttime = $_POST['blinklisttime'];

// Get Tumblr timeout
$tumblrtime = $_POST['tumblrtime'];

// Get Twitter timeout
$twittertime = $_POST['twittertime'];

// Get Mister-Wong timeout
$mistertime = $_POST['mistertime'];

// Get Dzone timeout
$dzonetime = $_POST['dzonetime'];

// Get A1-Webmarks timeout
$a1time = $_POST['a1time'];

// Get Url.org timeout
$urlotime = $_POST['urlotime'];

// Get Spotback timeout
$spotbacktime = $_POST['spotbacktime'];

// Get Bibsonomy timeout
$bibsonomytime = $_POST['bibsonomytime'];

// Get Jumptags timeout
$jumptagstime = $_POST['jumptagstime'];

// Get Searchles timeout
$searchlestime = $_POST['searchlestime'];

// Get QuadRiot timeout
$quadtime = $_POST['quadtime'];

// Get LinkArena timeout
$linkarenatime = $_POST['linkarenatime'];

// Get Gabbr timeout
$gabbrtime = $_POST['gabbrtime'];

// Get LinkaGoGo timeout
$linkagotime = $_POST['linkagotime'];

// Get Faves timeout
$favestime = $_POST['favestime'];

// Get Google timeout
$googletime = $_POST['googletime'];

// Get Delicious timeout
$delicioustime = $_POST['delicioustime'];

// Get MySpace timeout
$myspacetime = $_POST['myspacetime'];

// Get Newscola timeout
$newscolatime = $_POST['newscolatime'];

// Get Yahoo timeout
$yahootime = $_POST['yahootime'];

// Get Joontz timeout
$joontztime = $_POST['joontztime'];

// Get StumbleUpon timeout
$stumbletime = $_POST['stumbletime'];

// Get Filbe timeout
$filbetime = $_POST['filbetime'];

// Get NewsBomb timeout
$newsbombtime = $_POST['newsbombtime'];

// Get Blurpalicious timeout
$blurpalicioustime = $_POST['blurpalicioustime'];

// Get Identi timeout
$identitime = $_POST['identitime'];

// Get Bookmarkindo timeout
$bookmarkindotime = $_POST['bookmarkindotime'];

// Get Youblogged timeout
$youbloggedtime = $_POST['youbloggedtime'];

// Get Oneview timeout
$oneviewtime = $_POST['oneviewtime'];

// Get Spurl timeout
$spurltime = $_POST['spurltime'];

// Get Referer
$referer = $_POST['referer'];

// Lets write timeouts to database
$fh = fopen("settings.xml", "w");

$line = '<?xml version="1.0" encoding="utf-8"?>
<set status="ok">
<settings>
<diigotime>'.$diigotime.'</diigotime>
<blinklisttime>'.$blinklisttime.'</blinklisttime>
<tumblrtime>'.$tumblrtime.'</tumblrtime>
<twittertime>'.$twittertime.'</twittertime>
<mistertime>'.$mistertime.'</mistertime>
<dzonetime>'.$dzonetime.'</dzonetime>
<a1time>'.$a1time.'</a1time>
<urlotime>'.$urlotime.'</urlotime>
<spotbacktime>'.$spotbacktime.'</spotbacktime>
<bibsonomytime>'.$bibsonomytime.'</bibsonomytime>
<jumptagstime>'.$jumptagstime.'</jumptagstime>
<searchlestime>'.$searchlestime.'</searchlestime>
<quadtime>'.$quadtime.'</quadtime>
<linkarenatime>'.$linkarenatime.'</linkarenatime>
<gabbrtime>'.$gabbrtime.'</gabbrtime>
<linkagotime>'.$linkagotime.'</linkagotime>
<favestime>'.$favestime.'</favestime>
<googletime>'.$googletime.'</googletime>
<delicioustime>'.$delicioustime.'</delicioustime>
<myspacetime>'.$myspacetime.'</myspacetime>
<newscolatime>'.$newscolatime.'</newscolatime>
<yahootime>'.$yahootime.'</yahootime>
<joontztime>'.$joontztime.'</joontztime>
<stumbletime>'.$stumbletime.'</stumbletime>
<filbetime>'.$filbetime.'</filbetime>
<newsbombtime>'.$newsbombtime.'</newsbombtime>
<blurpalicioustime>'.$blurpalicioustime.'</blurpalicioustime>
<identitime>'.$identitime.'</identitime>
<bookmarkindotime>'.$bookmarkindotime.'</bookmarkindotime>
<youbloggedtime>'.$youbloggedtime.'</youbloggedtime>
<oneviewtime>'.$oneviewtime.'</oneviewtime>
<spurltime>'.$spurltime.'</spurltime>
<referer>'.$referer.'</referer>
</settings>
</set>';

fputs($fh, $line);
fclose($fh);

//lets get back to the page we were

echo '
<html>
<head>
<script language="JavaScript">
function goback()
{
 document.location.href="settings.php";
}
</script>
</head>
<body onload="goback()">
</body>
</html>';


?>