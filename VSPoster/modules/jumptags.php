<?php

function jumptagsbookmark($title,$link,$text,$tags,$cookiefile,$jumptagsusername,$jumptagspassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Jumptags times
$jumptagstime = $xml->settings->jumptagstime;
$referer = $xml->settings->referer;

$link = urlencode($link);
$tags = str_replace(" ",",",$tags);
$text = substr($text, 0, 1000);
$title = substr($title, 0, 449);
$tags = substr($tags, 0, 250);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.jumptags.com/?l=1");
curl_setopt($ch, CURLOPT_TIMEOUT, $jumptagstime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "login=$jumptagsusername&password=$jumptagspassword&rememberme=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Jumptags:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Jumptags error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

//If wrong username or password
$checker = strpos($output,"DEFAULT_LANGUAGE");

if($checker === false) {
echo "<span class='reptext'>Jumptags:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.jumptags.com/?type=bookmark");
curl_setopt($ch, CURLOPT_TIMEOUT, $jumptagstime);
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
    echo "<span class='reptext'>Jumptags:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Jumptags error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.jumptags.com/joozit/components/data/update_bookmark.cfm");
curl_setopt($ch, CURLOPT_TIMEOUT, $jumptagstime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "dummy=1&undefined=undefined&jumptag_public=1&undefined=undefined&new_tag=$tags&common_title=$title&reference_url=$link&common_keywords=&common_description=$text&undefined=undefined&collection=&collection_ids=&public_bypass=0&btAdd=%20Add%20Jumptag%20&btCancel=%20Cancel%20&cMode=website");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Jumptags:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Jumptags error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

//If invalid url
if(strstr($output,"URL must begin with")) {
echo "<span class='reptext'>Jumptags:</span> <span class='badtext'> you have entered invalid or already posted url.</span><br />";
return false;
}

//If invalid tags
if(strstr($output,"Tag cannot begin with")) {
echo "<span class='reptext'>Jumptags:</span> <span class='badtext'> please check your tags for invalid characters.</span><br />";
return false;
}

//If already bookmarked
if(strstr($output,"Jumptag already exists. You have already bookmarked this URL")) {
echo "<span class='reptext'>Jumptags:</span> <span class='badtext'> you have already bookmarked this URL.</span><br />";
return false;
}

//If server error
if(strstr($output,"JRun Servlet Error")) {
echo "<span class='reptext'>Jumptags:</span> <span class='badtext'> server error (account may be blocked or slow down your submissions).</span><br />";
return false;
}
else{
echo "<span class='reptext'>Jumptags:</span> <span class='goodtext'> success.</span><br />";
}

curl_close($ch);
}

?>