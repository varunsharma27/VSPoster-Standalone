<?php

function quadbookmark($title,$link,$text,$tags,$cookiefile,$quadusername,$quadpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get QuadRiot times
$quadtime = $xml->settings->quadtime;

$link = urlencode($link);
$text = substr($text, 0, 270);
$tags = str_replace(" ",",",$title);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://quadriot.com/login/");
curl_setopt($ch, CURLOPT_TIMEOUT, $quadtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.quadriot.com/"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$quadusername&password=$quadpassword&login=login&return_to_page=%2F");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Incorrect login")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Quad error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://quadriot.com/submitlink/");
curl_setopt($ch, CURLOPT_TIMEOUT, $quadtime);
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
    echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Quad error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://quadriot.com/submitlink");
curl_setopt($ch, CURLOPT_TIMEOUT, $quadtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "title=$title&url=$link&comment=$text&tags=$tags&submitlink=submit&bookmarklet=false");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If success
if(strstr($output,"thanks for submitting")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If no valid url
if(strstr($output,"This is not a valid URL")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'> please insert valid url.</span><br />";
return false;
}

//If no title
if(strstr($output,"You must supply a title")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'> title is required field.</span><br />";
return false;
}

//If no tags
if(strstr($output,"Tags must not be empty")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'> please provide at least 1 tag.</span><br />";
return false;
}

//If duplicated
if(strstr($output,"This URL already exists")) {
echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'> this url is already posted.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>QuadRiot:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Quad error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>