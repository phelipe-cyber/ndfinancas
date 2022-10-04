<?php 
    // include_once("starter.php");

use Faker\Guesser\Name;

    include_once("conexao.php");

 ?>

 <?php   
    // print_r($_POST);

$id = $_POST['id'];

// $acesso_select = "SELECT menu_name, 
// GROUP_CONCAT( DISTINCT menu_folder ORDER BY `id` ASC SEPARATOR '|-separator-sql-|') as `menu_folder`,
// GROUP_CONCAT( DISTINCT menu ORDER BY `id` ASC SEPARATOR '|-separator-sql-|') as `menu`,
// GROUP_CONCAT( DISTINCT id ORDER BY `id` ASC SEPARATOR '|-separator-sql-|') as `id`

// FROM `menus`
// GROUP BY menu_name
// ORDER BY id;";


 $acesso_select = "SELECT menu_name,
 GROUP_CONCAT( DISTINCT a.menu_folder ORDER BY a.`id` ASC SEPARATOR '|-separator-sql-|') as `menu_folder`,
 GROUP_CONCAT( DISTINCT a.menu ORDER BY a.`id` ASC SEPARATOR '|-separator-sql-|') as `menu`,
 GROUP_CONCAT( DISTINCT a.id ORDER BY a.`id` ASC SEPARATOR '|-separator-sql-|') as `id`,
 GROUP_CONCAT( IF( (SELECT 
 d.menu_folder 
 FROM `user_accesses` d 
 WHERE d.menu_folder = a.menu_folder and d.menu_folder in (SELECT menu_folder FROM `menus` ) and d.id_usuario = '$id' LIMIT 1 )                                    
 IS NULL, 'Sem Acesso' , 'Com acesso') ORDER BY a.`id` ASC SEPARATOR '|-separator-sql-|') as `acesso`
 FROM `menus` a 
 GROUP by a.menu_name 
 ORDER BY a.id;";

$recebidos = mysqli_query($conn, $acesso_select);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    // ($row_usuario);
    $acessos[] = ($row_usuario);
    // $menu_folder[] = ($row_usuario['menu_folder']);
    
};



foreach( $acessos as $ver_acessos):
    // print_r($ver_acessos);
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo $ver_acessos['menu_name'] ?></h3>
    </div>
    <div class="card-body">
    <?php 
          
          $ver_acessos_name = explode('|-separator-sql-|', $ver_acessos['menu_folder']);
          $menu_sep = explode('|-separator-sql-|', $ver_acessos['menu']);
          $ids = explode('|-separator-sql-|', $ver_acessos['id']);
          $acesso = explode('|-separator-sql-|', $ver_acessos['acesso']);
        //   $status = explode('|-separator-sql-|', $ver_acessos['status']);
        //   print_r($acesso);
          $index2 = 0;
          foreach ($ver_acessos_name as $key => $name):
            
            // print_r($acesso[$key]);

            ?>
                <div class="row">
                <div class="col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <?php
                                                        //    print_r($acesso[$key]) ;
                                                        if( $acesso[$key] == 'Com acesso' ){
                                                           ?>
                                                                  <input checked value="<?php echo($ids[$key]) ?>" type="checkbox" class="custom-control-input"
                                                            id="customSwitch<?php echo $name?>">
                                                        
                                                            <label class="custom-control-label"
                                                            for="customSwitch<?php echo($name) ?>"><?php echo($menu_sep[$key] ) ?></label>

                                                            <input id="id_menu<?php echo($name) ?>" value="<?php echo($ids[$key]) ?>" type="hidden">
                                                            
                                                            <input id="id_user<?php echo($name) ?>" value="<?php echo($_POST['id']) ?>" type="hidden">
                                                           <?php     
                                                        }else{

                                                            ?>
                                                            <input value="<?php echo($ids[$key]) ?>" type="checkbox" class="custom-control-input"
                                                      id="customSwitch<?php echo $name?>">
                                                  
                                                      <label class="custom-control-label"
                                                      for="customSwitch<?php echo($name) ?>"><?php echo($menu_sep[$key] ) ?></label>

                                                      <input id="id_menu<?php echo($name) ?>" value="<?php echo($ids[$key]) ?>" type="hidden">
                                                      
                                                      <input id="id_user<?php echo($name) ?>" value="<?php echo($_POST['id']) ?>" type="hidden">
                                                     <?php  

                                                        }
                                                        ?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                              $(document).ready(function() {
                                        $("#customSwitch<?php echo $name ?>").click(function() {

                                            var isChecked = document.getElementById("customSwitch<?php echo $name ?>").checked;
                                            // console.log(isChecked);

                                            if (isChecked == false) {

                                                let id_menu = document.getElementById("id_menu<?php echo($name) ?>").value;
                                                        let id_user = document.getElementById("id_user<?php echo($name) ?>").value;

                                                var vData = {
                                                                id_menu: id_menu,
                                                                id_user: id_user
                                                            };
                                                            console.log(vData);
                                                            $.ajax({
                                                                url: 'deletar_acesso.php',
                                                                dataType: 'html',
                                                                type: 'POST',
                                                                data: vData,
                                                                success: function(html) {
                                                                    //   console.log(html);
                                                                    //html é a resposta que a URL que pesquisamos retornou
                                                                    // depois adicionamos o html dentro do html da div form_content
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                    // document.getElementById('add_pedido').style = 'display:block;';
                                                                    $('#add_pedido_acesso').html(html);
                                                                    // document.location.reload(true);
                                                                },
                                                                error: function(err) {
                                                                    // console.log(err);
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                },
                                                            });
                                              

                                            } else {

                                                let id_menu = document.getElementById("id_menu<?php echo($name) ?>").value;
                                                        let id_user = document.getElementById("id_user<?php echo($name) ?>").value;

                                                var vData = {
                                                                id_menu: id_menu,
                                                                id_user: id_user
                                                            };
                                                            console.log(vData);
                                                            $.ajax({
                                                                url: 'salvar_acesso.php',
                                                                dataType: 'html',
                                                                type: 'POST',
                                                                data: vData,
                                                                success: function(html) {
                                                                    //   console.log(html);
                                                                    //html é a resposta que a URL que pesquisamos retornou
                                                                    // depois adicionamos o html dentro do html da div form_content
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                    // document.getElementById('add_pedido').style = 'display:block;';
                                                                    $('#add_pedido_acesso').html(html);
                                                                    // document.location.reload(true);
                                                                },
                                                                error: function(err) {
                                                                    // console.log(err);
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                },
                                                            });

                                            }

                                        });
                                    });

                                        </script>
                                        <script>
                                                $(document).ready(function() {
                                                    $("#customSwitch<?php echo($name) ?>").change(function() {
                                                        // document.getElementById('spiner').style = 'display:block;';
                                                       
                                                            // console.log("CLICK");

                                                        if (id_menu == "") {

                                                        } else {
                                                         
                                                        };
                                                    })
                                                });
                                            </script>
                                        <?php
                                            $index2 ++;
                                        endforeach;
                                        ?>

</div>
</div>

<?php
          $index ++;
endforeach;

die();

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