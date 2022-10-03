<?php 
session_start();
include_once("verifica_login.php");
include_once("conexao.php");

$id_user = $_SESSION['id_user'];

$acesso_select = "SELECT menu_name, GROUP_CONCAT( DISTINCT menu_folder ORDER BY `id` ASC SEPARATOR '|-separator-sql-|') as `menu_folder`,
GROUP_CONCAT( DISTINCT menu ORDER BY `id` ASC SEPARATOR '|-separator-sql-|') as `menu`
FROM `user_accesses`
WHERE `id_usuario` = '$id_user' and status = 1
GROUP BY menu_name
ORDER BY id;";

$recebidos = mysqli_query($conn, $acesso_select);
while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    // ($row_usuario);
    $acessos[] = ($row_usuario);
    // $menu_folder[] = ($row_usuario['menu_folder']);
};

 $acesso_select_page = "SELECT menu_folder FROM `user_accesses` WHERE '$id_user'  ORDER BY id;";

$recebidos_page = mysqli_query($conn, $acesso_select_page);
$acessos_page = [];
while ($row_usuario_page = mysqli_fetch_assoc($recebidos_page)) {
//    print_r($row_usuario_page);
    $acessos_page[] = $row_usuario_page['menu_folder'];
    // $menu_folder[] = ($row_usuario['menu_folder']);
};
// print_r($acessos);
// print_r($_SERVER);

 $SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];

$search  = array_map('trim',array("'", '.php', '/','\\'));

$array_salvar = str_replace($search, "",  $SCRIPT_NAME);

$sql_menu = "SELECT menu_name FROM `menus` where menu_folder = '$array_salvar' ORDER BY `menus`.`id` ASC";

 $recebidos_menu = mysqli_query($conn, $sql_menu);
 
 while ($row_menu = mysqli_fetch_assoc($recebidos_menu)) {

     $menu = $row_menu['menu_name'];
    
 };


?>  
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
       $(document).ready(function() {
            document.getElementById('<?php echo  $array_salvar ?>').classList.add('active');
            document.getElementById('<?php echo  $menu ?>').classList.add('menu-open');
       })
</script>