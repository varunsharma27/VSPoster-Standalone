<?php

function diigobookmark($title,$link,$text,$tags,$diigopassword,$diigousername){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Diigo times
$diigotime = $xml->settings->diigotime;

$link = urlencode($link);	
$diigovars = 'url='.$link.'&title='.$title.'&shared=yes&desc='.$text.'&tags='.$tags; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://api2.diigo.com/bookmarks');
curl_setopt($ch, CURLOPT_TIMEOUT, $diigotime);
curl_setopt($ch, CURLOPT_USERPWD, $diigousername.':'.$diigopassword);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $diigovars);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec ($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if($status == 503){
echo "<span class='reptext'>Diigo:</span> <span class='badtext'> service overloaded</span><br />";
return false;
}
if($status == 403){
echo "<span class='reptext'>Diigo:</span> <span class='badtext'> account probably blocked</span><br />";
return false;
}
if($status == 502){
echo "<span class='reptext'>Diigo:</span> <span class='badtext'> site is down</span><br />";
return false;
}
if($status == 401){
echo "<span class='reptext'>Diigo:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}
if($status == 0){
echo "<span class='reptext'>Diigo:</span> <span class='badtext'> couldnt connect</span><br />";
return false;
}
if($status == 200){
echo "<span class='reptext'>Diigo:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Diigo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
curl_close($ch);
}

?>