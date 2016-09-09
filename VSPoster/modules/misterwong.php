<?php

function misterbookmark($title,$link,$text,$tags,$cookiefile,$misterusername,$misterpassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Mister-Wong times
$mistertime = $xml->settings->mistertime;

$text = substr($text, 0, 199);
$title = substr($title, 0, 99);
$tags = substr($tags, 0, 99);

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "http://www.mister-wong.com/login");
curl_setopt($ch, CURLOPT_TIMEOUT, $mistertime);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
curl_setopt($ch, CURLOPT_REFERER, "http://www.mister-wong.com/users/login/"); 
curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "_method=POST&data%5BUser%5D%5Bname%5D=$misterusername&data%5BUser%5D%5Bpassword%5D=$misterpassword");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If wrong username or password
if(strstr($output,"The password entered is not correct.")) {
echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Mister-Wong error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "http://www.mister-wong.com/add_url/");
curl_setopt($ch, CURLOPT_TIMEOUT, $mistertime);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Mister-Wong error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, "http://www.mister-wong.com/add_url/");
curl_setopt($ch, CURLOPT_TIMEOUT, $mistertime);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "_method=POST&data[Bookmark][return]=http://www.mister-wong.com/user/&data[Bookmark][url]=$link&data[Bookmark][title]=$title&data[Bookmark][comment]=$text&data[Bookmark][tags]=$tags&data[Bookmark][status]=public&data[Twitter][username]=Username&data[Twitter][password2]=Password&data[Twitter][password]=&data[Twitter][save_data]=yes&data[Twitter][message]=");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec ($ch);

//If success
if(strstr($output,"The URL was successfully saved.")) {
echo "<span class='reptext'>Mister-Wong:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If duplicated
if(strstr($output,"You already saved this website on")) {
echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'> you already saved this website.</span><br />";
return false;
}

//If invalid url
if(strstr($output,"The URL is invalid.")) {
echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'> please insert valid url.</span><br />";
return false;
}

//If invalid title
if(strstr($output,"The title is too short. Please enter more than 2 characters.")) {
echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'> please insert title.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Mister-Wong:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Mister-Wong error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>