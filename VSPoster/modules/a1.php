<?php

function a1bookmark($title,$link,$text,$tags,$cookiefile,$a1username,$a1password){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get A1-Webmarks times
$a1time = $xml->settings->a1time;
$referer = $xml->settings->referer;


$tags = str_replace(" ",",",$tags);

$link = urlencode($link);
$title = urlencode($title);
$text = urlencode($text);
$tags = urlencode($tags);
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.a1-webmarks.com/login.html");
curl_setopt($ch, CURLOPT_TIMEOUT, $a1time);
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

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input name="([^"]+)" type="hidden" value="lgn">/', $output, $randk);
$key = $randk[1];
}

$key = str_replace("'); document.write('","",$key);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.a1-webmarks.com/login.html");
curl_setopt($ch, CURLOPT_TIMEOUT, $a1time);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$key=lgn&username=$a1username&password=$a1password&submit=Submit");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If wrong username or password

if (strpos($output, "Invalid username or password")){
echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.a1-webmarks.com/bm_edit.html");
curl_setopt($ch, CURLOPT_TIMEOUT, $a1time);
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

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input name="([^"]+)" value="" size=80 maxlength=1000>/', $output, $randk);
$key = $randk[1];
}

$key = str_replace("'); document.write('","",$key);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.a1-webmarks.com/bm_edit.html");
curl_setopt($ch, CURLOPT_TIMEOUT, $a1time);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "link_1=$link&title=$title&$key=$tags&remarks=$text&private_remarks=&privacy=1&evaluation=4&favorite=1&submit=Submit&id=0&orig_link=http%3A%2F%2F&orig_tag=$tags");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.a1-webmarks.com/search.html?q=$title");
curl_setopt($ch, CURLOPT_TIMEOUT, $a1time);
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

// If Curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  A1 error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

//If success
if(strpos($output, "Webmark found")) {
echo "<span class='reptext'>A1-Webmarks:</span> <span class='goodtext'> success.</span><br />";
return false;
}
else {
echo "<span class='reptext'>A1-Webmarks:</span> <span class='badtext'> something went wrong.</span><br />";
}

curl_close($ch);
}

?>