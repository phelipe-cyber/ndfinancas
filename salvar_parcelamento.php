<?php 
include_once("starter.php");
include_once("conexao.php");
date_default_timezone_set('America/Recife');
$data_hora = (date('Y-m-d H:i:s'));
$usuario = $_SESSION['login'];

// print_r($_POST);
// exit();

$id_solicitacao = $_POST['id_solicitacao'];
$id_cliente = $_POST['id_cliente'];
$id_servico = $_POST['id_servico'];
$total_em_atraso = $_POST['total_em_atraso'];
$dt_solicitacao = $_POST['dt_solicitacao'];
$total_parcelas = $_POST['total_parcelas'];

$valor = $_POST['valor'];
$valor = preg_replace("/[^0-9,]+/i","",$valor);
$valor = str_replace(",",".",$valor);

$valor_bruto = $_POST['valor_bruto'];
$valor_bruto = preg_replace("/[^0-9,]+/i","",$valor_bruto);
$valor_bruto = str_replace(",",".",$valor_bruto);

$valor_parcela = $_POST['valor_parcela'];
$valor_parcela = preg_replace("/[^0-9,]+/i","",$valor_parcela);
$valor_parcela = str_replace(",",".",$valor_parcela);

 $sql_update_par = "UPDATE `solicitacao` SET `status_solicitacao` = 6 WHERE `id` = '$id_solicitacao' " ;
$sql_update_solicitacao = mysqli_query($conn, $sql_update_par);

 $select_sql = "INSERT INTO `solicitacao`(`id`, `id_cliente`, `id_servico`,`valor`, `valor_parcela`, `status_solicitacao`, `juros`, `valor_bruto`, `dt_solicitacao`, `dt_pgto`,`usuario`, `data_hora_solicitacao`)
VALUES (null,'$id_cliente', '$id_servico', '$total_em_atraso', '$valor_parcela', '3', '$total_em_atraso','$valor_bruto', '$dt_solicitacao', '$dt_solicitacao','$usuario','$data_hora')";
$sql_parce = mysqli_query($conn, $select_sql);

// exit();

    if( $sql_update_solicitacao == 1 or $sql_parce == 1){

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
                    <div id="alert-success" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                       PArcelamento finalizado com sucesso!
                    </div>

                    <script>
                        $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-success").slideUp(500);
                        });
                    </script>

                    <?php
                        echo '<meta http-equiv="refresh" content="3;URL=mes.php" />';

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
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">&times;</button>
                                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                            Erro ao salvar
                                        </div>

                                        <?php

           
    }