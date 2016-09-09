<?php

function joontzbookmark($title,$link,$text,$tags,$cookiefile,$joontzusername,$joontzpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Joontz times
$joontztime = $xml->settings->joontztime;
$referer = $xml->settings->referer;

$link = urlencode($link);
$summary = substr($text, 0, 139);
$text = substr($text, 0, 499);
$tags = substr($text, 0, 40);
$tags = str_replace(" ",",",$tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.joontz.com/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $joontztime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $referer); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$joontzusername&password=$joontzpassword&processlogin=1&return=%2Fsubmit");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"Incorrect Username or Password")) {
echo "<span class='reptext'>Joontz:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Joontz:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Joontz error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<input type="hidden" name="randkey" value="([^"]+)">#si', $output, $key);
$key = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.joontz.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $joontztime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$link&phase=1&randkey=$key&id=c_1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If no url
if(strstr($output,"URL is invalid or blocked")) {
echo "<span class='reptext'>Joontz:</span> <span class='badtext'> you have entered invalid or blocked url.</span><br />";
return false;
}

//If duplicate
if(strstr($output,"Duplicate article URL")) {
echo "<span class='reptext'>Joontz:</span> <span class='badtext'> this url is already posted.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Joontz:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Joontz error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<input type="hidden" name="id" value="([^"]+)" [^>]/', $output, $id);
$id = $id[1];
$key = $key[1];
}

$postdata = array('title' => $title, 'category' => '20', 'tags' => $tags, 'bodytext' => $text, 'trackback' => '', 'url' => $link, 'phase' => '2', 'randkey' => $key, 'id' => $id);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.joontz.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $joontztime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If no title or text
if(strstr($output,"Incomplete title or text")) {
echo "<span class='reptext'>Joontz:</span> <span class='badtext'> incomplete title or text.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Joontz:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Joontz error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<input type="hidden" name="id" value="([^"]+)" [^>]/', $output, $id);
$id = $id[1];
$key = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.joontz.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $joontztime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "phase=3&randkey=$key&id=$id&trackback=");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//If success
if($status == 302){
echo "<span class='reptext'>Joontz:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Joontz:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Joontz error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
echo $output;
curl_close($ch);
}

?>