<?php

function spotbackbookmark($title,$link,$text,$tags,$cookiefile,$spotbackusername,$spotbackpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Spotback times
$spotbacktime = $xml->settings->spotbacktime;
$referer = $xml->settings->referer;

$title = substr($title, 0, 250);
$text = substr($text, 0, 500);
$tags = substr($tags, 0, 250);
$tags = str_replace(" ",",",$tags);
$text = urlencode($text);
$title = urlencode($title);
$link = urlencode($link);
$tags = urlencode($tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://spotback.com/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $spotbacktime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$spotbackusername&pass=$spotbackpassword");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Wrong username")) {
echo "<span class='reptext'>Spotback:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Spotback:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Spotback error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_setopt($ch, CURLOPT_URL, "http://spotback.com/scripts/wsapiprocessor.js");
curl_setopt($ch, CURLOPT_TIMEOUT, $spotbacktime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "s=no&m=ItemData.UpdateRating&a0=-1&a1=%22$link%22&a2=%22$title%22&a3=%22$text%22&a4=100&a5=%22$tags%22&a6=4");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If success
if(strstr($output,"error:null")) {
echo "<span class='reptext'>Spotback:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If no title
if(strstr($output,'null value in column \"title\"')) {
echo "<span class='reptext'>Spotback:</span> <span class='badtext'> please insert title.</span><br />";
return false;
}

//If no url
if(strstr($output,'null value in column \"url\"')) {
echo "<span class='reptext'>Spotback:</span> <span class='badtext'> please insert title.</span><br />";
return false;
}

//If not valid url
if(strstr($output,"Unknown URL format")) {
echo "<span class='reptext'>Spotback:</span> <span class='badtext'> please insert valid url.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Spotback:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Spotback error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>