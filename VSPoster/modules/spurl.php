<?php

function spurlbookmark($title,$link,$text,$tags,$cookiefile,$spurlusername,$spurlpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Spurl times
$spurltime = $xml->settings->spurltime;

$title = substr($title, 0, 150);
$text = substr($text, 0, 499);
$tags = substr($tags, 0, 150);

$link = urlencode($link);
$title = urlencode($title);
$text =  urlencode($text);
$tags = urlencode($tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.spurl.net/smalllogin.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $spurltime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.spurl.net/smalllogin.php"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$spurlusername&password=$spurlpassword&Submit=Login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strpos($output,"New to spurl.net?")) {
echo "<span class='reptext'>Spurl:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Spurl:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Spurl error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.spurl.net/submit.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $spurltime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "link_title=$title&redir=&link_href=$link&title=$title&category=-1&newcategory=Links&keywords=$tags&description=$text&snip=&language=en&explicit=0&usercomment=&store=1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Spurl:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Spurl error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

//If some data is missing
if(strpos($output,"Spurltype, userid or url missing")) {
echo "<span class='reptext'>Spurl:</span> <span class='badtext'> Spurltype, userid or url missing.</span><br />";
return false;
}
else {
echo "<span class='reptext'>Spurl:</span> <span class='goodtext'> success.</span><br />";
return false;
}

curl_close($ch);

}

?>