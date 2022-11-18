<?php 
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 
 //  print_r($_POST);
//  exit();
$id = $_POST['cliente'];

$valor = $_POST['valor'];
$valor = preg_replace("/[^0-9,]+/i","",$valor);
$valor = str_replace(",",".",$valor);


$juros = $_POST['juros'];
$juros = preg_replace("/[^0-9,]+/i","",$juros);
$juros = str_replace(",",".",$juros);

$valor_bruto = $_POST['valor_bruto'];
$valor_bruto = preg_replace("/[^0-9,]+/i","",$valor_bruto);
$valor_bruto = str_replace(",",".",$valor_bruto);

$valor_parcelado = $_POST['valor_parcela'];
$valor_parcelado = preg_replace("/[^0-9,]+/i","",$valor_parcelado);
$valor_parcelado = str_replace(",",".",$valor_parcelado);

$id_servico = $_POST['id_servico'];
$dt_solicitcao = $_POST['dt_solicitcao'];
$dt_solicitcao = date('Y-m-d', strtotime($_POST['dt_solicitcao']));

$id = explode('.', $id);
$id = $id[0];

if($id_servico == 1){  
  $dt_pgto = $_POST['dt_solicitcao'];
  $dt_pgto = date('Y-m-d', strtotime( $_POST['dt_solicitcao']));
  
}else{

  $dt_pgto = $_POST['dt_solicitcao'];
  $dt_pgto = date('Y-m-d', strtotime( $_POST['dt_solicitcao'] . '+1 month'));

}

 $select_sql = "INSERT INTO `solicitacao`(`id`, `id_cliente`, `id_servico`,`valor`, `valor_parcela`, `status_solicitacao`, `juros`, `valor_bruto`, `dt_solicitacao`, `dt_pgto`,`usuario`, `data_hora_solicitacao`)
VALUES (null,'$id', '$id_servico', '$valor', '$valor_parcelado', '1', '$juros','$valor_bruto', '$dt_solicitcao', '$dt_pgto','$usuario','$data_hora')";
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