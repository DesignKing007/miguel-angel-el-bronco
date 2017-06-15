<?php require("pelogin.php"); ?>

<html>
<head>
<title>PowerEffects - GreyBox Designer</title>

<?php
//$GB_ROOT_DIR = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
//$GB_ROOT_DIR = 'http://'.substr($GB_ROOT_DIR, 0, strrpos($GB_ROOT_DIR,'/')).'/greybox/';
//echo "<script type=\"text/javascript\">\n";
//echo "var GB_ROOT_DIR = '$GB_ROOT_DIR';\n";
//echo "</script>";
?>

<script type="text/javascript">
   var GB_ROOT_DIR = "./greybox/";
</script>

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
   document.getElementById('link_id').value = trim(document.getElementById('link_id').value);
   document.getElementById('link_title').value = trim(document.getElementById('link_title').value);
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
   strID = document.getElementById('link_id').value;
   if (strID != "") {  
      idChar = strID.charAt(0);
      ch = idChar.charCodeAt(0);
      if ((ch > 64 && ch < 91) || (ch > 96 && ch < 123) ) { }
      else {
         alert("Sorry. The name of this link must be composed of numbers and letters only, beginning with a letter, and containing no spaces.");
         return false;
      }   
      for(var i=0; i<strID.length; i++) {
         idChar = strID.charAt(i);
         ch = idChar.charCodeAt(0);
         if ((ch > 47 && ch < 58) || (ch > 64 && ch < 91) || (ch > 96 && ch < 123) ) { }
         else {
            alert("Sorry. The name of this link must be composed of numbers and letters only, beginning with a letter, and containing no spaces.");
            return false;
         }
      }
   }
   if (document.frmproperties.box_size[2].checked) {
      strWidth = document.getElementById('box_width').value;
      strHeight = document.getElementById('box_height').value;
      if ((!isNumeric(strWidth)) || (!isNumeric(strHeight))) {
         alert("The height and width must be numeric.");
         return false;
      }
      if (trim(strWidth) == "" || trim(strHeight) == "") {
         alert("Oops. We can't proceed until you specify a height and width of the GreyBox.");
         return false;
      }    
   }
   return true;   
}

function processLink(bPreview) {
   var gbType = "gb_page";
   var gbTypeAlt = "GB_show";
   var setText = "";
   var linkID = "[]";
   var gbOut;
   var gbOutAlt;
   var gbSize = "";
   var gbSizeAlt = "";
   var linkTitle = document.getElementById('link_title').value;
   linkTitle = linkTitle.replace(/"/g, '&#34;');
   var linkTitleAlt = linkTitle.replace(/'/g, "\\'");
   var linkText = document.getElementById('link_text').value;
   linkText = linkText.replace(/"/g, '&#34;');
   linkText = linkText.replace(/'/g, "&#39;");      

   if (document.frmproperties.link_type[1].checked) {
      gbType = "gb_image";
      gbTypeAlt = "GB_showImage";
   }
   
   if (document.frmproperties.link_type[0].checked) { // size only applies to web pages
      if (document.frmproperties.box_size[2].checked) {
         gbSize = "[" + document.getElementById('box_width').value + ", " + document.getElementById('box_height').value + "]";
         gbSizeAlt = ", " + document.getElementById('box_height').value + ", " + document.getElementById('box_width').value;
      }
      if (document.frmproperties.box_size[0].checked) { // Default size
         gbSize = "[500, 500]";
      }
      if (document.getElementById('box_centered').checked && !document.frmproperties.box_size[1].checked) {
         gbType = "gb_page_center";
         gbTypeAlt = "GB_showCenter";
      }   
      if (document.frmproperties.box_size[1].checked) {
         gbType = "gb_page_fs";
         gbTypeAlt = "GB_showFullScreen";
      }
   }
   if (document.frmproperties.link_set[1].checked) {
      setText = "set";
      linkID = "[" + document.getElementById('link_id').value + "]";
   }
   
   // Modifiers
   //if (document.frmproperties.link_type[0].checked && !document.frmproperties.box_size[1].checked) { // if a web page and not in full screen
   if (gbSize != "") { //if size is set
      linkID = ""; // then get rid of empty brackets or brackets will appear twice
   }
   if (document.frmproperties.link_type[0].checked && document.frmproperties.link_set[1].checked) { // if a web page and part of a set
      gbType = "gb_page"; // then change gbType to match,
      linkID = "[" + document.getElementById('link_id').value + "]"; // put back link ID
      gbSize = ""; // and get rid of size in brackets
      gbTypeAlt = "GB_showFullScreen"; // Change preview to full screen
      gbSizeAlt = ""; // get rid of preview page size
   }

   gbOut = '<a href="' + document.getElementById('link_url').value + '" title="' + linkTitle + '" rel="';
   gbOut = gbOut + gbType + setText + gbSize + linkID + '">' + linkText + '</a>';
   
   gbOutAlt = '<a href="' + document.getElementById('link_url').value + '" onclick="return ' + gbTypeAlt + '(\'' + linkTitleAlt + '\', this.href' + gbSizeAlt + ')">';
   gbOutAlt = gbOutAlt + linkText + '</a>';
   
   if (bPreview) {
      document.getElementById('preview_link').innerHTML = gbOutAlt;
   } else {
      document.getElementById('output_link').value = gbOut;
      document.frmproperties.submit();
   }
}

function disableOnLoad() {
   if (document.frmproperties.link_set[0].checked) {
      document.getElementById('link_id').disabled=true;
   }
   if (document.frmproperties.box_size[0].checked || document.frmproperties.box_size[1].checked) {
      document.getElementById('box_width').disabled = true;
      document.getElementById('box_height').disabled = true;
      if (document.frmproperties.box_size[1].checked) {
         document.getElementById('box_centered').disabled=true;
      }
   }
   if (document.frmproperties.link_type[1].checked) {
      disableSize(true);
   }
}

function disableSize(bToggle) {
   document.frmproperties.box_size[0].disabled = bToggle;
   document.frmproperties.box_size[1].disabled = bToggle;
   document.frmproperties.box_size[2].disabled = bToggle;            
   document.getElementById('box_width').disabled = bToggle;
   document.getElementById('box_height').disabled = bToggle;
   document.getElementById('box_centered').disabled=bToggle;
}



//-->
</script>
<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>

<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" />

</head>
<body onload="disableOnLoad();">

<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">


<form name="frmproperties" action="gbcode.php" method="post" target="_gbcode">
<table width="100%" border=0 cellpadding=10 cellspacing=5><tr>
<td colspan="2">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td align="left"><a href="index.php" onclick="return confirm('Return to the main menu? (Be sure to save or write down any settings first)');"><img src="img/home.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Home','<br>Return to the powerEffects Main Menu. Be sure to save any settings first!'); window.status=''; return true;" onmouseout="exit();"></a></td>
<td align="right"><font size=-1><b><input type="checkbox" name="helptips" id="helptips" value="true" checked> Show Help Tips</b></font></td>
</tr></table>

<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">GreyBox Settings</p>

<center>
<table width=550 cellspacing=0 cellpadding=0 border=0><tr>
    <td height=15 background="img/shadedbox_top.jpg"><img src="img/boxspacer.gif" border=0></td></tr>
<tr><td background="img/shadedbox_middle.jpg"><img src="img/boxspacer.gif" border=0><br>
<table width=550 cellspacing=0 cellpadding=10 border=0><tr><td style="text-align: center;" align="center">

<table width="100%" border="0" cellpadding=5 cellspacing=0><tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Title','<br>The title is the caption that will appear on the GreyBox when your visitor clicks the link.<br><br>It can be any descriptive text you wish.');" onmouseout="exit();"> <b>Link title (caption):</b></td>
<td valign="top" align="left"><input type="text" id="link_title" name="link_title" size="40" maxlength="80"></td></tr>

</table>
</td></tr></table>
</td></tr>


<tr><td height=15 background="img/shadedbox_bottom.jpg"><img src="img/boxspacer.gif" border=0 width=550></td></tr>
</table>
</center>


</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Type','<br>Select whether this link is to a web page or an image.');" onmouseout="exit();"> <b>Type of link:</b></td>
<td valign="top" align="left"><input type="radio" name="link_type" value="page" checked onclick="if(document.frmproperties.link_set[0].checked) {disableSize(false); disableOnLoad();}"> A web page<br>
<input type="radio" name="link_type" value="image" onclick="disableSize(true);"> An image</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Set','<br>If you want this link to be associated with other GreyBox links you create (so a visitor can page through the popups), each link in the set must contain the same set name. <br><br>The set name can be made up of letters and numbers, but must begin with a letter. No spaces, punctuation, or special characters can be used in this name. <b>NOTE: Web pages in a set are always shown in full screen mode, no matter your size settings.</b><br><br>For more information on sets, click on the link below: <i>What is a set</i>.');" onmouseout="exit();"> <b>This link is:</b></td>
<td valign="top" align="left"><input type="radio" name="link_set" value="false" checked onclick="this.focus(); document.getElementById('link_id').disabled=true; disableSize(false); disableOnLoad();"> Not part of a set<br>
<input type="radio" name="link_set" value="true" onclick="document.getElementById('link_id').disabled=false; document.getElementById('link_id').focus(); if(document.frmproperties.link_type[0].checked){disableSize(true);}"> Part of set named: <input type="text" id="link_id" name="link_id" size="20" maxlength="20" onclick="document.frmproperties.link_set[1].checked=true;">
<p style="text-align: center;"><a href="sethelp.html" target="_sethelp">What is a set?</a></p></td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','GreyBox Size','<br>Select whether the popup GreyBox is full screen or a specific width and height (in pixels). This only applies to web pages. Images are always centered to the image\'s size.<br><br>If you select a specific size, you can also choose whether you want the GreyBox centered on the screen or at the top of the screen.');" onmouseout="exit();"> <b>Size of GreyBox:<br>(For web page only)</b></td>
<td valign="top" align="left"><input type="radio" name="box_size" value="default" checked onclick="this.focus(); document.getElementById('box_width').disabled=true; document.getElementById('box_height').disabled=true; document.getElementById('box_centered').disabled=false;"> Default size (500 x 500 pixels)<br>
<input type="radio" name="box_size" value="fs" onclick="this.focus(); document.getElementById('box_width').disabled=true; document.getElementById('box_height').disabled=true; document.getElementById('box_centered').disabled=true;"> Full screen<br>
<input type="radio" name="box_size" value="specific" onclick="document.getElementById('box_width').disabled=false; document.getElementById('box_height').disabled=false; document.getElementById('box_centered').disabled=false; document.getElementById('box_width').focus();"> Specific size:<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="box_width" name="box_width" size="4" maxlength="4"> Pixels wide<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="box_height" name="box_height" size="4" maxlength="4"> Pixels high<br>
<input type="checkbox" name="box_centered" id="box_centered" value="true" checked> Center GreyBox on screen
</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link URL','<br>The link URL is the actual web address of the web page or image you wish to link to. That is, this is what the link will open when a visitor click on it.<br><br>This field may be an address relative to your host web page (e.g images/myimage.jpg) or an absolute one (e.g. http://www.google.com).');" onmouseout="exit();"> <b>Link URL (web address):</b></td>
<td valign="top" align="left"><input type="text" id="link_url" name="link_url" size="60" maxlength="200"></td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Link Anchor Text','<br>This is the text they will see where the link appears on your web page.<br><br>This is different from the link title (caption) above, which is the caption they will see in the GreyBox AFTER they click the link.');" onmouseout="exit();"> <b>Link anchor text:</b></td>
<td valign="top" align="left"><input type="text" id="link_text" name="link_text" size="60" maxlength="200"></td></tr>

<tr>
<td valign="top" colspan="2"><center>

<a onclick="Javascript: if (validate()) processLink(true);"><img src="img/preview.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Preview GreyBox Link','<br>Allows you to preview your GreyBox link below based on the settings you\'ve entered so far.'); window.status=''; return true;" onmouseout="exit();"></a>

<hr color="midnightblue" width="400">
<p><div id="preview_link"></div>&nbsp;</p>
<hr color="midnightblue" width="400">

<a href="#" onclick="if (validate()) processLink(false);"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Once you\'ve got your GreyBox link the way you want, this option takes you to the next step, where you can get the code to add to your web page.'); window.status=''; return true;" onmouseout="exit();"></a>

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


</body>
</html>
