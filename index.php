<?php
	//Headers de permissão
	header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
    
    include_once('Pessoa.php');

    //conexao
    $server = "localhost";
    $user = "id5179924_dados";
    $pass = "123456789";
    $database = "id5179924_dados";

	$conexao = mysqli_connect($server, $user, $pass, $database);

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    	$selectQuery = "select * from dados;";
		$resposta = mysqli_query($conexao, $selectQuery);

  	  	$dados = array();
    	while ($dados_array = mysqli_fetch_assoc($resposta)) {
    		$pessoa = new Pessoa();

	    	$pessoa->nome = $dados_array['nome'];
   			$pessoa->email = $dados_array['email'];
	    	$pessoa->senha = $dados_array['senha'];
	    	$pessoa->cidade = $dados_array['cidade'];

	    	array_push($dados, $pessoa);
    	}

    	echo json_encode($dados);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    	$nome = $_POST['nome'];
    	$email = $_POST['email'];
    	$senha = $_POST['senha'];
    	$cidade = $_POST['cidade'];

    	$insertQuery = "insert into dados(nome, email, senha, cidade) values ('".$nome."', '".$email."', '".$senha."', '".$cidade."');";
    	mysqli_query($conexao, $insertQuery);
    }
?>