$( function(){

	// scrool nas etapas
	var scrollingScreen = false;
	$(".slide").mousewheel(function (event, delta) {

		if ( delta < 0 && $(this).hasClass('aplicativos') ){
			console.log(1);
			return true;
		}

	    if (!scrollingScreen) {
	        scrollingScreen = true; 
	        
	        var top = $("body").scrollTop() || $("html").scrollTop(); 
	        
	        var candidates = $(".slide").filter( function(){
	            if ( delta < 0 )
	                return $(this).offset().top > top + 1;
	            else
	                return $(this).offset().top < top - 1;
	        });
	        
	        if (candidates.length > 0) {
	            if (delta < 0)
	                top = candidates.first().offset().top;
	            else if ( delta > 0 )
	                top = candidates.last().offset().top;
	        }
	        
	        $("html,body").animate({ scrollTop:top }, "easeInOutQuint", function() {
	            scrollingScreen = false; 	            
	        });
	    }
	    return false; 
	});

});