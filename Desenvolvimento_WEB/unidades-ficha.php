<?php
	$acao = @$_POST['acao'];
	$cod_unidade = @$_POST['cod_unidade'];

	if( $acao != 'alterar' and $acao != 'incluir' )
	{
		echo '<script language="javascritp">
					document.location = "index.php?modulo=unidades&erro=Ação inválida !!!";
			  </script>
			 ';
	}


	if( $acao == 'alterar' )
	{
		// buscar os dados do registro a ser alterado

		$sql = " select * from unidades where cod_unidade = '$cod_unidade' ";

		$r = $pdo->query($sql);

		$dados = $r->fetch(PDO::FETCH_ASSOC);

		// se conseguiu obter o registro
		if( $dados )
		{
			$descricao = $dados['descricao'];
			$sigla   = $dados['sigla'];
		}
		else
		{
			echo '<script language="javascritp">
						document.location = "index.php?modulo=unidades&erro=Cidade não encontrada para alteração !!!";
				  </script>
				 ';
		}

	} // se estiver alterando
	else
	{
		$descricao = "";
		$sigla	  = "";

	} // se estiver incluindo


?>

<script type="text/javascript">
	
	$(document).ready(function(){

		//-------------------------------------------------------------
		$("div[id*=erro]").css("color", "#f00");

		//-------------------------------------------------------------
		$("#btcancelar").click(function(){
			document.location="index.php?modulo=unidades";
		});

		//-------------------------------------------------------------
		$("#fcad").submit(function(){

			var erros = 0;

			$("div[id*=erro]").html("");

			$("#descricao").val(  $.trim($("#descricao").val() ) );
			$("#sigla").val(  $.trim($("#sigla").val() ) );

			if( $("#descricao").val() == "" )
			{
				$("#div_error_descricao").html("O campo Descrição deve ser preenchido !!!");
				erros++;
			}

			if( $("#sigla").val() == "" )
			{
				$("#div_error_sigla").html("O campo Sigla deve ser preenchido !!!");
				erros++;
			}

			return erros == 0;

		}); // submit de fcad


	}); // read

</script>




	<h2>Cadastro de Unidades de Medida</h2>

	<form name="fcad" id="fcad" method="post" action="unidades-gravar.php">

		<input type="hidden" name="acao" id="acao" value="<?php echo $acao; ?>">
		<input type="hidden" name="cod_unidade" id="cod_unidade" value="<?= $cod_unidade; ?>">

		<p>		
			Descrição:<br>
			<input type="text" name="descricao" id="descricao" maxlength="100" value="<?= $descricao; ?>" size="60">
			<div id="div_error_descricao"></div>
		</p>

		<p>		
			Sigla:<br>
			<input type="text" name="sigla" id="sigla" maxlength="15" value="<?= $sigla; ?>" size="20">
			<div id="div_error_sigla"></div>
		</p>

		<input type="submit" name="btgravar" id="btgravar" value=" Gravar ">
		&nbsp;&nbsp;
		<input type="button" name="btcancelar" id="btcancelar" value=" Cancelar ">

	</form>

