<?php

class Produto extends Conexao{
	
	
	public function getDestaque(){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.*, b.cat_nome, c.sub_nome 
								FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
								LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
								WHERE pro_destaque = ? 
								ORDER BY pro_id ASC");
								
		$stmt->execute(array(1));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getDestaqueOutros($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.*, b.cat_nome, c.sub_nome 
								FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
								LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
								WHERE pro_destaque = ? 
								AND pro_id != ? 
								ORDER BY pro_id ASC");
								
								
								
		$stmt->execute( array(1, $id) );
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getProduto($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.*, b.cat_nome, c.sub_nome
									FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
									LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
									WHERE pro_id = ? 
									ORDER BY cat_nome ASC, sub_nome ASC, pro_nome ASC");
								
		$stmt->execute(array($id));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public static function getProdutoDescricao($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.pro_nome, a.pro_descricao, b.cat_nome, c.sub_nome
									FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
									LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
									WHERE pro_id = ? ");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return '';
		
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($rs['cat_nome'] == 'Maria e Maizena')
			$str = $rs['pro_nome'] . ' : ' . $rs['pro_descricao'];
		else
			$str = $rs['cat_nome'] . ' ' . $rs['sub_nome'] . ' ' . $rs['pro_nome'] . ' : ' . $rs['pro_descricao']; 
		
		$pdo = NULL;
		return $str;
	}
	
	
	public function getSugestao($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_produto_sugestao 
								WHERE cms_produto_pro_id = ?");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getProdutosCat($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.*, b.cat_nome, c.sub_nome
									FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
									LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
									WHERE a.cms_produto_cat_cat_id = ?
									ORDER BY cat_nome ASC, sub_nome ASC, pro_nome ASC");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getBusca(){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT a.*, b.cat_nome, c.sub_nome
									FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
									LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id 
									WHERE a.pro_nome LIKE :busca
									OR b.cat_nome LIKE :busca
									OR c.sub_nome LIKE :busca
									ORDER BY cat_nome ASC, sub_nome ASC, pro_nome ASC");
								
		$stmt->execute(array(':busca' => "%{$_POST['busca']}%"));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getCategoria($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT cat_nome  
								FROM cms_produto_cat 
								WHERE cat_id = ?");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
		$str = $rs['cat_nome'];
		
		$pdo = NULL;
		return $str;
	}
	
	
	public function getCategoriaAndSubcategoria($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT cat_nome, sub_nome 
								FROM cms_produto_cat_sub INNER JOIN cms_produto_cat 
								ON cms_produto_cat_cat_id = cat_id 
								WHERE sub_id = ?");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$rs = $stmt->fetch(PDO::FETCH_ASSOC);
		$ar['categoria'] = $rs['cat_nome'];
		$ar['subcategoria'] = $rs['sub_nome'];
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getProdutosSubcat($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_produto 
								WHERE cms_produto_cat_sub_sub_id = ?");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	
	public function getNutricao($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * FROM cms_produto_nutricao WHERE cms_produto_pro_id = ?");
								
		$stmt->execute(array($id));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getNutricaoItem($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * FROM cms_produto_nutricao_item WHERE cms_produto_nutricao_nut_id = ? ORDER BY ite_id ASC");
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getPdf($idcat){
		
		switch($idcat){
			// massas
			case 1: $url = __URL . 'externos/pdf/massas.pdf'; break;
			// maria e maizena
			case 2: $url = __URL . 'externos/pdf/mariaemaizena.pdf'; break;
			// wafer
			case 3: $url = __URL . 'externos/pdf/wafer.pdf'; break;
			// amanteigados
			case 4: $url = __URL . 'externos/pdf/amanteigados.pdf'; break;
			// cream cracker
			case 5: $url = __URL . 'externos/pdf/creamcracker.pdf'; break;
			// rosquinhas
			case 6: $url = __URL . 'externos/pdf/rosquinhas.pdf'; break;
			// biscoitos salgados
			case 7: $url = __URL . 'externos/pdf/salgados.pdf'; break;
			// recheados
			case 8: $url = __URL . 'externos/pdf/recheados.pdf'; break;
			// sequilhos
			case 9: $url = __URL . 'externos/pdf/sequilhos.pdf'; break;
			// coquinho
			case 12: $url = __URL . 'externos/pdf/coquinho.pdf'; break;
		}
		
		return $url;
	}
	
}

?>