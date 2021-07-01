<?php
	session_start();

	include_once("funcoes.php");

	verificar_autenticacao();

	include_once("bd.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;

	$acao = @$_POST['acao'];
	$cod_ingrediente = @$_POST['cod_ingrediente'];

	//--------------------------------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into ingredientes 	
					(descricao,valor_unitario,cod_unidade) 
				 values 
					(:descricao,:valor_unitario,:cod_unidade) 
				";

		$cmd = $pdo->prepare($sql);

	} // incluir
	else
	//--------------------------------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update ingredientes set
						descricao         = :descricao       , 
						valor_unitario    = :valor_unitario  ,
						cod_unidade       = :cod_unidade

				 where cod_ingrediente = :cod_ingrediente
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_ingrediente", $cod_ingrediente );

	} // alterar
	else
	//--------------------------------------------------------------------
	if( $acao == 'excluir' )
	{
		// verificando a integridade referencial

		// integridade referencial : tabela composicao
		$r = $pdo->query(" select count(*) as total from composicao where cod_ingrediente = $cod_ingrediente ");
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0 )
		{
			echo '<script language="javascript">
						document.location = "index.php?modulo=ingredientes&erro=Não é possível excluir este ingrediente porque está relacionado com a composição de pratos !!!";
				  </script>
				 ';
			exit;
		}

		// integridade referencial : tabela itens_compra
		$r = $pdo->query(" select count(*) as total from itens_compra where cod_ingrediente = $cod_ingrediente ");
		$dados = $r->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0 )
		{
			/*
			echo '<script language="javascript">
						document.location = "index.php?modulo=ingredientes&erro=Não é possível excluir este ingrediente porque está relacionado com registro de compras !!!";
				  </script>
				 ';
			exit;
			*/

			// fazendo o redirecionamento com a função header do PHP
			header('Location: index.php?modulo=ingredientes&erro=Não é possível excluir este ingrediente porque está relacionado com registro de compras !!!');

		} // possui itens_compra relacionado

		$sql = " delete from ingredientes where cod_ingrediente = :cod_ingrediente ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_ingrediente", $cod_ingrediente );

	} // excluir
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=ingredientes&erro=Ação inválida !!!";
			  </script>
			 ';
	}

	//--------------------------------------------------------------------
	if( $acao == 'incluir' or $acao == 'alterar' )
	{

		$descricao      = $_POST['descricao'];                    
		$valor_unitario = trim($_POST['valor_unitario']) == "" ? null : floatUSA($_POST['valor_unitario']);         
		$cod_unidade    = $_POST['cod_unidade'] == '0' ? null : $_POST['cod_unidade'];

		//die( $valor_unitario );

		$cmd->bindValue(":descricao"      , $descricao);                    
		$cmd->bindValue(":valor_unitario" , $valor_unitario);         
		$cmd->bindValue(":cod_unidade"    , $cod_unidade);             

	} // if( $acao == 'incluir' or $acao == 'alterar' )


	// se conseguiu executar o comando sql sem erros
	if( $cmd->execute() )
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=ingredientes";
			  </script>
			 ';
	}
	else
	{

		//die( $sql );

		//echo "<p>Data: " . $data_nascimento . "</p>";
		//echo "<p>Renda: " . $valor_unitario . "</p>";

		//print_r( $cmd->errorInfo() ); exit;		

		echo '<script language="javascript">
					document.location = "index.php?modulo=ingredientes&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
			  </script>
			 ';
	}

?>