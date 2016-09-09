<?php

function blinklistbookmark($title,$link,$text,$tags,$cookiefile,$blinklistusername,$blinklistpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Blinklist times
$blinklisttime = $xml->settings->blinklisttime;

$link = urlencode($link);
$text = substr($text, 0, 499);
$tags = str_replace(" ",",",$tags);

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.blinklist.com/user/login/?next=GoTo&u=$link&t=$title&d=");
curl_setopt($ch, CURLOPT_TIMEOUT, $blinklisttime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.blinklist.com/blink?u=$link&t=$title&d="); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Blinklist:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.blinklist.com/user/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $blinklisttime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "username=$blinklistusername&password=$blinklistpassword");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

// If wrong username or password
if($output){
preg_match('#<p>([^"]+)\s*. It happens.</p>#si', $output, $randk);
$fail = $randk[1];
}
if($fail == "Your login was incorrect or incomplete"){
echo "<span class='reptext'>Blinklist:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Blinklist:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.blinklist.com/blink?u=$link&t=$title&d=");
curl_setopt($ch, CURLOPT_TIMEOUT, $blinklisttime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.blinklist.com/user/login/?next=GoTo&u=$link&t=$title&d="); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Blinklist:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Blinklist error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}


$ch = curl_init();  
curl_setopt ($ch, CURLOPT_URL, "http://www.blinklist.com/blink");
curl_setopt($ch, CURLOPT_TIMEOUT, $blinklisttime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt ($ch, CURLOPT_POSTFIELDS, "name=$title&description=$text&tags=$tags&email=&url=$link&isBookmarklet=true");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//If success
if($status == 200){
echo "<span class='reptext'>Blinklist:</span> <span class='goodtext'> success.</span><br />";
return false;
}

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Blinklist:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Blinklist error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>