<?php

class Categoria {
	public $id;
	public $nome;
	public $descricao;

	private $conexao;

	// Ao instanciar um objeto, passaremos a conexão 
	// A conexão será armazenada em $this->conexao para uso aqui na Class

	public function __construct($con){
		$this->conexao = $con;
	}

	/* O método read() deverá efetuar uma consulta SQL na tabela categoria, e retornar o resultado */

	public function read($id=null) {
		if (!isset($id)) {
			$consulta = "SELECT * FROM categoria ORDER BY nome";
			$stmt = $this->conexao->prepare($consulta);
		} else {
			$consulta = "SELECT * FROM categoria WHERE id = :id";
			$stmt = $this->conexao->prepare($consulta);
			$stmt = $this-> bindParam('id', $id);
		}
		
		try{
			$stmt->execute();
			$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $resultado;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function create() {
		$consulta = "INSERT INTO categoria(nome, descricao) VALUES (:nome, :descricao)";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam('nome', $this->nome, PDO::PARAM_STR);
		$stmt->bindParam('descricao', $this->descricao, PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "true";
		} else {
			return "false";
		}
	}

	public function update(){
		$consulta = "UPDATE categoria SET nome = :nome, descricao = :descricao where id = :id ";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam('id', $this->id,PDO::PARAM_INT);
		$stmt->bindParam('nome', $this->nome, PDO::PARAM_STR);
		$stmt->bindParam('descricao', $this->descricao, PDO::PARAM_STR);	
		if ($stmt->execute()) {
			return "true";
		} else {
			return "false";
		}	
	}
	public function delete(){
		$consulta = "DELETE FROM categoria where id = :id";
		$stmt = $this->conexao->prepare($consulta);
		$stmt->bindParam('id', $this->id, PDO::PARAM_STR);	
		if ($stmt->execute()) {
			return "true";
		} else {
			return "false";
		}		
	}
	
}

