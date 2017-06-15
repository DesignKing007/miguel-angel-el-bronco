animInit_Designer = "";
animControlName_Designer = "Designer";
animCurrentFrame_Designer = 0;
animMaxNumFrames_Designer = 3;
var animFrameDelay_Designer = new Array(0, 3000, 3000, 3000);
animFadeDelay_Designer = .5; 
var animEffect1_Designer = new Array('Fade',   'Shrink', 'Shake', 'Fade');
var animEffect2_Designer = new Array('Appear', 'Appear', 'Grow', 'Shake');
var animContent_Designer = new Array('',
   '<span style="color: rgb(51, 0, 153); font-size: 38pt;"><span style="font-weight: bold; font-family: impact;">Just <span style="color: rgb(255, 0, 0);">Point</span> and <span style="color: rgb(255, 0, 0);">Click...</span></span></span><br>',
'<span style="color: rgb(51, 0, 153); font-size: 38pt;"><span style="font-weight: bold; font-family: impact;">...To Create<br><span style="color: rgb(255, 0, 0);">Effects Like These!</span></span></span><br>',
'<span style="color: rgb(51, 0, 153); font-size: 38pt;"><span style="font-weight: bold; font-family: impact;">...To Create<br><span style="color: rgb(255, 0, 0);">Effects Like These!</span></span></span><br>');

animIE_Designer = (Prototype.Browser.IE);
animLoop_Designer = true;
   
document.write ('<div style="text-align: center; width: 450px; height: 200px; clip: auto; overflow: hidden;"><span id="Designer" ');
if (animInit_Designer != "")
   document.write (animInit_Designer + '="animCurrentFrame_Designer=1; selectAnim_Designer();">' + animContent_Designer[1]);
else
	document.write ('>');
document.write ('</span></div>');

if (animInit_Designer == "")
   selectAnim_Designer();   
   
function selectAnim_Designer() {
   if (animCurrentFrame_Designer < animMaxNumFrames_Designer || animLoop_Designer) {
      var sEffect = animEffect1_Designer[animCurrentFrame_Designer];
      if (animIE_Designer && sEffect == "Shrink") sEffect = "Fade";  // IE doesn't like "Shrink"
      if (sEffect != "None")
   	   var myresult = eval('new Effect.' + sEffect + '(animControlName_Designer, {duration:animFadeDelay_Designer});');
      animCurrentFrame_Designer += 1;
      if (animCurrentFrame_Designer > animMaxNumFrames_Designer) animCurrentFrame_Designer = 1;
      window.setTimeout('changeAnim_Designer()',animFadeDelay_Designer * 1000);
   }
}

function changeAnim_Designer() {
   document.getElementById(animControlName_Designer).innerHTML = animContent_Designer[animCurrentFrame_Designer];
   var sEffect = animEffect2_Designer[animCurrentFrame_Designer];
   if (sEffect != "None")
	   var myresult = eval('new Effect.' + sEffect + '(animControlName_Designer, {duration:animFadeDelay_Designer});');
   window.setTimeout('selectAnim_Designer()',animFrameDelay_Designer[animCurrentFrame_Designer]);
}
