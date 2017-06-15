<?php

require("pelogin.php");

$currentframe = $_GET["currentframe"];
$nextframe = $currentframe + 1;
$previousframe = $currentframe - 1;

$maxframes = 1;
if (isset($_POST["maxframes"]))
   $maxframes = $_POST["maxframes"];
if ((int)$currentframe > (int)$maxframes)
   $maxframes =  $currentframe;

$deletedframe = $maxframes + 1;
   
$effect1 = "";
if (isset($_POST["S_effect1_" . $currentframe]))
   $effect1 = $_POST["S_effect1_" . $currentframe];

$effect2 = "";
if (isset($_POST["S_effect2_" . $currentframe]))
   $effect2 = $_POST["S_effect2_" . $currentframe];   
if (isset($_POST["height"]))
   $height = $_POST["height"];
else
   $height="500"; 

if (isset($_POST["align"]))
   $align = $_POST["align"];
else
   $align="center";     
?>

<html>
<head>
<title>PowerEffects Designer v2</title>
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
.invis {
   position: absolute;
   visibility: hidden;
   width: 1px;
   height: 1px;
   clip: auto;
   overflow: hidden;
}
</style>
<script language="Javascript">
   var phpPEalign = "<?php echo $align; ?>";
</script>
<script src="prototype.js" type="text/javascript"></script>
<script src="scriptaculous.js?load=effects" type="text/javascript"></script>
<script type="text/javascript" src="nicEdit.js"></script>

<script language="Javascript">
<!--
window.name = "design";

var myNicEditor, bEditor;

bEditor = true;

function addArea() {
   if (!bEditor) {
      myNicEditor = new nicEditor({buttonList : ['bold','italic','underline','strikethrough','fontFamily','fontSize','forecolor','image','link','unlink']}).panelInstance('content');
      bEditor = true;
   }
}
function removeArea() {
   if (bEditor) {
      myNicEditor.removeInstance('content');
      bEditor = false;
   }
}   

bkLib.onDomLoaded(function() {
   myNicEditor = new nicEditor({buttonList : ['bold','italic','underline','strikethrough','fontFamily','fontSize','forecolor','image','link','unlink']}).panelInstance('content');
});

function importPop() {
   importwin = window.open ("getfile.html", "importwin","location=1,status=1,scrollbars=1, width=400,height=200");
}

function cleancss(inContent) {
   var outContent = inContent.replace(/<font/g, "<span");
   outContent = outContent.replace(/<\/font>/g, "<\/span>");
   outContent = outContent.replace(/size="1"/g, 'style="font-size: 8pt;"');
   outContent = outContent.replace(/size="2"/g, 'style="font-size: 10pt;"');
   outContent = outContent.replace(/size="3"/g, 'style="font-size: 12pt;"');
   outContent = outContent.replace(/size="4"/g, 'style="font-size: 14pt;"');
   outContent = outContent.replace(/size="5"/g, 'style="font-size: 18pt;"');
   outContent = outContent.replace(/size="6"/g, 'style="font-size: 24pt;"');
   outContent = outContent.replace(/size="7"/g, 'style="font-size: 38pt;"');
   outContent = outContent.replace(/" style="/g, ' ');
   outContent = outContent.replace(/<p>/g, '');
   outContent = outContent.replace(/<\/p>/g, '<br><br>');
   outContent = outContent.replace(/<b>/g, '<span style="font-weight: bold;">');
   outContent = outContent.replace(/<\/b>/g, '<\/span>');
   outContent = outContent.replace(/<strong>/g, '<span style="font-weight: bold;">');
   outContent = outContent.replace(/<\/strong>/g, '<\/span>');
   outContent = outContent.replace(/<i>/g, '<span style="font-style: italic;">');
   outContent = outContent.replace(/<\/i>/g, '<\/span>');
   outContent = outContent.replace(/<em>/g, '<span style="font-style: italic;">');
   outContent = outContent.replace(/<\/em>/g, '<\/span>'); 
   outContent = outContent.replace(/<u>/g, '<span style="text-decoration: underline;">');
   outContent = outContent.replace(/<\/u>/g, '<\/span>');
   outContent = outContent.replace(/ align="center"/g, '');
   outContent = outContent.replace(/ align="right"/g, '');
   outContent = outContent.replace(/ align="left"/g, '');
   outContent = outContent.replace(/<html>/g, '');
   outContent = outContent.replace(/<\/html>/g, '');
   outContent = outContent.replace(/<head>/g, '');
   outContent = outContent.replace(/<\/head>/g, ''); 
   outContent = outContent.replace(/<body>/g, '');
   outContent = outContent.replace(/<\/body>/g, '');
   outContent = outContent.replace(/<title>/g, '');
   outContent = outContent.replace(/<\/title>/g, '');                
   return outContent;
}

function cleanQuotes(inContent) {
   var outContent = inContent.replace(/"/g, '&#34;'); 
   outContent = outContent.replace(/'/g, "&#39;");
   return outContent;
}

function startOver() {
   if (confirm("Are you sure you want to start over? (All your existing settings will be erased)")) {
      window.location = "main.php";
   }   
}   
   
function insertFrame() {
   var decIndex;
<?php
   echo "   var curFrame = $currentframe;\n";
   $newmaxframes = $maxframes + 1;
   echo "   var newMaxFrames = $newmaxframes;\n";   
   echo "   var maxFrames = $maxframes;\n";
?>
   copySettings();
   document.getElementById('inserts').innerHTML = document.getElementById('inserts').innerHTML + '<input type="hidden" name="SB_content_' + newMaxFrames + '" value="' + cleanQuotes(document.getElementById('SB_content_' + maxFrames).value) + '">';
   document.getElementById('inserts').innerHTML = document.getElementById('inserts').innerHTML + '<input type="hidden" name="S_effect1_' + newMaxFrames + '" value="' + cleanQuotes(document.getElementById('S_effect1_' + maxFrames).value) + '">';
   document.getElementById('inserts').innerHTML = document.getElementById('inserts').innerHTML + '<input type="hidden" name="S_effect2_' + newMaxFrames + '" value="' + cleanQuotes(document.getElementById('S_effect2_' + maxFrames).value) + '">';
   document.getElementById('inserts').innerHTML = document.getElementById('inserts').innerHTML + '<input type="hidden" name="N_framedelay_' + newMaxFrames + '" value="' + cleanQuotes(document.getElementById('N_framedelay_' + maxFrames).value) + '">';
   for (var i=maxFrames; i>curFrame; i--) {
      decIndex = i - 1;
      document.getElementById('SB_content_' + i).value = document.getElementById('SB_content_' + decIndex).value;
      document.getElementById('S_effect1_' + i).value = document.getElementById('S_effect1_' + decIndex).value;
      document.getElementById('S_effect2_' + i).value = document.getElementById('S_effect2_' + decIndex).value;
      document.getElementById('N_framedelay_' + i).value = document.getElementById('N_framedelay_' + decIndex).value;           
   }
   document.getElementById('SB_content_' + curFrame).value = "Enter your content for this frame here...";
   document.getElementById('S_effect1_' + curFrame).value = "Fade";
   document.getElementById('S_effect2_' + curFrame).value = "Appear";
   document.getElementById('N_framedelay_' + curFrame).value = "3"; 
   document.settings.maxframes.value = newMaxFrames;
   document.settings.action = "design.php?currentframe=" + curFrame;
   // alert(document.settings.SB_content_1.value);
   // alert(document.getElementById('SB_content_1').value);
   document.settings.submit();
}

function deleteFrame () {
<?php
   echo "   var curFrame = $currentframe;\n";
   $newmaxframes = $maxframes - 1;
   echo "   var newMaxFrames = $newmaxframes;\n";   
   echo "   var maxFrames = $maxframes;\n";
?>
   var targetFrame = curFrame;
   if (confirm("Are you sure you want to delete this animation frame? (This action cannot be undone)")) {
      copySettings();
      if (curFrame == maxFrames ) {
         if (maxFrames == 1) {
            document.getElementById('SB_content_' + curFrame).value = "Enter your content for this frame here...";
            document.getElementById('S_effect1_' + curFrame).value = "Fade";
            document.getElementById('S_effect2_' + curFrame).value = "Appear";
            document.getElementById('N_framedelay_' + curFrame).value = "3"; 
            newMaxFrames = maxFrames;
         } else { targetFrame = newMaxFrames; } // if current frame = last frame, but there's more than one frame, we want to dec the current frame after this frame is deleted
      } else {
         for (var i=curFrame; i<maxFrames; i++) {
            incIndex = i + 1;
            document.getElementById('SB_content_' + i).value = document.getElementById('SB_content_' + incIndex).value;
            document.getElementById('S_effect1_' + i).value = document.getElementById('S_effect1_' + incIndex).value;
            document.getElementById('S_effect2_' + i).value = document.getElementById('S_effect2_' + incIndex).value;
            document.getElementById('N_framedelay_' + i).value = document.getElementById('N_framedelay_' + incIndex).value;         
         }
      }
      document.settings.maxframes.value = newMaxFrames;
      document.settings.action = "design.php?currentframe=" + targetFrame;
      document.settings.submit();        
   }
}

function copySettings() {
<?php
   echo "   if (bEditor) document.getElementById('content').value = myNicEditor.nicInstances[0].getContent();\n";
   echo "   document.settings.SB_content_$currentframe.value = document.getElementById('content').value;\n";
   echo "   document.settings.S_effect1_$currentframe.value = document.getElementById('effect1').options[document.getElementById('effect1').selectedIndex].value;\n"; 
   echo "   document.settings.S_effect2_$currentframe.value = document.getElementById('effect2').options[document.getElementById('effect2').selectedIndex].value;\n";
   echo "   document.settings.N_framedelay_$currentframe.value = document.getElementById('framedelay').value;\n";
   echo "   document.settings.maxframes.value = document.getElementById('maxframes').value;\n";
   echo "   document.settings.target = \"_top\";";   
   echo "   if (document.getElementById('helptips').checked) { document.getElementById('inserts').innerHTML = document.getElementById('inserts').innerHTML + \"<input type='hidden' name='helptips' value='true'>\"; }\n";
?>
}

function goPrevious() {

<?php
   echo "   copySettings();";
   echo "   document.settings.action=\"";
   if ($currentframe == 1)
      echo "main.php\";";
   else
      echo "design.php?currentframe=$previousframe\";";              
?>
   document.settings.submit();
}

function goPreview() {

<?php
   echo "   copySettings();";
   echo "   document.settings.action = \"preview.php\";";
   echo "   document.settings.target = \"_preview\";";     
?>
   document.settings.submit();
}

function goExport() {

<?php
   echo "   copySettings();";
   echo "   document.settings.action = \"export.php\";";    
?>
   document.settings.submit();
}

function jumpTo(nFrame) {
   if (nFrame == -1) return false;
<?php
   echo "   copySettings();";
   echo "   document.settings.maxframes.value = document.getElementById('maxframes').value;\n";               
?>
   if (nFrame == "0") {
      document.settings.action = "main.php";
   } else {
      document.settings.action = "design.php?currentframe=" + nFrame;
   }
   document.settings.submit();
}

function goForward() {

<?php
   echo "   copySettings();"; 
   echo "   document.settings.action = \"design.php?currentframe=$nextframe\";";           
?>
   document.settings.submit();
}

function preview_effect() {
   if (bEditor) document.getElementById('content').value = myNicEditor.nicInstances[0].getContent();
   document.getElementById('content').value = cleancss(document.getElementById('content').value);   
   document.getElementById('preview').innerHTML = document.getElementById('content').value;
   var sEffect1 = document.getElementById('effect1').options[document.getElementById('effect1').selectedIndex].value;
   var sEffect2 = document.getElementById('effect2').options[document.getElementById('effect2').selectedIndex].value;
   var framedelay = document.getElementById('framedelay').value * 1000;
   if (sEffect2 == "Appear")
      Element.hide('preview');
   var command1 = "new Effect." + sEffect2 + "(document.getElementById('preview'));";
   var timeoutFunc = "Effect." + sEffect1 + "('preview', {duration:.5})";
   var command2 = "window.setTimeout(timeoutFunc, framedelay);";
   var myresult = eval(command1 + " " + command2);
}

function trim(inString) {
	return inString.replace(/^\s+|\s+$/g,"");
}

function isNumeric(inString) {
   var numChars = "0123456789";
   var isNumber = true;
   var myChar;
 
   for (i = 0; i < inString.length && isNumber == true; i++) { 
      myChar = inString.charAt(i); 
      if (numChars.indexOf(myChar) == -1) { 
         isNumber = false;
         }
      }
   return isNumber;
}

function validate() {
   var strFrameDelay;
   document.getElementById('framedelay').value = trim(document.getElementById('framedelay').value);
   strFrameDelay = document.getElementById('framedelay').value;
   if (strFrameDelay == "") {
      alert("You must specify a delay (in number of seconds) for this frame.");
      return false;
   }   

   if (!isNumeric(strFrameDelay)) {
      alert("The duration of this frame must be numeric.");
      return false;
   }   
   return true;   
}

//-->
</script>

<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>

</head>
<body>
<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">

<form name="frmproperties">

<table width="100%" border=0 cellpadding=0 cellspacing=0><tr>
<td valign="top" align="center">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td align="left"><a href="index.php" onclick="return confirm('Return to the main menu? (Be sure to save or write down any settings first)');"><img src="img/home.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Home','<br>Return to the powerEffects Main Menu. Be sure to save any settings first!'); window.status=''; return true;" onmouseout="exit();"></a> 
<img src="img/beginning.gif" border="0" width="8" height="11"> <span onmouseover="tooltip('PowerEffects Help','Start Over','<br>Quit everything and start over from scratch, overwriting all settings defined so far.'); window.status=''; return true;" onmouseout="exit();"><a href="Javascript: startOver();"><font size=-1><b>Start Over</font></a></span></td>
<td align="right"><font size=-1><b><input type="checkbox" name="helptips" id="helptips" value="true" <?php if(isset($_POST['helptips'])) echo "checked"; ?>> Show Help Tips</b></font></td>
</tr></table>

<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">

<?php
echo "Frame $currentframe of $maxframes [$id]</p>";
echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\"><tr valign=\"top\"><td>";
echo "<textarea id=\"content\" name=\"content\" rows=15 cols=74>\n";

if (isset($_POST["SB_content_" . $currentframe])) {
   echo stripslashes(trim($_POST["SB_content_" . $currentframe])) . "\n";
   }
else {
   echo "Enter your content for this frame here...";
}

?>
</textarea></td>

<td align="center"><select name="jump" id="jump" onchange="if (validate()) jumpTo(document.getElementById('jump').options[document.getElementById('jump').selectedIndex].value);" style="width: 63px;" onmouseover="tooltip('PowerEffects Help','Go To Different Page','<br>You can jump directly to the main settings or a specific frame by selecting where you want to go here.');" onmouseout="exit();">

<?php
echo "<option value=\"-1\" selected>Go:</option>\n";
for ($i=0; $i<= $maxframes; $i++) {
   if ($i == 0)
      echo "<option value=\"0\">Main</option>\n";
   else
      echo "<option value=\"$i\">Frame $i</option>\n";
}
echo "</select>";
?>
<br><br><a href="#" onclick="if (validate()) insertFrame();"><img src="img/insert.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Insert Frame','<br>Inserts a new animation frame immediately before the current one.');" onmouseout="exit();"></a>
<br><br><a href="Javascript: deleteFrame();"><img src="img/delete.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Delete Frame','<br>Deletes the current animation frame.'); window.status=''; return true;" onmouseout="exit();"></a>
<br><br><br><a href="Javascript: goExport();"><img src="img/save.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Save','<br>Allows you to export all your settings for the entire animation and save it to your computer.'); window.status=''; return true;" onmouseout="exit();"></a>
<br><br><a href="Javascript: importPop();"><img src="img/load.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Load','<br>Allows you to load a previously saved animation from your computer, overwriting the current one.'); window.status=''; return true;" onmouseout="exit();"></a>

<br><br><br><br><a href="#" onclick="if (validate()) goPreview();"><img src="img/preview.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Preview All Frames and Get the Code','<br>Opens a new window showing you what the full animation sequence (as you\'ve defined it so far) will look like.<br><br>You\'ll also be able to get all the code to insert on your web page, plus instructions on where to insert the code.<br><br>Nothing is final at this point. You can always close that window and come back here to adjust your settings further.');" onmouseout="exit();"></a>



</td></tr></table>

</td></tr>
<tr><td align="left">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td align="left"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Editor Mode','<br>These buttons switch between normal editing and HTML source code.<br><br>You can edit the content in either mode, and your changes will take place immediately.');" onmouseout="exit();"> <input type="button" onClick="addArea();" value="Editor"><input type="button" onClick="removeArea();" value="Source Code"></td>

<td align="left" width="225"><a href="#prev" onclick="if (validate()) preview_effect();"><img src="img/preview_frame.gif" border="0" width="136" height="21" onmouseover="tooltip('PowerEffects Help','Preview This Frame','<br>This option allows you to preview below what this single frame will look like in your final animation sequence.<br><br>It takes into account your content, frame duration, and starting and ending effect for this frame ONLY.<br><br>It also uses the animation height and alignment you specified in the main settings, which apply to ALL animation frames.');" onmouseout="exit();"></a></td>
</tr></table>

</td></tr>

<tr><td valign="top">&nbsp;<br>
<table width="100%" border=0 cellpadding=5 cellspacing=0><tr>
<td valign="top" align="center"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Duration of Frame','<br>This applies to the duration of this frame, in seconds, between the time the start effect completes and the end effect begins.<br><br>In other words, this value specifies how long this single frame stays on the screen before moving to the next frame.');" onmouseout="exit();"> Duration of this frame:<br><br>
 
<?php 

echo "<input type=\"text\" id=\"framedelay\" name=\"framedelay\"";
if (isset($_POST["N_framedelay_" . $currentframe])) {
   echo " value=\"" . $_POST["N_framedelay_" . $currentframe] . "\"";
   }
else {
   echo " value=\"3\"";
   }   
echo " size=\"3\" maxlength=\"3\">";
?>
 seconds
</td>

<td valign="top"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Frame Start Effect','<br>This is the starting effect for this frame. If this is the first frame in your animation sequence, it will dictate how the content appears.<br><br>If it is the second frame or later, it will determine how this frame transitions from the ending effect of the previous frame.');" onmouseout="exit();"> Start Effect (for this frame):
<select name="effect2" id="effect2">
<option value="Appear"<?php if ($effect2 == "Appear" || $effect2 == "") echo " selected";?>>Appear</option>
<option value="Fade"<?php if ($effect2 == "Fade") echo " selected";?>>Fade Out</option>
<option value="Puff"<?php if ($effect2 == "Puff") echo " selected";?>>Puff</option>
<option value="BlindDown"<?php if ($effect2 == "BlindDown") echo " selected";?>>Blind Down</option>
<option value="BlindUp"<?php if ($effect2 == "BlindUp") echo " selected";?>>Blind Up</option>
<option value="SwitchOff"<?php if ($effect2 == "SwitchOff") echo " selected";?>>Switch Off</option>
<option value="SlideDown"<?php if ($effect2 == "SlideDown") echo " selected";?>>Slide Down</option>
<option value="SlideUp"<?php if ($effect2 == "SlideUp") echo " selected";?>>Slide Up</option>
<option value="DropOut"<?php if ($effect2 == "DropOut") echo " selected";?>>Drop Out</option>
<option value="Shake"<?php if ($effect2 == "Shake") echo " selected";?>>Shake</option>
<option value="Pulsate"<?php if ($effect2 == "Pulsate") echo " selected";?>>Pulsate</option>
<option value="Squish"<?php if ($effect2 == "Squish") echo " selected";?>>Squish</option>
<option value="Fold"<?php if ($effect2 == "Fold") echo " selected";?>>Fold</option>
<option value="Grow"<?php if ($effect2 == "Grow") echo " selected";?>>Grow</option>
<option value="Shrink"<?php if ($effect2 == "Shrink") echo " selected";?>>Shrink</option>
<option value="Highlight"<?php if ($effect2 == "Highlight") echo " selected";?>>Highlight</option>
</select>

<br><br><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Frame End Effect','<br>This is the ending effect for this frame. If this is the last frame in your animation sequence, it will dictate how the last frame ends.<br><br>If this frame is any other but the last, it will determine how this frame transitions into the next one.<br><br>NOTE: If you\'ve chosen to run this animation as a loop, this effect will determine how the frame transitions back into the starting frame again.');" onmouseout="exit();"> End Effect (for this frame):
<select name="effect1" id="effect1">
<option value="Appear"<?php if ($effect1 == "Appear") echo " selected";?>>Appear</option>
<option value="Fade"<?php if ($effect1 == "Fade" || $effect1 == "") echo " selected";?>>Fade Out</option>
<option value="Puff"<?php if ($effect1 == "Puff") echo " selected";?>>Puff</option>
<option value="BlindDown"<?php if ($effect1 == "BlindDown") echo " selected";?>>Blind Down</option>
<option value="BlindUp"<?php if ($effect1 == "BlindUp") echo " selected";?>>Blind Up</option>
<option value="SwitchOff"<?php if ($effect1 == "SwitchOff") echo " selected";?>>Switch Off</option>
<option value="SlideDown"<?php if ($effect1 == "SlideDown") echo " selected";?>>Slide Down</option>
<option value="SlideUp"<?php if ($effect1 == "SlideUp") echo " selected";?>>Slide Up</option>
<option value="DropOut"<?php if ($effect1 == "DropOut") echo " selected";?>>Drop Out</option>
<option value="Shake"<?php if ($effect1 == "Shake") echo " selected";?>>Shake</option>
<option value="Pulsate"<?php if ($effect1 == "Pulsate") echo " selected";?>>Pulsate</option>
<option value="Squish"<?php if ($effect1 == "Squish") echo " selected";?>>Squish</option>
<option value="Fold"<?php if ($effect1 == "Fold") echo " selected";?>>Fold</option>
<option value="Grow"<?php if ($effect1 == "Grow") echo " selected";?>>Grow</option>
<option value="Shrink"<?php if ($effect1 == "Shrink") echo " selected";?>>Shrink</option>
<option value="Highlight"<?php if ($effect1 == "Highlight") echo " selected";?>>Highlight</option>
</select>

</td></tr></table>

</td></tr>


<tr>
<td valign="top">

<?php
foreach ($_POST as $key => $val) {
  $val = stripslashes($val);
  $val = str_replace(chr(34), '&#34;', $val);
  $val = str_replace(chr(39), '&#39;', $val);
  // if below is to prevent those fields from being written twice in the same form
  if (substr($key, 0, 11) != "SB_content_" && substr($key, 0, 10) != "S_effect1_" && substr($key, 0, 10) != "S_effect2_" && substr($key, 0, 13) != "N_framedelay_" && $key != "maxframes")
  // if ($key != "SB_content_$currentframe" && $key != "S_effect1_$currentframe" && $key != "S_effect2_$currentframe" && $key != "N_framedelay_$currentframe" && $key != "maxframes")
     echo "<input type=\"hidden\" name=\"$key\" value=\"$val\">\n";
}

echo "\n\n<input type=\"hidden\" id=\"maxframes\" name=\"maxframes\" value=\"$maxframes\">\n\n";

echo "<br><center><a href=\"Javascript: if (validate()) goPrevious();\">";
if ($currentframe != 1)
   echo "<img src=\"img/previous.gif\" border=\"0\" width=\"76\" height=\"21\" onmouseover=\"tooltip('PowerEffects Help','Go To Previous Frame','<br>Returns you to the previous animation frame.'); window.status=''; return true;\" onmouseout=\"exit();\"></a>";
else
   echo "<img src=\"img/main.gif\" border=\"0\" width=\"76\" height=\"21\" onmouseover=\"tooltip('PowerEffects Help','Go To Home','<br>Returns you to the main settings of this animation that apply to all frames.'); window.status=''; return true;\" onmouseout=\"exit();\"></a>";
      
echo "&nbsp;&nbsp;&nbsp;<a href=\"Javascript: if (validate()) goForward();\">";
echo "<img src=\"img/next.gif\" border=\"0\" width=\"76\" height=\"21\" onmouseover=\"tooltip('PowerEffects Help','Go To Next Frame','<br>Sends you to the next animation frame or inserts another frame after this one (and brings you there) if this frame is the last so far in your sequence.'); window.status=''; return true;\" onmouseout=\"exit();\"></a>";

echo "</center></td></tr>";
echo "</table></form>\n\n";

echo "<form name=\"settings\" action=\"\"";
echo " method=\"post\">";
foreach ($_POST as $key => $val) {
  $val = stripslashes($val);
  $val = str_replace(chr(34), '&#34;', $val);
  $val = str_replace(chr(39), '&#39;', $val);
  // if below is to prevent those fields from being written twice in the same form and to get rid of any deleted frames
  if ($key != "SB_content_$currentframe" && $key != "S_effect1_$currentframe" && $key != "S_effect2_$currentframe" && $key != "N_framedelay_$currentframe" && $key != "maxframes" && $key != "helptips" && $key != "SB_content_$deletedframe" && $key != "S_effect1_$deletedframe" && $key != "S_effect2_$deletedframe" && $key != "N_framedelay_$deletedframe")
     echo "<input type=\"hidden\" name=\"$key\" value=\"$val\" id=\"$key\">\n";
}

   echo "<input type=\"hidden\" name=\"SB_content_$currentframe\" id=\"SB_content_$currentframe\">";
   echo "<input type=\"hidden\" name=\"S_effect1_$currentframe\" id=\"S_effect1_$currentframe\">";
   echo "<input type=\"hidden\" name=\"S_effect2_$currentframe\" id=\"S_effect2_$currentframe\">";
   echo "<input type=\"hidden\" name=\"N_framedelay_$currentframe\" id=\"N_framedelay_$currentframe\">";
   echo "<input type=\"hidden\" name=\"maxframes\">";
   echo "<div class=\"invis\" name=\"inserts\" id=\"inserts\"></div>";         

echo "</form>\n\n";

?>
<a name="prev"></a>



<hr color="midnightblue" width="400">

<?php
 echo "<div align=\"$align\" style=\"width: 700px; height: " . $height . "px;\"><span id=\"preview\"></span></div>";
?>

<p style="text-align: center; font-size: 10pt;">&copy; 2008 Street Muse Publishing. All Rights Reserved.<br>
<a href="http://www.power-effects.com" target="_pehome">Power-Effects.com</a></p>
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
