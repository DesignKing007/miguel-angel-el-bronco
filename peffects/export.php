<?php

require("pelogin.php");

$cr = chr(13) . chr(10);
$exportout = "// PowerEffects Saved File$cr";

foreach ($_POST as $key => $val) {
   $val = str_replace(chr(13), " ", $val);
   $val = str_replace(chr(10), " ", $val);
   $exportout .= "$key:$val$cr";
}
if (isset($_POST["id"])) $filename = $_POST["id"] . ".pef";
else $filename = "myEffect.pef"; 

$exportlen = strlen($exportout);

header("Cache-control: private");
header('Content-Description: File Transfer'); 
header('Content-Type: application/force-download'); 
header('Content-Length: ' . $exportlen); 
header('Content-Disposition: attachment; filename=' . $filename);

echo $exportout;

?>