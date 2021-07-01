<?php
	session_start();

	include_once("bd.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;


	$login = @$_POST['login'];
	$senha = @$_POST['senha'];

	$sql = " select * 
			 from usuarios 
			 where login = :login and senha = :senha
		   ";

	$cmd = $pdo->prepare($sql);

	$cmd->bindValue(":login", $login);
	$cmd->bindValue(":senha", md5($senha) ) ;

	$cmd->execute();

	//if( !$r ) die("Problema no sql");

	if( $dados = $cmd->fetch(PDO::FETCH_ASSOC) )
	//if( $login == 'andre' && $senha = '123' )
	{
		$_SESSION['usuario']['cod_usuario']   = $dados['cod_usuario'];
		$_SESSION['usuario']['login']         = $login;
		$_SESSION['usuario']['nome_completo'] = $dados['nome_completo'];

		header("Location: index.php");

	} 
	else 
	{
		header("Location: index.php?erro=Usuário e/ou senha inválidos!!!");	
	}



?>