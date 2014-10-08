$( function(){


	/* banner topo */
    $('#banner').carrossel1();
    var receitaCarrossel = false;


    /* banner aplicativos */
    $('#banner-aplicativo').carrossel2();

	/* scrool nas etapas */
	var scrollingScreen = false;
	$(".slide").mousewheel(function (event, delta) {

        // ativa carrossel Receitas
        if (receitaCarrossel === false && $(this).hasClass('produtos') ){
            $('#banner-receita').carrossel1({'auto': true});

            receitaCarrossel = true;
        }

        // se estiver na tela Aplicativos
		if ( delta < 0 && $(this).hasClass('aplicativos') ){
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
            intervalo;

        total = this.find('.c-img > ul li').length;


        // se tiver passado opcoes
        var settings = $.extend( {
          'auto' : false
        }, options);
        console.log(settings.auto);
        if (settings.auto){
            iniIntervalo();
            self.find('.c-link a').eq(0).addClass('anima');
        }


        // click no botao
        this.find('.c-link a').click( function(event) {
            event.preventDefault();

            clearInterval(intervalo);

            // $('a.anima circle.border').css('animation-timing-function', '10s');
            $(this).find('circle.border').css({'animation-duration': '5s', '-webkit-animation-duration': '5s'});

            clickNext( $(this).parent().index() );
        });

        function clickNext(index){

            // index atual
            var ul = self.find('.c-img > ul');
            var indexAtual = ul.find('.ativo').index();

            // se NAO tiver passado o Index (indice)
            if (typeof index === 'undefined'){
                if (indexAtual < total-1){
                    index = indexAtual+1;
                }else{
                    index = 0;
                    // como ja passou por todos automaticamente...
                    clearInterval(intervalo);
                     $(this).find('circle.border').css({'animation-duration': '5s', '-webkit-animation-duration': '5s'});
                }
            }

            // verifica se eh um banner novo
            if (index !== indexAtual){
                
                // pega a lista
                var li = ul.find('li');

                // animacao para frente
                if (index > indexAtual){
                    // retira a ativo
                    $(li).css('z-index', '1').removeClass('ativo');
                    // anima
                    li.eq(index).css({'left': '100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                    li.eq(indexAtual).animate({ left: '-100%'}, 800, "easeInOutQuart");
                
                }else if (index < indexAtual){
                    // retira a ativa
                    $(li).css('z-index', '1').removeClass('ativo');
                    // anima
                    li.eq(index).css({'left': '-100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                    li.eq(indexAtual).animate({ left: '100%'}, 800, "easeInOutQuart");
                }


                // anima botao
                self.find('.c-link a').removeClass('anima');
                self.find('.c-link a').eq(index).addClass('anima');
            }
        }




        // passando automaticamente
        function iniIntervalo(){
            intervalo = setInterval( function(){
                
                clickNext();

            }, 5000);
        }

        $(window).bind('load', iniIntervalo);

        return this;
    };
}(jQuery));



/*
    carrossel Aplicativos
*/
(function($){

    $.fn.carrossel2 = function(options){

        var self = this,
            total = 0,
            clique = false,
            intervalo;

        total = this.find('.c-img ul li').length;


        // click anterior
        this.find('a.last').click( function(event) {
            
            event.preventDefault();

            clearInterval(intervalo);

            var i = self.find('.c-img').find('.ativo').index();

            if (i > 0){
            	// retira a ativo e pega a lista
                var li = self.find('.c-img ul li');
                $(li).css('z-index', '2').removeClass('ativo');

                // anima
                li.eq(i-1).css({'left': '-100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                li.eq(i).animate({ left: '100%'}, 800, "easeInOutQuart");

                // exibe o texto
                // self.find('.c-txt p').eq(i-1).addClass('ativo').fadeIn();
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
                // retira a ativo e pega a lista
                var li = self.find('.c-img ul li');
                $(li).css('z-index', '2').removeClass('ativo');

                // anima
                li.eq(i+1).css({'left': '100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                li.eq(i).animate({ left: '-100%'}, 800, "easeInOutQuart");

                // exibe o texto
                // self.find('.c-txt p').eq(i-1).addClass('ativo').fadeIn();
            }
        }


        // passando automaticamente
        function iniIntervalo(){
            intervalo = setInterval( function(){
                
                clickNext();

            }, 4000);
        }

        // $(window).bind('load', iniIntervalo);

        return this;
    };
}(jQuery));