<?php 
    // include_once("starter.php");
    include_once("conexao.php");
    // print_r($_POST);

$id = $_POST['id'];

$select_sql = ("SELECT status_solicitacao FROM `clientes` where id = $id ORDER BY id ASC ");
$recebidos = mysqli_query($conn, $select_sql);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    $status_solicitacao = $row_usuario['status_solicitacao'];

}

if( $status_solicitacao == 1 ){
    ?>
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

