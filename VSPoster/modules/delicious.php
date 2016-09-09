<?php

function deliciousbookmark($title,$link,$text,$tags,$cookiefile,$delicioususername,$deliciouspassword){

// Lets get timeout value
$xml = simplexml_load_file(dirname (__FILE__).'/../db/settings.xml');
// Get Delicious times
$delicioustime = $xml->settings->delicioustime;
$referer = $xml->settings->referer;

$link = urlencode($link);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure.delicious.com/login?jump=ub");
curl_setopt($ch, CURLOPT_TIMEOUT, $delicioustime);
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
    echo "<span class='reptext'>Delicious:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Delicious error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}
if($output){
preg_match('#<a href="([^"]+)">\s*Sign In with your Yahoo! ID</a>#si', $output, $lo);
$loginurl = $lo[1];
}

curl_setopt($ch, CURLOPT_URL, $loginurl);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_TIMEOUT, $delicioustime);
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
    echo "<span class='reptext'>Delicious:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Delicious error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input type="hidden" name=".challenge" value="([^"]+)"[>]/', $output, $cha);
preg_match('/<input type="hidden" name=".u" value="([^"]+)"[>]/', $output, $uk);
preg_match('/<input type="hidden" name=".pd" value="([^"]+)"[>]/', $output, $p);
$ch = urlencode($cha[1]);
$u = urlencode($uk[1]);
$pd = urlencode($p[1]);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://login.yahoo.com/config/login?");
curl_setopt($ch, CURLOPT_TIMEOUT, $delicioustime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_REFERER, $loginurl); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ".tries=1&.src=delic&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=&.partner=&.u=$u&.v=0&.challenge=$ch&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=0&.chkP=Y&.done=https%3A%2F%2Flogin.yahoo.com%2Fconfig%2Fvalidate%3F.pc%3D3478%26.pd%3Dc%253D7E2m_2ap2e5vmGcz4d5s2Y0-%26.src%3Ddelic%26.intl%3Dus%26.done%3Dhttps%253A%252F%252Fsecure.delicious.com%252Fylogin%253Fjump%253Dub&.pd=$pd&login=$delicioususername&passwd=$deliciouspassword&.save=Sign+In");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If wrong username or password
if($output){
preg_match('#<strong><strong>([^"]+)\s* yet taken.</strong>#si', $output, $randk);
$fail = $randk[1];
}
if($fail == "This ID is not"){
echo "<span class='reptext'>Delicious:</span> <span class='badtext'> invalid username or password.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Delicious:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Delicious error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('#<a href="([^"]+)" id="saveBookmark">\s*Save a new bookmark</a>#si', $output, $sa);
$saveurl = $sa[1];
}

curl_setopt($ch, CURLOPT_URL, "http://delicious.com/$saveurl");
curl_setopt($ch, CURLOPT_TIMEOUT, $delicioustime);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "noui=no&key=$key&url=$link&step=1&oldurl=new&next=next");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Delicious:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Delicious error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

if($output){
preg_match('/<input name="key" id="key" class="hidden" type="hidden" value="([^"]+)"[>]/', $output, $randk);
preg_match('/<input name="hash" id="hash" class="hidden" type="hidden" value="([^"]+)"[>]/', $output, $randh);
$key1 = $randk[1];
$hash = $randh[1];
}

curl_setopt($ch, CURLOPT_URL, "http://delicious.com/save");
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 GTB6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_TIMEOUT, $delicioustime);
curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiefile);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiefile);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "noui=no&key=$key1&url=$link&jump=&hash=$hash&oldurl=new&title=$title&notes=$text&tags=$tags&send=&newSend=&message=&submit=submit");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

// If success
if($output){
preg_match('#<a rel="nofollow" class="taggedlink " href="([^"]+)" >'.$title.'</a>#si', $output, $lin);
$fail = $lin[1];
}
if($fail = $link){
echo "<span class='reptext'>Delicious:</span> <span class='goodtext'> success.</span><br />";
return false;
}

//If curl error
if(curl_error($ch))
{
    echo "<span class='reptext'>Delicious:</span> <span class='badtext'>" .curl_error($ch).".</span><br />";
	error_log(date('Y M D h:s:m '). ":  Delicious error:  "  .curl_error($ch)."\n", 3, dirname (__FILE__).'/../errors');
	return false;
}

curl_close($ch);
}

?>