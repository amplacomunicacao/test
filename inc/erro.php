<?php

function enviar_erro($errno, $errstr, $errfile, $errline, $errcontext){
	
	$html = "Nível de erro: $errno <br />";
	$html .= "Mensagem de erro: $errstr <br />";
	$html .= "Arquivo: $errfile <br />";
	$html .= "Linha: $errline <br />";
	// $html .= "Variáveis: " . var_export($errcontext, true) . " <br />";
	
	$header = "Mime-Version: 1.0 \r\n";
	$header .= "Content-Type: text/html; charset=utf8 \r\n";
	$header .= "From: Ampla <suporte@ampla.com.br> \r\n";
	
	@mail('marcelo.galvao@ampla.com.br', 'ERRO - VITARELLA', $html, $header);
}

set_error_handler('enviar_erro', E_WARNING);

?>