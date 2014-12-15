<?php

class Paginas{

	static function getPagina($i){

		switch($i){
			case 'imprensa': include 'paginas/imprensa/noticias.php'; break;
			case 'fale-conosco': include 'paginas/fale-conosco/fale-conosco.php'; break;
			case 'sobre': include 'paginas/sobre/sobre.php'; break;
			case 'nossa-historia': include 'paginas/sobre/nossa-historia.php'; break;
			case 'missao-e-valores': include 'paginas/sobre/missao-e-valores.php'; break;
			case 'area-de-atuacao': include 'paginas/sobre/area-de-atuacao.php'; break;
			case 'premios': include 'paginas/sobre/premios.php'; break;
			case 'acoes-sociais': include 'paginas/sobre/acoes-sociais.php'; break;
			case 'eventos': include 'paginas/sobre/eventos.php'; break;
			default : include 'paginas/home.php'; break;
		}
	}




	// retirar caracteres especiais
	static function retirarCaracteres($texto){

	  $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
						 , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"," ");
	  $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
						 , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "-");

	  // retira acentos
	  $texto = str_replace($array1, $array2, $texto);

	  // retira caracteres especiais
	  $texto = preg_replace("([^a-zA-Z0-9_-])", "", $texto);

	  // retorna minusculo
	  return strtolower($texto);

	}


	static function metaDescricao($i){

		switch($i){
			case 'cuidando-de-nossa-familia':
					$descricao = 'Soluções preparadas pela Vitarella para facilitar e organizar sua vida, como ajudar a organizar os encontros em família ou entre amigos, como almoços, jantares ou outro evento: você vai poder incorporar uma receita, definir um lugar, além de escolher o horário e enviar os convites de uma forma prática e rápida para todos; além disso, você vai ter uma ferramenta para organizar o cardápio da sua casa, podendo definir o tipo da refeição e o período (semana ou mês); vai poder contar com dicas de como organizar sua geladeira da melhor forma. Tudo pensado com muito carinho para você e sua família.';
					break;
			case 'para-voce':
					$descricao = 'Arquivos e aplicativos pensando em você. Entre eles os jogos da turma do Biscoito Treloso e a Calculadora de Festinha, que permite saber a quantidade exata de cada ingrediente, para você servir na sua festa.';
					break;
			case 'mais-gostosas':
					$descricao = 'As melhores receitas com produtos Vitarella. Receitas deliciosas, feitas com todo carinho para você. Enviadas pelos consumidores, por Chefs renomados e também receitas da Associação Brasileira das Indústrias de Massas Alimentícias, a ABIMA.';
					break;
			case 'produto-subcategoria':
			case 'produto-categoria':
			case 'produtos':
					$descricao = 'Todos os produtos da Vitarella, com a qualidade que você conhece, feitos com todo carinho. Massas, biscoito maria, maizena, os amanteigados, as deliciosas cream crackers, os biscoitos salgados, os sequilhos, as rosquinhas e toda a família Treloso e Chocoresco.';
					break;
			case 'produto':
					$descricao = Produto::getProdutoDescricao( intval($_GET['cod']) );
					break;
			case 'fale-conosco':
					$descricao = 'Entre em contato com a Vitarella. Leia as perguntas freqüentes, entre em contato com o SAC ou acesse as informações para estudantes. Também com área para contato para jornalistas, representantes e pessoas interessadas em trabalhar na Vitarella.';
					break;
			case 'imprensa':
					$descricao = 'Tudo o que sai na imprensa sobre a Vitarella, seus produtos, eventos e campanhas.';
					break;
			case 'sobre':
					$descricao = 'Fundada no ano de 1993, em Jaboatão dos Guararapes, a Vitarella sempre investiu na excelência e na diversidade dos seus produtos e, como não poderia deixar de ser, o resultado apareceu rápido. O que era apenas uma fábrica de massas, hoje se estende para mais de cem itens entre wafers, recheados, amanteigados, sequilhos, cream crackers e massas. Por trabalhar pensando sempre em você, com todo carinho, conquistamos a confiança dos nossos consumidores. Conheça mais da nossa história, veja a área de atuação, saiba quais prêmios nós conquistamos, quais ações sociais apoiamos, os eventos que participamos e as nossas campanhas.';
					break;
			default :
					$descricao = 'No mercado desde 1993, a Vitarella se destaca como uma marca de sucesso no meio da indústria de alimentos. Líder de mercado, a empresa pernambucana conta com uma vasta linha de produtos.';
					break;
		}

		return $descricao;
	}



}