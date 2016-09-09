<?php

function favesbookmark($title,$link,$text,$tags,$favesusername,$favespassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Faves times
$favestime = $xml->settings->favestime;
$referer = $xml->settings->referer;

$text = substr($text, 0, 999);
$title = substr($title, 0, 250);
$tags = substr($tags, 0, 250);

$title = urlencode($title);
$text = urlencode($text);
$link = urlencode($link);
$tags = urlencode($tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure.faves.com/v1/posts/add?url=$link&description=$title&ectended=$text&tags=$tags");
curl_setopt($ch, CURLOPT_TIMEOUT, $favestime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_USERPWD, $favesusername.':'.$favespassword);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if($status == 503){
echo "<span class='reptext'>Faves:</span> <span class='badtext'> service overloaded</span><br />";
return false;
}
if($status == 403){
echo "<span class='reptext'>Faves:</span> <span class='badtext'> account probably blocked</span><br />";
return false;
}
if($status == 502){
echo "<span class='reptext'>Faves:</span> <span class='badtext'> site is down</span><br />";
return false;
}
if($status == 401){
echo "<span class='reptext'>Faves:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}
if($status == 0){
echo "<span class='reptext'>Faves:</span> <span class='badtext'> couldnt connect</span><br />";
return false;
}
if($status == 200){
echo "<span class='reptext'>Faves:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Faves:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Faves error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
curl_close($ch);
}

?>