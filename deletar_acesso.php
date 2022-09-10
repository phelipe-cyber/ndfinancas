<?php 
    // include_once("starter.php");
    include_once("conexao.php");
    // print_r($_POST);

$id_menu = $_POST['id_menu'];
$id_user = $_POST['id_user'];

// exit();

$deletar_sql = "DELETE FROM user_accesses WHERE `id_menu` = $id_menu";

$salvar = mysqli_query($conn, $deletar_sql);
 
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
       <div id="alert-danger" class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Acesso Deletado !
                </div>

                <script>
                        $("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-danger").slideUp(500);
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
                <script>
                        $("#alert-danger").fadeTo(2000, 500).slideUp(500, function() {
                            $("#alert-danger").slideUp(500);
                        });
                </script>
    <?php
}