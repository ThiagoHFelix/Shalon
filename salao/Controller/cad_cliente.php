<?php
	
	/*
		Autor: Paulo Gabriel Ronchini
		Data: 08/05/2017

		Código para o cadastro de dados na tabela cliente.		
	*/

	session_start();
	#função para se conectar ao banco.
	function conecta(){
		$connect = mysqli_connect('localhost','root','', 'projeto shalon');
		return $connect;
	}

	#Dados vindos do formulário	de cadastro de cliente
	$pato = $_POST['patologias'];
	$trat = $_POST['tratamento'];
	$alergia = $_POST['alergia'];	
	$senha = $_POST['senha'];
	$cpf = $_POST['cpf'];

	#If para verificar a variável $_POST['cardiaco'].
	if(isset($_POST['cardiaco'])){
		$cardiaco = 1;
	}else{
		$cardiaco = 0;
	}
	#If para verificar a variável $_POST['gravidez'].
	if(isset($_POST['gravidez'])){
		$gravidez = 1;
	}else{
	 	$gravidez = 0;
	}
	#If para verificar a variável $_POST['amamenta'].
	if(isset($_POST['amamenta'])){
		$amamenta = 1;
	}else{
		$amamenta = 0;
	}
	#If para verificar a variável $_POST['hipertenso'].
	if(isset($_POST['hipertenso'])){
		$hiper = 1;
	}else{
		$hiper = 0;
	}	

	#Comando para inserir dados na tablea cliente no banco de dados.
	$result = mysqli_query(conecta(), "insert into cliente (CPF, senha, status, Patologias, Tratamento, Gestante, Alergia, Cardiaco, Hipertenso, lactante) values('".$cpf."', '".$senha."', 'at', '".$pato."', '".$trat."', ".$gravidez.", '".$alergia."', ".$cardiaco.", ".$hiper.", ".$amamenta.")")or die(mysqli_error($connect));


	#Fecha a conexão com o banco.
	mysqli_close($connect);

	
	header("Location:../dist/page_login.php");

?>