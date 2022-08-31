<?php
session_start();
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];

$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$rg=$_POST['rg'];
$tel=$_POST['tel'];
$tel2=$_POST['tel2'];
$atividade=$_POST['atividade'];
$lougadouro=$_POST['lougadouro'];
$number=$_POST['number'];
$bairro=$_POST['bairro'];
$municipio=$_POST['municipio'];
$uf=$_POST['uf'];
$complemento=$_POST['complemento'];
$referencia=$_POST['referencia'];

    include_once("conexao.php");

    $Sql = "INSERT INTO `clientes`(`id`, `nome`, `sobrenome`, `cpf`, `rg`, `tel`, `tel2`, `atividade`, `endereco`, `numero`, `bairro`, 
    `municipio`, `uf`, `complemento`, `referencia`, `user_created`, `data_hora`)
    VALUES (null,'$nome','$sobrenome','$cpf','$rg','$tel','$tel2','$atividade','$lougadouro','$number',
    '$bairro','$municipio','$uf','$complemento','$referencia','$usuario','$data_hora')";

$salvar = mysqli_query($conn, $Sql);    

if( $salvar == 1 ){
    ?>
       <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Salvo com Sucesso
                </div>
    <?php
       echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
}else{
    ?>
     <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Erro ao Salvar
                </div>
    <?php
}


?>