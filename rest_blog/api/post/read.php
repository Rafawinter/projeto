<?php

	header('Acess-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Content-Type: text/html; charset=utf-8');
	
	require_once '../../config/Conexao.php';
	require_once '../../models/post.php';

	$db = new Conexao();
	$con = $db->getConexao();

    $post = new Post($con);

    $resultado = $post->read();
    $qtde_cats=sizeof($resultado);
    if($qtde_cats>0){
        echo json_encode($resultado);
       
    }else{
        echo json_encode(['mensagem' => 'nenhuma post encontrada']);
    }