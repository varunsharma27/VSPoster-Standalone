<?php

function identibookmark($title,$link,$identiusername,$identipassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Identi times
$identitime = $xml->settings->identitime;
	
$title = substr($title, 0, 50);
$link = urlencode($link);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://identi.ca/api/statuses/update.xml");
curl_setopt($ch, CURLOPT_TIMEOUT, $identitime);
curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);;
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "status=$title $link");
curl_setopt($ch, CURLOPT_USERPWD, $identiusername.':'.$identipassword);
			
$output = curl_exec ($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if($status == 503){
echo "<span class='reptext'>Identi:</span> <span class='badtext'> service overloaded</span><br />";
return false;
}
if($status == 403){
echo "<span class='reptext'>Identi:</span> <span class='badtext'> account probably blocked</span><br />";
return false;
}
if($status == 502){
echo "<span class='reptext'>Identi:</span> <span class='badtext'> site is down</span><br />";
return false;
}
if($status == 401){
echo "<span class='reptext'>Identi:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}
if($status == 0){
echo "<span class='reptext'>Identi:</span> <span class='badtext'> please insert url and title.</span><br />";
return false;
}
if($status == 200){
echo "<span class='reptext'>Identi:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Identi:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Identi error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
curl_close($ch);
}

?>