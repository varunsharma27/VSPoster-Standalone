<?php

function myspacebookmark($title,$link,$text,$cookiefile,$myspaceusername,$myspacepassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get MySpace times
$myspacetime = $xml->settings->myspacetime;
$referer = $xml->settings->referer;

$link = urlencode($link);
$text = substr($text, 0, 499);
$text = "$text <br />Read more from... $link";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.myspace.com/");
curl_setopt($ch, CURLOPT_TIMEOUT, $myspacetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
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
    echo "<span class='reptext'>MySpace:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  MySpace error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="([^"]+)" [^>]/', $output, $vi);
$view = urlencode($vi[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure.myspace.com/index.cfm?fuseaction=login.process");
curl_setopt($ch, CURLOPT_TIMEOUT, $myspacetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "__VIEWSTATE=$view&NextPage=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24Email_Textbox=$myspaceusername&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24Password_Textbox=$myspacepassword&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24SingleSignOnHash=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24SingleSignOnRequestUri=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24nexturl=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24apikey=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24ContainerPage=&ctl00%24ctl00%24cpMain%24cpMain%24LoginBox%24SMSVerifiedCookieToken=");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>MySpace:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  MySpace error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://home.myspace.com/index.cfm?fuseaction=user");
curl_setopt($ch, CURLOPT_TIMEOUT, $myspacetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Please log in to continue")) {
echo "<span class='reptext'>MySpace:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>MySpace:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  MySpace error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<a class="link1" title="Post Bulletin" href="([^"]+)">\s*post bulletin</a>#si', $output, $pos);
$post = $pos[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $post);
curl_setopt($ch, CURLOPT_TIMEOUT, $myspacetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
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
    echo "<span class='reptext'>MySpace:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  MySpace error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<form action=\'([^"]+)\'#', $output, $ac);
preg_match('#<input type="hidden" name="groupID" value=\'([^"]+)\'#', $output, $gr);
preg_match('#<input type="hidden" name="hash" value=\'([^"]+)\'#', $output, $ha);
preg_match('#<input type="hidden" name="hashcode" value=\'([^"]+)\'#', $output, $has);
$action = $ac[1];
$group = $gr[1];
$hash = $ha[1];
$hashcode = $has[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $action);
curl_setopt($ch, CURLOPT_TIMEOUT, $myspacetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "groupID=$group&hashcode=$hashcode&hash=$hash&subject=$title&body=$text&allowBulletinComments=1&mode=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If success
if(strstr($output,"Your bulletin has been posted to MySpace")) {
echo "<span class='reptext'>MySpace:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>MySpace:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  MySpace error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>