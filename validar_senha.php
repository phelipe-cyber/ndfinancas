<?php
include_once("conexao.php");

// print_r($_POST);

$password = $_POST['senha'];
$id_user = $_POST['id_user'];


$query = "select * from user where id = '{$id_user}' and senha = md5('{$password}') ";

$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);

// print_r($row);

if( $row == 1 ){
    ?>
    <script>
        document.getElementById('erro').style = 'display:none;';
        document.getElementById('validada_senha').style = 'display:block;';
    </script>
    
<?php  
    
}else{
    
    ?>
        <script>
            document.getElementById('erro').style = 'display:block;';
            document.getElementById('validada_senha').style = 'display:none;';
            
        </script>
        
    <?php  
}
    