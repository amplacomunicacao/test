$( function(){


	/* banner link circular */
	$('.c-link-circulo a').click(function(event) {
		event.preventDefault();

		clearInterval(intervalo);

		// botao
		$(this).parent().parent().find('a').removeClass('anima');
		$(this).addClass('anima');


		// animacao do banner
		var ind = $(this).parent().index();
		var li = $('#banner .c-img ul li');
		var indAtual = $('#banner .c-img ul li.ativo').index();

		if (ind !== indAtual){

			// var li = $('#banner .c-img ul li');
			if (ind > indAtual){
				$(li).css('z-index', '1').removeClass('ativo');
				li.eq(ind).css({'left': '100%',	'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
				li.eq(indAtual).animate({ left: '-100%'}, 800, "easeInOutQuart");
			
			}else if (ind < indAtual){
				$(li).css('z-index', '1').removeClass('ativo');
				li.eq(ind).css({'left': '-100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
				li.eq(indAtual).animate({ left: '100%'}, 800, "easeInOutQuart");
			}
		}
	});

	// passando automaticamente
    // function iniIntervalo(){
        var intervalo = setInterval( function(){
            
            var indAtual = $('#banner .c-img ul li.ativo').index();
            if (indAtual < 2)
            	$('#banner .c-link ul li').eq(indAtual+1).find('a').trigger('click');

        }, 4000);
    // }


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