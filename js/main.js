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





/*
    carrossel tipo 1
*/
(function($){

    $.fn.carrossel1 = function(options){

        var self = this,
            total = 0,
            clique = false,
            intervalo;

        total = this.find('.c-img div').length;


        // click anterior
        this.find('a.last').click( function(event) {
            
            event.preventDefault();

            clearInterval(intervalo);

            var i = self.find('.c-img').find('.ativo').index();

            if (i > 0){

                // oculta a anterior
                var atual = self.find('.c-img').find('div').get(i);
                $(atual).removeClass('ativo').hide();
                $(self).find('.faixa-moedor').hide();

                // oculta o texto                
                self.find('.c-txt').hide().removeClass('ativo');
                self.find('.c-txt p').eq(i).hide().removeClass('ativo');
                self.find('.interrogacao').removeClass('ativo').hide();

                // exibe a nova
                var prox = self.find('.c-img').find('div').get(i-1);
                $(prox).addClass('ativo').css({'opacity': 0, left: '-26px'}).show().animate({'opacity': 1, left: '16px'}, 300, function(){
                    // $(self).find('.faixa-moedor').fadeIn();
                    var p = self.find('.c-txt p').eq(i-1);
                    if ( $(p).html() != '' ){
                           self.find('.interrogacao').delay(600).fadeIn(200).addClass('ativo');
                        // self.find('.c-txt').addClass('ativo');
                        $(p).addClass('ativo');
                    }
                });
                // $(self).find('.faixa-moedor').fadeIn(); 
                switch(i-1){
                    case 0: var l = '101px'; break;
                    case 1: var l = '102px'; break;
                    case 2: var l = '101px'; break;
                    case 3: var l = '102px'; break;
                    case 4: var l = '102px'; break;
                    case 5: var l = '105px'; break;
                    case 6: var l = '104px'; break;
                    case 7: var l = '104px'; break;
                    case 8: var l = '105px'; break;
                    default: var l = '104px'; break;
                }
                // $(self).find('.faixa-moedor').css({'opacity': 0, left: '38px'}).show().stop().animate({'opacity': 1, left: l}, 300);
                $(self).find('.faixa-moedor').css({'opacity': 0, 'width': 0, 'right': l}).show(0).stop().delay(200).animate({'opacity': 1, 'width': 156}, 400);

                // exibe o texto
                self.find('.c-txt p').eq(i-1).addClass('ativo').fadeIn();
            }

        });


        // click proximo
        this.find('a.next').click( function(event) {
            
            event.preventDefault();

            clearInterval(intervalo);

            clickNext();
        });

        function clickNext(){

            var i = self.find('.c-img').find('.ativo').index();

            if (i+1 < total){

                // oculta a anterior
                var atual = self.find('.c-img').find('div').get(i);
                $(atual).removeClass('ativo').hide();
                $(self).find('.faixa-moedor').hide();

                // oculta o texto
                self.find('.c-txt').hide().removeClass('ativo');
                self.find('.c-txt p').eq(i).hide().removeClass('ativo');
                self.find('.interrogacao').removeClass('ativo').hide();

                // exibe a nova
                var prox = self.find('.c-img').find('div').get(i+1);
                $(prox).addClass('ativo').css({'opacity': 0, left: '46px'}).show().animate({'opacity': 1, left: '16px'}, 300, function(){
                    // $(self).find('.faixa-moedor').fadeIn();

                    // exibe o texto
                    // setTimeout( function(){
                        var p = self.find('.c-txt p').eq(i+1);
                        if ( $(p).html() != '' ){
                            self.find('.interrogacao').delay(600).fadeIn(200).addClass('ativo');
                            // self.find('.c-txt').addClass('ativo');
                            $(p).addClass('ativo');
                        }
                    // }, 600);

                });
                // $(self).find('.faixa-moedor').fadeIn();
                switch(i+1){
                    case 0: var l = '101px'; break;
                    case 1: var l = '102px'; break;
                    case 2: var l = '101px'; break;
                    case 3: var l = '102px'; break;
                    case 4: var l = '102px'; break;
                    case 5: var l = '105px'; break;
                    case 6: var l = '104px'; break;
                    case 7: var l = '104px'; break;
                    case 8: var l = '105px'; break;
                    default: var l = '104px'; break;
                }
                // $(self).find('.faixa-moedor').css({'opacity': 0, left: '128px'}).show().stop().animate({'opacity': 1, left: l}, 300);
                $(self).find('.faixa-moedor').css({'opacity': 0, 'width': 0, 'right': l}).show(0).stop().delay(200).animate({'opacity': 1, 'width': 156}, 400);

            }
        }



        // click interrogacao
        this.find('.interrogacao').click( function(event) {
            
            event.preventDefault();
            clearInterval(intervalo);
            
            if ( self.find('.c-txt').css('display') == 'block' ){
                self.find('.c-txt').removeClass('ativo').delay(100).fadeOut(50);
                self.find('.c-txt p.ativo').hide();
            }else{
                self.find('.c-txt').show(0).addClass('ativo');
                self.find('.c-txt p.ativo').show();
            }
        });


        // passando automaticamente
        function iniIntervalo(){
            intervalo = setInterval( function(){
                
                clickNext();

            }, 4000);
        }

        $(window).bind('load', iniIntervalo);

        return this;
    };
}(jQuery));