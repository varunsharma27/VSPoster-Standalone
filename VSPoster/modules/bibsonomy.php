<?php

function bibsonomybookmark($title,$link,$text,$tags,$cookiefile,$bibsonomyusername,$bibsonomypassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Bibsonomy times
$bibsonomytime = $xml->settings->bibsonomytime;
$referer = $xml->settings->referer;
$link = urlencode($link);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.bibsonomy.org/");
curl_setopt($ch, CURLOPT_TIMEOUT, $bibsonomytime);
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

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.bibsonomy.org/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $bibsonomytime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$bibsonomyusername&password=$bibsonomypassword&referer=http%3A%2F%2Fwww.bibsonomy.org%2F");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If wrong username or password
if($output){
preg_match('#<div class="error">([^"]+)\s* do not match or the username is not registered.</div>#si', $output, $user);
$fail = $user[1];
}
if($fail == "The password and username you entered"){
echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.bibsonomy.org/post_bookmark");
curl_setopt($ch, CURLOPT_TIMEOUT, $bibsonomytime);
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
    echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.bibsonomy.org/postBookmark");
curl_setopt($ch, CURLOPT_TIMEOUT, $bibsonomytime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$link&submit=check");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
// If invalid url
if($output){
preg_match('#<span id="([^"]+)\s*url.errors">#si', $output, $lin);
$fail = $lin[1];
}
if($fail == "post.resource."){
echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'> you have entered invalid or already posted url.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
if($output){
preg_match('/<input value="([^"]+)" name="ckey" type="hidden"[^>]/', $output, $randk);
preg_match('/<input value="([^"]+)" name="postID" type="hidden"[^>]/', $output, $randid);
preg_match('/<input id="intraHashToUpdate" name="intraHashToUpdate" type="hidden" value="([^"]+)"[^>]/', $output, $intrahash);
$ckey = $randk[1];
$id = $randid[1];
$intra = $intrahash[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.bibsonomy.org/postBookmark");
curl_setopt($ch, CURLOPT_TIMEOUT, $bibsonomytime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "post.resource.url=$link&post.resource.title=$title&post.description=$text&tags=$tags&abstractGrouping=public&postID=$id&ckey=$ckey&jump=false&intraHashToUpdate=$intra&selection=+&requTask=upload");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If success
if($output){
preg_match('#<a rel="nofollow" href="([^"]+)">'.$title.'#si', $output, $lin);
$fail = $lin[1];
}
if($fail = $link){
echo "<span class='reptext'>Bibsonomy:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bibsonomy:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bibsonomy error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>