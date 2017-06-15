<?php
header('Pragma: no-cache');
header('Cache-Control: no-cache'); 
header('Expires: -1');

require("config.php");

$peuserid = trim($_COOKIE[peuserid]);
$pepassword = trim($_COOKIE[pepassword]);

if ($peuserid != $userid || $pepassword != $password) {
   $peuserid = trim($_POST["myuserid"]);
   $pepassword = trim($_POST["mypassword"]);
}

if (($peuserid != $userid || $pepassword != $password) || ($password == "1234" && $pepassword == "1234"))  { 

   $html_output = <<<HTML
   <html><head>
<style>
body {
   background-color: black;
	text-align:center;
	font-family: Arial, Helvetica, sans-serif;
	font-size : 12pt;
   margin: 15px 0 15px 0;
	color: #000000;   
}

p {
	margin: 15px 0 15px 0;
	text-align: left;
	line-height: 14pt;
   text-indent: 0px;   
}
</style>

<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>   
   <title>PowerEffects v2</title>
   </head>
   <body>
<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">

<table width="100%" border=0 cellpadding=15 cellspacing=5><tr>
<td valign="top" align="center">
   <center><b>Please enter your user name and password to login</b><br><br>
HTML;
$html_output .= "<form action='" . $myself . "' method='POST'>";
$html_output .= <<<HTML
<table border="0">
<tr><td align="right">User Name:</td>
<td align="left"><input type='text' name='myuserid'></td></tr>
<tr><td align="right">Password:</td>
<td align="left"><input type='password' name='mypassword'></td></tr>
<tr><td align="center" colspan="2">&nbsp;<br><input type='submit' name='login' value='Login'></td></tr></table>
</form></center>
HTML;

if ($password == "1234" && $pepassword == "1234" && $peuserid == $userid) {
   $html_output .= "<center><br><br><b><font color=red size=+1>You must change the default password of '1234' before continuing.<br><br>Simply edit the config.php file, changing the password to something OTHER than 1234 and re-upload the file. Then try again.</font></b></center>";
} elseif ($peuserid != "" || $pepassword != "") {
   $html_output .= "<center><br><br><b><font color=red size=+1>The user name or password you entered is invalid.</font></b></center>";
}

$html_output .= <<<HTML
<br><p style="text-align: center; font-size: 10pt;">&copy; 2008 Street Muse Publishing. All Rights Reserved.<br>
<a href="http://www.power-effects.com" target="_pehome">Power-Effects.com</a></p>
</td></tr></table>
</td></tr></table>
<img src="img/pefooter.jpg" border="0" width="724" height=139">
</td></tr></table>

<MAP NAME="registermap">
<AREA
   HREF="http://www.power-effects.com/peregister/" target="_register" onmouseover="tooltip('Register PowerEffects For Free!','Discover The Untapped Secrets of PowerEffects','<br>Register your copy of PowerEffects for free to get tips, test results, techniques, tutorial videos, free updates for life, and more!<br><br>Simply click the \'Register Here\' link above to gain instant access.<br><br>&nbsp;&nbsp;&nbsp;&nbsp;<img src=\'img/PowerEffects_boxtiny.jpg\' border=1>');" onmouseout="exit();" 
   SHAPE=RECT COORDS="15,101,156,126">
</MAP>


</body>
</html>
HTML;
echo $html_output;
exit(1);
} else {
   setcookie("peuserid", $userid, time()+86400, "/");
   setcookie("pepassword", $password, time()+86400, "/");
}

?>