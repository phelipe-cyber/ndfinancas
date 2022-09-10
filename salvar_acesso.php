<?php 
    // include_once("starter.php");
    include_once("conexao.php");
    // print_r($_POST);

$id_menu = $_POST['id_menu'];
$id_user = $_POST['id_user'];

 $validar_acesso = "SELECT * FROM `user_accesses` where id_usuario = $id_user and id_menu = '$id_menu' ";
$validar_sql = mysqli_query($conn, $validar_acesso);

$row = mysqli_num_rows($validar_sql);
// print_r($row);
// exit();
?><script src="https://code.jquery.com/jquery-1.9.1.js"></script><?php

if( $row == 1 ){
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
                  Acesso já liberado !
                </div>
                    
                <script>
                        $("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-danger").slideUp(500);
                        });

                </script>



    <?php
   
}else{
    
    //    echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
    
    $select_sql = ("SELECT * FROM `menus` where id = $id_menu; ");

    $recebidos = mysqli_query($conn, $select_sql);
    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        // print_r($row_usuario);
        $menu_folder = $row_usuario['menu_folder'];
        $menu = $row_usuario['menu'];
        $menu_name = $row_usuario['menu_name'];
        $status = $row_usuario['status'];

    }


    $sql_salvar = "INSERT INTO `user_accesses`(`id`, `id_usuario`, `id_menu`, `menu_name`, `menu_folder`, `menu`, `status`)

    VALUES (null,'$id_user', '$id_menu', '$menu_name','$menu_folder','$menu','$status')";

    $salvar = mysqli_query($conn, $sql_salvar);
    
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
        <div id="alert-success" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Acesso liberado !
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
        <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    Erro 
                    </div>
        <?php
    }
}