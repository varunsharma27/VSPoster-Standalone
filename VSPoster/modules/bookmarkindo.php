<?php

function bookmarkindobookmark($title,$link,$text,$tags,$cookiefile,$bookmarkindousername,$bookmarkindopassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Bookmarkindo times
$bookmarkindotime = $xml->settings->bookmarkindotime;

$summary = $text;

$title = substr($title, 0, 115);
$text = substr($text, 0, 499);
$summary = substr($summary, 0, 145);
$tags = substr($tags, 0, 59);
$tags = str_replace(" ",",",$tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://bookmarkindo.com/login.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $bookmarkindotime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://bookmarkindo.com/login.php?return=/submit.php"); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$bookmarkindousername&password=$bookmarkindopassword&processlogin=1&return=%2Fsubmit.php");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strpos($output,"incorrect username or password")) {
echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bookmarkindo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)"[>]/', $output, $key);
$key = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://bookmarkindo.com/submit.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $bookmarkindotime);
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

//If duplicated
if(strpos($output,"Duplicate article URL")) {
echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'> this url is already posted.</span><br />";
return false;
}

//If no url
if(strpos($output,"URL is invalid or blocked")) {
echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'> you have entered invalid or blocked url.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bookmarkindo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<input type="hidden" name="id" value="([^"]+)" [^>]/', $output, $id);
$id = $id[1];
$key = $key[1];
}

$postdata = array('title' => $title, '' => $tags, 'bodytext' => $text, 'summarycheckbox' => 'on', 'summarytext' => $summary,  'remLen' => '125',  'category' => '1', 'trackback' => '', 'url' => $link, 'phase' => '2', 'randkey' => $key, 'id' => $id);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://bookmarkindo.com/submit.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $bookmarkindotime);
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
if(strpos($output,"Incomplete title or text")) {
echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'> incomplete title or text.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bookmarkindo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="randkey" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<input type="hidden" name="id" value="([^"]+)" [^>]/', $output, $id);
$id = $id[1];
$key = $key[1];
}

curl_setopt($ch, CURLOPT_URL, "http://bookmarkindo.com/submit.php");
curl_setopt($ch, CURLOPT_TIMEOUT, $bookmarkindotime);
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

// If success
if (strpos($output, $title)) {
    echo "<span class='reptext'>Bookmarkindo:</span> <span class='goodtext'> success.</span><br />";
	return false;	
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Bookmarkindo:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Bookmarkindo error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>