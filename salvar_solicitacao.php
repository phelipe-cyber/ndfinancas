<?php 
session_start();
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 
//  print_r($_POST);

 $id = $_POST['cliente'];
 $valor = $_POST['valor'];
 $juros = $_POST['juros'];
 $valor_bruto = $_POST['valor_bruto'];
 $valor_parcelado = $_POST['valor_parcela'];

//  echo $juros;
// exit();
 $data_inicio = (date_create('Y-m-d')) + 20;

$data_final = (date_create('Y-m-d'));


$data = new DateTime('03-06-2022');
$data->modify('+20 day');
 $data->format('d-m-Y');

// exit();


$data1 = new DateTime('2011-09-11');
$data2 = new DateTime('2011-10-13');
$intervalo = $data1->diff($data2);
 $intervalo->format('%R%a dias');



 $select_sql = "INSERT INTO `solicitacao`(`id`, `id_cliente`, `valor`, `valor_parcela`, `status_solicitacao`, `juros`, `valor_bruto`,`usuario`, `data_hora_solicitacao`)
VALUES (null,'$id','$valor', '$valor_parcelado', '1', '$juros','$valor_bruto','$usuario','$data_hora')";
$salvar = mysqli_query($conn, $select_sql);

$update = "UPDATE clientes SET status_cliente = '1' WHERE id = $id";
$salvar_update = mysqli_query($conn, $update);

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
       echo '<meta http-equiv="refresh" content="3;URL=solicitacao.php" />';
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