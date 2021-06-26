<?php

	$pesquisa = @$_POST['pesquisa'];	
?>


<script type="text/javascript">
	
	//-----------------------------------------------------------------
	function incluir()
	{
		$("#acao").val("incluir");
		$("#cod_cidade").val(0);
		$("#form_oculto").attr("action", "index.php?modulo=cidades-ficha");
		$("#form_oculto").submit();
	} // incluir

	//-----------------------------------------------------------------
	function alterar(cod_cidade)
	{
		$("#acao").val("alterar");
		$("#cod_cidade").val(cod_cidade);
		$("#form_oculto").attr("action", "index.php?modulo=cidades-ficha");
		$("#form_oculto").submit();
	} // alterar

	//-----------------------------------------------------------------
	function excluir(cod_cidade)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val("excluir");
			$("#cod_cidade").val(cod_cidade);
			$("#form_oculto").attr("action", "cidades-gravar.php");
			$("#form_oculto").submit();
		}
	} // excluir	

</script>

	<h2>Cadastro de Cidades</h2>

	<form name="form_oculto" id="form_oculto" method="post" action=""> 
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_cidade" id="cod_cidade" value="">
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
			 from cidades
			 where nome like '%$pesquisa%'
			 order by nome
			";

	$r = $pdo->query( $sql );

	echo '<table border="0" cellpadding="5" cellspacing="1" width="90%">';
	echo ' <tr bgcolor="#f2f2f2">';
	echo ' 	<td align="center"><b>Código</b></td>';
	echo ' 	<td><b>Nome</b></td>';
	echo ' 	<td align="center"><b>Unidade Federal</b></td>';
	echo ' 	<td align="center"><b>Opções</b></td>';
	echo ' </tr>';


	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{
		echo ' <tr bgcolor="#f8f8f8">';
		echo ' 	<td align="center">'.$dados['cod_cidade'].'</td>';
		echo ' 	<td>'.$dados['nome'].'</td>';
		echo ' 	<td align="center">'.$dados['uf'].'</td>';

		$link_alterar = '<a href="javascript:alterar('.$dados['cod_cidade'].');">Alterar</a>';
		$link_excluir = '<a href="javascript:excluir('.$dados['cod_cidade'].');">Excluir</a>';


		echo ' 	<td align="center">'.$link_alterar . '&nbsp;&nbsp;'. $link_excluir.' </td>';

		echo ' </tr>';

	} // while

	echo '</table>';

?>
