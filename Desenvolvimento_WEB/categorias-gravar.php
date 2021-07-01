<?php
	session_start();

	include_once("funcoes.php");

	verificar_autenticacao();

	include_once("bd.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;

	$acao = @$_POST['acao'];
	$cod_categoria = @$_POST['cod_categoria'];

	//--------------------------------------------------------------------
	if( $acao == 'incluir' or $acao == 'alterar' )
	{
		$descricao = $_POST['descricao'];
	}

	//--------------------------------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into categorias (descricao) values (:descricao) ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":descricao" , $descricao );


	} // incluir
	else
	//--------------------------------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update categorias set
					descricao = :descricao
				 where cod_categoria = :cod_categoria
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_categoria", $cod_categoria );
		$cmd->bindValue(":descricao"      , $descricao );


	} // alterar
	else
	//--------------------------------------------------------------------
	if( $acao == 'excluir' )
	{

		// fazendo a integridade referencial: 
		$result = $pdo->query("select count(*) as total from pratos where cod_categoria = '$cod_categoria' ");
		$dados = $result->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0)
		{
			header("Location: index.php?modulo=categorias&erro=Não é possível excluir esta categoria porque possui pratos relacionados !!!");
			exit;
		}


		$sql = " delete from categorias where cod_categoria = :cod_categoria ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_categoria", $cod_categoria );

	} // excluir
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=categorias&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	// se conseguiu executar o comando sql sem erros
	if( $cmd->execute() )
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=categorias";
			  </script>
			 ';
	}
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=categorias&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
			  </script>
			 ';
	}

?>