<?php
	session_start();

	include_once("funcoes.php");

	verificar_autenticacao();

	include_once("bd.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;

	$acao = @$_POST['acao'];
	$cod_cidade = @$_POST['cod_cidade'];

	//--------------------------------------------------------------------
	if( $acao == 'incluir' or $acao == 'alterar' )
	{
		$nome = $_POST['nome'];
		$uf   = $_POST['uf'];
	}

	//--------------------------------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into cidades (nome, uf) values (:nome, :uf) ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":nome" , $nome );
		$cmd->bindValue(":uf"   , $uf );


	} // incluir
	else
	//--------------------------------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update cidades set
					nome = :nome,
					uf   = :uf
				 where cod_cidade = :cod_cidade
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cidade", $cod_cidade );
		$cmd->bindValue(":nome"      , $nome );
		$cmd->bindValue(":uf"   	 , $uf );


	} // alterar
	else
	//--------------------------------------------------------------------
	if( $acao == 'excluir' )
	{
		// fazendo a integridade referencial: clientes
		$result = $pdo->query("select count(*) as total from clientes where cod_cidade = '$cod_cidade' ");
		$dados = $result->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0)
		{
			header("Location: index.php?modulo=cidades&erro=Não é possível excluir esta cidade porque possui clientes relacionados !!!");
			exit;
		}

		// fazendo a integridade referencial: clientes
		$result = $pdo->query("select count(*) as total from fornecedores where cod_cidade = '$cod_cidade' ");
		$dados = $result->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0)
		{
			header("Location: index.php?modulo=cidades&erro=Não é possível excluir esta cidade porque possui fornecedores relacionados !!!");
			exit;
		}


		$sql = " delete from cidades where cod_cidade = :cod_cidade ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cidade", $cod_cidade );

	} // excluir
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=cidades&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	// se conseguiu executar o comando sql sem erros
	if( $cmd->execute() )
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=cidades";
			  </script>
			 ';
	}
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=cidades&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
			  </script>
			 ';
	}

?>