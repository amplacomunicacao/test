$( function(){

    // form
    $('textarea, input[type=text]').focus( function(){
        if ( this.value == this.defaultValue ) this.value = '';
    });
    $('textarea, input[type=text]').blur( function(){
        if ( this.value == '' ) this.value = this.defaultValue;
    });

	// banner topo 
    $('#banner').carrossel1({'auto': true});

    // banner produto
    $('#banner-produto').carrossel1();

    // banner aplicativos 
    var __telaAplicativo = new TelaAplicativo('banner-aplicativo');

    // receita - sidebar
    $('#sidebar-receita .bt').click(function(event) {
        event.preventDefault();

        // $('#sidebar-receita .submenu').slideUp();

        $('#sidebar-receita .bt').removeClass('ativo');

        if ( $(this).parent().find('.submenu').css('display') === 'block' ){
            $('#sidebar-receita .submenu').slideUp();
        }else{
            $('#sidebar-receita .submenu').slideUp();
            $(this).parent().find('.submenu').slideDown();
            $(this).addClass('ativo');
        }

    });


	// scrool nas etapas 
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

            /*if ( $(this).data('url') ){
                var full_url = __URL + $(this).data('url');
                window.history.pushState({path:full_url},'',full_url);
            }*/
	        
	        $("html,body").animate({ scrollTop:top }, "easeInOutQuint", function() {
	            scrollingScreen = false;

	        });
	    }
	    return false; 
	});



    // click ancora - scroll 
    $("a.scroll").click(function(event){
         clickMenu = true;

        //prevent the default action for the click event
        event.preventDefault();
        
        //get the full url - like mysitecom/index.htm#home
        var full_url = this.href;
        
        //split the url by # and get the anchor target name - home in mysitecom/index.htm#home
        var parts = full_url.split("#");
        var trgt = parts[1];
        
        //get the top offset of the target anchor
        var target_offset = $("a[name="+trgt+"]").offset();
        var target_top = target_offset.top;
        
        //goto that anchor by setting the body scroll top to anchor top
        // animaMenu(target_top);
        $('html, body').animate({scrollTop:target_top}, 800, function(){ clickMenu = false; });
        
        
        //to change the browser URL to the given link location
        if(full_url!=window.location){
            // full_url = full_url.replace('#', '');
            window.history.pushState({path:full_url},'',full_url);
        }
        
        // ativo botao do menu
        // $("#menu li a").removeClass('ativo');
        // $(this).addClass('ativo');      
    });






    /* Mobile
       ============================================================================== */
    // banner topo 
    $("#banner, #banner-receita, #banner-produto").swipe({
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


    // banner receitas     
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


    // carrossel produtos
    /*$("#produtos-carrossel").swipe({
      swipeStatus: function(event, phase, direction, distance) {
        // $(this).text("You swiped " + direction );
        console.log(phase);
        if (phase == "move" && direction === 'left'){            
            $('#produtos-carrossel').animate({ scrollLeft: '+=400'}, 800, "easeInOutQuart");

        }else if (phase == "move" && direction === 'right'){
            $('#produtos-carrossel').animate({ scrollLeft: '-=400'}, 800, "easeInOutQuart");
        }
      },
      triggerOnTouchEnd: true, allowPageScroll: 'vertical' });*/
    // $("#produtos-carrossel").niceScroll();
    
    $("#produtos-carrossel").niceScroll({cursorcolor:"#ffcc00",cursoropacitymax:0.7,touchbehavior:true});
    $("#produtos-carrossel").bind('scroll', function(event) {
        scrollAtivo = true;
        scrollAtivoTime = setTimeout( function(){ scrollAtivo = false; }, 1000);
    });


    /* FIM - Mobile
       ============================================================================== */


});

var scrollAtivo = false,
        scrollAtivoTime;

// ativa o banner Receita
var receitaCarrossel = false;
function receitaCarrosselInit(){
	if (!receitaCarrossel){
        // var top = window.scrollY;

		if ( scrollTop >= $("#cena-receita").offset().top ){

            setTimeout( function(){
			     $('#banner-receita').carrossel1({'auto': true});
            }, 1000);
			receitaCarrossel = true;
		}
	}
}


// muda url no scroll
var mudaUrlScrollInterval;
function mudaUrlScroll(){

    var topReceita = $("section.receitas").offset().top;
    var topProdutos = $("section.produtos").offset().top;
    var topAplicativos = $("section.aplicativos").offset().top;

    switch(scrollTop){
        case topReceita: url = 'receitas'; break;
        case topProdutos: url = 'produtos'; break;
        case topAplicativos: url = 'aplicativos'; break;
        default: url = ''; break;
    }

     window.history.pushState({path: __URL + url}, '', __URL + url);
}


// eventos no scroll 
function eventosScroll(){
    scrollTop = window.scrollY;

    // ativo carrossel receita
    receitaCarrosselInit();

    // muda url
    // clearTimeout(mudaUrlScrollInterval);
    // mudaUrlScrollInterval = setTimeout( function(){ mudaUrlScroll(); }, 500);
}

// eventos no load 
function eventosLoad(){

    // ativo carrossel receita
    receitaCarrosselInit();
}

// eventos no resize
function eventosResize(){
    
}

var scrollTop = window.scrollY;
$(window).bind('scroll', eventosScroll);
$(window).bind('load', eventosLoad);
$(window).bind('resize', eventosResize);




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
    Tela Aplicativos - Home
 */
var TelaAplicativo = (function(){

    var self = new TelaAplicativo(),
        total,
        innerWidth = window.innerWidth,
        ul,
        li,
        liTxt,
        tela;

    // contrutor 
    function TelaAplicativo(id){

        tela = $('#'+id);

        total = tela.find('.c-img > ul li').css('width', innerWidth+'px').length;
        ul = tela.find('.c-img > ul');
        li = ul.find('li');
        liTxt = tela.find('.c-txt > ul');

        // zera o scroll
        tela.find('.c-img').scrollLeft(0);

        // click anterior - evento
        tela.find('a.last').click( function(event) {            
            event.preventDefault();

            self.clickLast();
        });

        // click proximo - evento
        tela.find('a.next').click( function(event) {            
            event.preventDefault();

            self.clickNext();
        });
    }


    // click last 
    TelaAplicativo.prototype.clickLast = function(){

        var i = tela.find('.c-img').find('.ativo').index();

        if (i > 0){

            // retira a classe
            $(ul).find('.ativo').removeClass('ativo');
            li.eq(i-1).addClass('ativo');
            // anima
            innerWidth = parseInt(tela.find('.c-img > ul li').eq(0).css('width'));
            tela.find('.c-img').animate({ scrollLeft: innerWidth*(i-1)}, 800, "easeInOutQuart");

            // exibe o texto              
            var txt = tela.find('.c-txt');
            liTxt.find('.ativo').removeClass('ativo').delay(100).fadeOut(200);
            txt.delay(100).animate({ left: 200}, 200, function() {
                    liTxt.find('li').eq(i-1).addClass('ativo').fadeIn(300);
                    txt.css('left', '-300px').animate({ left: 0}, 300);
            });

            // ativa o botao next
            tela.find('a.next').removeClass('seta-dir').addClass('seta-dir-ativo');

            // seleciona na sidebar
            selecionaBtSidebar(i-1);
        }
        
        // desativa botao last ?
        if (i-1 == 0) tela.find('a.last').removeClass('seta-esq-ativo').addClass('seta-esq');
    }


    // click next 
    TelaAplicativo.prototype.clickNext = function(){

        var i = tela.find('.c-img').find('.ativo').index();

        if (i+1 < total){

            // retira a classe
            $(ul).find('.ativo').removeClass('ativo');
            li.eq(i+1).addClass('ativo');
            // anima
            innerWidth = parseInt(tela.find('.c-img > ul li').eq(0).css('width'));
            tela.find('.c-img').animate({ scrollLeft: innerWidth*(i+1)}, 800, "easeInOutQuart");

            // anima e exibe o texto
            var txt = tela.find('.c-txt');
            liTxt.find('li.ativo').removeClass('ativo').delay(100).fadeOut(200);
            txt.delay(100).animate({ left: -200}, 200, function() {
                    liTxt.find('li').eq(i+1).addClass('ativo').fadeIn(300);
                    txt.css('left', '300px').animate({ left: 0}, 300);
            });

            // ativa o botao last
            tela.find('a.last').removeClass('seta-esq').addClass('seta-esq-ativo');
            
            // seleciona na sidebar
            selecionaBtSidebar(i+1);
        }

        // botao
        if (i+1 == total-1) tela.find('a.next').removeClass('seta-dir-ativo').addClass('seta-dir');
    }

    
    // atualiza tamanho da li
    TelaAplicativo.prototype.update = function(){
        innerWidth = window.innerWidth;
        tela.find('.c-img > ul li').css('width', innerWidth+'px');
        tela.find('.c-img').scrollLeft(0);
    }

    $(window).bind('resize', self.update);
 
    
    

    // exibir sidebar 
    $('#ver-todos-app').click(function(event) {
        event.preventDefault();

        if ( parseInt($('#sidebar-app').css('right')) ){

            $('#sidebar-app').show(0).animate({right: 0}, 800, "easeInOutQuart");
            $('#banner-aplicativo .c-txt, #banner-aplicativo .c-img > ul li').animate({'width': window.innerWidth - 330}, 800, "easeInOutQuart");
            // $('#banner-aplicativo .content').animate({'width': window.innerWidth - 330});

            $(this).animate({'margin-right': '330px'}, 800, "easeInOutQuart");

            var i = $('#banner-aplicativo').find('.c-img').find('.ativo').index();
            $('#banner-aplicativo').find('.c-img').animate({ scrollLeft: (window.innerWidth - 330)*(i)}, 800, "easeInOutQuart");
        }else{
            $('#sidebar-app').animate({right: -325}, 800, "easeInOutQuart").delay(800).hide(0);
            $('#banner-aplicativo .c-txt, #banner-aplicativo .c-img > ul li').animate({'width': window.innerWidth}, 800, "easeInOutQuart");
            // $('#banner-aplicativo .content').animate({'width': window.innerWidth});

            $(this).animate({'margin-right': '0'}, 800, "easeInOutQuart");

            var i = $('#banner-aplicativo').find('.c-img').find('.ativo').index();
            $('#banner-aplicativo').find('.c-img').animate({ scrollLeft: (window.innerWidth)*(i)}, 800, "easeInOutQuart");
        }

    });
    
    // click em um link da sidebar 
    $('#sidebar-app a').click(function(event) {
        event.preventDefault();
        showApp( $(this).parent().index() );
    });

    // exibe algum app no carrossel 
    function showApp(ind){
        
        var i = $('#banner-aplicativo').find('.c-img').find('.ativo').index();
        var total = $('#banner-aplicativo').find('.c-img > ul li').length;

        // while (ind !== i){
            i = $('#banner-aplicativo').find('.c-img').find('.ativo').index();

            if (ind > i && ind < total){
                $('#banner-aplicativo a.next').trigger('click');
                ind++;
            }else if (ind < i){
                $('#banner-aplicativo a.last').trigger('click');
                ind--;
            }
        // }
    }

    // seleciona 1 na sidebar 
    function selecionaBtSidebar(i){
        $('#sidebar-app .ativo').removeClass('ativo');
        $('#sidebar-app ul li').eq(i).addClass('ativo').find('a > span.sprite-1').addClass('ativo');
    }


    return TelaAplicativo;

})();

// var __telaAplicativo = new TelaAplicativo('banner-aplicativo');



/*
    Tela Produtos
 */
var TelaProduto = ( function(){

    var self = new TelaProduto(),
        tela;


    function TelaProduto(){
        tela = $('#cena-produto');
    }


    // click - categoria
   /* $('#produtos-carrossel > ul li a').click(function(event) {
        event.preventDefault();

        if (scrollAtivo) return false;

        $('#produtos-carrossel > ul li.ativo').removeClass('ativo');
        $(this).parent().addClass('ativo');

        self.exibeCategoria( $(this).data('cod') );
    });
    TelaProduto.prototype.exibeCategoria = function(id){

        $.ajax({
            url: __URL+'ajax/categoria.php',
            type: 'POST',
            dataType: 'html',
            cache: true,
            data: {cod: id },
            beforeSend: function(){
                tela.find('.load').fadeIn();
                tela.find('.cena2').hide();
            },
            success: function(data){

                setTimeout( function(){
                    tela.find('.cena1').html(data).show(0);
                    tela.find('.load').fadeOut();
                    self.carrosselMaior();
                }, 1000);
            }
        });
    }*/

    // atualiza tamanho do carrossel produto
    TelaProduto.prototype.carrosselMenor = function(){
        $('#cena-produto').css('height', (window.innerHeight - 187) + 'px');
        $('.produtos .carrossel').addClass('subcategoria');
        // $('#bt-produtos').trigger('click');
        window.scrollTo(0, $("a[name=produtos]").offset().top);

        $("#produtos-carrossel").getNiceScroll().resize();
    }
    TelaProduto.prototype.carrosselMaior = function(){
        $('#cena-produto').css('height', (window.innerHeight - 250) + 'px');
        $('.produtos .carrossel').removeClass('subcategoria');
        // $('#bt-produtos').trigger('click');
        window.scrollTo(0, $("a[name=produtos]").offset().top);

        $('#produtos-carrossel > ul li.ativo').removeClass('ativo');

        $("#produtos-carrossel").getNiceScroll().resize();
    }


    // click - subcategoria
    // tela.on('click', 'a.subcategoria', function(event) {
    $('#produtos-carrossel > ul li a').click(function(event) {
        event.preventDefault();

        if (scrollAtivo) return false;

        $('#produtos-carrossel > ul li.ativo').removeClass('ativo');
        $(this).parent().addClass('ativo');

        self.exibeSubcategoria( $(this).data('cod') );
    });
    TelaProduto.prototype.exibeSubcategoria = function(id){

        $.ajax({
            url: __URL+'ajax/produtos-subcategoria.php',
            type: 'POST',
            dataType: 'html',
            cache: true,
            data: {cod: id },
            beforeSend: function(){
                tela.find('.load').fadeIn();
                tela.find('.cena1, .cena2, .cena3').hide(0);
                self.carrosselMenor();
            },
            success: function(data){

                setTimeout( function(){
                    tela.find('.cena2').html(data).show(0);
                    tela.find('.load').fadeOut();

                    // self.carrosselMenor();
                }, 400);
            }
        });
    }
    // click fechar - subcategoria
    tela.find('.cena2').on('click', 'a.fechar', function(event) {
        event.preventDefault();

        tela.find('.load').fadeIn();
        tela.find('.cena2').hide();
        setTimeout( function(){
            tela.find('.cena1').show(0);
            tela.find('.load').fadeOut();

            self.carrosselMaior();
         }, 400);
    });

    
    // click - produto
    tela.find('.cena2').on('click', '.lista-produtos li a', function(event) {
        event.preventDefault();

        self.exibeProduto( $(this).data('cod') );
    });
    TelaProduto.prototype.exibeProduto = function(id){

        $.ajax({
            url: __URL+'ajax/produto.php',
            type: 'POST',
            dataType: 'html',
            cache: true,
            data: {cod: id },
            beforeSend: function(){
                tela.find('.load').fadeIn();
                tela.find('.cena2').hide(0);
            },
            success: function(data){

                setTimeout( function(){
                    tela.find('.cena3').html(data).show(0);
                    tela.find('.load').fadeOut();
                }, 400);
            }
        });
    }
    // click fechar - produto
    tela.find('.cena3').on('click', 'a.fechar', function(event) {
        event.preventDefault();

        tela.find('.load').fadeIn();
        tela.find('.cena3, .cena2').hide();
        setTimeout( function(){
            tela.find('.cena1').show(0);
            tela.find('.load').fadeOut();

            self.carrosselMaior();
         }, 400);
    });
    // click voltar
    tela.find('.cena3').on('click', 'a.voltar', function(event) {
        event.preventDefault();

        tela.find('.load').fadeIn();
        tela.find('.cena3').hide();
        setTimeout( function(){
            tela.find('.cena2').show(0);
            tela.find('.load').fadeOut();
         }, 400);
    });



    return TelaProduto;

})();






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