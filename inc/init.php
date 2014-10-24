<?php

/* configuracoes */
error_reporting(E_ALL);
session_start();

setlocale(LC_ALL, 'pt_BR', 'ptb', 'PT_BR.UTF8');
date_default_timezone_set('America/Recife');

/* define url root */
define('__URL', 'http://'.$_SERVER['HTTP_HOST'].'/vitarella_site_novo/');

/* define site path */
// $site_path = realpath(dirname(__FILE__));
// $site_path = $_SERVER['DOCUMENT_ROOT'] . "\\classes\\" ;
// ini_set('include_path',  ini_get('include_path') . PATH_SEPARATOR . $site_path);

function __autoload($classe){
	if(file_exists("classes/$classe.php")){
		include "classes/$classe.php";
	
	}else if(file_exists("../classes/$classe.php")){
		include "../classes/$classe.php";
	}	
}