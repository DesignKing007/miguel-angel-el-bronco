<?php require("pelogin.php"); ?>

<html></head></head><body>

<?php

if (!isset($_FILES['uploadfile']['tmp_name']) || $_FILES['uploadfile']['tmp_name'] == "") {
   echo "<br><br><p align=\"center\"><b>Not a valid PowerEffects file. Please try again.</b></p>";
   echo "<p align=\"center\"><a href=\"javascript:history.go(-1);\"><img src=\"img/back.gif\" border=\"0\" width=\"63\" height=\"21\"></a></p>";
   die();
}

$inFile = $_FILES['uploadfile']['tmp_name'];
$fhandle = fopen($inFile, 'r');
$startPos = 28;

$myData = fread($fhandle, filesize($inFile));
fclose($fhandle);

if (strpos($myData, "// PowerEffects Saved File") === false) {
   echo "<br><br><p align=\"center\"><b>Not a valid PowerEffects file. Please try again.</b></p>";
   echo "<p align=\"center\"><a href=\"javascript:history.go(-1);\"><img src=\"img/back.gif\" border=\"0\" width=\"63\" height=\"21\"></a></p>";
   die();
}
echo "<form name=\"frmImport\" action=\"main.php\" target=\"design\" method=\"post\">";

$breakout = 0;
do {
   $lineEnd = strpos($myData, chr(13) . chr(10), $startPos);
   if ($lineEnd === false || $startPos > strlen($myData)) {
      $breakout = 1;
   } else {
      $line = substr($myData, $startPos, $lineEnd - $startPos);
      $divider = strpos($line, ":");
      
      $key = substr($line, 0, $divider);
      $val = substr($line, $divider + 1);
      $startPos = $lineEnd + 2;
      
      $val = stripslashes($val);
      $val = str_replace(chr(34), '&#34;', $val);
      $val = str_replace(chr(39), '&#39;', $val);      
      
      echo "<input type=\"hidden\" name=\"$key\" value=\"$val\">";
   }
} while (breakout == 0 && $startPos < strlen($myData));
?>
</form>
<script language="Javascript">
<!--
document.frmImport.submit();
window.close();
</script>

</body>
</html>
