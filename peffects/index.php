<?php

require("pelogin.php");
   
?>
<html>
<head>
<title>PowerEffects v2 - Main Menu</title>
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
div.hiddenContent
{
margin: 0px 20px 0px 20px;
display: none;
}

</style>

<link rel="stylesheet" type="text/css" href="fstooltips.css">
<SCRIPT language="JavaScript" type="text/javascript" src="fstooltips.js"></SCRIPT>

<link rel="stylesheet" href="menufiles/main.css" type="text/css" media="all">
<link href="menufiles/imageMenu.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="pfusion/mootools.js"></script>
<script type="text/javascript" src="menufiles/imageMenu.js"></script>

<script language="Javascript">
   function toggleLayer( whichLayer )
   {
      var elem, vis;
      if( document.getElementById ) // this is the way the standards work
      elem = document.getElementById( whichLayer );
      else if( document.all ) // this is the way old msie versions work
      elem = document.all[whichLayer];
      else if( document.layers ) // this is the way nn4 works
      elem = document.layers[whichLayer];
      vis = elem.style;
      // if the style.display value is blank we try to figure it out here
      if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
      vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
      vis.display = (vis.display==''||vis.display=='block')?'none':'block';
   }
   
   var lastMenu = 0;
</script>

</head>
<body onload="toggleLayer('hidden0');">

<center>
<table width="724" border="0" cellpadding=0 cellspacing=0><tr>
<td><img src="img/peheader.jpg" border="0" width="724" height="139" USEMAP="#registermap"><br>
<table width="100%" border="0" cellpadding="5" cellspacing="0"><tr>
<td style="background-color: white;" align="center">


<form name="frmproperties" action="design.php?currentframe=1" method="post">
<table width="100%" border=0 cellpadding=10 cellspacing=5><tr>
<td colspan="2">

<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>

<td align="right">&nbsp;</td>
</tr></table>

<p style="text-align: center; font-size: 22pt; color: midnightblue; font-weight: bold;">PowerEffects Main Menu</p>

		<div id="example" align="center">
			<div id="imageMenu">
			<ul>
				<li class="designer"><a href="#">Designer</a></li>
				<li class="greybox"><a href="#">GreyBox</a></li>
				<li class="phatfusion"><a href="#">PhatFusion</a></li>
				<li class="register"><a href="#">More</a></li>
			</ul>
			</div>
		
		<script type="text/javascript">
			
			window.addEvent('domready', function(){
				var myMenu = new ImageMenu($$('#imageMenu a'),{openWidth:310, border:2, onOpen:function(e,i){ toggleLayer('hidden' + lastMenu); lastMenu = i+1; toggleLayer('hidden' + lastMenu); }});
			});
		</script>
		</div>
<br>
<center>
<table width=550 cellspacing=0 cellpadding=0 border=0><tr>
    <td height=15 background="img/shadedbox_top.jpg"><img src="img/boxspacer.gif" border=0></td></tr>
<tr><td background="img/shadedbox_middle.jpg"><img src="img/boxspacer.gif" border=0><br>
<table width=550 cellspacing=0 cellpadding=10 border=0><tr><td style="text-align: center;" align="center">

<table width="100%" border="0" cellpadding=5 cellspacing=0><tr>
<td valign="top" align="center" height="250">

<div id="hidden0" class="hiddenContent">
<p style="text-align: center; font-size: 14pt; color: midnightblue; font-weight: bold;">Welcome to PowerEffects!</p>
<p>Start by selecting the <i>Access Pass</i> to the effect you want to create above. Upon your selection, this text will be replaced with an overview of that effect,
and a button to proceed.</p>
</div>
<div id="hidden1" class="hiddenContent">
<p style="text-align: center; font-size: 14pt; color: midnightblue; font-weight: bold;">PowerEffects Designer</p>
<p>The PowerEffects Designer allows you to create dazzling animated effects with text, headlines, images, and more!</p>
<p><b>NOTE:</b> The PowerEffects Designer uses the Prototype and Scriptaculous engines, which are not compatible with the MooTools engine used in
PhatFusion. If you want to combine animated effects with lightbox capabilities on the same web page, use the GreyBox engine instead of PhatFusion,
which DOES work with the animated effects.</p>
<a href="main.php"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Sends you to the PowerEffects Animation Designer, so you can begin creating effects or editing your work in progress.'); window.status=''; return true;" onmouseout="exit();"></a>
</div>
<div id="hidden2" class="hiddenContent">
<p style="text-align: center; font-size: 14pt; color: midnightblue; font-weight: bold;">GreyBox Engine</p>
<p>The GreyBox engine allows you to create light boxes that open images or entire web pages in a "GreyBox", which turns the rest of the screen grey, while
highlighting the opened image or page. You can also include sets of images or web pages that the visitor can scroll through, if desired.</p>

<p>GreyBoxes are useful when you want to show an image or entire web page, while still keeping them on the current page. Note that the new page can contain
images, audio, video, any content you wish to provide.</p>
<a href="greybox.php"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Sends you to the GreyBox Settings page, where you can design your own \'GreyBox\' to include on your web page.'); window.status=''; return true;" onmouseout="exit();"></a>
</div>
<div id="hidden3" class="hiddenContent">
<p style="text-align: center; font-size: 14pt; color: midnightblue; font-weight: bold;">PhatFusion Light boxes</p>
<p>PhatFusion allows you to create boxes that pop open images, MP3 content, videos, or entire web pages in a light box, which turns the rest of the screen grey, while
highlighting the opened content. Light boxes are useful when you want to show new content, while still keeping them on the current page.</p>
<p><b>NOTE:</b> The PowerEffects Designer uses the Prototype and Scriptaculous engines, which are not compatible with the MooTools engine used in
PhatFusion. If you want to combine animated effects with lightbox capabilities on the same web page, use the GreyBox engine instead of PhatFusion,
which DOES work with the animated effects.</p>
<a href="pfusion.php"><img src="img/next.gif" border="0" width="76" height="21" onmouseover="tooltip('PowerEffects Help','Next Step','<br>Sends you to the PhatFusion Settings page, where you can design your own Light Box to include on your web page.'); window.status=''; return true;" onmouseout="exit();"></a>

</div>
<div id="hidden4" class="hiddenContent">
<div style="float: right;"><img src="img/PowerEffects_boxtiny.jpg" border=1></div>
<p style="text-align: center; font-size: 14pt; color: midnightblue; font-weight: bold;">Discover The Untapped Secrets<br>Of PowerEffects</p>
<p>Register your copy of PowerEffects for free to get tips, test results, techniques, tutorial videos, free updates for life, and more!</p>
<p><a href="http://www.power-effects.com/peregister/" target="_register">Register Here</a> to gain instant access.</p>
</div>

</td></tr></table>
</td></tr></table>
</td></tr>


<tr><td height=15 background="img/shadedbox_bottom.jpg"><img src="img/boxspacer.gif" border=0 width=550></td></tr>
</table>
</center>


</td></tr>

<td valign="top" colspan="2"><center>

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
<a href="http://www.power-effects.com" target="_pehome">Power-Effects.com</a><br>
<?php require("version.php"); ?></p>
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
