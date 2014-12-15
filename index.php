<?php

include 'inc/init.php';
include 'inc/erro.php';

$i = ( isset($_GET['i']) ) ? $_GET['i'] : 'home';

?>
<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Massas Cream Crackers Biscoitos e muito mais Vitarella</title>
        <meta name="description" content="No mercado desde 1993, a Vitarella se destaca como uma marca de sucesso no meio da indústria de alimentos. Líder de mercado, a empresa pernambucana conta com uma vasta linha de produtos.">
        <meta name="keywords" content="vitarella, massa, biscoito, massas, macarrão, espaguete, spaghetti, biscoitos, cream cracker, saltvita, maria, maizena, treloso, chocoresco, wafer, amanteigados, sequilhos, fettuccine, sobremesa, lanche, pernambuco" />
		<meta name="robots" content="all" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- <link rel="stylesheet" href="css/main.css"> -->
        <link rel="stylesheet/less" type="text/css" href="<?= __URL ?>css/main.less">
        <script src="<?= __URL ?>js/vendor/less.js"></script>

        <script src="<?= __URL ?>js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body class="<?= $i ?>">
        <!--[if lt IE 8]>
            <p class="browsehappy">Você está usando um navegador (browser) <strong>desatualizado</strong>. Por favor <a href="http://browsehappy.com/">atualize seu navegador</a> para uma melhor experiência.</p>
        <![endif]-->

        <div class="load" id="loader"><img src="<?= __URL ?>img/loader.gif" height="16" width="16" alt="carregando..."></div>

        <p id="msg-landscape"><img src="img/msg01.gif" alt="gire seu dispositivo" /><br />Gire seu dispositivo.</p>

		<h1 class="hidden">Vitarella</h1>

		<a name="topo" class="ancora"></a>


		<div class="menu" id="menu">
			<div class="row1">
				<div class="content">
					<a href="<?= __URL ?>"><img src="img/marca-1.png" height="72" width="126" alt="logomarca"></a>
					<nav>
						<ul>
							<li><a href="<?= __URL ?>sobre"><span class="sprite-1 icon-sobre"></span>&nbsp;&nbsp; Sobre a vitarella</a></li>
							<li><a href="<?= __URL ?>imprensa"><span class="sprite-1 icon-imprensa"></span>&nbsp;&nbsp; Imprensa</a></li>
							<li><a href="<?= __URL ?>fale-conosco"><span class="sprite-1 icon-contato"></span>&nbsp;&nbsp; Fale Conosco</a></li>
							<!-- <li><a href="#" class="sprite-1 login-1 indent">Efetuar login</a></li> -->
							<!-- <li><a href="#" class="sprite-1 busca-1 indent">pesquisar</a></li> -->
							<li class="busca">
								<div class="circulo">
								<input type="text" name="busca">
								<a href="#" class="sprite-1 icon-busca">buscar</a>
								</div>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<div class="row2">
				<div class="bg"></div>
				<div class="content">
					<nav>
						<ul>
							<li>
								<span class="linha-l"></span>
								<a href="<?= __URL ?>#produtos" class="scroll" id="bt-produtos"><span class="sprite-1 icon-produto"></span>&nbsp;&nbsp; Nosso Produtos</a>
							</li>
							<li>
								<span class="linha-l"></span>
								<a href="<?= __URL ?>#receitas" class="scroll"><span class="sprite-1 icon-receita"></span>&nbsp;&nbsp; Nossas Receitas</a>
							</li>
							<li>
								<span class="linha-l"></span>
								<a href="<?= __URL ?>#dicas-e-aplicativos" class="scroll"><span class="sprite-1 icon-aplicativo"></span>&nbsp;&nbsp; Dicas e Aplicativos</a>
								<span class="linha-r"></span>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>

		<div class="menu-2" id="menu-2">
			<div class="content">
				<a href="#topo" class="scroll"><img src="img/marca-1.png" height="48" width="85" alt="logomarca"></a>
				<a href="#" class="sprite-1 menu-mobile">menu</a>
			</div>
			<div class="clear"></div>
		</div>


        <?php Paginas::getPagina($i); ?>


        <footer>
        	<h2 class="hidden">foooter</h2>
        	<div class="content">
        		<nav>
        			<a href="#">Sobre</a> <span class="sprite-1 ponto"></span>
        			<a href="#">Imprensa</a> <span class="sprite-1 ponto"></span>
        			<a href="#">Contato</a>
        			<br><br>
        			<a href="#" class="sprite-1 facebook">Facebook</a>
        			<a href="#" class="sprite-1 twitter">Twitter</a>
        			<a href="#" class="sprite-1 youtube">Youtube</a>
        		</nav>
        		<br>
        		<p>
        			Rodovia BR 101 Sul - Km 84 - Prazeres <br>
					Jaboatão dos Guararapes - CEP 54345-160 <br>
					0800 704 5664
        		</p>
        	</div>
        	<div class="row">
        		<p>Copyright® Vitarella - Todos os direitos reservados</p>
        	</div>
        </footer>




		<script type="text/javascript">
		var __URL = '<?= __URL ?>';
		</script>

        <script src="<?= __URL ?>js/vendor/jquery-1.11.1.min.js"></script>
        <script src="<?= __URL ?>js/plugins.js"></script>
        <script src="<?= __URL ?>js/vendor/jquery-mousewheel.min.js"></script>
        <script src="<?= __URL ?>js/vendor/jquery.touchSwipe.min.js"></script>
        <script src="<?= __URL ?>js/vendor/jquery.nicescroll.min.js"></script>
        <script src="<?= __URL ?>js/vendor/jquery-ui.min.js"></script>
        <script src="<?= __URL ?>js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID.
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        -->
    </body>
</html>
