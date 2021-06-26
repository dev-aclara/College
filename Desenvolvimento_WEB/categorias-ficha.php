<?php
	$acao = @$_POST['acao'];
	$cod_categoria = @$_POST['cod_categoria'];

	if( $acao != 'alterar' and $acao != 'incluir' )
	{
		echo '<script language="javascritp">
					document.location = "index.php?modulo=categorias&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	if( $acao == 'alterar' )
	{
		// buscar os dados do registro a ser alterado

		$sql = " select * from categorias where cod_categoria = '$cod_categoria' ";

		$r = $pdo->query($sql);

		$dados = $r->fetch(PDO::FETCH_ASSOC);

		// se conseguiu obter o registro
		if( $dados )
		{
			$descricao = $dados['descricao'];
		}
		else
		{
			echo '<script language="javascritp">
						document.location = "index.php?modulo=categorias&erro=Cidade não encontrada para alteração !!!";
				  </script>
				 ';
		}

	} // se estiver alterando
	else
	{
		$descricao = "";

	} // se estiver incluindo


?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//-------------------------------------------------------------
		$("div[id*=erro]").css("color", "#f00");

		//-------------------------------------------------------------
		$("#btcancelar").click(function(){
			document.location="index.php?modulo=categorias";
		});

		//-------------------------------------------------------------
		$("#fcad").submit(function(){

			var erros = 0;

			$("div[id*=erro]").html("");

			$("#descricao").val(  $.trim($("#descricao").val() ) );

			if( $("#descricao").val() == "" )
			{
				$("#div_error_descricao").html("O campo descrição deve ser preenchido !!!");
				erros++;
			}

			return erros == 0;

		}); // submit de fcad


	}); // read

</script>


	<h2>Cadastro de Categorias</h2>

	<form name="fcad" id="fcad" method="post" action="categorias-gravar.php">

		<input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
		<input type="hidden" name="cod_categoria" id="cod_categoria" value="<?= $cod_categoria; ?>">

		<p>		
			Descrição:<br>
			<input type="text" name="descricao" id="descricao" maxlength="100" value="<?= $descricao; ?>" size="60">
			<div id="div_error_descricao"></div>
		</p>


		<input type="submit" name="btgravar" id="btgravar" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar ">

	</form>
