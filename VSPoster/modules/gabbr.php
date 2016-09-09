<?php

function gabbrbookmark($title,$link,$text,$tags,$cookiefile,$gabbrusername,$gabbrpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Gabbr times
$gabbrtime = $xml->settings->gabbrtime;

$link = urlencode($link);
$text = substr($text, 0, 999);
$tags = str_replace(" ",",",$tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.gabbr.com/bookmarks/add/");
curl_setopt($ch, CURLOPT_TIMEOUT, $gabbrtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.gabbr.com/bookmarks/add/"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "unameLogin=$gabbrusername&userPassword=$gabbrpassword&submitLogin.x=49&submitLogin.y=7&submitLogin=Login");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If wrong username or password
if($output){
preg_match('#<strong>([^"]+)\s* Login.  Please <a#si', $output, $user);
$fail = $user[1];
}
if($fail == "Invalid"){
echo "<span class='reptext'>Gabbr:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Gabbr:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Gabbr error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.gabbr.com/bookmarks/add/");
curl_setopt($ch, CURLOPT_TIMEOUT, $gabbrtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.gabbr.com/bookmarks/add/"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "bookname=$title&bookurl=$link&bookdesc=$text&bookcat1=news&booktags=$tags&bookmarkstep=steptwo&bksubmit.x=27&bksubmit.y=9");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If success
if($output){
preg_match('#<span style="margin-left:8px;">([^"]+)\s*.   You can now view your <a#si', $output, $user);
$fail = $user[1];
}
if($fail == "Your bookmark was successfully added"){
echo "<span class='reptext'>Gabbr:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Gabbr:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Gabbr error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>