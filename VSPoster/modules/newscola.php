<?php

function newscolabookmark($title,$link,$text,$cookiefile,$newscolausername,$newscolapassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Newscola times
$newscolatime = $xml->settings->newscolatime;

$link = urlencode($link);
$text = substr($text, 0, 499);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.newscola.com/login.php?return=/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $newscolatime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.newscola.com/login.php?return=/submit"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$newscolausername&password=$newscolapassword&persistent=on&processlogin=1&return=%2Fsubmit");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strstr($output,"incorrect username or password")) {
echo "<span class='reptext'>Newscola:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Newscola:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Newscola error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)"[>]/', $output, $key);
$ckey = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.newscola.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $newscolatime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$link&phase=1&randkey=$ckey&id=c_1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If is duplicated
$someurl = strstr($output,"duplicate article URL");
if($someurl == true) {
echo "<span class='reptext'>Newscola:</span> <span class='badtext'> duplicate article URL.</span><br />";
return false;
}

//If no url
$someurl = strstr($output,"URL:");
if($someurl === false) {
echo "<span class='reptext'>Newscola:</span> <span class='badtext'> please insert valid url.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Newscola:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Newscola error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<input type="hidden" name="id" value="([^"]+)" [^>]/', $output, $ide);
$id = $ide[1];
$ckey = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.newscola.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $newscolatime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "phase=2&randkey=$ckey&id=$id&url=$url&title=$title&bodytext=$text&category=1&trackback=");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If success
if(strpos($output,$title)) {
echo "<span class='reptext'>Newscola:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Newscola:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Newscola error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>