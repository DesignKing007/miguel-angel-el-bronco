// iPhone Listeners
	
window.addEventListener('load', setOrientation, false); 
window.addEventListener('orientationchange', setOrientation, false);

function setOrientation() {
  var orient = Math.abs(window.orientation) === 90 ? 'landscape' : 'portrait'; 
  var cl = document.body.className; 
  cl = cl.replace(/portrait|landscape/, orient);
  document.body.className = cl; 
}

window.addEventListener('load', function(){
	if (location.hash.length == 0) {
		setTimeout(scrollTo, 0, 0, 1);
	}
}, false);

// jQuery functions

$(document).ready(function(){
	
	// Login popup
	$('#login_link').toggle(function(){
		$('#login_window').show();
	}, function(){
		$('#login_window').hide();
	});
	
	// Navigation popup
	$('#main_navigation_button').toggle(function(){
		$('#main_navigation_links').show();
	}, function(){
		$('#main_navigation_links').hide();
	});
	
	// Back2Top 4 iPhone
	$("#back2top").click(function(){
		setTimeout(scrollTo, 0, 0, 1);
	});
	
	// Form reset function
	
	function formReset() {
		window.location.reload();
	}
	
	// Forms validation script
	
	$(".form_submit").click(function(){
		form = $(this).parent().parent();
		if (form.find(":input:not(button)[value=]").length > 0 ) {
			emptyInputName = form.find(":input[value=]:first").attr("name");
			missingText = form.find("label[for='" + emptyInputName + "']").text();
			form.find(".form_alert")
				.css("opacity","0")
				.show()
				.html("Type in your <strong>" + missingText + "</strong>")
				.animate({
					opacity:1
				},200);
			return false;
		}
		dataString = form.serialize();
		$.ajax ({
			type:"POST",
			url:"php/sendmail.php",
			data: dataString,
			success: function() {
				form.find("fieldset").animate({
					opacity:0.1
				},500,function(){
					$(this).find(":input").attr("disabled","disabled");
					$(this).find(".form_alert").replaceWith("");
					if($(this).parent().find(".success").length == 0) {
						$(this).parent().prepend("<p class='success'><span>Thank you!</span><br/>Your message was sent!</p>");
					}
					$(this).parent()
							.find(".success")
							.hide()
							.css("opacity","0")
							.show()
							.animate({
								opacity:1
							}, 500, function(){
								var formTimeout = setTimeout(formReset,2000);
							});
				});
			}
		});
		
		return false;
	});
	
	$("form :input:not(button)").focus(function(){
		$(this).parent().parent().find(".form_alert").animate({
			opacity:0
		},200,function(){
			$(this).hide();
		});
	});
	
	// Slider script

	if ($("#slider").length > 0) {
		slidesLength = $(".slides").length;
		
		// Slide switcher
		
		function slideSwitcher(slideIndex) {
			
			$(".slides:visible").hide();
			$(".slides").eq(slideIndex+1).show();
			$("#slider_navigation li").removeAttr("class").eq(slideIndex+1).addClass("current");
			
		}
		
		$("#slider_controls .next").click(function(){
			slideIndex = $(".slides:visible:first").index();
			if (slideIndex < 0) {
				slideIndex = 0;				
			} else if (slideIndex == slidesLength-1) {
				slideIndex = -1;	
			}
			slideSwitcher(slideIndex);
		});
		
		$("#slider_controls .prev").click(function(){
			slideIndex = $(".slides:visible").prev().index();
			if ( slideIndex == -1 ) {
				slideIndex = slidesLength - 1;
			}
			slideIndex = slideIndex - 1;
			slideSwitcher(slideIndex);
		});
		
		$("#slider_navigation li a").click(function(){
			slideIndex = $(this).parent().index() - 1;
			slideSwitcher(slideIndex);
		});
		
	}
	
});