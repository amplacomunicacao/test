<?php include 'inc/init.php'; ?>
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
        <link rel="stylesheet/less" type="text/css" href="css/main.less">
        <script src="js/vendor/less.js"></script>

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browsehappy">Você está usando um navegador (browser) <strong>desatualizado</strong>. Por favor <a href="http://browsehappy.com/">atualize seu navegador</a> para uma melhor experiência.</p>
        <![endif]-->

        <p id="msg-landscape"><img src="img/msg01.gif" alt="gire seu dispositivo" /><br />Gire seu dispositivo.</p>
	

		<h1 class="hidden">Vitarella</h1>

        <header class="slide">
			<div class="menu">
				<div class="row1">
					<div class="content">
						<img src="img/marca-1.png" height="72" width="126" alt="logomarca">
						<nav>
							<ul>
								<li><a href="#"><span class="sprite-1 icon-sobre"></span>&nbsp;&nbsp; Sobre a vitarella</a></li>
								<li><a href="#"><span class="sprite-1 icon-imprensa"></span>&nbsp;&nbsp; Imprensa</a></li>
								<li><a href="#"><span class="sprite-1 icon-contato"></span>&nbsp;&nbsp; Fale Conosco</a></li>
								<!-- <li><a href="#" class="sprite-1 login-1 indent">Efetuar login</a></li> -->
								<li><a href="#" class="sprite-1 busca-1 indent">pesquisar</a></li>
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
									<a href="#produtos" class="scroll" id="bt-produtos"><span class="sprite-1 icon-produto"></span>&nbsp;&nbsp; Nosso Produtos</a>
								</li>
								<li>
									<span class="linha-l"></span>
									<a href="#receitas" class="scroll"><span class="sprite-1 icon-receita"></span>&nbsp;&nbsp; Nossas Receitas</a>
								</li>
								<li>
									<span class="linha-l"></span>
									<a href="#dicas-e-aplicativos" class="scroll"><span class="sprite-1 icon-aplicativo"></span>&nbsp;&nbsp; Dicas e Aplicativos</a>
									<span class="linha-r"></span>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>

			<div class="menu-2">
				<div class="content">
					<img src="img/marca-1.png" height="48" width="85" alt="logomarca">
					<a href="#" class="sprite-1 menu-mobile">menu</a>
				</div>
				<div class="clear"></div>
			</div>

			<div class="banner" id="banner">				
				<div class="c-img">
					<ul>
						<li style="background-image: url(img/banner-001.jpg)" class="ativo"><!-- <img src="img/banner-1.jpg" alt="banner"> --></li>
						<li style="background-image: url(img/banner-002.jpg)"></li>
						<li style="background-image: url(img/banner-003.jpg)"></li>
					</ul>
				</div>

				<div class="content">

					<div class="c-link c-link-circulo">
						<ul>
						<li>
							<a href="#" class="anima">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						</ul>
					</div>

				</div>

			</div>
        </header>

        <section class="produtos slide" data-url="produtos">
        	<h2 class="hidden">produtos</h2>
        	<a name="produtos" class="ancora"></a>

        	<div class="cena-produto" id="cena-produto">
				
				<div class="load"><img src="<?= __URL ?>img/loader.gif" height="16" width="16" alt="carregando..."></div>

        		<div class="cena1">
					
					<div class="banner" id="banner-produto">
						<div class="c-img">
							<ul>
								<li style="background-image: url(externos/produto-1.jpg)" class="ativo"></li>
								<li style="background-image: url(externos/produto-1.jpg)"></li>
								<li style="background-image: url(externos/produto-1.jpg)"></li>
							</ul>
						</div>
						<div class="c-txt">
							<div class="content">
							<ul>
								<li class="ativo">
				        			<h3>Wafers</h3>
				        			<p>Receitas com esse produto</p>
			        				<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
		        					<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
			        				<!-- <a href="#" class="subcategoria" data-cod="1">abrir</a> -->
								</li>
								<li>
									<h3>Wafers 2</h3>
				        			<p>Receitas com esse produto</p>
				        			<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
		        					<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
			        				<!-- <a href="#" class="subcategoria" data-cod="1">abrir</a> -->
								</li>
								<li>
									<h3>Wafers 3</h3>
				        			<p>Receitas com esse produto</p>
				        			<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
		        					<a href="#" class="receita"><img src="externos/receita-tumb-1.png" height="125" width="126" alt="receita"><span class="mask"></span></a>
			        				<!-- <a href="#" class="subcategoria" data-cod="1">abrir</a> -->
								</li>
							</ul>
							</div>
						</div>
						<div class="c-link c-link-circulo">
							<ul>
							<li>
								<a href="#" class="anima">
									<svg height="46" width="46">
										<circle cx="23" cy="23" r="20" class="border-opacity" />
										<circle cx="23" cy="23" r="20" class="border" />
										<circle cx="23" cy="23" r="6" fill="white" />
									</svg> 
								</a>
							</li>
							<li>
								<a href="#">
									<svg height="46" width="46">
										<circle cx="23" cy="23" r="20" class="border-opacity" />
										<circle cx="23" cy="23" r="20" class="border" />
										<circle cx="23" cy="23" r="6" fill="white" />
									</svg> 
								</a>
							</li>
							<li>
								<a href="#">
									<svg height="46" width="46">
										<circle cx="23" cy="23" r="20" class="border-opacity" />
										<circle cx="23" cy="23" r="20" class="border" />
										<circle cx="23" cy="23" r="6" fill="white" />
									</svg> 
								</a>
							</li>
							</ul>
						</div>
					</div>

        		</div>

        		<div class="cena2">

        		</div>

        		<div class="cena3">
        			
        		</div>

        	</div>
        	<div class="carrossel">
        		<div id="produtos-carrossel">
        		<ul>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-1-thumb.png" height="170" width="189" alt="">
	        				<p>Biscoitos Salgados</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-2-thumb.png" height="170" width="148" alt="">
	        				<p>Cream Crackers <br>Crocks</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-3-thumb.png" height="170" width="189" alt="">
	        				<p>Wafers</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-4-thumb.png" height="170" width="147" alt="">
	        				<p>Maria e Maizena</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-5-thumb.png" height="170" width="141" alt="">
	        				<p>Cream Cracker</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-1-thumb.png" height="170" width="189" alt="">
	        				<p>Biscoitos Salgados</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-2-thumb.png" height="170" width="148" alt="">
	        				<p>Cream Crackers <br>Crocks</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-3-thumb.png" height="170" width="189" alt="">
	        				<p>Wafers</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-4-thumb.png" height="170" width="147" alt="">
	        				<p>Maria e Maizena</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        			<li>
        				<a href="#" data-cod="1">
	        				<img src="img/produto-5-thumb.png" height="170" width="141" alt="">
	        				<p>Cream Cracker</p>
	        				<span class="linha"></span>
        				</a>
        			</li>
        		</ul>
        		</div>
        	</div>
        </section>

        <section class="receitas slide" data-url="receitas">
        	<h2 class="hidden">receitas</h2>
        	<a name="receitas" class="ancora"></a>
        	<div id="cena-receita" class="cena-receita">
				<div class="load"><img src="<?= __URL ?>img/loader.gif" height="16" width="16" alt="carregando..."></div>
        		
				<div class="banner" id="banner-receita">
					<div class="c-img">
						<ul>
							<li style="background-image: url(img/receita-1.jpg)" class="ativo"><!-- <img src="img/banner-1.jpg" alt="banner"> --></li>
							<li style="background-image: url(img/receita-1.jpg)"></li>
							<li style="background-image: url(img/receita-1.jpg)"></li>
						</ul>
					</div>


					<div class="c-txt">
						<div class="content">
						<ul>
							<li class="ativo">
								<img src="img/receita-icon-1.png" height="87" width="89" alt="icone">
								<p class="autor">por <br><span>Camila Nogueira</span></p>
								<h3>Penne com camarão <br> e salada especial</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nisi eveniet maiores laudantium error, repellendus ea dicta nesciunt.</p>
								<a href="#" class="sprite-1 ver-mais indent">ver mais</a>
							</li>
							<li>
								<img src="img/receita-icon-1.png" height="87" width="89" alt="icone">
								<p class="autor">por <br><span>Camila Nogueira</span></p>
								<h3>Penne com camarão <br> e salada especial 2</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nisi eveniet maiores laudantium error, repellendus ea dicta nesciunt.</p>
								<a href="#" class="sprite-1 ver-mais indent">ver mais</a>
							</li>
							<li>
								<img src="img/receita-icon-1.png" height="87" width="89" alt="icone">
								<p class="autor">por <br><span>Camila Nogueira</span></p>
								<h3>Penne com camarão <br> e salada especial 3</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nisi eveniet maiores laudantium error, repellendus ea dicta nesciunt.</p>
								<a href="#" class="sprite-1 ver-mais indent">ver mais</a>
							</li>
						</ul>
						</div>
					</div>
					<div class="c-link c-link-circulo">
						<ul>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="23" cy="23" r="20" class="border-opacity" />
									<circle cx="23" cy="23" r="20" class="border" />
									<circle cx="23" cy="23" r="6" fill="white" />
								</svg> 
							</a>
						</li>
						</ul>
					</div>
				</div>

				<div class="resultado">
					
				</div>

        	</div>

        	<aside id="sidebar-receita">
					<h3>Receitas</h3>
					<div class="sprite-1 busca-receita">
						<form action="" method="post">
							<input type="text" value="Digite sua busca">
							<input type="submit" value="buscar">
						</form>
					</div>
					<ul>
						<li>
							<a href="#" class="bt">Tipos de prato <span class="sprite-1 seta-baixo"></span></a>
							<ul class="submenu">
								<li><a href="#" class="filtro" data-filtro="tipo">Entrada</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Prato principal</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Sobremesa</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Lanche</a></li>
							</ul>
						</li>
						<li>
							<a href="#" class="bt">Por produtos <span class="sprite-1 seta-baixo"></span></a>
							<ul class="submenu">
								<li><a href="#" class="filtro" data-filtro="tipo">Entrada</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Prato principal</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Sobremesa</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Lanche</a></li>
							</ul>
						</li>
						<li>
							<a href="#" class="bt">Tempode preparo <span class="sprite-1 seta-baixo"></span></a>
							<ul class="submenu">
								<li><a href="#" class="filtro" data-filtro="tipo">Entrada</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Prato principal</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Sobremesa</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Lanche</a></li>
							</ul>
						</li>
						<li>
							<a href="#" class="bt">Nívelde dificuldade <span class="sprite-1 seta-baixo"></span></a>
							<ul class="submenu">
								<li><a href="#" class="filtro" data-filtro="tipo">Entrada</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Prato principal</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Sobremesa</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Lanche</a></li>
							</ul>
						</li>
						<li>
							<a href="#" class="bt">Favoritas <span class="sprite-1 seta-baixo"></span></a>
							<ul class="submenu">
								<li><a href="#" class="filtro" data-filtro="tipo">Entrada</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Prato principal</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Sobremesa</a></li>
								<li><a href="#" class="filtro" data-filtro="tipo">Lanche</a></li>
							</ul>
						</li>
					</ul>
				</aside>

        </section>

        <section class="aplicativos slide" data-url="dicas-e-aplicativos">
        	<h2 class="hidden">aplicativos</h2>
        	<a name="dicas-e-aplicativos" class="ancora"></a>

			<div class="banner" id="banner-aplicativo">	
				<div class="c-img">
					<ul>
						<li class="ativo" style="background-image: url(img/aplicativo-1.jpg)">
						</li>
						<li style="background-image: url(img/app-cozinha-vitarella.jpg)">
						</li>
					</ul>
				</div>
				<div class="c-txt">
					<ul>
						<li class="ativo">
							<span class="sprite-1 app-calculadora"></span>
							<h3>Calculadora de Festinha</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum nisi eveniet maiores laudantium error, repellendus ea dicta nesciunt.</p>
							<a href="#" class="sprite-1 ver-mais indent">ver mais</a>
						</li>
						<li>
							<span class="sprite-1 app-cozinha"></span>
							<h3>Cozinha Vitarella</h3>
							<p>Para compartilhar receitas deliciosas, <br>aprovadas pela Vitarella e com sua garantia <br>de qualidade e credibilidade.</p>
							<a href="#" class="sprite-1 ver-mais indent">ver mais</a>
						</li>
					</ul>
					<a href="#" class="sprite-1 seta-esq last">anterior</a>
					<a href="#" class="sprite-1 seta-dir-ativo next">próximo</a>
				</div>
				<a href="#" class="ver-todos" id="ver-todos-app"><span class="sprite-1 icon-mais"></span> Ver todos aplicativos</a>
			</div>

			<nav id="sidebar-app">
				<ul>
					<li class="ativo"><a href="#"><span class="sprite-1 app-calculadora2 ativo"></span><span class="txt">Calculadora <br>de festinha</span></a></li>
					<li><a href="#"><span class="sprite-1 app-cozinha2"></span><span class="txt">Cozinha Vitarella</span></a></li>
					<li><a href="#"><span class="sprite-1 app-receitas2"></span><span class="txt">Minhas Receitas <br><span class="amarelo">Em breve</span></span></a></li>
					<li><a href="#"><span class="sprite-1 app-lista2"></span><span class="txt">Lista de Compras <br><span class="amarelo">Em breve</span></span></a></li>
				</ul>
			</nav>
        </section>

        <section class="servicos">
        	<h2 class="hidden">sevicos</h2>
			<div class="banner" id="banner-servico">
				<div class="box">
					<a href="#" class="ver-todos-2"><span class="sprite-1 mais"></span> Ver todos os serviços</a>

					<div class="c-txt">
						<ul>
							<li>
							<h3>Como manter <br>a geladeira em ordem</h3>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
							<br>
							<a href="#" class="sprite-1 ver-mais-4">ver mais</a>
							</li>
						</ul>
					</div>

					<div class="c-link c-link-circulo">
						<ul>
						<li>
							<a href="#" class="anima">
								<svg height="46" width="46">
									<circle cx="20" cy="20" r="17" class="border-opacity" />
									<circle cx="20" cy="20" r="17" class="border" />
									<circle cx="20" cy="20" r="5" fill="#999999" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="20" cy="20" r="17" class="border-opacity" />
									<circle cx="20" cy="20" r="17" class="border" />
									<circle cx="20" cy="20" r="5" fill="#999999" />
								</svg> 
							</a>
						</li>
						<li>
							<a href="#">
								<svg height="46" width="46">
									<circle cx="20" cy="20" r="17" class="border-opacity" />
									<circle cx="20" cy="20" r="17" class="border" />
									<circle cx="20" cy="20" r="5" fill="#999999" />
								</svg> 
							</a>
						</li>
						</ul>
					</div>
				</div>

				<div class="box right">
					
					<!-- <img src="img/sevicos-2.jpg" alt="imagem"> -->
					<div class="c-img">
						<ul>
							<li><img src="img/sevicos-2.jpg" alt="imagem"></li>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
			</div>
        </section>

        <section class="noticias">
        	<h2 class="hidden">notícias</h2>
			<div class="banner" id="banner-noticia">
				<ul>
					<li>
						<div class="box">
							<img src="img/noticia-1.jpg" alt="imagem">
							<a href="#" class="sprite-1 play indent">vídeo</a>
						</div>
						<div class="box right">
							<a href="#" class="ver-todos-2"><span class="sprite-1 mais"></span> Ver todos as notícias</a>

							<div class="c-txt">
								<ul>
									<li>
									<h3>Campanha 20 anos <br>da Vitarella</h3>
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>
									<br>
									<a href="#" class="sprite-1 ver-mais-4">ver mais</a>
									</li>
								</ul>
							</div>

							<div class="c-link c-link-circulo">
								<ul>
								<li>
									<a href="#" class="anima">
										<svg height="46" width="46">
											<circle cx="20" cy="20" r="17" class="border-opacity" />
											<circle cx="20" cy="20" r="17" class="border" />
											<circle cx="20" cy="20" r="5" fill="#999999" />
										</svg> 
									</a>
								</li>
								<li>
									<a href="#">
										<svg height="46" width="46">
											<circle cx="20" cy="20" r="17" class="border-opacity" />
											<circle cx="20" cy="20" r="17" class="border" />
											<circle cx="20" cy="20" r="5" fill="#999999" />
										</svg> 
									</a>
								</li>
								<li>
									<a href="#">
										<svg height="46" width="46">
											<circle cx="20" cy="20" r="17" class="border-opacity" />
											<circle cx="20" cy="20" r="17" class="border" />
											<circle cx="20" cy="20" r="5" fill="#999999" />
										</svg> 
									</a>
								</li>
								</ul>
							</div>
						</div>
						<div class="clear"></div>
					</li>
				</ul>
			</div>
        </section>

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

        <script src="js/vendor/jquery-1.11.1.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/vendor/jquery-mousewheel.min.js"></script>
        <script src="js/vendor/jquery.touchSwipe.min.js"></script>
        <script src="js/vendor/jquery.nicescroll.min.js"></script>
        <script src="js/vendor/jquery-ui.min.js"></script>
        <script src="js/main.js?v=2"></script>

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
