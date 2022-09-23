<?php 
include_once("starter.php");
include_once("conexao.php");
date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];

$login = $_POST['login'];
$password = $_POST['password'];

$validar_usuario = "SELECT * FROM `user` where usuario = '$login' ";
$validar_sql_login = mysqli_query($conn, $validar_usuario);
$row_usuario = mysqli_num_rows($validar_sql_login);

if( $row_usuario == 1 ){

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
                Login já existe !
                </div>
    <?php


}else{

    // $hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);

    $hashToStoreInDb = MD5($password);
    $ran_id = rand(time(), 100000000);

    $sql_login = "INSERT INTO `user`(`id`, `unique_id`, `usuario`, `senha`, `status`)
    VALUES (null,'$ran_id', '$login', '$hashToStoreInDb', 'Off-line agora' )";

    $validar_sql = mysqli_query($conn, $sql_login);

    $id_user = mysqli_insert_id($conn);

    $salve_acesso = "INSERT INTO `user_accesses` (`id`, `id_usuario`, `id_menu`, `menu_name`, `menu_folder`, `menu`, `status`) 
    VALUES (NULL, '$id_user', '11', 'Inicio', 'starter', 'Inicio', '0')";
    $salve_acesso_user = mysqli_query($conn, $salve_acesso);


    // $row = mysqli_num_rows($validar_sql);
    // print_r($validar_sql);
    // exit();
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
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Login criado com sucesso
                    </div>
                        
                    <script>
                            $("#alert-success").fadeTo(2000, 500).slideUp(500, function() {
                                $("#alert-success").slideUp(500);
                            });
    
                    </script>
    
    
    
        <?php

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
                        Erro ao salvar
                        </div>
    
            <?php

           
    }
}
