<?php
    session_start();

    include_once("funcoes.php");

    verificar_autenticacao();

    include_once("bd.php");

    // Fazendo a conexão com o Banco de Dados    
    $meu_BD = new BD();    
    
    $pdo = $meu_BD->pdo;

    $acao = @$_POST['acao'];
    $cod_motoboy = @$_POST['cod_motoboy'];

    //--------------------------------------------------------------------
    if( $acao == 'incluir' )
    {
        $sql = " insert into motoboys     
                    (nome,telefone_fixo,celular,taxa_entrega,email) 
                 values 
                     (:nome,:telefone_fixo,:celular,:taxa_entrega,:email) 
                ";

        $cmd = $pdo->prepare($sql);

    } // incluir
    else
    //--------------------------------------------------------------------
    if( $acao == 'alterar' )
    {
        $sql = " update motoboys set
                        nome                     = :nome                   , 
                        telefone_fixo            = :telefone_fixo          ,
                        celular                  = :celular                ,
                        email                    = :email                  ,
                        taxa_entrega             = :taxa_entrega           

                 where cod_motoboy = :cod_motoboy
               ";

        $cmd = $pdo->prepare($sql);

        $cmd->bindValue(":cod_motoboy", $cod_motoboy );

    } // alterar
    else
    //--------------------------------------------------------------------
    if( $acao == 'excluir' )
    {

        $sql = " delete from motoboys where cod_motoboy = :cod_motoboy ";

        $cmd = $pdo->prepare($sql);

        $cmd->bindValue(":cod_motoboy", $cod_motoboy );

    } // excluir
    else
    {
        echo '<script language="javascript">
                    document.location = "index.php?modulo=motoboys&erro=Ação inválida !!!";
              </script>
             ';
    }

    //--------------------------------------------------------------------
    if( $acao == 'incluir' or $acao == 'alterar' )
    {

        $nome                     = $_POST['nome'];                                 
        $telefone_fixo            = $_POST['telefone_fixo'];               
        $celular                  = $_POST['celular'];
        $taxa_entrega             = trim($_POST['taxa_entrega']) == "" ? null : floatUSA($_POST['taxa_entrega']);     
        $email                    = $_POST['email'];                  
      

        $cmd->bindValue(":nome"                     , $nome);                                 
        $cmd->bindValue(":telefone_fixo"                 , $telefone_fixo);               
        $cmd->bindValue(":celular"                  , $celular);
        $cmd->bindValue(":taxa_entrega"           , $taxa_entrega);               
        $cmd->bindValue(":email"                    , $email);                  
      

    } // if( $acao == 'incluir' or $acao == 'alterar' )


    // se conseguiu executar o comando sql sem erros
    if( $cmd->execute() )
    {
        echo '<script language="javascript">
                    document.location = "index.php?modulo=motoboys";
              </script>
             ';
    }
    else
    {

        //die( $sql );

        //echo "<p>Data: " . $data_nascimento . "</p>";
        //echo "<p>Renda: " . $taxa_entrega . "</p>";

        //print_r( $cmd->errorInfo() ); exit;        

        echo '<script language="javascript">
                    document.location = "index.php?modulo=motoboys&erro=Não foi possível gravar as informações, houve algum erro na transação com o Banco de Dados!!!";
              </script>
             ';
    }

?>