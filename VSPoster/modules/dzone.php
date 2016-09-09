<?php

function dzonebookmark($title,$link,$text,$cookiefile,$dzoneusername,$dzonepassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Dzone times
$dzonetime = $xml->settings->dzonetime;
$referer = $xml->settings->referer;

$link = urlencode($link);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.dzone.com/links/j_acegi_security_check ");
curl_setopt($ch, CURLOPT_TIMEOUT, $dzonetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "j_username=$dzoneusername&j_password=$dzonepassword&_acegi_security_remember_me=on");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If wrong username or password
if($output){
preg_match('#<font color="red">([^"]+)</font>#si', $output, $randk);
$key = $randk[1];
}
if($key == "Invalid username or password"){
echo "<span class='reptext'>Dzone:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

// Write error log
if(curl_error($ch))
{
    echo "<span class='reptext'>Dzone:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Dzone error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_setopt($ch, CURLOPT_URL, "http://www.dzone.com/links/add.html");
curl_setopt($ch, CURLOPT_TIMEOUT, $dzonetime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIE, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "title=$title&url=$link&description=$text&tags=announcement&tags=news&tags=opinion&tags=trends");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
// If already posted
if($output){
preg_match('#<h4>([^"]+)\s* in the last 30 days. Please make sure#si', $output, $ident);
$dub = $ident[1];
}
if($dub == "A link with an identical title was posted"){
echo "<span class='reptext'>Dzone:</span> <span class='badtext'> this link is already posted.</span><br />";
}

//If link spam
if($output){
preg_match('#<p>([^"]+)\s*Links to this domain have been prohibited.</p>#si', $output, $randk);
$key = $randk[1];
}
if($key == "Your link could not be posted. "){
echo "<span class='reptext'>Dzone:</span> <span class='badtext'> Your link could not be posted. Links to this domain have been prohibited.</span><br />";
}

//If success
if($output){
preg_match('#<div id="entice_prompt" class="info">([^"]+)\s* by our moderators.</div>#si', $output, $suc);
$succ = $suc[1];
}
if($succ == "This link is currently under review"){
echo "<span class='reptext'>Dzone:</span> <span class='goodtext'> success.</span><br />";
}

// Write error log
if(curl_error($ch))
{
    echo "<span class='reptext'>Dzone:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Dzone error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
curl_close($ch);
}

?>