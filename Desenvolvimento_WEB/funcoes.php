<?php

// Vetores para impressão da data -------------------------------
$semana[0] = 'Domingo';
$semana[1] = 'Segunda-Feira';
$semana[2] = 'Ter&ccedil;a-Feira';
$semana[3] = 'Quarta-Feira';
$semana[4] = 'Quinta-Feira';
$semana[5] = 'Sexta-Feira';
$semana[6] = 'Sab&aacute;do';

$mes[1] = 'Janeiro';
$mes[2] = 'Fevereiro';
$mes[3] = 'Mar&ccedil;o';
$mes[4] = 'Abril';
$mes[5] = 'Maio';
$mes[6] = 'Junho';		
$mes[7] = 'Julho';
$mes[8] = 'Agosto';
$mes[9] = 'Setembro';
$mes[10] = 'Outubro';
$mes[11] = 'Novembro';
$mes[12] = 'Dezembro';

//---------------------------------------------------------------
//------------------------------------------------------------
function saudacoes()
{
	$hora = (int)date('G');

	if( $hora >= 0 and $hora < 12 )
	{
		return 'Bom dia';
	}
	elseif( $hora >= 12 and $hora< 18 )
	{
		return 'Boa tarde';
	}
	else return 'Boa noite';

}
	

//-- func. para imprimir uma data por extenso ----------------------------------------------------------------
function imprimir_data_extenso()
{
	global $semana;
	global $mes;	
	$diasemana = date('w');
	$diames = date('j');
	$numeromes = date('n');
	$ano = date('Y');	
	echo $semana[ $diasemana ] . ', ' .
		 $diames . ' de ' . 
		 $mes[ $numeromes ] . ' de ' . 
		 $ano;		 
}

//-- func. para obter uma data por extenso ----------------------------------------------------------------
function data_extenso()
{
	global $semana;
	global $mes;	
	$diasemana = date('w');
	$diames = date('j');
	$numeromes = date('n');
	$ano = date('Y');	
	return $semana[ $diasemana ] . ', ' .
		 $diames . ' de ' . 
		 $mes[ $numeromes ] . ' de ' . 
		 $ano;		 
}

//-------------------------------------------------------------
function dataUSA($d)
{
	if( trim($d) == '' ) { return ''; }
	// 25/02/1992
	return 	substr($d,6,4) . '/' . 
			substr($d,3,2) . '/' . 
			substr($d,0,2) ;
}
//-------------------------------------------------------------
function dataBR($d)
{
	if( trim($d) == '' ) { return ''; }

	// 1992/02/25
	return 	substr($d,8,2) . '/' . 
			substr($d,5,2) . '/' . 
			substr($d,0,4) ;
}

//-------------------------------------------------------------
function floatUSA($v)
{
	return str_replace(',','.',$v);
}
//-------------------------------------------------------------
function floatBR($v)
{
	return str_replace('.',',',$v);
}

//-------------------------------------------------------------
function ValidaData($dat){
	$data = explode("/","$dat"); // fatia a string $dat em pedados, usando / como referência
	$d = $data[0];
	$m = $data[1];
	$y = $data[2];

	// verifica se a data é válida!
	// 1 = true (válida)
	// 0 = false (inválida)
	$res = checkdate($m,$d,$y);
	if ($res == 1){
	   //echo "data ok!";
		return true;
	} else {
	   //echo "data inválida!";
		return false;
	}
}

/*//-------------------------------------------------------------
function validaCPF($cpf = null) {
 
    // Verifica se um número foi informado
    if(empty($cpf)) {
        return false;
    }
 
    // Elimina possivel mascara
    $cpf = ereg_replace('[^0-9]', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
     
    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF é válido
     } else {   
         
        for ($t = 9; $t < 11; $t++) {
             
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
 
        return true;
    }

} // validaCPF
*/

//-------------------------------------------------------------
function validaEmail($email) 
{
	if(!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email))
	{
	 	return true;
	}
	else
	{
	 	return false;
	}	
/*

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
 echo "E-mail inválido.";    
}else{
 echo "Seu e-mail é ".$email;
}
*/

} // validaEmail

//-------------------------------------------------------------
function gerar_log($pdo, $log, $tabela, $valores_anteriores, $valores_novos )
{

	// Registrando o log de login -------
	$sql = " insert into logs (cod_usuario, log, ip, tabela, valores_anteriores, valores_novos) 
			 values (:cod_usuario, :log, :ip, :tabela, :valores_anteriores, :valores_novos)
		   ";

	$cmd = $pdo->prepare($sql);

	// preenchendo os parâmetros 
	$cmd->bindValue(":cod_usuario" , $_SESSION['usuario']['cod_usuario']);
	$cmd->bindValue(":log"		   , $log);
	$cmd->bindValue(":ip"		   , $_SERVER['REMOTE_ADDR']);
	$cmd->bindValue(":tabela"	   , $tabela);
	$cmd->bindValue(":valores_anteriores"	   , $valores_anteriores);
	$cmd->bindValue(":valores_novos"	   , $valores_novos);

	$cmd->execute();


} // gerar_log()

function verificar_autenticacao()
{
	if( !isset($_SESSION['usuario']) )
	{
		die("Usuário não autenticado!");
	}	
}

//-------------------------------------------------------------
//-------------------------------------------------------------



//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------
//---------------------------------------------------------------



?>