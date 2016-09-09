<?php

function tumblrbookmark($title,$link,$text,$cookiefile,$tumblrusername,$tumblrpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Tumblr times
$tumblrtime = $xml->settings->tumblrtime;

$tumblrusername = urlencode($tumblrusername);
$tumblrpassword = urlencode($tumblrpassword);
$text = substr($text, 0,499);
$text = "$text<br /><br />Read more about: <a target=_blank href=$link>$title</a>"; 
$link = urlencode($link);
$title = urlencode($title);
$text = urlencode($text);

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.tumblr.com/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $tumblrtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.tumblr.com/login?s=&t=$title&u=$link&v=3"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "s=&t=$title&u=$link&v=3&email=$tumblrusername&password=$tumblrpassword");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If wrong username or password
if(strstr($output,"Email or password is incorrect ")) {
echo "<span class='reptext'>Tumblr:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Tumblr:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Tumblr error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.tumblr.com/share?s=&t=$title&u=$link&v=3");
curl_setopt($ch, CURLOPT_TIMEOUT, $tumblrtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
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
    echo "<span class='reptext'>Tumblr:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Tumblr error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$output = str_replace("\n","",$output);
$output = str_replace("                   ","",$output);
if($output){
preg_match('/<input type="hidden" id="form_key" name="form_key" value="([^"]+)"[^>]/', $output, $randk);
$key = $randk[1];
}

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.tumblr.com/share");
curl_setopt($ch, CURLOPT_TIMEOUT, $tumblrtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "s=&t=$title&u=$link&v=3&source=bookmarklet&form_key=$key&channel_id=0&send_to_twitter=1&post%5Bstate%5D=0&post%5Bdate%5D=now&post%5Bslug%5D=&post%5Btags%5D=&post%5Btype%5D=link&post%5Bone%5D=$title&post%5Btwo%5D=$link&post%5Bthree%5D=%3Cp%3E$text%3C%2Fp%3E&is_rich_text%5Bthree%5D=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If success
if(strstr($output,"Done!")) {
echo "<span class='reptext'>Tumblr:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Tumblr:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Tumblr error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>