<?php

	header('Acess-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	
	require_once '../../config/Conexao.php';
	require_once '../../models/post.php';

	$db = new Conexao();
	$con = $db->getConexao();

    $post = new Post($con);

    $resultado = $post->read();

    $qtde_cats = sizeof($resultado);

    if($qtde_cats>0){
        // $arr_posts = array();
        // $arr_posts['data'] = array();

        echo json_encode($resultado);
    }else{
        echo json_encode(array('mensagem' => 'nenhuma post encontrada'));
    }