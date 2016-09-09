<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<meta content="index,follow" name="robots" />
<meta content="all" name="audience" />
<meta name="description" content="VSPoster is new revolutional standalone social bookmarking tool." />
<meta name="keywords" content="bookmark, bookmarking, social bookmarking, social bookmarks, standalone" />
<meta name="copyright" content="seomonsters.net" />
<meta name="publisher" content="seomonsters.net" />
<link rel="icon" type="image/png" href="../images/favicon.ico" />

<!--
#########################################################################

- VSPoster standalone                              
- Author: Varun Sharma                        		      
- Version: 1.1                     				      
- License: For personal use only not allowed to sell or offer as service!               				      

#########################################################################
 -->

<title>VSPoster standalone</title>

<link rel="stylesheet" type="text/css" href="../screen.css" />

</head>
<body>

<?php

    echo "<div id='container'>";
	echo "<div class='cont' style='margin-bottom:0px;'>";
	echo '<div class="accback"><a href="bmp.php"><img src="../images/back.png" alt="back" /></a></div>';
	echo '<form method="post" action="delete.php">';
    echo '<input type="submit" name="delete" class="delete" value="" />';
    echo '</form>';
	echo "</div>";
	echo "<div class='cont'>";
	
if (file_exists('../errors')) {
$log = explode("\n", file_get_contents('../errors'));
$log = implode("<br />", $log);
echo $log;
}
else{
echo '<center style="font-weight:bold; color:#0088ee">Everything is cool no errors available.</center><br />';
}
    echo "</div>";
    echo "</div>";

?>
	
</body>
</html>