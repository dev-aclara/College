<?php
	$acao = @$_POST['acao'];
	$cod_motoboy = @$_POST['cod_motoboy'];

	if( $acao != 'alterar' and $acao != 'incluir' )
	{
		echo '<script language="javascritp">
					document.location = "index.php?modulo=motoboys&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	if( $acao == 'alterar' )
	{
		// buscar os dados do registro a ser alterado

		$sql = " select * from motoboys where cod_motoboy = '$cod_motoboy' ";

		$r = $pdo->query($sql);

		$dados = $r->fetch(PDO::FETCH_ASSOC);

		// se conseguiu obter o registro
		if( $dados )
		{
			$nome                  = $dados['nome'];  
			$telefone_fixo         = $dados['telefone_fixo'];    
			$celular               = $dados['celular'];    
			$email                 = validaEmail($dados['email']);
            $taxa_entrega          = floatBR($dados['taxa_entrega']);
				
		}
		else
		{
			echo '<script language="javascritp">
						document.location = "index.php?modulo=motoboys&erro=Motoboy não encontrado para alteração !!!";
				  </script>
				 ';
		}

	} // se estiver alterando
	else
	{
		$nome                  = "";
		$telefone_fixo         = "";
		$celular               = "";
		$email                 = "";
        $taxa_entrega          = "";
		

	} // se estiver incluindo


?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//-------------------------------------------------------------
		$("div[id*=erro]").css("color", "#f00");

		//-------------------------------------------------------------
		$("#btcancelar").click(function(){
			document.location="index.php?modulo=motoboys";
		});

		//-------------------------------------------------------------
		$("#fcad").submit(function(){

			var erros = 0;

			$("div[id*=erro]").html("");

			$("#nome").val(  $.trim($("#nome").val() ) );

			if( $("#nome").val() == "" )
			{
				$("#div_error_nome").html("O campo Nome deve ser preenchido !!!");
				erros++;
			}

            if( $("#telefone_fixo").val() == "" )
			{
				$("#erro_telefone_fixo").html("O campo Telefone Fixo deve ser preenchido !!!");
				erros++;
			}

            if( $("#celular").val() == "" )
			{
				$("#erro_celular").html("O campo Celular deve ser preenchido !!!");
				erros++;
			}
            if( $("#taxa_entrega").val() == "" )
			{
				$("#erro_taxa").html("O campo Taxa de Entrega deve ser preenchido !!!");
				erros++;
			}

            if( $("#email ").val() == "" )
			{
				$("#erro_email").html("O campo E-mail deve ser preenchido !!!");
				erros++;
			}
           

			return erros == 0;

		}); // submit de fcad


	}); // read

</script>




	<h2>Cadastro de Motoboy</h2>

	<form name="fcad" id="fcad" method="post" action="motoboys-gravar.php">

		<input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
		<input type="hidden" name="cod_motoboy" id="cod_motoboy" value="<?= $cod_motoboy; ?>">

		<p>		
			Nome:<br>
			<input type="text" name="nome" id="nome" maxlength="100" value="<?= $nome; ?>" size="60">
			<div id="div_error_nome"></div>
		</p>

		<p>
			Telefone Fixo:<br>
			<input type="text" name="telefone_fixo" id="telefone_fixo" maxlength="30" value="<?= $telefone_fixo; ?>">
			<div id="erro_telefone_fixo"></div>
		</p>

		<p>
			Celular:<br>
			<input type="text" name="celular" id="celular" maxlength="30" value="<?= $celular; ?>">
			<div id="erro_celular"></div>
		</p>


        <p>
			Taxa de Entrega:<br>
			<input type="float" name="taxa_entrega" id="taxa_entrega" size="15" value="<?= $taxa_entrega; ?>">
			<div id="erro_taxa"></div>
		</p>

        <p>
			E-mail:<br>
			<input type="text" name="email" id="email" maxlength="100" size="60" value="<?= $email; ?>">
			<div id="erro_email"></div>
		</p>
	
		<input type="submit" name="btgravar" id="btgravar" value=" Gravar ">
	
		&nbsp;&nbsp;
	
		<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar ">

	</form>
