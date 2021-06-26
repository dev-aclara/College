<?php
	$pesquisa = @$_POST['pesquisa'];	
?>

<script type="text/javascript">
	
	//-----------------------------------------------------------------
	function incluir()
	{
		$("#acao").val("incluir");
		$("#cod_ingrediente").val(0);
		$("#form_oculto").attr("action", "index.php?modulo=ingredientes-ficha");
		$("#form_oculto").submit();
	} // incluir

	//-----------------------------------------------------------------
	function alterar(cod_ingrediente)
	{
		$("#acao").val("alterar");
		$("#cod_ingrediente").val(cod_ingrediente);
		$("#form_oculto").attr("action", "index.php?modulo=ingredientes-ficha");
		$("#form_oculto").submit();
	} // alterar

	//-----------------------------------------------------------------
	function excluir(cod_ingrediente)
	{
		if( confirm("Deseja realmente excluir este registro ?") )
		{
			$("#acao").val("excluir");
			$("#cod_ingrediente").val(cod_ingrediente);
			$("#form_oculto").attr("action", "ingredientes-gravar.php");
			$("#form_oculto").submit();
		}
	} // excluir	

</script>


	<h2>Cadastro de Ingredientes</h2>

	<form name="form_oculto" id="form_oculto" method="post" action=""> 
		<input type="hidden" name="acao" id="acao" value="">
		<input type="hidden" name="cod_ingrediente" id="cod_ingrediente" value="">
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

	$sql = " select 	i.*, 
						u.descricao as unidade, 
						u.sigla as unidade_sigla
			
			from 	ingredientes as i 
					inner join unidades as u on (i.cod_unidade = u.cod_unidade)
					
			where 	i.descricao like '%$pesquisa%'	or u.sigla like '%$pesquisa%' or u.descricao like '%$pesquisa%'
					
			order by i.descricao		
			";

	$r = $pdo->query( $sql );

	echo '<table border="0" cellpadding="5" cellspacing="1" width="90%">';
	echo ' <tr bgcolor="#f2f2f2">';
	echo ' 	<td align="center"><b>Código</b></td>';
	echo ' 	<td><b>Descrição</b></td>';
	echo ' 	<td align="left"><b>Unidade de Medida</b></td>';
	echo ' 	<td align="right"><b>Valor Unitário (R$)</b></td>';
	echo ' 	<td align="center"><b>Opções</b></td>';
	echo ' </tr>';


	while( $dados = $r->fetch(PDO::FETCH_ASSOC) )
	{
		echo ' <tr bgcolor="#f8f8f8">';
		echo ' 	<td align="center">'.$dados['cod_ingrediente'].'</td>';
		echo ' 	<td>'.$dados['descricao'].'</td>';
		echo ' 	<td align="left">'.$dados['unidade'] . ' ('.$dados['unidade_sigla'].')' .'</td>';
		echo ' 	<td align="right">'. number_format($dados['valor_unitario'],2,',','.') .'</td>';

		$link_alterar = '<a href="javascript:alterar('.$dados['cod_ingrediente'].');">Alterar</a>';
		$link_excluir = '<a href="javascript:excluir('.$dados['cod_ingrediente'].');">Excluir</a>';


		echo ' 	<td align="center">'.$link_alterar . '&nbsp;&nbsp;'. $link_excluir.' </td>';

		echo ' </tr>';

	} // while

	echo '</table>';

?>

