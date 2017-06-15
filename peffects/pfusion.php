<?php require("pelogin.php"); 

if (isset($_POST["output_link"])) {
   $outputlink = stripslashes($_POST["output_link"]);
}
if (isset($_POST["link_title"])) {
   $linktitle = stripslashes($_POST["link_title"]);
   $linktitle = str_replace(chr(34), '&#34;', $linktitle);
   $linktitle = str_replace(chr(39), '&#39;', $linktitle);
}
if (isset($_POST["link_subtitle"])) {
   $linksubtitle = stripslashes($_POST["link_subtitle"]);
   $linksubtitle = str_replace(chr(34), '&#34;', $linksubtitle);
   $linksubtitle = str_replace(chr(39), '&#39;', $linksubtitle);
}
if (isset($_POST["link_text"])) {
   $linktext = stripslashes($_POST["link_text"]);
   $linktext = str_replace(chr(34), '&#34;', $linktext);
   $linktext = str_replace(chr(39), '&#39;', $linktext);
}

?>

<html>
<head>
<title>PowerEffects - PhatFusion Designer</title>

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

<script language="Javascript">
<!--

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
   var strID, idChar, ch, strWidth, strHeight;
   document.getElementById('link_title').value = trim(document.getElementById('link_title').value);
   document.getElementById('link_subtitle').value = trim(document.getElementById('link_subtitle').value);   
   document.getElementById('link_url').value = trim(document.getElementById('link_url').value);
   document.getElementById('link_text').value = trim(document.getElementById('link_text').value);
   document.getElementById('box_width').value = trim(document.getElementById('box_width').value);
   document.getElementById('box_height').value = trim(document.getElementById('box_height').value);   
   if (document.getElementById('link_url').value == "") {
      alert("Oops. We can't proceed until you specify the link URL (web address).");
      return false;
   }
   if (document.getElementById('link_text').value == "") {
      alert("Oops. We can't proceed until you specify the link anchor text.");
      return false;
   }
   if (document.getElementById('box_width').value != "" || document.getElementById('box_height').value != "") {
      if (!isNumeric(document.getElementById('box_width').value) || !isNumeric(document.getElementById('box_height').value)) {
         alert("You can leave the height and width blank for a MP3 link, but if you specify either value, you must specify both, and they must both be numeric (in pixels).");
      }
   }
    

   return true;   
}

function processLink(bPreview) {
   var pfOut;
   var pfSize = "";
   var linkText = document.getElementById('link_text').value;
   //linkText = linkText.replace(/"/g, '&#34;');
   //linkText = linkText.replace(/'/g, "&#39;");
   var linkTitle = document.getElementById('link_title').value;
   //linkTitle = linkTitle.replace(/"/g, '&#34;');
   //linkTitle = linkTitle.replace(/'/g, "&#39;");
   var linkSubtitle = document.getElementById('link_subtitle').value;
   //linkSubtitle = linkSubtitle.replace(/"/g, '&#34;');
   //linkSubtitle = linkSubtitle.replace(/'/g, "&#39;");   
   
   if (document.getElementById('box_width').value != "" || document.getElementById('box_height').value != "") {
      pfSize = "width:" + document.getElementById('box_width').value + ",height:" + document.getElementById('box_height').value;
   }
   
   pfOut = '<a href="' + document.getElementById('link_url').value + '" rel="' + pfSize + '" id="pf" class="mb" title="' + linkTitle + '">' + linkText + '</a><div class="multiBoxDesc pf">' + linkSubtitle + '</div>'; 
   
   if (bPreview) {
      document.getElementById('output_link').value = pfOut;
      document.frmproperties.action = "pfusion.php#prev";
      document.frmproperties.target = "_top";
      document.getElementById('link_text').value = linkText;
      document.getElementById('link_title').value = linkTitle;
      document.getElementById('link_subtitle').value = linkSubtitle;
      document.frmproperties.submit();
   } else {
      document.getElementById('output_link').value = pfOut;
      document.frmproperties.action = "pfcode.php";
      document.frmproperties.target = "_pfcode";
      document.frmproperties.submit();
   }
}

//-->
</script>
<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>

<link href="pfusion/multibox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="pfusion/mootools.js"></script>
<script type="text/javascript" src="pfusion/overlay.js"></script>
<script type="text/javascript" src="pfusion/multibox.js"></script>

</head>
<body>

<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">


<form name="frmproperties" method="post">
<table width="100%" border=0 cellpadding=10 cellspacing=5><tr>
<td colspan="2">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td align="left"><a href="index.php" onclick="return confirm('Return to the main menu? (Be sure to save or write down any settings first)');"><img src="img/home.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Home','<br>Return to the powerEffects Main Menu. Be sure to save any settings first!'); window.status=''; return true;" onmouseout="exit();"></a></td>
<td align="right"><font size=-1><b><input type="checkbox" name="helptips" id="helptips" value="true" checked> Show Help Tips</b></font></td>
</tr></table>

<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">PhatFusion Settings</p>

<center>
<table width=550 cellspacing=0 cellpadding=0 border=0><tr>
    <td height=15 background="img/shadedbox_top.jpg"><img src="img/boxspacer.gif" border=0></td></tr>
<tr><td background="img/shadedbox_middle.jpg"><img src="img/boxspacer.gif" border=0><br>
<table width=550 cellspacing=0 cellpadding=10 border=0><tr><td style="text-align: center;" align="center">

<table width="100%" border="0" cellpadding=5 cellspacing=0><tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Title','<br>The title is the caption that will appear on the popup window when your visitor clicks the link.<br><br>It can be any descriptive text you wish.');" onmouseout="exit();"> <b>Link title (caption):</b></td>
<td valign="top" align="left"><input type="text" id="link_title" name="link_title" size="40" maxlength="80" value="<?php echo $linktitle; ?>"></td></tr>

<tr><td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Subtitle','<br>The subtitle is the caption that will appear under the title on the popup window when your visitor clicks the link.<br><br>It can be any descriptive text you wish.');" onmouseout="exit();"> <b>Link subtitle (caption):</b></td>
<td valign="top" align="left"><input type="text" id="link_subtitle" name="link_subtitle" size="40" maxlength="80" value="<?php echo $linksubtitle; ?>"></td></tr>

</table>
</td></tr></table>
</td></tr>


<tr><td height=15 background="img/shadedbox_bottom.jpg"><img src="img/boxspacer.gif" border=0 width=550></td></tr>
</table>
</center>


</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','window Size','<br>Select the width and height (in pixels) of the popup window. You can leave these blank if you are opening up an MP3 file, as the window will size itself automatically to the MP3 player.');" onmouseout="exit();"> <b>Size of window:</b></td>
<td valign="top" align="left"><input type="text" id="box_width" name="box_width" size="4" maxlength="4" value="<?php echo stripslashes($_POST["box_width"]); ?>"> Pixels wide<br>
<input type="text" id="box_height" name="box_height" size="4" maxlength="4" value="<?php echo stripslashes($_POST["box_height"]); ?>"> Pixels high<br>
</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link URL','<br>The link URL is the actual web address of the web page or image you wish to link to. That is, this is what the link will open when a visitor click on it.<br><br>This field may be an address relative to your host web page (e.g images/myimage.jpg) or an absolute one (e.g. http://www.google.com).');" onmouseout="exit();"> <b>Link URL (web address):</b></td>
<td valign="top" align="left"><input type="text" id="link_url" name="link_url" size="60" maxlength="200" value="<?php echo stripslashes($_POST["link_url"]); ?>"></td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Anchor Text','<br>This is the text they will see where the link appears on your web page.<br><br>This is different from the link title (caption) above, which is the caption they will see in the window AFTER they click the link.');" onmouseout="exit();"> <b>Link anchor text:</b></td>
<td valign="top" align="left"><input type="text" id="link_text" name="link_text" size="60" maxlength="200" value="<?php echo $linktext; ?>"></td></tr>

<tr>
<td valign="top" colspan="2"><center>

<a onclick="Javascript: if (validate()) processLink(true);"><img src="img/preview.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Preview window Link','<br>Allows you to preview your window link below based on the settings you\'ve entered so far.'); window.status=''; return true;" onmouseout="exit();"></a>

<a name="prev"></a>
<hr color="midnightblue" width="400">
<p><div id="preview_link"><?php echo $outputlink; ?></div>&nbsp;</p>
<hr color="midnightblue" width="400"> 

<a href="#" onclick="if (validate()) processLink(false);"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Once you\'ve got your window link the way you want, this option takes you to the next step, where you can get the code to add to your web page.'); window.status=''; return true;" onmouseout="exit();"></a>

</center></td></tr>
</table>
<input type="hidden" id="output_link" name="output_link">
</form>

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

<script type="text/javascript">
   var box = {};
   window.addEvent('domready', function(){
   	box = new MultiBox('mb', {descClassName: 'multiBoxDesc', useOverlay: true});
   });
</script>

</body>
</html>
