<?php
include_once("conexao.php");
include_once("starter.php");

// print_r($_POST);
// exit();

$id = $_POST['id_user'];
$password = $_POST['password2'];

$hashToStoreInDb = MD5($password);

 $sql = "UPDATE `user` SET `senha` = '$hashToStoreInDb' WHERE `user`.`id` = '$id' " ;

$validar_sql = mysqli_query($conn, $sql);

if( $validar_sql == 1 ){
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
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                Senha alterada com sucesso!
                </div>

                <script>
                        $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-success").slideUp(500);
                        });
                </script>
    <?php
       echo '<meta http-equiv="refresh" content="2;URL=logout.php" />';
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
    <div id="alert-danger" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Erro
                </div>

                <script>
                        $("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-danger").slideUp(500);
                        });
                </script>
    <?php
}


?>