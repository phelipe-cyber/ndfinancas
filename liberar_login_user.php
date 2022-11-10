<?php
include_once("conexao.php");

// print_r($_POST);
// exit();

$id = $_POST['id_user'];
$status = $_POST['status'];

$sql = "UPDATE `user` SET `status_login` = '$status', `session` = '' WHERE `id` = '$id' " ;

$validar_sql = mysqli_query($conn, $sql);

if( $status == 1 ){
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
                Login liberado ao sistema!
                </div>

                <script>
                        $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-success").slideUp(500);
                        });
                </script>
    <?php
    //    echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
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
                Login bloqueado ao sistema
                </div>

                <script>
                        $("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-danger").slideUp(500);
                        });
                </script>
    <?php
}


?>