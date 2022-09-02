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

$cep_emp = $_POST['cep_emp'];
$lougadouro_emp=$_POST['lougadouro_emp'];
$number_emp=$_POST['number_emp'];
$bairro_emp=$_POST['bairro_emp'];
$uf_emp=$_POST['uf_emp'];
$municipio_emp=$_POST['municipio_emp'];
$complemento_emp=$_POST['complemento_emp'];
$referencia_emp=$_POST['referencia_emp'];

    $Sql = "INSERT INTO `clientes`(`id`, `nome`, `sobrenome`, `cpf`, `rg`, `tel`, `tel2`, `atividade`,
    `endereco`, `numero`, `bairro`, `municipio`, `uf`, `complemento`, `referencia`, `cep_emp`, `lougadouro_emp`, 
    `number_emp`, `municipio_emp`, `uf_emp`, `bairro_emp`, `complemento_emp`, `referencia_emp`, `status_cliente`, 
    `user_created`, `data_hora_cliente`)

    VALUES (null,'$nome','$sobrenome','$cpf','$rg','$tel','$tel2','$atividade','$lougadouro','$number',
    '$bairro','$municipio','$uf','$complemento','$referencia', '$cep_emp', '$lougadouro_emp', '$number_emp', 
    '$municipio_emp', '$uf_emp', '$bairro_emp', '$complemento_emp', '$referencia_emp', '0', '$usuario', '$data_hora')";

$salvar = mysqli_query($conn, $Sql);

if( $salvar == 1 ){
    ?>
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-12">
            
                      <div id="spiner" style="display: none;">
                <!-- <div class="spinner-border"></div> -->
                <div class="text-center">
                  <div class="spinner-border" role="status">

                  </div>
                </div>
                <div class="text-center">
                  <!-- <label>Buscando...</label> -->
                </div>
              </div>
       <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Salvo com Sucesso
                </div>
    <?php
       echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
}else{
    ?>
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-12">
            
                      <div id="spiner" style="display: none;">
                <!-- <div class="spinner-border"></div> -->
                <div class="text-center">
                  <div class="spinner-border" role="status">

                  </div>
                </div>
                <div class="text-center">
                  <!-- <label>Buscando...</label> -->
                </div>
              </div>
     <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Erro ao Salvar
                </div>
    <?php
}


?>