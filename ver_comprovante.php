<?php
include_once("starter.php");
include_once("conexao.php");

$id_comprovante = $_GET['id'];

 $select_sql = ("SELECT * FROM `comprovantes` where id = '$id_comprovante' ");
                            
$recebidos = mysqli_query($conn, $select_sql);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

 $nome_arquivo = $row_usuario['comprovante'];
// echo '<img src="'.$row_usuario['comprovante'].'">';


// echo "<div class='col-sm-6'>
// <img class='img-fluid' src='' alt='Photo'>
// </div>";

}
// echo "<br>";
// echo "2_2022-09-02_09_11_57_WhatsApp Image 2022-08-30 at 14.47.15.jpeg";

?>
<!-- <img class="img-circle img-bordered-sm" src="./comprovante/2_2022-09-02_09_11_57_WhatsApp Image 2022-08-30 at 14.47.15.jpeg" alt="user image"> -->
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-12">

<embed style="display: flex;" src="./comprovante/<?php echo $nome_arquivo ?>" width="760" height="500" type='application/pdf'>

