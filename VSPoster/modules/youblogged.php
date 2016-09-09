<?php

function youbloggedbookmark($title,$link,$text,$cookiefile,$youbloggedusername,$youbloggedpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Youblogged times
$youbloggedtime = $xml->settings->youbloggedtime;

$title = substr($title, 0, 79);
$text = substr($text, 0, 499);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://youblogged.com/user");
curl_setopt($ch, CURLOPT_TIMEOUT, $youbloggedtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://youblogged.com/"); 
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
    echo "<span class='reptext'>Youblogged:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Youblogged error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="form_build_id" id="([^"]+)"/', $output, $key);
$key = $key[1];
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://youblogged.com/user");
curl_setopt($ch, CURLOPT_TIMEOUT, $youbloggedtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "name=$youbloggedusername&pass=$youbloggedpassword&form_build_id=$key&form_id=user_login&op=Log+in");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strpos($output,"Sorry, unrecognized username or password.")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Youblogged:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Youblogged error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://youblogged.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $youbloggedtime);
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
    echo "<span class='reptext'>Youblogged:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Youblogged error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="form_build_id" id="([^"]+)"/', $output, $id);
preg_match('/<input type="hidden" name="form_token" id="edit-drigg-node-form-form-token" value="([^"]+)" [^>]/', $output, $tok);
preg_match('/<input type="hidden" name="form_id" id="edit-drigg-node-form" value="([^"]+)" [^>]/', $output, $formid);
$id = $id[1];
$token = $tok[1];
$formid = $formid[1];
}

$postdata = array('submit_as' => '-1', 'url' => $link, 'title' => $title, 'body' => $text, 'changed' => '',  'form_build_id' => $id,  'form_token' => $token, 'form_id' => $formid, 'op' => 'save');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://youblogged.com/submit");
curl_setopt($ch, CURLOPT_TIMEOUT, $youbloggedtime);
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

//If not valid url
if(strpos($output,"The URL is not valid")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> you have entered invalid or blocked url.</span><br />";
return false;
}

//If description too short
if(strpos($output,"The description is too short!")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> description is too short.</span><br />";
return false;
}

//If no title
if(strpos($output,"title field is required.")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> title field is required.</span><br />";
return false;
}

//If no url
if(strpos($output,"URL field is required.")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> URL is required field.</span><br />";
return false;
}

//If duplicated
if(strpos($output,"The URL has already been submitted!")) {
echo "<span class='reptext'>Youblogged:</span> <span class='badtext'> this url is already posted.</span><br />";
return false;
}

// If success
if (strpos($output, $title)) {
    echo "<span class='reptext'>Youblogged:</span> <span class='goodtext'> success.</span><br />";
	return false;	
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Youblogged:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Youblogged error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>