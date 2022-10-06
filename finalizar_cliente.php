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

 $sql_solicitacao = "UPDATE `solicitacao` SET `status_solicitacao` = 4 WHERE `id` = '$id_solicitacao' " ;
$sql_update_solicitacao = mysqli_query($conn, $sql_solicitacao);


 $sql_update = "UPDATE `clientes` SET `status_cliente` = 0 WHERE `id` = '$id_cliente' " ;
$salve_update_cliente = mysqli_query($conn, $sql_update);

    if( $sql_update == 1 or $salve_update_cliente == 1){

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
                        Finalizado com sucesso!
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