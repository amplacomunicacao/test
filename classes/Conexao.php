<?php

class Conexao {

	public function conecta(){
		
		$pdo = new PDO('mysql:host=187.45.196.228;dbname=vitarella', 'vitarella', 'ah91kQa0');
		// $pdo = new PDO('mysql:host=localhost;dbname=vitarella', 'root', '');
		$pdo->exec('SET CHARACTER SET utf8');
		return $pdo;
	}
	
}
?>
