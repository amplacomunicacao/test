<?php

class NossaFamilia extends Conexao{

	public function getTitulosPorCategoria(){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT cat_titulo, fam_titulo, fam_id FROM cms_familia_cat INNER JOIN cms_familia 
								ON cat_id = cms_familia_cat_cat_id");
								
		$stmt->execute();
		
		$ar = array();
		$i = 0;
		$cat = '';
		while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
						
			if ( $cat != '' and $cat != $rs['cat_titulo'] ) $i++;
				
			$cat = $rs['cat_titulo'];
			$ar[$i][] = $rs;
		}
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getTexto($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * FROM cms_familia WHERE fam_id = ?");
								
		$stmt->execute(array($id));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
}

?>