<?php require("pelogin.php"); ?>

<html>
<head>
<title>PowerEffects PhatFusion - Get Code</title>
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

<table width="100%" border=0 cellpadding=15 cellspacing=5><tr>
<td valign="top" align="center">
<p style="text-align: center; font-size: 16pt; color: midnightblue; font-weight: bold;">PhatFusion Code</p>
<hr width="300" color="midnightblue">

<p style="text-align: center;" align="center"><?php echo stripslashes($_POST["output_link"]); ?></p>

<hr width="300" color="midnightblue">

<p>The link above is how your PhatFusion link will look on your web page (NOTE: Your web page may alter the appearance of the link based on any style settings, but the link anchor text and functionality
of the PhatFusion link will remain the same). You can click the link to see how the PhatFusion will look.</p>

<p>If you want to go back and make modifications, simply <a href="#" onclick="window.close();">close this window</a> to return to the Power Effects PhatFusion Designer.</p>

<p><b>If you're ready to paste the code into your web page, simply follow these steps:</b></p>

<p><b>Step 1:</b> First, you'll need to add the following code between the <b>&lt;HEAD&gt;</b> and <b>&lt;/HEAD&gt;</b> section of your HTML. Simply click in the text box below to select all
the code, then right-click, select "Copy", then paste it just before the <b>&lt;/HEAD&gt;</b> tag in your web page:</p>

<p><b>NOTE: you only need to add this code once to your web page, regardless of how many PhatFusion links you have on the page.</b></p>

<textarea id="includes" name="includes" rows=3 cols=80 onclick="this.focus(); this.select();">
&lt;link href="pfusion/multibox.css" rel="stylesheet" type="text/css" /&gt;
&lt;script type="text/javascript" src="pfusion/mootools.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="pfusion/overlay.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript" src="pfusion/multibox.js"&gt;&lt;/script&gt;
</textarea>

<p><b>Step 2:</b> You'll need to paste the code below wherever you want your PhatFusion link to appear on your website. Like Step 1 above, simply copy and paste the code,
only this time you'll paste it where you want your link to appear, somewhere inside your web page's body:</p>

<textarea id="code" name="code" rows=2 cols=75 onclick="this.focus(); this.select();">
<?php echo stripslashes($_POST["output_link"]); ?>
</textarea>

<p><b>Step 3:</b> Add the following code just before the closing <b>&lt;/BODY&gt;</b> tag.
Simply click in the text box below to select all
the code, then right-click, select "Copy", then paste it just before the <b>&lt;/BODY&gt;</b> tag in your web page:</p>

<p><b>NOTE: you only need to add this code once to your web page, regardless of how many PhatFusion links you have on the page.</b></p>

<textarea id="includes" name="includes" rows=3 cols=80 onclick="this.focus(); this.select();">
&lt;script type="text/javascript"&gt;
   var box = {};
   window.addEvent('domready', function(){
   	box = new MultiBox('mb', {descClassName: 'multiBoxDesc', useOverlay: true});
   });
&lt;/script&gt;
</textarea>

<p><b>Step 4:</b> Final step! You need to upload the <b>pfusion</b> folder and all the files in it to your web server. Upload the <b>pfusion</b> folder and its contents
to the same folder where your own web page resides.</p>

<p>For example, if your web page was located at:</p>

<p style="text-align: center;" align="center"><b>http://www.yourdomain.com/specialoffer/mypage.html</b></p>

<p>...You would upload the <b>pfusion</b> folder and its contents to:</p>

<p style="text-align: center;" align="center"><b>http://www.yourdomain.com/specialoffer/</b></p>

<p><b>NOTE: you only need to upload this folder to your web server once, regardless of how many PhatFusion links you have on your web page.</b>
The same goes if you have multiple web pages using PhatFusion effects
that all reside in this folder. However, if you are using PhatFusion effects in a different folder, than you would also need to upload these files there as well.</p>

<p><b>That's it!</b> Now it's on to the next effect!</p>

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

<script type="text/javascript">
   var box = {};
   window.addEvent('domready', function(){
   	box = new MultiBox('mb', {descClassName: 'multiBoxDesc', useOverlay: true});
   });
</script>

</body>
</html>

