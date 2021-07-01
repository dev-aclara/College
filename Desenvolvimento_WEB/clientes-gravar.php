<?php
	session_start();

	include_once("funcoes.php");

	verificar_autenticacao();

	include_once("bd.php");

	// Fazendo a conexão com o Banco de Dados	
	$meu_BD = new BD();	
	
	$pdo = $meu_BD->pdo;

	$acao = @$_POST['acao'];
	$cod_cliente = @$_POST['cod_cliente'];

	//--------------------------------------------------------------------
	if( $acao == 'incluir' )
	{
		$sql = " insert into clientes 	
					(nome,cpf,rg,sexo,data_nascimento,renda_familiar,telefone,celular,email,rua,bairro,cod_cidade,cep,conheceu_por_jornais,conheceu_por_internet,conheceu_por_outro) 
				 values 
				 	(:nome,:cpf,:rg,:sexo,:data_nascimento,:renda_familiar,:telefone,:celular,:email,:rua,:bairro,:cod_cidade,:cep,:conheceu_por_jornais,:conheceu_por_internet,:conheceu_por_outro) 
				";

		$cmd = $pdo->prepare($sql);

	} // incluir
	else
	//--------------------------------------------------------------------
	if( $acao == 'alterar' )
	{
		$sql = " update clientes set
						nome                     = :nome                   , 
						cpf                      = :cpf                    ,
						rg                       = :rg                     ,
						sexo                     = :sexo                   ,
						data_nascimento          = :data_nascimento        ,
						renda_familiar           = :renda_familiar         ,
						telefone                 = :telefone               ,
						celular                  = :celular                ,
						email                    = :email                  ,
						rua                      = :rua                    ,
						bairro                   = :bairro                 ,
						cod_cidade               = :cod_cidade             ,
						cep                      = :cep                    ,
						conheceu_por_jornais     = :conheceu_por_jornais   ,
						conheceu_por_internet    = :conheceu_por_internet  ,
						conheceu_por_outro       = :conheceu_por_outro   

				 where cod_cliente = :cod_cliente
			   ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cliente", $cod_cliente );

	} // alterar
	else
	//--------------------------------------------------------------------
	if( $acao == 'excluir' )
	{
		// fazendo a integridade referencial: 
		$result = $pdo->query("select count(*) as total from encomendas where cod_cliente = '$cod_cliente' ");
		$dados = $result->fetch(PDO::FETCH_ASSOC);

		if( $dados['total'] > 0)
		{
			header("Location: index.php?modulo=clientes&erro=Não é possível excluir este cliente porque possui encomendas relacionadas !!!");
			exit;
		}



		$sql = " delete from clientes where cod_cliente = :cod_cliente ";

		$cmd = $pdo->prepare($sql);

		$cmd->bindValue(":cod_cliente", $cod_cliente );

	} // excluir
	else
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes&erro=Ação inválida !!!";
			  </script>
			 ';
	}

	//--------------------------------------------------------------------
	if( $acao == 'incluir' or $acao == 'alterar' )
	{

		$nome                     = $_POST['nome'];                    
		$cpf                      = $_POST['cpf'];
		$rg                       = $_POST['rg'];                     
		$sexo                     = @$_POST['sexo'];                   
		$data_nascimento          = trim($_POST['data_nascimento']) == "" ? null : dataUSA($_POST['data_nascimento']);     
		$renda_familiar           = trim($_POST['renda_familiar']) == "" ? null : floatUSA($_POST['renda_familiar']);         
		$telefone                 = $_POST['telefone'];               
		$celular                  = $_POST['celular'];                
		$email                    = $_POST['email'];                  
		$rua                      = $_POST['rua'];                    
		$bairro                   = $_POST['bairro'];   
		$cod_cidade               = $_POST['cod_cidade'] == '0' ? null : $_POST['cod_cidade'];
		$cep                      = $_POST['cep'];                    
		$conheceu_por_jornais     = @$_POST['conheceu_por_jornais'];   
		$conheceu_por_internet    = @$_POST['conheceu_por_internet'];  
		$conheceu_por_outro       = @$_POST['conheceu_por_outro'];     

		$cmd->bindValue(":nome"                     , $nome);                    
		$cmd->bindValue(":cpf"                      , $cpf);
		$cmd->bindValue(":rg"                       , $rg);                     
		$cmd->bindValue(":sexo"                     , $sexo);                   
		$cmd->bindValue(":data_nascimento"          , $data_nascimento);        
		$cmd->bindValue(":renda_familiar"           , $renda_familiar);         
		$cmd->bindValue(":telefone"                 , $telefone);               
		$cmd->bindValue(":celular"                  , $celular);                
		$cmd->bindValue(":email"                    , $email);                  
		$cmd->bindValue(":rua"                      , $rua);                    
		$cmd->bindValue(":bairro"                   , $bairro);                 
		$cmd->bindValue(":cod_cidade"               , $cod_cidade);             
		$cmd->bindValue(":cep"                      , $cep);                    
		$cmd->bindValue(":conheceu_por_jornais"     , $conheceu_por_jornais);   
		$cmd->bindValue(":conheceu_por_internet"    , $conheceu_por_internet);  
		$cmd->bindValue(":conheceu_por_outro"       , $conheceu_por_outro);	

	} // if( $acao == 'incluir' or $acao == 'alterar' )


	// se conseguiu executar o comando sql sem erros
	if( $cmd->execute() )
	{
		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes";
			  </script>
			 ';
	}
	else
	{

		//die( $sql );

		//echo "<p>Data: " . $data_nascimento . "</p>";
		//echo "<p>Renda: " . $renda_familiar . "</p>";

		//print_r( $cmd->errorInfo() ); exit;		

		echo '<script language="javascript">
					document.location = "index.php?modulo=clientes&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
			  </script>
			 ';
	}

?>