<?php

class Receita extends Conexao{
	
	
	public function getDestaque(){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_destaque = ?");
								
		$stmt->execute(array(1));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getDestaqueOutros($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_destaque = ? 
								AND rec_id != ? 
								ORDER BY rec_id DESC");
								
		$stmt->execute( array(1, $id) );
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getReceita($id){
		
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_id = ?");
								
		$stmt->execute(array($id));
		
		$rs = ( $stmt->rowCount() ) ? $stmt->fetch(PDO::FETCH_ASSOC) : false;
		
		$pdo = NULL;
		return $rs;
	}
	
	
	public function getReceitas(){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_receita 
					ORDER BY rec_titulo ASC";
		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getReceitasCardapio(){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_receita 
					WHERE rec_enviada != 1 AND rec_enviada2012 != 1
					ORDER BY rec_titulo ASC";
		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getReceitasCaderno(){
		
		if ( empty($_SESSION['portal_usuario']) ) return false;
		
		$pdo = parent::conecta();
		
			$sql = "SELECT a.* 
					FROM cms_receita a INNER JOIN cms_usuario_portal_has_cms_receita b
					ON a.rec_id = b.cms_receita_rec_id
					WHERE b.cms_usuario_portal_por_id = ? 
					ORDER BY a.rec_id DESC";
		
		
		$stmt = $pdo->prepare($sql);
		
		$stmt->execute( array($_SESSION['portal_usuario']['id']) );
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getBusca($limit = false){
		
		extract($_POST);
		
		// $_SESSION['busca']['busca'] = $busca;
		// $_SESSION['busca']['categoria'] = $categoria;
		// var_dump($categoria);
		
		$pdo = parent::conecta();
		
		/*if ( !empty($ordem) ){
			
			if (!empty($ordem) and $ordem == 'voto'){
				$ordem = 'ORDER BY rec_voto DESC';
				$_SESSION['receitas_ordem'] = 'voto';
			}else{
				$ordem = 'ORDER BY rec_id DESC';
				$_SESSION['receitas_ordem'] = 'data';
			}		

		}else{
			if ($_SESSION['receitas_ordem'] == 'voto'){
				$ordem = 'ORDER BY rec_voto DESC';
			}else{
				$ordem = 'ORDER BY rec_id DESC';
			}
		}*/
		$ordem = 'ORDER BY rec_colocacao ASC, titulo ASC';
		
		// monta query
		$query = '';
		$param = array();
		
		if ( !empty($busca) ){
			$query .= " AND rec_titulo LIKE :titulo ";
			$param[':titulo'] = "%$busca%";
		}
		
		if ( isset($categoria) ){
			
			if ( count($categoria) == 1 ){
				$query .= ' AND cms_receitas_cat_cat_id = :categoria';
				$param[':categoria'] = $categoria[0];
				
			}else{
				$query .= ' AND (';
				
				$total = count($categoria);
				for($x = 0; $x < $total; $x++){
				
					$query .= ' cms_receitas_cat_cat_id = :categoria'.$x;
					$param[':categoria'.$x] = $categoria[$x];
					if ($total > $x+1) $query .= ' OR ';
				}
				
				$query .= ')';
			}
			
		}
		
		$_SESSION['receitas_busca']['tipo_prato'] = $tipo_prato;
		if ( !empty($tipo_prato) ){
			$query .= ' AND cms_tipo_prato_pra_id = :prato ';
			$param[':prato'] = $tipo_prato;
		}
		
		$_SESSION['receitas_busca']['modo_preparo'] = $modo_preparo;
		if ( !empty($modo_preparo) ){
			$query .= ' AND cms_modo_preparo_pre_id = :modo_preparo ';
			$param[':modo_preparo'] = $modo_preparo;
		}
		
		$_SESSION['receitas_busca']['produto_receita'] = $produto_receita;
		if ( !empty($produto_receita) ){
			$query .= ' AND rec_id IN (SELECT cms_receita_rec_id FROM cms_produto_has_receita WHERE cms_produto_pro_id = :produto ) ';
			$param[':produto'] = $produto_receita;
		}
		
		
		if ( isset($tempo1) ){
			$query .= ' AND rec_tempo_hora < 1 AND rec_tempo_minuto <= 30';
		}
		
		if ( isset($tempo2) ){
			$query .= ' AND rec_tempo_hora = 1 OR (rec_tempo_hora <= 1 AND rec_tempo_minuto >= 30)';
		}
		
		if ( isset($tempo3) ){
			$query .= ' AND rec_tempo_hora > 1 ';
		}
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			
			$_SESSION['receitas_busca']['query'] = $query;
			$_SESSION['receitas_busca']['param'] = $param;
			$_SESSION['receitas_busca']['cozinha_premiada'] = $cozinha_premiada;
			$_SESSION['receitas_busca']['busca'] = $busca;	
			
		}else{
			$query = $_SESSION['receitas_busca']['query'];
			$param = $_SESSION['receitas_busca']['param'];
			$cozinha_premiada = $_SESSION['receitas_busca']['cozinha_premiada'];
		}
		
		
		// --
		if ($limit !== false){
			
			if ( !empty($cozinha_premiada) ){
				$sql = "SELECT *, LTRIM(rec_titulo) AS titulo 
							FROM cms_receita 
							WHERE rec_enviada2012 = 1 AND rec_aprovada = 1 $query
							$ordem
							LIMIT $limit ";
			}else{
				$sql = "SELECT *, LTRIM(rec_titulo) AS titulo 
							FROM cms_receita 
							WHERE rec_enviada2012 = 0 $query
							$ordem
							LIMIT $limit ";
			}
			
		}else{
			if ( !empty($cozinha_premiada) ){
				$sql = "SELECT *, LTRIM(rec_titulo) AS titulo 
							FROM cms_receita 
							WHERE rec_enviada2012 = 1 AND rec_aprovada = 1 $query
							$ordem";
			}else{
				$sql = "SELECT *, LTRIM(rec_titulo) AS titulo 
							FROM cms_receita 
							WHERE rec_enviada2012 = 0 $query
							$ordem";
			}
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute($param);
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	
	public function getBuscaPaginas(){
		
		$pdo = parent::conecta();
		
		// monta query
		$query = '';
		$param = array();
		
		if ( !empty($_SESSION['receitas_busca']['cozinha_premiada']) ){
			$sql = "SELECT rec_id 
						FROM cms_receita 
						WHERE rec_enviada2012 = 1 AND rec_aprovada = 1 ".$_SESSION['receitas_busca']['query'];
		}else{
			$sql = "SELECT rec_id 
						FROM cms_receita 
						WHERE rec_enviada2012 = 0 ".$_SESSION['receitas_busca']['query'];
		}
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute($_SESSION['receitas_busca']['param']);
		
		if ( !$stmt->rowCount() ) 
			return false;
		else
			return $stmt->rowCount()/13;
	}
	
	
	
	public function getBuscaGeral(){
		
		extract($_POST);
		
		$pdo = parent::conecta();
		
		// receitas enviadas
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								INNER JOIN cms_usuario_portal ON cms_usuario_portal_por_id = por_id 
								WHERE rec_aprovada = 1 AND (rec_titulo LIKE ? OR rec_autor LIKE ? OR por_nome LIKE ? )");
		
		$stmt->execute( array("%$busca%", "%$busca%", "%$busca%") );
		
		$ar = array();
		if ( $stmt->rowCount() > 0 )
			while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$stmt->closeCursor();
		
		// receitas nao enviadas
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_enviada != 1 AND rec_enviada2012 != 1 AND rec_titulo LIKE ? ");
		
		$stmt->execute( array("%$busca%") );
		
		if ( $stmt->rowCount() > 0 )
			while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		
		if ( empty($ar) ) return false;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getBuscaParticipantes($limit = false){
		
		extract($_POST);
		
		$pdo = parent::conecta();
		
		if ( !empty($ordem) ){
			
			if (!empty($ordem) and $ordem == 'voto'){
				$ordem = 'ORDER BY rec_voto DESC';
				$_SESSION['receitas_ordem'] = 'voto';
			}else{
				$ordem = 'ORDER BY rec_id DESC';
				$_SESSION['receitas_ordem'] = 'data';
			}		

		}else{
			if ($_SESSION['receitas_ordem'] == 'voto'){
				$ordem = 'ORDER BY rec_voto DESC';
			}else{
				$ordem = 'ORDER BY rec_id DESC';
			}
		}
		
		if ($limit !== false){
			
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_enviada2012 = 1 
								AND rec_aprovada = 1
								$ordem 
								LIMIT $limit ");
		}else{
			
			$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_enviada2012 = 1 
								AND rec_aprovada = 1
								$ordem");
		}
		
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getBuscaParticipantesPaginas(){
				
		$pdo = parent::conecta();
		
		$stmt = $pdo->prepare("SELECT * 
								FROM cms_receita 
								WHERE rec_enviada2012 = 1 
								AND rec_aprovada = 1
								ORDER BY rec_id DESC");
		
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) 
			return false;
		else
			return $stmt->rowCount()/13;
	}
	
	
	public function getMaisVotadas(){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_receita 
					WHERE rec_enviada2012 = 1 
					ORDER BY rec_voto DESC
					LIMIT 3";
		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getCategorias(){
		
		$pdo = parent::conecta();
		
		$sql = "SELECT * FROM cms_receitas_cat WHERE cat_id != 5 ORDER BY cat_titulo ASC";
				
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getTipoPrato(){
		
		$pdo = parent::conecta();
		
		$sql = "SELECT * FROM cms_tipo_prato ORDER BY pra_descricao ASC";
				
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getModoPreparo(){
		
		$pdo = parent::conecta();
		
		$sql = "SELECT * FROM cms_modo_preparo ORDER BY pre_descricao ASC";
				
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getProdutos(){
		
		$pdo = parent::conecta();
		
		$sql = "SELECT a.*, b.cat_nome, c.sub_nome
				FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
				LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id
				ORDER BY cat_nome ASC, sub_nome ASC, pro_nome ASC";
								
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getProdutosMenu(){
		
		$pdo = parent::conecta();
		
		$sql = "SELECT a.*, b.cat_nome, c.sub_nome
				FROM cms_produto a LEFT OUTER JOIN cms_produto_cat b ON cms_produto_cat_cat_id = cat_id 
				LEFT OUTER JOIN cms_produto_cat_sub c ON cms_produto_cat_sub_sub_id = sub_id
				WHERE pro_id IN (SELECT cms_produto_pro_id FROM cms_produto_has_receita) 
				ORDER BY cat_nome ASC, sub_nome ASC, pro_nome ASC";
								
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute();
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getReceitasRelacionadas($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT rec_id, rec_titulo, rec_imagem  
					FROM cms_receita INNER JOIN cms_receita_has_receita
					ON rec_id = cms_receita_rec_id 
					WHERE cms_receita_rec_id_1 = ?
					LIMIT 3";		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getComentarioReceita($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT a.*, TIME(a.com_data) AS horario, DATE_FORMAT( DATE(a.com_data), '%d/%m/%Y' ) AS dia, b.por_nome   
					FROM cms_receita_coment a INNER JOIN cms_usuario_portal  b
					ON cms_usuario_portal_por_id = por_id 
					WHERE cms_receita_rec_id = ? 
					AND com_aprovado = 1 
					ORDER BY com_id DESC";		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getIngredientes($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_ingrediente 
					WHERE cms_receita_rec_id = ? 
					ORDER BY ing_id ASC";	
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getModoPreparoReceita($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_preparo 
					WHERE cms_receita_rec_id = ? 
					ORDER BY pre_id ASC";	
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getModoPreparoPassos($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_preparo_passo 
					WHERE cms_preparo_pre_id = ? 
					ORDER BY pas_id ASC";	
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function getReceitasPorProduto($id){
		
		$pdo = parent::conecta();
		
			$sql = "SELECT * 
					FROM cms_receita INNER JOIN cms_produto_has_receita
					ON rec_id = cms_receita_rec_id
					WHERE cms_produto_pro_id = ?
					ORDER BY rec_voto DESC
					LIMIT 3";
		
		
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array($id));
		
		if ( !$stmt->rowCount() ) return false;
		
		$ar = array();
		while ( $rs = $stmt->fetch(PDO::FETCH_ASSOC) ) $ar[] = $rs;
		
		$pdo = NULL;
		return $ar;
	}
	
	
	public function enviaReceita($post){
	
		extract($post);
		
		$pdo = parent::conecta();
		
		$sql = "INSERT INTO cms_receita (cms_usuario_portal_por_id, 
													cms_receitas_cat_cat_id, 
													cms_modo_preparo_pre_id, 
													cms_tipo_prato_pra_id, 
													rec_titulo, 
													rec_tempo,  
													rec_rendimento, 
													rec_autor, 
													rec_enviada, 
													cms_produto_pro_id, 
													rec_dica, 
													rec_acompanhamento, 
													rec_enviada2012) 
													
											VALUES (:codigo, 
													:categoria, 
													:modo_preparo, 
													:tipo_prato, 
													:titulo, 
													:tempo, 
													:rendimento, 
													:autor, 
													:enviada, 
													:produto, 
													:dica, 
													:acompanhamento,
													1)";
	
		$stmt = $pdo->prepare($sql);
								
		$stmt->execute(array(':codigo' => $idusuario,
							':categoria' => 5, 
							':modo_preparo' => $modo_preparo, 
							':tipo_prato' => 6, 
							':titulo' => $titulo,  
							':tempo' => $tempo, 
							':rendimento' => $rendimento, 
							':autor' => $autor, 
							':enviada' => 1, 
							':produto' => $produto, 
							':dica' => $dicas, 
							':acompanhamento' => $acompanhamento));
		
		if ( !$stmt->rowCount() ) return false;
				
		$id = $pdo->lastInsertId();
		
		$stmt->closeCursor();
		
		
		// produto relacionado
		if ( !empty($produto) ){
			
			$stmt = $pdo->prepare("INSERT INTO cms_produto_has_receita (cms_receita_rec_id, 
																		cms_produto_pro_id) 
																		
																VALUES (?, ?)");
														
			$stmt->execute( array($id, $produto) );
						
			if ( !$stmt->rowCount() ) return false;
			$stmt->closeCursor();
		}
		
		
		// ingredientes
		$total = count($medida);
		for($x = 0; $x < $total; $x++){
			
			if ( !empty($ingrediente[$x]) ){
				$stmt = $pdo->prepare("INSERT INTO cms_ingrediente (cms_receita_rec_id, 
																	ing_quantidade, 
																	ing_descricao,
																	ing_medida) 
																	
															VALUES (?, ?, ?, ?)");
															
				$stmt->execute( array($id, $quantidade[$x], $ingrediente[$x], $medida[$x]) );
							
				if ( !$stmt->rowCount() ) return false;
				$stmt->closeCursor();
			}
		}
		
		
		// modo de preparo
		if ( !empty($passo) ){
			
			$stmt = $pdo->prepare("INSERT INTO cms_preparo (cms_receita_rec_id, pre_titulo) 																
													VALUES (?, ?)");
			
			$stmt->execute( array($id, 'Receita') );
			
			if ( !$stmt->rowCount() ) return false;
	
			$idPre = $pdo->lastInsertId();
			
			$stmt->closeCursor();
			
			$total = count($passo);
			for($i = 0; $i < $total; $i++){
				
				if ( !empty($passo[$i]) ) {
				
					$stmt = $pdo->prepare("INSERT INTO cms_preparo_passo (cms_preparo_pre_id, pas_descricao ) 											
																	VALUES (?, ?)");
					$stmt->execute( array($idPre, $passo[$i]) );
			
					if ( !$stmt->rowCount() ) return false;
					$stmt->closeCursor();
				}
			}
		}
		
				
		return true;
	}
	
	
	
	public function enviaComentario($post){
	
		extract($post);
		
		$pdo = parent::conecta();
	
		$stmt = $pdo->prepare("INSERT INTO cms_receita_coment (cms_usuario_portal_por_id, cms_receita_rec_id, com_texto) 
														VALUES (?, ?, ?)");
								
		$stmt->execute(array( $_SESSION['portal_usuario']['id'], intval($_GET['cod']), $comentario));
		
		if ( !$stmt->rowCount() ) return false;
				
		$id = $pdo->lastInsertId();
		
		$stmt->closeCursor();
		
		
				
		return true;
	}
	
	
	public function linksPaginacao($paginas, $pag_atual){
	
		//mostro os diferentes índices das páginas, se é que há várias páginas
		if ($paginas> 1){ 
			
			//se a pag atual for menor q 10 comeca do 0
			if ( $pag_atual <= 6){
			
				for ($i=1;$i<=$paginas;$i++){ 
				   		
						if ($i == 8){
							echo "<span style=\"color:#FFFAB6\">...</span> <a href=\"".__URL."concurso-receitas-participantes/".$paginas."\">".$paginas."</a> ";
							break;
						}
						
					   if ($pag_atual == $i){
						  //se mostro o índice da página atual, não coloco link
						  echo "<a href=\"".__URL."concurso-receitas-participantes/$i\" class=\"active\">$i</a> ";
					   }else{
						  //se o índice não corresponde com a página mostrada atualmente, coloco o link para ir a essa página
						  echo "<a href=\"".__URL."concurso-receitas-participantes/$i\">$i</a> ";
					   }
				}
			
			}else{
				
				if ( $paginas > ($pag_atual+6) ){
					
					echo "<a href=\"".__URL."concurso-receitas-participantes/1\">1</a> ";
					echo '<span style="color:#FFFAB6">...</span> ';
					$x = $pag_atual+5;
					
				}else if ( $paginas > 8 ){
					
					echo "<a href=\"".__URL."concurso-receitas-participantes/1\">1</a> ";
					echo '<span style="color:#FFFAB6">...</span> ';
					$x = $paginas;
					
				}else{
					$x = $paginas;
				}
				
				for ($i = ($pag_atual-4) ; $i <= $x ; $i++){ 

						
						if ( $i == ($pag_atual+4) ){
							echo "<span style=\"color:#FFFAB6\">...</span> <a href=\"".__URL."concurso-receitas-participantes/".$paginas."\">".$paginas."</a> ";
							break;
						}
						
					   if ($pag_atual == $i){
						  //se mostro o índice da página atual, não coloco link
						  echo "<a href=\"".__URL."concurso-receitas-participantes/$i\" class=\"active\">$i</a> ";
					   }else{
						  //se o índice não corresponde com a página mostrada atualmente, coloco o link para ir a essa página
						  echo "<a href=\"".__URL."concurso-receitas-participantes/$i\">$i</a> ";
					   }
				}
			
			}//fim else

		} //fim primeiro if		
	}
	
	
	
	
	public function linksPaginacaoBusca($paginas, $pag_atual){
	
		//mostro os diferentes índices das páginas, se é que há várias páginas
		if ($paginas> 1){ 
			
			//se a pag atual for menor q 10 comeca do 0
			if ( $pag_atual <= 6){
			
				for ($i=1;$i<=$paginas;$i++){ 
				   		
						if ($i == 8){
							echo "<span style=\"color:#FFFAB6\">...</span> <a href=\"".__URL."mais-gostosas-busca/".$paginas."\">".$paginas."</a> ";
							break;
						}
						
					   if ($pag_atual == $i){
						  //se mostro o índice da página atual, não coloco link
						  echo "<a href=\"".__URL."mais-gostosas-busca/$i\" class=\"active\">$i</a> ";
					   }else{
						  //se o índice não corresponde com a página mostrada atualmente, coloco o link para ir a essa página
						  echo "<a href=\"".__URL."mais-gostosas-busca/$i\">$i</a> ";
					   }
				}
			
			}else{
				
				if ( $paginas > ($pag_atual+6) ){
					
					echo "<a href=\"".__URL."mais-gostosas-busca/1\">1</a> ";
					echo '<span style="color:#FFFAB6">...</span> ';
					$x = $pag_atual+5;
					
				}else if ( $paginas > 8 ){
					
					echo "<a href=\"".__URL."mais-gostosas-busca/1\">1</a> ";
					echo '<span style="color:#FFFAB6">...</span> ';
					$x = $paginas;
					
				}else{
					$x = $paginas;
				}
				
				for ($i = ($pag_atual-4) ; $i <= $x ; $i++){ 

						
						if ( $i == ($pag_atual+4) ){
							echo "<span style=\"color:#FFFAB6\">...</span> <a href=\"".__URL."mais-gostosas-busca/".$paginas."\">".$paginas."</a> ";
							break;
						}
						
					   if ($pag_atual == $i){
						  //se mostro o índice da página atual, não coloco link
						  echo "<a href=\"".__URL."mais-gostosas-busca/$i\" class=\"active\">$i</a> ";
					   }else{
						  //se o índice não corresponde com a página mostrada atualmente, coloco o link para ir a essa página
						  echo "<a href=\"".__URL."mais-gostosas-busca/$i\">$i</a> ";
					   }
				}
			
			}//fim else

		} //fim primeiro if		
	}
	
	
}

?>