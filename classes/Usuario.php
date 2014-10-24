<?php

class Usuario extends Conexao{
	
	
	public function loginTwitter($nome, $email, $codigo){
		
		$pdo = parent::conecta();
		
		$rs = $this->getUsuarioFacebook($email, $codigo);
		
		if ( $rs == false ){
			
			if( $this->inserirTwitter($nome, $email, $codigo) )
				$rs = $this->getUsuarioFacebook($email, $codigo);
		}
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function loginFacebook($nome, $email, $codigo){
		
		$pdo = parent::conecta();
		
		$rs = $this->getUsuarioFacebook($email, $codigo);
		
		if ( $rs == false ){
			
			if( $this->inserirFacebook($nome, $email, $codigo) )
				$rs = $this->getUsuarioFacebook($email, $codigo);
		}
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function login($login, $senha){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT *  
								FROM cms_usuario_portal 
								WHERE por_login = ? AND por_senha = ?");
								
		$stmt->execute( array($login, sha1($senha) ) );
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getUsuarioFacebook($email, $codigo){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT *  
								FROM cms_usuario_portal 
								WHERE por_email = ? AND por_login = ?");
								
		$stmt->execute( array($email, $codigo) );
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	public function getUsuario($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT *  
								FROM cms_usuario_portal 
								WHERE por_id = ?");
								
		$stmt->execute( array($id) );
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getNome($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT por_nome  
								FROM cms_usuario_portal 
								WHERE por_id = ?");
								
		$stmt->execute( array($id) );
		
		if ( $stmt->rowCount() ){
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			$str = $rs['por_nome'];
		}else{
			$str = false;
		}
		
		$pdo = NULL;
		return $str;
	}
	
	
	public function inserirTwitter($nome, $email, $codigo){
		
		$pdo = parent::conecta();
				
		$stmt = $pdo->prepare("INSERT INTO cms_usuario_portal (por_nome, 
																por_email, 
																por_login, 
																por_twitter)
															
														VALUES(:nome, 
																:email, 
																:login, 
																:twitter)");
								
		$stmt->execute( array(':nome' => $nome, 
								':email' => $email, 
								':login' => $codigo, 
								':twitter' => 1 ) );
		
		$rs = ( $stmt->rowCount() ) ? true : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function inserirFacebook($nome, $email, $codigo){
		
		$pdo = parent::conecta();
				
		$stmt = $pdo->prepare("INSERT INTO cms_usuario_portal (por_nome, 
																por_email, 
																por_login, 
																por_facebook)
															
														VALUES(:nome, 
																:email, 
																:login, 
																:facebook)");
								
		$stmt->execute( array(':nome' => $nome, 
								':email' => $email, 
								':login' => $codigo, 
								':facebook' => 1 ) );
		
		$rs = ( $stmt->rowCount() ) ? true : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	public function inserir($post){
		
		$pdo = parent::conecta();
		
		extract($post);
		$rg = '';
		
		$stmt = $pdo->prepare("INSERT INTO cms_usuario_portal (por_nome, 
																por_email, 
																por_login, 
																por_senha, 
																por_data_nasc, 
																por_sexo, 
																por_uf, 
																por_cidade, 
																por_endereco, 
																por_telefone, 
																por_telefone_ddd,
																por_celular,
																por_celular_ddd, 
																por_newsletter, 
																por_rg, 
																por_cpf, 
																por_cep,
																por_redes)
															
														VALUES(:nome, 
																:email, 
																:login, 
																:senha, 
																:data_nasc,
																:sexo, 
																:uf, 
																:cidade, 
																:endereco, 
																:telefone, 
																:telefone_ddd,
																:celular, 
																:celular_ddd, 
																:newsletter, 
																:rg, 
																:cpf, 
																:cep,
																:redes)");
								
		$stmt->execute( array(':nome' => $nome, 
								':email' => $email, 
								':login' => $login, 
								':senha' => sha1($senha), 
								':data_nasc' => $this->dataIng($data_nascimento), 
								':sexo' => $sexo, 
								':uf' => $uf, 
								':cidade' => $cidade, 
								':endereco' => $endereco, 
								':telefone' => $telefone, 
								':telefone_ddd' => $telefone_ddd, 
								':celular' => $celular, 
								':celular_ddd' => $celular_ddd,
								':newsletter' => $newsletter,
								':rg' => $rg,
								':cpf' => $cpf,
								':cep' => $cep,
								':redes' => $redes_sociais ) );
		
		$rs = ( $stmt->rowCount() ) ? true : false;
		
		$pdo = NULL;
		return $rs;
	}	
	
	
	
	public function salvar($post){
		
		$pdo = parent::conecta();
		
		extract($post);
		$rg = '';
		
		// alterar senha
		if ( !empty($senha) ){
			$stmt = $pdo->prepare("UPDATE cms_usuario_portal SET por_senha = ? WHERE por_id = ?");
			$insert = $stmt->execute( array(sha1($senha), $codigo) );
			if ( !$insert ) return false;
			$stmt->closeCursor();
		}
		
		// outros dados
		$stmt = $pdo->prepare("UPDATE cms_usuario_portal SET por_nome = :nome, 
																por_email = :email, 
																por_login = :login,  
																por_data_nasc = :data_nasc, 
																por_sexo = :sexo, 
																por_uf = :uf, 
																por_cidade = :cidade, 
																por_endereco = :endereco, 
																por_telefone = :telefone, 
																por_telefone_ddd = :telefone_ddd, 
																por_celular = :celular, 
																por_celular_ddd = :celular_ddd, 
																por_newsletter = :newsletter, 
																por_rg = :rg, 
																por_cpf = :cpf, 
																por_cep = :cep, 
																por_redes = :redes
														WHERE por_id = :codigo");
								
		$insert = $stmt->execute( array(':nome' => $nome, 
								':email' => $email, 
								':login' => $login, 
								':data_nasc' => $this->dataIng($data_nascimento), 
								':sexo' => $sexo, 
								':uf' => $uf, 
								':cidade' => $cidade, 
								':endereco' => $endereco, 
								':telefone' => $telefone, 
								':telefone_ddd' => $telefone_ddd, 
								':celular' => $celular, 
								':celular_ddd' => $celular_ddd,
								':newsletter' => $newsletter, 
								':codigo' => $codigo,
								':rg' => $rg,
								':cpf' => $cpf,
								':cep' => $cep,
								':redes' => $redes_sociais ) );
		
		$rs = ( $insert ) ? true : false;
		
		$pdo = NULL;
		return $rs;
	}	
	
	
	// cadastrar email na TB newsltter
	public function inserirEmail($nome, $email){
		
		$pdo = parent::conecta();
				
		$stmt = $pdo->prepare("INSERT INTO cms_newsletter (new_nome, new_email) VALUES (?, ?)");
								
		$insert = $stmt->execute( array($nome, $email) );
		
		$rs = ( $insert ) ? true : false;
		
		$pdo = NULL;
		return $rs;
	}	
	
	// converte data br para eng
	public function dataIng($data){
		if ( !empty($data) ){
			$ex = explode("/",$data);
			$d = $ex[0];
			$m = $ex[1];
			$a = $ex[2];
			$data = "$a-$m-$d";
			return $data;
		}
	}
	
	
	// converte data eng para br
	public function dataBr($data){
		if ( !empty($data) ){
			$ex = explode("-",$data);
			$a = $ex[0];
			$m = $ex[1];
			$d = $ex[2];
			$data = "$d/$m/$a";
			return $data;
		}
	}
	
}

?>