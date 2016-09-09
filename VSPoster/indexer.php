<?php

$link = $_POST['index'];
$link = trim($link);
$link = preg_replace("/^(http:\/\/)*(www.)*/is", "", $link);
$link = preg_replace("/\/.*$/is" , "" ,$link);

function indexer($url){

	//Lets define cookiefile
	 $tmp = (dirname (__FILE__).'/tmp');
	 $cookiefile = tempnam($tmp,'COO');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($ch);
curl_close($ch);
}

$url = "http://www.alexa.com/siteinfo/$link";
indexer($url);

$url = "http://www.alexa.com/data/details/?url=$link";
indexer($url);

$url = "http://www.domaintools.com/go/?service=whois&q=$link";
indexer($url);

$url = "http://www.statbrain.com/$link";
indexer($url);

$url = "http://who.is/whois-com/$link";
indexer($url);

$url = "http://www.aboutus.org/$link";
indexer($url);

$url = "http://snapshot.compete.com/$link";
indexer($url);;

$url = "http://whois.ws/whois-info/ip-address/$link";
indexer($url);

$url = "http://www.whoisya.com/$link";
indexer($url);

$url = "http://www.robtex.com/dns/$link.html";
indexer($url);

$url = "http://www.siteadvisor.cn/sites/$link/summary/";
indexer($url);

$url = "http://www.siteadvisor.cn/sites/$link";
indexer($url);

$url = "http://www.talkreviews.com/$link";
indexer($url);

$url = "http://www.websiteoutlook.com/$link";
indexer($url);

$url = "http://www.sitedossier.com/site/$link";
indexer($url);

$url = "http://www.quarkbase.com/$link";
indexer($url);

$url = "http://www.thegetpr.com/site/$link";
indexer($url);

$url = "http://www.urladex.com/url/$link";
indexer($url);

$url = "http://whois.domainlabs.eu/$link";
indexer($url);

$url = "http://www.cubestat.com/$link";
indexer($url);

$url = "http://www.valuatemysite.com/$link";
indexer($url);

$url = "http://www.xmarks.com/site/$link";
indexer($url);

$url = "http://www.estimix.com/$link";
indexer($url);

$url = "http://www.seoserp.com/fast.way.get.index/?sitename1=$link&fast_way=get-index-site-links ";
indexer($url);

echo '
<html>
<head>
<script language="JavaScript">
function goback()
{
 document.location.href="index.php";
}
</script>
</head>
<body onload="goback()">
</body>
</html>';

?>