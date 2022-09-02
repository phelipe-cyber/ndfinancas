<?php 
    // include_once("starter.php");
    include_once("conexao.php");
    // print_r($_POST);

$id = $_POST['id'];

 $select_sql = ("SELECT status_cliente FROM `clientes` where id = $id; ");

$recebidos = mysqli_query($conn, $select_sql);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    $status_solicitacao = $row_usuario['status_cliente'];

}

if( $status_solicitacao == 1 ){
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
                <div id="danger-alert" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                    Cliente Em Andamento
                  </div>

                  <script>

                    document.getElementById('button').style = 'display:none;';
                $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
                        $("#danger-alert").slideUp(500);
                    });


                </script>
    <?php

    //    echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
    }else{
        ?>
        <script>
            document.getElementById('button').style = 'display:flex;';
        </script>

            <?php
                
        }
        ?>

