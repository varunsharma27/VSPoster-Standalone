<?php

// Lets delete errors file
 unlink("../errors");

 //lets get back to the page we were
echo '
<html>
<head>
<script language="JavaScript">
function goback()
{
 document.location.href="clear.php";
}
</script>
</head>
<body onload="goback()">
</body>
</html>';

?>