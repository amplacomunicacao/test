<?php

class Clipping extends Conexao{

	public function getClippings($limit = ''){
		
		$pdo = parent::conecta();
		
		if ($limit != ''){
			$sql = "SELECT *, DATE_FORMAT(cli_data, '%d.%m/%Y') AS notdata 
								FROM cms_clipping 
								WHERE cli_data <= '".date('Y-m-d')."' 
								ORDER BY cli_data DESC
								LIMIT $limit";
		}else{
			$sql = "SELECT *, DATE_FORMAT(cli_data, '%d.%m.%Y') AS notdata 
								FROM cms_clipping 
								WHERE cli_data <= '".date('Y-m-d')."' 
								ORDER BY cli_data DESC";
		}
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	
	public function getNovidades(){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT not_id AS id, not_titulo AS titulo, not_texto AS texto, 
					DATE_FORMAT(not_data, '%d/%m/%Y') AS datanoticia, DATE_FORMAT(not_data, '%Y-%m-%d %H:%i') AS datareal, 'noticia' AS tipo
					FROM cms_noticia 
					WHERE DATE_FORMAT(not_data, '%d/%m/%Y') <= '".date('d/m/Y')."' 
					UNION 
					SELECT twi_link AS id, twi_nome AS titulo, twi_texto AS texto, 
					DATE_FORMAT( STR_TO_DATE(twi_data,'%a, %d %b %Y %H:%i:%s') , '%d/%m/%Y') AS datanoticia, DATE_FORMAT( STR_TO_DATE(twi_data,'%a, %d %b %Y %H:%i:%s') , '%Y-%m-%d') AS datareal, 'twitter' AS tipo
					FROM cms_twitter
					
					ORDER BY datareal DESC 
					LIMIT 3";
		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	
	public function getClipping($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT *, DATE_FORMAT(cli_data, '%d.%m.%Y') AS notdata 
								FROM cms_clipping 
								WHERE cli_id = ?");
								
		$stmt->execute(array($id));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
}

?>