<?php 
session_start();
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 
 $id = $_POST['cliente'];
 $valor = $_POST['valor'];
 


 $data_inicio = (date_create('Y-m-d')) + 20;

$data_final = (date_create('Y-m-d'));



$data = new DateTime('03-06-2022');
$data->modify('+20 day');
echo $data->format('d-m-Y');

exit();


$data1 = new DateTime('2011-09-11');
$data2 = new DateTime('2011-10-13');
$intervalo = $data1->diff($data2);
 $intervalo->format('%R%a dias');



$select_sql = "INSERT INTO `solicitacao`(`id`, `id_cliente`, `valor`, `status`, `usuario`, `data_hora`) 
VALUES (null,'$id','$valor','1','$usuario','$data_hora')";
$salvar = mysqli_query($conn, $select_sql);

$update = "UPDATE clientes SET status_solicitacao = '1' WHERE id = $id";
$salvar = mysqli_query($conn, $update);

if( $salvar == 1 ){
    ?>
       <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Salvo com Sucesso
                </div>
    <?php
       echo '<meta http-equiv="refresh" content="3;URL=solicitacao.php" />';
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