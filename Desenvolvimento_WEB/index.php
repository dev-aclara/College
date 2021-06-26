<?php
	session_start();

	include_once("bd.php");
	include_once("funcoes.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestão Comercial : Restaurantes</title>

	<!-- incluindo a biblioteca jQuery -->
	<script type="text/javascript" src="_js/jquery-3.4.1.min.js"></script>

	<!-- incluindo a biblioteca de funções gerais -->
	<script type="text/javascript" src="_js/funcoes.js"></script>	

</head>
<body>

	<h1>SISTEMA DE GESTÃO COMERCIAL</h1>

	<?php

		// se o usuário estiver logado -------
		if( isset($_SESSION['usuario']) )
		{
			include_once("menu.php");

			$modulo = @$_GET['modulo'];
			$arquivo = $modulo . '.php';

			if( file_exists($arquivo) )
			{
				include_once( $arquivo );	
			}
			else
			{
				include_once('home.php');
			}		

		} // se o usuário estiver logado
		else
		{
			//echo 'Usuário não logado no sistema!!!';
			include_once("login.php");
		}



	?>


</body>
</html>