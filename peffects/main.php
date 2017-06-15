<?php

require("pelogin.php");

$id = "";
$loop_TF = "";
$align = "";
$grow = "";
$width = "";
$height = "";
$init = "";

if (isset($_POST["id"])) {
   $id = $_POST["id"];
   }
else {
   $id = "myEffect";
}
if (isset($_POST["loop_TF"]))
   $loop_TF = $_POST["loop_TF"];
if (isset($_POST["align"]))
   $align = $_POST["align"];
if (isset($_POST["grow"]))
   $grow = $_POST["grow"];
if (isset($_POST["width"])) {
   $width = $_POST["width"];
   }
else {
   $width = "550";
}
     
if (isset($_POST["height"])) {
   $height = $_POST["height"];
   }
else {
   $height = "200";
}

if (isset($_POST["init"]))
   $init = $_POST["init"];    
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
   document.getElementById('myid').value = trim(document.getElementById('myid').value);
   document.getElementById('width_id').value = trim(document.getElementById('width_id').value);
   document.getElementById('height_id').value = trim(document.getElementById('height_id').value);
   strID = document.getElementById('myid').value;
   if (strID == "") {
      alert("Oops. We can't proceed until you specify a name for this animation.");
      return false;
   }
   idChar = strID.charAt(0);
   ch = idChar.charCodeAt(0);
   if ((ch > 64 && ch < 91) || (ch > 96 && ch < 123) ) { }
   else {
      alert("Sorry. The unique name of this animation must be composed of numbers and letters only, beginning with a letter, and containing no spaces.");
      return false;
   }   
   for(var i=0; i<strID.length; i++) {
      idChar = strID.charAt(i);
      ch = idChar.charCodeAt(0);
      if ((ch > 47 && ch < 58) || (ch > 64 && ch < 91) || (ch > 96 && ch < 123) ) { }
      else {
         alert("Sorry. The unique name of this animation must be composed of numbers and letters only, beginning with a letter, and containing no spaces.");
         return false;
      }
   }
   strWidth = document.getElementById('width_id').value;
   strHeight = document.getElementById('height_id').value;
   if ((!isNumeric(strWidth)) || (!isNumeric(strHeight))) {
      alert("The height and width of the animation space must be numeric.");
      return false;
   }
   if (trim(strWidth) == "" || trim(strHeight) == "") {
      alert("Oops. We can't proceed until you specify a height and width of the animation space.");
      return false;
   }      

   return true;   
}

function importPop() {
   importwin = window.open ("getfile.html", "importwin","location=1,status=1,scrollbars=1, width=400,height=200");
}

window.name = "design";

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


<form name="frmproperties" action="design.php?currentframe=1" method="post">
<table width="100%" border=0 cellpadding=10 cellspacing=5><tr>
<td colspan="2">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
<td align="left"><a href="index.php" onclick="return confirm('Return to the main menu? (Be sure to save or write down any settings first)');"><img src="img/home.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Home','<br>Return to the powerEffects Main Menu. Be sure to save any settings first!'); window.status=''; return true;" onmouseout="exit();"></a> 
<a href="Javascript: importPop();"><img src="img/load.gif" border="0" width="63" height="21" onmouseover="tooltip('PowerEffects Help','Load','<br>Allows you to load a previously saved animation from your computer, overwriting the current one.'); window.status=''; return true;" onmouseout="exit();"></a></td>
<td align="right"><font size=-1><b><input type="checkbox" name="helptips" id="helptips" value="true" <?php if(isset($_POST['helptips']) || !isset($_POST['maxframes'])) echo "checked"; ?>> Show Help Tips</b></font></td>
</tr></table>

<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">PowerEffects Main Settings</p>

<center>
<table width=550 cellspacing=0 cellpadding=0 border=0><tr>
    <td height=15 background="img/shadedbox_top.jpg"><img src="img/boxspacer.gif" border=0></td></tr>
<tr><td background="img/shadedbox_middle.jpg"><img src="img/boxspacer.gif" border=0><br>
<table width=550 cellspacing=0 cellpadding=10 border=0><tr><td style="text-align: center;" align="center">

<table width="100%" border="0" cellpadding=5 cellspacing=0><tr>
<td valign="middle" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Unique Animation Name','<br>Enter a name you wish to give for this animation sequence.<br><br>You may have more than one animation on your web page, but each one must have a unique name to identify it.<br><br>The name can be made up of letters and numbers, but must begin with a letter. No spaces, punctuation, or special characters can be used in this name.');" onmouseout="exit();"> <b>Unique name for<br>this animation</b>:</td>
<td valign="middle" align="left"><input type="text" id="myid" name="id" size="40" maxlength="40" value="<?php echo $id; ?>"></td></tr>

<tr><td colspan="2" align="center">(Letters and numbers ONLY, beginning with a letter.<br>No spaces or special characters)</td></tr></table>
</td></tr></table>
</td></tr>


<tr><td height=15 background="img/shadedbox_bottom.jpg"><img src="img/boxspacer.gif" border=0 width=550></td></tr>
</table>
</center>


</td>
<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Animation Looping','<br>You can make your animation loop back and start again once it completes, or it can remain on the final animation frame at the end.');" onmouseout="exit();"> <b>I want this animation to</b>:</td>
<td valign="top" align="left"><input type="radio" name="loop_TF" value="true"<?php if ($loop_TF == "true" || $loop_TF == "") echo " checked"; ?>> Loop back to the beginning when complete<br>
<input type="radio" name="loop_TF" value="false"<?php if ($loop_TF == "false") echo " checked"; ?>> Remain on the final frame of the animation when complete</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Animation Alignment','<br>This alignment applies to all frames of your animation. If you try to change the animation of each frame with your HTML code, you may experience limited or no effects.<br><br>It\'s highly recommended that you choose your alignment for your effect here instead.');" onmouseout="exit();"> <b>Alignment of animation</b> (on your web page):</td>
<td valign="top" align="left"><input type="radio" name="align" value="center"<?php if ($align == "center" || $align == "") echo " checked"; ?>> Center<br>
<input type="radio" name="align" value="left"<?php if ($align == "left") echo " checked"; ?>> Left<br>
<input type="radio" name="align" value="right"<?php if ($align == "right") echo " checked"; ?>> Right<br>
</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Size of Animation Area','<br>Enter the width and height (in pixels) of your total animation area.<br><br>For best results, you should experiment with these values until you find an area slightly bigger than your largest animation.<br><br>If your animation area is too small, your effects could be cut off around the edges.');" onmouseout="exit();"> <b>Size of animation area</b>:</td>
<td valign="top" align="left">
<input type="hidden" name="grow" value="clip: auto; overflow: hidden;">
<input type="text" name="width" id="width_id" size="4" maxlength="4" value="<?php echo $width; ?>"> pixels wide<br>
<input type="text" name="height" id="height_id" size="4" maxlength="4" value="<?php echo $height; ?>"> pixels high
</td></tr>

<tr>
<td valign="top" align="right"><img src="img/help1.gif" border="0" width="16" height="16" onmouseover="tooltip('PowerEffects Help','Start of Animation','<br>You can choose to have this animation begin immediately or when the visitor takes some action.<br><br>The default is to begin the animation immediately upon page load.');" onmouseout="exit();"> <b>I want this animation to begin</b>:</td>
<td valign="top" align="left">

<select name="init">
<option value=""<?php if ($init == "") echo " selected";?>>Immediately</option>
<option value="onabort"<?php if ($init == "onabort") echo " selected";?>>When a visitor aborts the page loading</option>
<option value="onblur"<?php if ($init == "onblur") echo " selected";?>>When a visitor leaves the element</option>
<option value="onchange"<?php if ($init == "onchange") echo " selected";?>>When a visitor changes the value of the element</option>
<option value="onclick"<?php if ($init == "onclick") echo " selected";?>>When a visitor clicks on the element</option>
<option value="ondblclick"<?php if ($init == "ondblclick") echo " selected";?>>When a visitor double-clicks on the element</option>
<option value="onfocus"<?php if ($init == "onfocus") echo " selected";?>>When a visitor makes the element active</option>
<option value="onkeydown"<?php if ($init == "onkeydown") echo " selected";?>>When a keyboard key is on its way down</option>
<option value="onkeypress"<?php if ($init == "onkeypress") echo " selected";?>>When a keyboard key is pressed</option>
<option value="onkeyup"<?php if ($init == "onkeyup") echo " selected";?>>When a keyboard key is released</option>
<option value="onload"<?php if ($init == "onload") echo " selected";?>>When the page is finished loading</option>
<option value="onmousedown"<?php if ($init == "onmousedown") echo " selected";?>>When a visitor presses a mouse-button</option>
<option value="onmousemove"<?php if ($init == "onmousemove") echo " selected";?>>When the cursor moves on the element</option>
<option value="onmouseover"<?php if ($init == "onmouseover") echo " selected";?>>When the cursor moves over the element</option>
<option value="onmouseout"<?php if ($init == "onmouseout") echo " selected";?>>When the cursor moves off the element</option>
<option value="onmouseup"<?php if ($init == "onmouseup") echo " selected";?>>When a visitor releases the mouse-button</option>
<option value="onreset"<?php if ($init == "onreset") echo " selected";?>>When a visitor resets a form</option>
<option value="onselect"<?php if ($init == "onselect") echo " selected";?>>When a visitor selects content on a page</option>
<option value="onsubmit"<?php if ($init == "onsubmit") echo " selected";?>>When a visitor submits a form</option>
<option value="onunload"<?php if ($init == "onunload") echo " selected";?>>When a visitor closes a page or moves to another website</option>
</select>

<br><br><b>Note:</b> Not all conditions are applicable to every type of control. Be sure to preview and test to make sure you get the desired result.
<tr>
<td valign="top" colspan="2"><center>

<a href="Javascript: if (validate()) document.frmproperties.submit();"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Sends you to the first animation frame so you can begin creating effects or editing your work in progress.'); window.status=''; return true;" onmouseout="exit();"></a>

</center></td></tr>
</table>

<?php

foreach ($_POST as $key => $val) {
  $val = stripslashes($val);
  $val = str_replace(chr(34), '&#34;', $val);
  $val = str_replace(chr(39), '&#39;', $val);
  // NOTE: Any fields added to this form must not be duplicated below
  if ($key != "id" && $key != "loop_TF" && $key != "align" && $key != "grow" && $key != "width" && $key != "height" && $key != "init" && $key != "helptips")
     echo "<input type=\"hidden\" name=\"$key\" value=\"$val\">\n";
}

?>


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
