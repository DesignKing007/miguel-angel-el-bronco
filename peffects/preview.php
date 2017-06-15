<?php require("pelogin.php"); ?>

<html>
<head>
<title>PowerEffects Designer v2 - Preview</title>
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
<script src="prototype.js" type="text/javascript"></script>
<script src="scriptaculous.js?load=effects" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>

</head>
<body>
<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">

<table width="100%" border=0 cellpadding=15 cellspacing=5><tr>
<td valign="top" align="center">
<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">PowerEffects Preview</p>
<hr width="300" color="midnightblue">

<script language="Javascript">
<!--

<?php

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

echo $js;
?>
//-->

</script>

<hr width="300" color="midnightblue">

<?php
echo "<form name=\"download\" action=\"";
echo "download.php\"";
echo " method=\"post\">";
foreach ($_POST as $key => $val) {
  $val = stripslashes($val);
  $val = str_replace(chr(34), '&#34;', $val);
  $val = str_replace(chr(39), '&#39;', $val);
  echo "<input type=\"hidden\" name=\"$key\" value=\"$val\">\n";
}
echo "</form>\n\n";

?>

<p>If you want to go back and make modifications, simply <a href="#" onclick="window.close();">close this window</a> to return to the Power Effects Designer.</p>

<p><b>If you're ready to paste the code into your web page, simply follow these steps:</b></p>

<p><b>Step 1:</b> First, you'll need to add the following code between the <b>&lt;HEAD&gt;</b> and <b>&lt;/HEAD&gt;</b> section of your HTML. Simply click in the text box below to select all
the code, then right-click, select "Copy", then paste it just before the <b>&lt;/HEAD&gt;</b> tag in your web page:</p>

<textarea id="includes" name="includes" rows=3 cols=80 onclick="this.focus(); this.select();">
&lt;script src="prototype.js" type="text/javascript"&gt;&lt;/script&gt;
&lt;script src="scriptaculous.js?load=effects" type="text/javascript"&gt;&lt;/script&gt;
</textarea>

<p><b>Step 2:</b> You'll need to download the code to generate your animation and save it to the same folder on your web server where your web page is stored. 
<b><a href="#" onclick="document.download.submit();">Click Here</a></b> to download the required code and save it with the default name
of<b>
<?php echo "$_POST[id].js"; ?></b></p>

<p><b>Step 3:</b> You'll need to paste the code below wherever you want your animation to appear on your website. Like Step 1 above, simply copy and paste the code,
only this time you'll paste it where you want your effect to show, somewhere inside your web page's body:</p>

<textarea id="code" name="code" rows=2 cols=75 onclick="this.focus(); this.select();">
&lt;script src="<?php echo "$_POST[id].js"; ?>" type="text/javascript"&gt;&lt;/script&gt;
</textarea>

<p><b>Step 4:</b> Final step! You need to upload the following files that came with this package and put them in the same folder
as your web page:</p>

<p>prototype.js<br>
scriptaculous.js<br>
effects.js<br>
<?php echo "$_POST[id].js"; ?> (this is the one you downloaded in Step 2 above)</p>

<p><b>That's it!</b> Now it's on to the next animation!</p>

<p>Remember, the beauty of this tool is not simply the animations themselves, but how you use them. Combine images and text and more to create
something new and different that'll set YOUR site out from the pack!</p>

<p>Good luck and enjoy!</p>

<p>If you run into any problems, simply open up a support ticket <a href="http://www.copywriters-toolkit.com/support" target="_support">here</a>. Be sure to state in the
ticket that you're inquiring about the Power Effects tool, and that it's version 2.</p>

<p><b>Thank you!</b></p><br>

<p style="text-align: center; font-size: 10pt;">&copy; 2008 Street Muse Publishing. All Rights Reserved.<br>
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

