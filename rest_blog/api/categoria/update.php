<?php
	header('Content-Type: application/json');
	
	if(!isset($_SERVER['PHP_AUTH_USER'])){
		header('WWW-Authenticate: Basic realm="Página Restrita"');
		header('HTTP/1.0 401 Unauthorized');
		die(json_encode(["mensagem" => "autenticação necessária"]));
	}
	if($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin'){
		echo json_encode(["mensagem" => "Bem-vindo"]);
		exit;
	}elseif(!($_SERVER['PHP_AUTH_USER'] == 'admin' && $_SERVER['PHP_AUTH_PW'] == 'admin')){
		header('HTTP/1.0 401 Unauthorized');
		die(json_encode(["mensagem" => "dados incorretos"]));
	}
	
	require_once '../../config/Conexao.php';
	require_once '../../models/Categoria.php';
	if($_SERVER['REQUEST_METHOD']=='PUT'){

		$db = new Conexao();
		$con = $db->getConexao();

		$categoria = new Categoria($con);
		
        $dados = json_decode(file_get_contents("php://input"));	
        
        $categoria->id = $dados->id;
		$categoria->nome = $dados->nome;
		$categoria->descricao = $dados->descricao;

		if($categoria->update()) {
			$res = array('mensagem','Categoria atualizada');
		} else {
			$res = array('mensagem','Erro na atualização da categoria');
		}
		echo json_encode($res);
	}else{
		echo json_encode(['mensagem'=> 'método não suportado']);
	}