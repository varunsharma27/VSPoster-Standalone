<?php

function yahoobookmark($title,$link,$text,$tags,$cookiefile,$yahoousername,$yahoopassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Yahoo times
$yahootime = $xml->settings->yahootime;
$referer = $xml->settings->referer;

$link = urlencode($link);
$text = substr($text, 0, 999);
$title = substr($title, 0, 250);

$tags = explode(" ",$tags); 
$tag1 = $tags[0];
$tag2 = $tags[1];
$tag3 = $tags[2];
$tag4 = $tags[3];
$tag5 = $tags[4];

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "http://bookmarks.yahoo.com/myresults/bookmarklet");
curl_setopt($ch, CURLOPT_TIMEOUT, $yahootime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Yahoo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Yahoo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name=".challenge" value="([^"]+)"[>]/', $output, $cha);
preg_match('/<input type="hidden" name=".u" value="([^"]+)"[>]/', $output, $uk);
preg_match('/<input type="hidden" name=".pd" value="([^"]+)"[>]/', $output, $p);
$ch = urlencode($cha[1]);
$u = urlencode($uk[1]);
$pd = urlencode($p[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.yahoo.com/config/login?");
curl_setopt($ch, CURLOPT_TIMEOUT, $yahootime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "https://login.yahoo.com/config/login?.src=bmk2&.intl=us&.done=http%3A%2F%2Fbookmarks.yahoo.com%2Fmyresults%2Fbookmarklet"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ".tries=1&.src=bmk2&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=&.partner=&.u=$u&.v=0&.challenge=$ch&.yplus=&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=0&.chkP=Y&.done=http%3A%2F%2Fbookmarks.yahoo.com%2Fmyresults%2Fbookmarklet&.pd=$pd&login=$yahoousername&passwd=$yahoopassword&.save=Sign+In");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Invalid ID or password")) {
echo "<span class='reptext'>Yahoo:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Yahoo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Yahoo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://myweb.yahoo.com/myresults/bookmarklet");
curl_setopt($ch, CURLOPT_TIMEOUT, $yahootime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Yahoo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Yahoo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="crumbs" value="([^"]+)"[>]/', $output, $crumb);
$crumbs = urlencode($crumb[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://bookmarks.yahoo.com/toolbar/addbm");
curl_setopt($ch, CURLOPT_TIMEOUT, $yahootime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "docid=&crumbs=$crumbs&u=$link&v=&visible=0&t=$title&newname=&pfidopt=0&fname=&pfid=&fid=0&d=$text&tags=yes&tag%5B%5D=$tag1&tag%5B%5D=$tag2&tag%5B%5D=$tag3&tag%5B%5D=$tag4&tag%5B%5D=$tag5&tag%5B%5D=&cache=yes&save=Save");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If success
if(strstr($output,"This bookmark was successfully saved")) {
echo "<span class='reptext'>Yahoo:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If no url and title
if(strstr($output,"A problem occured while trying to save the bookmark")) {
echo "<span class='reptext'>Yahoo:</span> <span class='badtext'>please insert valid url.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Yahoo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Yahoo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>