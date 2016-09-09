<?php

function stumblebookmark($title,$link,$text,$tags,$cookiefile,$stumbleusername,$stumblepassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get StumbleUpon times
$stumbletime = $xml->settings->stumbletime;
$referer = $xml->settings->referer;

$text = substr($text, 0, 499);
$tags = str_replace(" ",",",$tags);
$text = "$text<br /><br />Read more about: <a target=_blank href=$link>$title</a>";

$title = urlencode($title);
$text = urlencode($text);
$tags = urlencode($tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.stumbleupon.com/login.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $stumbletime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$stumbleusername&password=$stumblepassword&dummyPassword=Password&login=Login&rememberme=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Invalid username")) {
echo "<span class='reptext'>StumbleUpon:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>StumbleUpon:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  StumbleUpon error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<input type="hidden" name="randkey" value="([^"]+)">#si', $output, $key);
$key = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.stumbleupon.com/favorites/");
curl_setopt($ch, CURLOPT_TIMEOUT, $stumbletime);
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
    echo "<span class='reptext'>StumbleUpon:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  StumbleUpon error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<div id="wrapperContent" class="([^"]+)">#si', $output, $tok);
$token = $tok[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.stumbleupon.com/ajax/edit/comment");
curl_setopt($ch, CURLOPT_TIMEOUT, $stumbletime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "review=$text&tags=$tags&title=$title&keep_date=0&sticky_post=0&commentid=0&publicid=&syndicate_tw=&syndicate_fb=&token=$token&url=$link&new_post=1&blog_post=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>StumbleUpon:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  StumbleUpon error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

//If success
if(strstr($output,"\"success\":true")) {
echo "<span class='reptext'>StumbleUpon:</span> <span class='goodtext'> success.</span><br />";
return false;
}
else{
echo "<span class='reptext'>StumbleUpon:</span> <span class='badtext'> unknown error.</span><br />";
return false;
}
curl_close($ch);
}

?>