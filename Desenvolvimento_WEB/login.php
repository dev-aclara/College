<?php
	if( isset($_GET['erro']) )
	{
		echo '<p style="color: #f00;">' . $_GET['erro'] . '</p>';
	}
?>


<form name="flogin" id="flogin" action="autenticar.php" method="post">
	
	Login:<br>
	<input type="text" name="login" id="login" value="">

	<p></p>

	Senha:<br>
	<input type="password" name="senha" id="senha" value="">

	<p></p>

	<input type="submit" name="btacessar" id="btacessar" value=" Acessar ">

</form>