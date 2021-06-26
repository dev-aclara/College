<?php
	$pesquisa = @$_POST['pesquisa'];	
?>

<script type="text/javascript">
	
	//-----------------------------------------------------------------
	function incluir()
	{
		$("#acao").val("incluir");
		$("#cod_unidade").val(0);
		$("#form_oculto").attr("action", "index.php?modulo=unidades-ficha");
		$("#form_oculto").submit();
	} // incluir

	//-----------------------------------------------------------------
	function alterar(cod_unidade)
	{
		$("#acao").val("alterar");
		$("#cod_unidade").val(cod_unidade);
		$("#form_oculto").attr("action", "index.php?modulo=unidades-ficha");
		$("#form_oculto").submit();
	} // alterar

	//-----------------------------------------------------------------
	function excluir(cod_unidade)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val("excluir");
			$("#cod_unidade").val(cod_unidade);
			$("#form_oculto").attr("action", "unidades-gravar.php");
			$("#form_oculto").submit();
		}
	} // excluir	

</script>


	<h2>Cadastro de Unidades de Medida</h2>

	<form name="form_oculto" id="form_oculto" method="post" action=""> 
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_unidade" id="cod_unidade" value="">
	</form>

	<div id="div_form_pesquisa">
		<form name="fpesquisa" id="fpesquisa" method="post" action="">
			<input type="text" name="pesquisa" id="pesquisa" value="<?php echo $pesquisa; ?>" size="100">&nbsp;&nbsp;&nbsp;
			<input type="submit" name="btpesquisar" id="btpesquisar" value=" Pesquisar ">
		</form>
	</div>

	<p style="color:#f00; text-align: center; font-weight: bold;">
		<?php
			echo @$_GET['erro'];
		?>
	</p>

	<p>
		<a href="javascript:incluir()">Incluir Novo Registro</a>
	</p>

<?php

	$sql = " select *
			 from unidades
			 where descricao like '%$pesquisa%' or sigla like '%$pesquisa%'
			 order by descricao
			";

	$r = $pdo->query( $sql );

	echo '<table border="0" cellpadding="5" cellspacing="1" width="90%">';
	echo ' <tr bgcolor="#f2f2f2">';
	echo ' 	<td align="center"><b>Código</b></td>';
	echo ' 	<td><b>Descrição</b></td>';
	echo ' 	<td align="center"><b>Sigla</b></td>';
	echo ' 	<td align="center"><b>Opções</b></td>';
	echo ' </tr>';


	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{
		echo ' <tr bgcolor="#f8f8f8">';
		echo ' 	<td align="center">'.$dados['cod_unidade'].'</td>';
		echo ' 	<td>'.$dados['descricao'].'</td>';
		echo ' 	<td align="center">'.$dados['sigla'].'</td>';

		$link_alterar = '<a href="javascript:alterar('.$dados['cod_unidade'].');">Alterar</a>';
		$link_excluir = '<a href="javascript:excluir('.$dados['cod_unidade'].');">Excluir</a>';


		echo ' 	<td align="center">'.$link_alterar . '&nbsp;&nbsp;'. $link_excluir.' </td>';

		echo ' </tr>';

	} // while

	echo '</table>';

?>

