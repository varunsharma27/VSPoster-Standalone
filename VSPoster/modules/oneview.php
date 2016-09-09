<?php

function oneviewbookmark($title,$link,$text,$tags,$cookiefile,$oneviewusername,$oneviewpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Oneview times
$oneviewtime = $xml->settings->oneviewtime;

$title = substr($title, 0, 150);
$text = substr($text, 0, 499);
$tags = substr($tags, 0, 150);
$tags = str_replace(" ",",",$tags);

$link = urlencode($link);
$title = urlencode($title);
$text =  urlencode($text);
$tags = urlencode($tags);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.oneview.de/login/");
curl_setopt($ch, CURLOPT_TIMEOUT, $oneviewtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, "http://www.oneview.de/"); 
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
    echo "<span class='reptext'>Oneview:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Oneview error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="javax.faces.ViewState" id="javax.faces.ViewState" value="([^"]+)" [^>]/', $output, $key);
$key = urlencode($key[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.oneview.de/login/");
curl_setopt($ch, CURLOPT_TIMEOUT, $oneviewtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "login_form%3Ausername=$oneviewusername&login_form%3Apassword=$oneviewpassword&login_form_SUBMIT=1&javax.faces.ViewState=$key&login_form%3A_idcl=login_form%3AloginButton");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If wrong username or password
if(strpos($output,"Die Kombination aus Benutzername und Kennwort ist leider nicht bekannt.")) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Oneview:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Oneview error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.oneview.de/myoneview/neu/url/");
curl_setopt($ch, CURLOPT_TIMEOUT, $oneviewtime);
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
    echo "<span class='reptext'>Oneview:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Oneview error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name="javax.faces.ViewState" id="javax.faces.ViewState" value="([^"]+)" [^>]/', $output, $key);
preg_match('/<span class="submitbtnbg right"><a href="#" onclick="return oamSubmitForm\(\'editlinkform\',\'editlinkform:([^"]+)\'/', $output, $key1);
$key = urlencode($key[1]);
$key1 = urlencode($key1[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://www.oneview.de/myoneview/neu/url/");
curl_setopt($ch, CURLOPT_TIMEOUT, $oneviewtime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "editlinkform%3Aurl=$link&editlinkform%3Atitle=$title&editlinkform%3Atags=$tags&editlinkform%3AtagsSuggestionbox_selection=&editlinkform%3Aattitude=POSITIVE&editlinkform%3Acomment=&editlinkform%3AurlCommentMonitor=true&editlinkform%3Adescription=$text&editlinkform%3Anotes=&editlinkform%3AmyRadios=4&editlinkform%3AcachePage=true&editlinkform%3Avisibility=1&editlinkform_SUBMIT=1&javax.faces.ViewState=$key&editlinkform%3A_idcl=editlinkform%3A$key1");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If is duplicated
if(strpos($output,"URL bereits vorhanden.")) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> this URL is already posted.</span><br />";
return false;
}

//If no url
if(strpos($output,'</p><input id="editlinkform:url" name="editlinkform:url" type="text" value="" class="txt" /><br /><span class="error">Eingabe erforderlich.</span>')) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> URL is required.</span><br />";
return false;
}

//If not valid url
if(strpos($output,"ist keine korrekte URL")) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> you have entered invalid or blocked url.</span><br />";
return false;
}

//If no title
if(strpos($output,'</p><input id="editlinkform:title" name="editlinkform:title" type="text" value="" class="txt" /><span class="error">Eingabe erforderlich.</span>')) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> title is required.</span><br />";
return false;
}

//If no tags
if(strpos($output,'<input type="hidden" autocomplete="off" id="editlinkform:tagsSuggestionbox_selection" name="editlinkform:tagsSuggestionbox_selection" /><span class="error">Eingabe erforderlich.</span>')) {
echo "<span class='reptext'>Oneview:</span> <span class='badtext'> tags are required.</span><br />";
return false;
}

// If success
if (strpos($output, $link)) {
    echo "<span class='reptext'>Oneview:</span> <span class='goodtext'> success.</span><br />";
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