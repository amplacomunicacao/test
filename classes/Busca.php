<?php

class Busca extends Conexao{
	
	
	public function getBuscaGeral($busca){
		
		$str = trim($busca);
		$str = $this->retirarAcento($str);
		$str = strtolower($str);

		$resultado = array();
		$ar = array();
		
		// fale-conosco
		foreach(glob('paginas/fale-conosco/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			$file = strtolower($file);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'estudantes.php': 
								$ar['secao'] = 'fale conosco - informações para estudantes';
								$ar['link'] = 'estudantes';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'perguntas.php': 
								$ar['secao'] = 'fale conosco - perguntas frequentes';
								$ar['link'] = 'perguntas-frequentes';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'contato-jornalistas.php': 
								$ar['secao'] = 'fale conosco - contato jornalistas';
								$ar['link'] = 'contato-jornalistas';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'sac.php': 
								$ar['secao'] = 'fale conosco - sac';
								$ar['link'] = 'sac';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'trabalhe-conosco.php': 
								$ar['secao'] = 'fale conosco - trabalhe conosco';
								$ar['link'] = 'trabalhe-conosco';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
						}		
			}
		}
		
		
		// mais gostosas
		foreach(glob('paginas/mais-gostosas/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'enviar-receita.php': 
								$ar['secao'] = 'as mais gostosas - enviar receita';
								$ar['link'] = 'enviar-receita';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'participar.php': 
								$ar['secao'] = 'as mais gostosas - como participar do concurso';
								$ar['link'] = 'concurso-como-participar';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'regulamento.php': 
								$ar['secao'] = 'as mais gostosas - regulamento do concurso';
								$ar['link'] = 'concurso-regulamento';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
						}		
			}
		}
		
		
		// nossa-familia
		foreach(glob('paginas/nossa-familia/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'almoco.php': 
								$ar['secao'] = 'cuidando de nossa família - almoço em família';
								$ar['link'] = 'almoco-em-familia';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'cardapio.php': 
								$ar['secao'] = 'cuidando de nossa família - fazendo o cardápio da semana/mês';
								$ar['link'] = 'fazendo-cardapio-do-mes';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'compras.php': 
								$ar['secao'] = 'cuidando de nossa família - faça sua lista de compras';
								$ar['link'] = 'lista-de-compras';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;						
							case 'festa-em-familia.php': 
								$ar['secao'] = 'cuidando de nossa família - festa em família';
								$ar['link'] = 'festa-em-familia';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;						
							case 'despensa.php': 
								$ar['secao'] = 'cuidando de nossa família - como manter a despensa organizada';
								$ar['link'] = 'despensa-organizada';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;						
							case 'geladeira.php': 
								$ar['secao'] = 'cuidando de nossa família - como manter a geladeira em ordem';
								$ar['link'] = 'geladeira-organizada';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'nossa-familia.php': 
								$ar['secao'] = 'cuidando de nossa família';
								$ar['link'] = 'cuidando-de-nossa-familia';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
						}		
			}
		}
		
		
		// para-voce
		foreach(glob('paginas/para-voce/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'aplicativos.php': 
								$ar['secao'] = 'para você - aplicativos';
								$ar['link'] = 'aplicativos';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'calculadora.php': 
								$ar['secao'] = 'para você - calculadora de festinha';
								$ar['link'] = 'calculadora-de-festinha';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'emoticon.php': 
								$ar['secao'] = 'para você - emoticons';
								$ar['link'] = 'emoticons';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'para-voce.php': 
								$ar['secao'] = 'para você';
								$ar['link'] = 'para-voce';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'screensaver.php': 
								$ar['secao'] = 'para você - protetor de tela';
								$ar['link'] = 'protetor-de-tela';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'wallpaper.php': 
								$ar['secao'] = 'para você - papel de parede';
								$ar['link'] = 'papel-de-parede';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							}
			}
		}
		
		
		// sobre
		foreach(glob('paginas/sobre/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'acoes-sociais.php': 
								$ar['secao'] = 'sobre a vitarella - ações sociais';
								$ar['link'] = 'acoes-sociais';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'area-de-atuacao.php': 
								$ar['secao'] = 'sobre a vitarella - área de atuação';
								$ar['link'] = 'area-de-atuacao';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'historia.php': 
								$ar['secao'] = 'sobre a vitarella - nossa história';
								$ar['link'] = 'historia';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;		
							case 'premios.php': 
								$ar['secao'] = 'sobre a vitarella - prêmios';
								$ar['link'] = 'premios';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;	
							case 'sobre.php': 
								$ar['secao'] = 'sobre a vitarella';
								$ar['link'] = 'sobre';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
							case 'eventos.php': 
								$ar['secao'] = 'sobre a vitarella - eventos';
								$ar['link'] = 'eventos';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
						}
			}
		}
		
		// imprensa
		foreach(glob('paginas/imprensa/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						switch( basename($arquivo) ){
							case 'clippings.php': 
								$ar['secao'] = 'imprensa - clippings';
								$ar['link'] = 'clippings';
								$ar['total'] = substr_count($file, $str);
								$resultado[] = $ar;
								break;
						}
			}
		}
		
		
		// eventos
		/*foreach(glob('paginas/eventos/*.php') as $arquivo){
		
			$file = file_get_contents($arquivo);
			
			if ( substr_count($file, $str) != false ){
					
						$arquivo = $arquivo;
						$ar['secao'] = 'sobre a vitarella - eventos';
						$ar['link'] = 'acoes-sociais';
						$ar['total'] = substr_count($file, $str);
						$resultado[] = $ar;
			}
		}
		*/
		
		return $resultado;
	}
	
	
	
	// retirar acento
	public function retirarAcento($texto){
	
	  $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
						 , "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü");
	  $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
						 , "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U");
	  
	  // retira acentos
	  $texto = str_replace($array1, $array2, $texto);
	  return $texto;	
	}
	
	
}

?>