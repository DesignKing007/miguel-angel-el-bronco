<?php

require("pelogin.php");

$filename = "$_POST[id].js";

// Generate Javascript
$js = <<<HTML
animInit_{{id}} = "{{init}}";
animControlName_{{id}} = "{{id}}";
animCurrentFrame_{{id}} = 0;
animMaxNumFrames_{{id}} = {{maxframes}};
var animFrameDelay_{{id}} = new Array(0, {{framedelay_N}});
animFadeDelay_{{id}} = .5; 
var animEffect1_{{id}} = new Array('Fade',   {{effect1_S}});
var animEffect2_{{id}} = new Array('Appear', {{effect2_S}});
var animContent_{{id}} = new Array('',
   {{content_SB}});

animIE_{{id}} = (Prototype.Browser.IE);
animLoop_{{id}} = {{loop_TF}};
   
document.write ('<div style="text-align: {{align}}; {{width}} {{height}} {{grow}}"><span id="{{id}}" ');
if (animInit_{{id}} != "")
   document.write (animInit_{{id}} + '="animCurrentFrame_{{id}}=1; selectAnim_{{id}}();">' + animContent_{{id}}[1]);
else
	document.write ('>');
document.write ('</span></div>');

if (animInit_{{id}} == "")
   selectAnim_{{id}}();   
   
function selectAnim_{{id}}() {
   if (animCurrentFrame_{{id}} < animMaxNumFrames_{{id}} || animLoop_{{id}}) {
      var sEffect = animEffect1_{{id}}[animCurrentFrame_{{id}}];
      if (animIE_{{id}} && sEffect == "Shrink") sEffect = "Fade";  // IE doesn't like "Shrink"
      if (sEffect != "None")
   	   var myresult = eval('new Effect.' + sEffect + '(animControlName_{{id}}, {duration:animFadeDelay_{{id}}});');
      animCurrentFrame_{{id}} += 1;
      if (animCurrentFrame_{{id}} > animMaxNumFrames_{{id}}) animCurrentFrame_{{id}} = 1;
      window.setTimeout('changeAnim_{{id}}()',animFadeDelay_{{id}} * 1000);
   }
}

function changeAnim_{{id}}() {
   document.getElementById(animControlName_{{id}}).innerHTML = animContent_{{id}}[animCurrentFrame_{{id}}];
   var sEffect = animEffect2_{{id}}[animCurrentFrame_{{id}}];
   if (sEffect != "None")
	   var myresult = eval('new Effect.' + sEffect + '(animControlName_{{id}}, {duration:animFadeDelay_{{id}}});');
   window.setTimeout('selectAnim_{{id}}()',animFrameDelay_{{id}}[animCurrentFrame_{{id}}]);
}

HTML;

foreach ($_POST as $key => $val) {
  $val = stripslashes($val);
  if ($key == "width")
     $val = "width: " . $val . "px;";
  if ($key == "height")
     $val = "height: " . $val . "px;";     
  $prefix = substr($key, 0, 2);
  if ($prefix != "N_" && $prefix != "S_" && substr($key, 0, 3) != "SB_") //Regular search and replace
     $js = str_replace('{{' . $key . '}}', $val, $js);
  if (substr($key, 0, 13) == "N_framedelay_") {
     $framedelay[substr($key, 13)] = $val;  // Save frame delays for later
  }
  if (substr($key, 0, 10) == "S_effect1_") {
     $effect1[substr($key, 10)] = $val;  // Save effect1's for later
  }
  if (substr($key, 0, 10) == "S_effect2_") {
     $effect2[substr($key, 10)] = $val;  // Save effect2's for later
  }
  if (substr($key, 0, 11) == "SB_content_") {
     $content[substr($key, 11)] = str_replace('\'', chr(92) . '\'', $val);  // Save contents for later
  }  
}

// Sort arrays numerically by keys
ksort($framedelay, SORT_NUMERIC);
ksort($effect1, SORT_NUMERIC);
ksort($effect2, SORT_NUMERIC);
ksort($content, SORT_NUMERIC);

$framedelays = "";
foreach ($framedelay as $val) {
   $val *= 1000;
   $framedelays .= $val . ", ";
}
$framedelays = substr($framedelays, 0, strlen($framedelays) - 2);
$js = str_replace('{{framedelay_N}}', $framedelays, $js);

$effect1s = "";
foreach ($effect1 as $val)
   $effect1s .= '\'' . $val . '\', ';
$effect1s = substr($effect1s, 0, strlen($effect1s) - 2);
$js = str_replace('{{effect1_S}}', $effect1s, $js);

$effect2s = "";
foreach ($effect2 as $val)
   $effect2s .= '\'' . $val . '\', ';
$effect2s = substr($effect2s, 0, strlen($effect2s) - 2);
$js = str_replace('{{effect2_S}}', $effect2s, $js);

$contents = "";
foreach ($content as $val) {
   $val = str_replace(chr(13), " ", $val);
   $val = str_replace(chr(10), " ", $val);
   
   // Convert "old" HTML to spans
   $val = str_replace("<font", "<span", $val);
   $val = str_replace("</font>", "</span>", $val);
   $val = str_replace("size=\"1\"", "style=\"font-size: 8pt;\"", $val);
   $val = str_replace("size=\"2\"", "style=\"font-size: 10pt;\"", $val);
   $val = str_replace("size=\"3\"", "style=\"font-size: 12pt;\"", $val);
   $val = str_replace("size=\"4\"", "style=\"font-size: 14pt;\"", $val);
   $val = str_replace("size=\"5\"", "style=\"font-size: 18pt;\"", $val);
   $val = str_replace("size=\"6\"", "style=\"font-size: 24pt;\"", $val);
   $val = str_replace("size=\"7\"", "style=\"font-size: 38pt;\"", $val);
   $val = str_replace("\" style=\"", " ", $val);
   $val = str_replace("<p>", "", $val);
   $val = str_replace("</p>", "<br><br>", $val);
   $val = str_replace("<b>", "<span style=\"font-weight: bold;\">", $val);
   $val = str_replace("</b>", "</span>", $val);                   
   $val = str_replace("<strong>", "<span style=\"font-weight: bold;\">", $val);
   $val = str_replace("</strong>", "</span>", $val);
   $val = str_replace("<i>", "<span style=\"font-style: italic;\">", $val);
   $val = str_replace("</i>", "</span>", $val);
   $val = str_replace("<em>", "<span style=\"font-style: italic;\">", $val);
   $val = str_replace("</em>", "</span>", $val);
   $val = str_replace("<u>", "<span style=\"text-decoration: underline;\">", $val);
   $val = str_replace("</u>", "</span>", $val);
   $val = str_replace(" align=\"center\"", "", $val);
   $val = str_replace(" align=\"right\"", "", $val);
   $val = str_replace(" align=\"left\"", "", $val);
   $val = str_replace("<html>", "", $val);
   $val = str_replace("</html>", "", $val);
   $val = str_replace("<head>", "", $val);
   $val = str_replace("</head>", "", $val);
   $val = str_replace("<body>", "", $val);
   $val = str_replace("/<body>", "", $val);
   $val = str_replace("<title>", "", $val);
   $val = str_replace("</title>", "", $val);                                                
   // end code cleaning   
   
   $contents .= '\'' . trim($val) . '\',' . "\n";
}
$contents = substr($contents, 0, strlen($contents) - 2);
$js = str_replace('{{content_SB}}', $contents, $js);

$jslen = strlen($js);

header("Cache-control: private");
header('Content-Description: File Transfer'); 
header('Content-Type: application/force-download'); 
header('Content-Length: ' . $jslen); 
header('Content-Disposition: attachment; filename=' . $filename);

echo $js;
?>
