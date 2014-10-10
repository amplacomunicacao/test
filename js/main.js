$( function(){


	/* banner topo */
    $('#banner').carrossel1({'auto': true});


    /* banner aplicativos */
    $('#banner-aplicativo').carrossel2();


	/* scrool nas etapas */
	var scrollingScreen = false;
	$(".slide").mousewheel(function (event, delta) {

        // ativa carrossel Receitas
        /*if (receitaCarrossel === false && $(this).hasClass('produtos') ){
            $('#banner-receita').carrossel1({'auto': true});
			receitaCarrossel = true;
        }*/

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



    /* Mobile
       ============================================================================== */
    /* banner topo */
    $("#banner, #banner-receita").swipe({
      swipe:function(event, direction, distance, duration, fingerCount) {
        // $(this).text("You swiped " + direction );

        var i = $(this).find('.c-img ul li.ativo').index();

        if (direction === 'left' && i < $(this).find('.c-img ul li').length ){
                $(this).find('.c-link ul li').eq(i+1).find('a').trigger('click');
        
        }else if (direction === 'right' && i > 0 ){
                $(this).find('.c-link ul li').eq(i-1).find('a').trigger('click');
        
        }/*else if(direction === 'up'){
            // var top = $(".slide").eq(1).offset().top;
            $("html,body").animate({ scrollTop: '+=300' }, "easeInOutQuint");
        }*/
      },
    allowPageScroll: 'vertical'});


    /* banner receitas */    
    $("#banner-aplicativo").swipe({
      swipe:function(event, direction, distance, duration, fingerCount) {
        // $(this).text("You swiped " + direction );

        var i = $(this).find('.c-img ul li.ativo').index();

        if (direction === 'left'){
                $(this).find('a.next').trigger('click');
        
        }else if (direction === 'right'){
                $(this).find('a.last').trigger('click');
        
        }/*else if(direction === 'up'){
            // var top = $(".slide").eq(1).offset().top;
            $("html,body").animate({ scrollTop: '+=300' }, "easeInOutQuint");
        }*/
      },
    allowPageScroll: 'vertical'});

    // $('#banner-receita').carrossel1({'auto': true});

});




/*
	ativa o banner Receita
 */
var receitaCarrossel = false;
function receitaCarrosselInit(){
	if (!receitaCarrossel){
		var top = window.scrollY;

		if ( top >= $("#cena-receita").offset().top ){

			$('#banner-receita').carrossel1({'auto': true});
			receitaCarrossel = true;
		}
	}
}
$(window).bind('scroll', receitaCarrosselInit);
$(window).bind('load', receitaCarrosselInit);





/*
    carrossel tipo 1
*/
(function($){

    $.fn.carrossel1 = function(options){

        var self = this,
            total = 0,
            intervalo, 
            innerWidth = window.innerWidth;

        total = this.find('.c-img > ul li').css('width', innerWidth+'px').length;
        
        var ul = self.find('.c-img > ul');
        var li = ul.find('li');
        var liTxt = self.find('.c-txt > .content > ul');

        // zera
        self.find('.c-img').scrollLeft(0);


        // se tiver passado opcoes
        var settings = $.extend( {
          'auto' : false
        }, options);

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
            // var ul = self.find('.c-img > ul');

            // index atual
            var indexAtual = ul.find('.ativo').index();

            // se NAO tiver passado o Index (indice)
            if (typeof index === 'undefined'){
                if (indexAtual < total-1){
                    index = indexAtual+1;
                }else{
                    index = 0;
                    // como ja passou por todos automaticamente...
                    clearInterval(intervalo);
                    self.find('.c-link a').find('circle.border').css({'animation-duration': '5s', '-webkit-animation-duration': '5s'});
                }
            }

            // verifica se eh um banner novo
            if (index !== indexAtual){
                
                // pega a lista
                // var li = ul.find('li');

                // animacao para frente
                /*if (index > indexAtual){
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
                }*/


                /* novo (com scroll) */
                // retira a classe
                $(ul).find('.ativo').removeClass('ativo');
                li.eq(index).addClass('ativo');
                // anima
                self.find('.c-img').animate({ scrollLeft: innerWidth*index}, 800, "easeInOutQuart");


                // anima botao
                self.find('.c-link a').removeClass('anima');
                self.find('.c-link a').eq(index).addClass('anima');


                // anima e exibe o texto, caso possua
                if (liTxt){
	                var txt = self.find('.c-txt');
	                if (index > indexAtual){
		                liTxt.find('.ativo').removeClass('ativo').delay(100).fadeOut(200);
		                txt.delay(100).animate({ left: 0}, 200, function() {
		                		liTxt.find('li').eq(index).addClass('ativo').fadeIn(300);
				                txt.css('left', '40%').animate({ left: '20%'}, 300);
		                });
	            	}else{
	            		liTxt.find('.ativo').removeClass('ativo').delay(100).fadeOut(200);
		                txt.delay(100).animate({ left: '40%'}, 200, function() {
		                		liTxt.find('li').eq(index).addClass('ativo').fadeIn(300);
				                txt.css('left', 0).animate({ left: '20%'}, 300);
		                });
	            	}
            	}

            }
        }




        // passando automaticamente
        function iniIntervalo(){
            intervalo = setInterval( function(){
                
                clickNext();

            }, 5000);
        }

        // $(window).bind('load', iniIntervalo);



        // atualiza tamanho da li
        function update(){
            innerWidth = window.innerWidth;
            self.find('.c-img > ul li').css('width', innerWidth+'px');
            self.find('.c-img').scrollLeft(0);
        }

        $(window).bind('resize', update);

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
            intervalo, 
            innerWidth = window.innerWidth;

        total = this.find('.c-img > ul li').css('width', innerWidth+'px').length;

        var ul = self.find('.c-img > ul');
        var li = ul.find('li');
        var liTxt = self.find('.c-txt > .content > ul');

        // zera
        self.find('.c-img').scrollLeft(0);

        // click anterior
        this.find('a.last').click( function(event) {
            
            event.preventDefault();

            clearInterval(intervalo);

            var i = self.find('.c-img').find('.ativo').index();

            if (i > 0){
            	/*// retira a ativo e pega a lista
                var li = self.find('.c-img ul li');
                $(li).css('z-index', '2').removeClass('ativo');

                // anima
                li.eq(i-1).css({'left': '-100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                li.eq(i).animate({ left: '100%'}, 800, "easeInOutQuart");*/

                /* novo (com scroll) */
                // retira a classe
                $(ul).find('.ativo').removeClass('ativo');
                li.eq(i-1).addClass('ativo');
                // anima
                self.find('.c-img').animate({ scrollLeft: innerWidth*(i-1)}, 800, "easeInOutQuart");

                // exibe o texto
                /*liTxt.find('.ativo').removeClass('ativo').fadeOut(0);
                liTxt.find('li').eq(i-1).addClass('ativo').fadeIn();*/                
                var txt = self.find('.c-txt');
                liTxt.find('.ativo').removeClass('ativo').delay(100).fadeOut(200);
                txt.delay(100).animate({ left: 200}, 200, function() {
                		liTxt.find('li').eq(i-1).addClass('ativo').fadeIn(300);
		                txt.css('left', '-300px').animate({ left: 0}, 300);
                });

                // ativa o botao next
                self.find('a.next').removeClass('disabled');
            }
            
            // botao
            if (i-1 == 0) self.find('a.last').addClass('disabled');

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
                /*// retira a ativo e pega a lista
                var li = self.find('.c-img ul li');
                $(li).css('z-index', '2').removeClass('ativo');

                // anima
                li.eq(i+1).css({'left': '100%', 'z-index': '2'}).addClass('ativo').show(0).animate({ left: 0}, 800, "easeInOutQuart");
                li.eq(i).animate({ left: '-100%'}, 800, "easeInOutQuart");*/

                /* novo (com scroll) */
                // retira a classe
                $(ul).find('.ativo').removeClass('ativo');
                li.eq(i+1).addClass('ativo');
                // anima
                self.find('.c-img').animate({ scrollLeft: innerWidth*(i+1)}, 800, "easeInOutQuart");

                // anima e exibe o texto
                var txt = self.find('.c-txt');
                liTxt.find('.ativo').removeClass('ativo').delay(100).fadeOut(200);
                txt.delay(100).animate({ left: -200}, 200, function() {
                		liTxt.find('li').eq(i+1).addClass('ativo').fadeIn(300);
		                txt.css('left', '300px').animate({ left: 0}, 300);
                });

                // ativa o botao last
                self.find('a.last').removeClass('disabled');
            }

            // botao
            if (i+1 == 2) self.find('a.next').addClass('disabled');
        }


        // passando automaticamente
        function iniIntervalo(){
            intervalo = setInterval( function(){
                
                clickNext();

            }, 4000);
        }

        // $(window).bind('load', iniIntervalo);        



        // atualiza tamanho da li
        function update(){
            innerWidth = window.innerWidth;
            self.find('.c-img > ul li').css('width', innerWidth+'px');
            self.find('.c-img').scrollLeft(0);
        }

        $(window).bind('resize', update);

        return this;
    };
}(jQuery));




/*
    bg parallax
*/
/*(function($){

    $.fn.parallaxBg = function(options){

        var settings = $.extend({
            xpos: 'center',
            yspeed: 0.4,
            yaddpx: 1
        }, options );

        var self = this,
            bgHeight = 750,
            windowHeight = window.innerHeight;


        function update(){
            var pos = window.scrollY;               
    
            self.each( function(){

                    var element = $(this);
                    var top = element.offset().top;
                    var height = element.height();

                    // caso esteja fora da arrea de visualizacao
                    if (top + height < pos || top > pos + windowHeight) return;
                    
                    element.css('backgroundPosition', settings.xpos + " " + Math.round((top - pos) * settings.yspeed + (settings.yaddpx)) + "px");
            });
        }

    
        $(window).bind('scroll', update).resize(update);
        update();


        return this;
    };

}(jQuery));*/