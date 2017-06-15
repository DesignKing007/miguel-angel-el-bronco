//copyright 2005-2006 Earth Science Agency, LLC
var dragInterval:Number;
var initAudio:Boolean = false;
var mediaLength:Number;
var scrubberPressed:Boolean = false;
var ffInterval:Number;
var fbInterval:Number;
// This variable is used so that the scrubber will not jump back/forward when released
var waitToScrub:Number;

var initTransition:Boolean = false;

// EVENT LISTENER
function handleEvent(evt){
	
	if (evt.type == "start"){
		
		// RESET VARIABLE
		waitToScrub == undefined;
		
		// INITIALIZE AUDIO
		if(initAudio == false){
			myDisplay.audioVolume = 50;
			initAudio = true;
		}
		
	} else if (evt.type == "end"){  
	
		// RESET SCRUBBER AND PROGRESS BAR
		if(scrubberPressed == false && myDisplay.paused == false){
		  scrubber_mc._x = bar_mc._x;
		  bar_mc.progBar_mc._xscale = 0;
		}
		
	} else if (evt.type == "mediaLength"){  
	
		mediaLength = myDisplay.mediaLength;
	
	} else if (evt.type == "mediaTime"){
		
		// Make sure the correct nav buttons are showing
		if(myDisplay.paused == true){
			play_mc._visible = true;
			play_mc.enabled = true;					
			pause_mc._visible = false;
			pause_mc.enabled = false;
			pause_mc.gotoAndStop(1);								
		}
		
		// Make sure the correct nav buttons are showing
		if(myDisplay.paused == false){
			pause_mc._visible = true;
			pause_mc.enabled = true;
			play_mc._visible = false;
			play_mc.enabled = false;	
			play_mc.gotoAndStop(1);
		}
   		
		// MOVE THE SCRUBBER AND PROGRESS BAR WITH THE PLAY TIME
   		if(Math.abs(waitToScrub-myDisplay.currentVideoPosition) < 1 || waitToScrub == undefined){
			
			waitToScrub = undefined;
			if(myDisplay.pctLoaded >=0 && myDisplay.pctLoaded <= 100 && Math.floor(myDisplay.currentVideoPosition) > 0){
				bar_mc.loadBar_mc._xscale = myDisplay.pctLoaded;
			}
			
			if(scrubberPressed == false && myDisplay.paused == false){			
				var percentPlayed:Number = Math.floor(myDisplay.currentVideoPosition / mediaLength * 100);
				if(percentPlayed >=0 && percentPlayed <= 100 && myDisplay.currentVideoPosition > 0){
					bar_mc.progBar_mc._xscale = percentPlayed;	
				}
				
				var newPos:Number = Math.round(percentPlayed * ((bar_mc._width - scrubber_mc._width)/100)+ bar_mc._x);
				
				if( newPos > bar_mc._x && newPos <  Math.round(bar_mc._width - scrubber_mc._width)+ bar_mc._x && myDisplay.currentVideoPosition > 0){
					scrubber_mc._x = newPos;
				}	
				
				time_txt.text = myDisplay.timeText;	
			}	
		}
		
		// RESET THE SCRUBBER AND PROGRESS BAR IF THE TIME IS UNDEFINED
		if(myDisplay.currentVideoPosition == undefined){
			bar_mc.progBar._xscale = 0;
			scrubber_mc._x = bar_mc._x;
		}		
		
   }
};

myDisplay.addEventListener('start', this);
myDisplay.addEventListener("end", this);
myDisplay.addEventListener("mediaTime", this);
myDisplay.addEventListener("mediaLength", this);

back_mc.onRelease = function(){
	myDisplay.seek(0);
	bar_mc.progBar._xscale = 0;
	scrubber_mc._x = bar_mc._x;
}

pause_mc.onRelease = function(){
	if(myDisplay.paused == false){
		myDisplay.pause();
	}			
}

play_mc.onRelease = function(){
	if(myDisplay.paused == true){
		myDisplay.play();
	}			
}


// TIME FORMAT FUNCTION
function timeFormat(timeNum:Number):String{

	var minutes:Number = Math.floor((timeNum/1000) / 60);
	var seconds:Number = Math.floor((timeNum/1000) % 60);
	var _timeText:String;
	
	if (minutes < 10) {
	  _timeText = '0' + minutes;
	}else{
	  _timeText = '' + minutes;
	}			
	if (seconds < 10) {
	  _timeText += ':0' + seconds;
	}else{
	  _timeText += ':' + seconds;
	}			
	
	return _timeText;
}	

// LOAD BAR NAVIGATION
bar_mc.loadBar_mc.onRelease = function(){
	var newPos:Number = Math.round(this._xmouse / bar_mc._width * mediaLength);
		
	if(newPos >= mediaLength-1){
		myDisplay.seek(mediaLength-1);
	}else if(newPos <= 0){
		myDisplay.seek(0);
	}else{
		myDisplay.seek(newPos);
	}
	if(myDisplay.paused == true){
		myDisplay.play();
	}			
}

// VIDEO SCRUBBER
scrubber_mc.onPress = function() {
	scrubberPressed = true;
	if(myDisplay.paused == false){
		myDisplay.pause();
	}			
	this.startDrag("false", bar_mc._x, this._y, bar_mc._width - scrubber_mc._width + bar_mc._x, this._y);					

	if(myDisplay.currentVideoPosition > 0){	
		dragInterval = setInterval(progBarDrag, 1);	
	}
	function progBarDrag(){
		var percentDragged:Number =  Math.floor(((scrubber_mc._x  - bar_mc._x) * 100) / (bar_mc._width - scrubber_mc._width))+1;		
		if(percentDragged >=0 && percentDragged <= 100 && myDisplay.currentVideoPosition > 0){
			bar_mc.progBar_mc._xscale = percentDragged;	
		}				
		
		var newPos:Number = percentDragged * mediaLength / 100;

		// ONLY SCRUB IF THE VIDEO IS PROGRESSIVE!!!
		if(myDisplay.currentStream.indexOf(".flv") !== -1){
			if(newPos >= mediaLength-1){
				myDisplay.seek(mediaLength-1);
			}else if(newPos <= 0){
				myDisplay.seek(0);
			}else{
				myDisplay.seek(newPos);
			}
		}
		
		timeFormat(newPos);
	}	
};
		
scrubber_mc.onRelease = (scrubber_mc.onReleaseOutside=function () { 
	this.stopDrag();	
	clearInterval(dragInterval);
	
	if(myDisplay.currentVideoPosition >= 0){
		
		var newPos:Number = Math.floor((scrubber_mc._x  - bar_mc._x) / (bar_mc._width - scrubber_mc._width) * mediaLength);
		if(myDisplay.paused == true){
			myDisplay.play();
		}

		if(newPos >= mediaLength-1){
			newPos = mediaLength-1;
		}else if(newPos <= 0){
			newPos = 0;
		}
		
		myDisplay.seek(newPos);
		waitToScrub = newPos;

	}
		scrubberPressed = false;

});	


/// ADJUST VOLUME
volScrubber_mc.onPress = function() {		
	this.startDrag("false", volBar_mc._x, volScrubber_mc._y, volBar_mc._x + volBar_mc._width, volScrubber_mc._y);
	
	drag_interval = setInterval(progBarDrag, 10);						
	function progBarDrag(){
		var percentDragged:Number = Math.floor( ((volScrubber_mc._x - volBar_mc._x) / volBar_mc._width) * 100);
		volBars_mc._yscale = percentDragged;	
		myDisplay.audioVolume = percentDragged;
	}			
};

volScrubber_mc.onRelease = (volScrubber_mc.onReleaseOutside=function () {						
	this.stopDrag();	
	clearInterval(drag_interval);
});	