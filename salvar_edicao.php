<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $data_hora_salve = (date('Y-m-d_H:i:s'));

$id_edit = $_POST['id_edit'];
$cpf = $_POST['cpf'];
$cep = $_POST['cep'];
$cnpj = $_POST['cnpj'];
$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$razao_social=$_POST['razao_social'];
$rg=$_POST['rg'];
$tel=$_POST['tel'];
$tel2=$_POST['tel2'];
$atividade=$_POST['atividade'];
$lougadouro=$_POST['lougadouro'];
$number=$_POST['number'];
$bairro=$_POST['bairro'];
$municipio=$_POST['municipio'];
$uf=$_POST['uf'];
$complemento=$_POST['complemento'];
$referencia=$_POST['referencia'];

$cep_emp = $_POST['cep_emp'];
$lougadouro_emp=$_POST['lougadouro_emp'];
$number_emp=$_POST['number_emp'];
$bairro_emp=$_POST['bairro_emp'];
$uf_emp=$_POST['uf_emp'];
$municipio_emp=$_POST['municipio_emp'];
$complemento_emp=$_POST['complemento_emp'];
$referencia_emp=$_POST['referencia_emp'];
$servico = $_POST['servico'];
// $socio = $_POST['servico'];

$Sql_update_cliente = "UPDATE `clientes` SET `nome`='$nome',`sobrenome`='$sobrenome',`socio`='$razao_social',`cpf`='$cpf',
`rg`='$rg',`tel`='$tel',`tel2`='$tel2',`atividade`='$atividade',`endereco`='$lougadouro',`cep`='$cep',
`cnpj`='$cnpj',`numero`='$number',`bairro`='$bairro',`municipio`='$municipio',`uf`='$uf',
`complemento`='$complemento',`referencia`='$referencia',`cep_emp`='$cep_emp',`lougadouro_emp`='$lougadouro_emp',
`number_emp`='$number_emp',`municipio_emp`='$municipio_emp',`uf_emp`='$uf_emp',`bairro_emp`='$bairro_emp',
`complemento_emp`='$complemento',`referencia_emp`='$referencia_emp', `id_cliente` = '$servico' WHERE id = '$id_edit' ";

$salvar = mysqli_query($conn, $Sql_update_cliente);

$select_sql = ("SELECT * FROM `fotos_clientes` where id_cliente = '$id_edit' ");

$recebidos = mysqli_query($conn, $select_sql);
             
while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

  $ftcliente = $row_usuario['ftcliente'];
  $ftrg = $row_usuario['ftrg'];
  $ftcpf = $row_usuario['ftcpf'];
  $ftcompres = $row_usuario['ftcompres'];
  $ftcompcomer = $row_usuario['ftcompcomer'];
  $ftcertificado = $row_usuario['ftcertificado'];
  $fttermo = $row_usuario['fttermo'];
  $ftlocal = $row_usuario['ftlocal'];
  $ftlocal2 = $row_usuario['ftlocal2'];
  $ftlocal3 = $row_usuario['ftlocal3'];
  $ftlocal4 = $row_usuario['ftlocal4'];

}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
if($nome_arquivo_inport == ""){
}else{
  @unlink( "imagens_cliente/".$ftcliente );
  $nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
  $nome_arquivoftcliente = $id_edit ."_". "self". "_". $data_hora_salve ."_". $nome_arquivo_inport;
  move_uploaded_file($_FILES['foto']['tmp_name']['ftcliente'], "imagens_cliente/" . $nome_arquivoftcliente);
  $Sql_update = "UPDATE `fotos_clientes` SET `ftcliente`='$nome_arquivoftcliente' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftrg'];
if($nome_arquivo_inport == ""){
}else{
  @unlink( "imagens_cliente/".$ftrg );
  $nome_arquivoftrg = $id_edit ."_". "rg". "_". $data_hora_salve ."_". $nome_arquivo_inport;
  move_uploaded_file($_FILES['foto']['tmp_name']['ftrg'], "imagens_cliente/" . $nome_arquivoftrg);
  $Sql_update = "UPDATE `fotos_clientes` SET `ftrg`='$nome_arquivoftrg' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcpf'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftcpf );
$nome_arquivoftcpf = $id_edit ."_". "cpf". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcpf'], "imagens_cliente/" . $nome_arquivoftcpf);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcpf`='$nome_arquivoftcpf' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompres'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftcompres );
$nome_arquivoftcompres = $id_edit ."_". "compres". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompres'], "imagens_cliente/" . $nome_arquivoftcompres);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcompres`='$nome_arquivoftcompres' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompcomer'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftcompcomer );
$nome_arquivoftcompcomer = $id_edit ."_". "compcomer". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompcomer'], "imagens_cliente/" . $nome_arquivoftcompcomer);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcompcomer`='$nome_arquivoftcompcomer' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['fttermo'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$fttermo );
$nome_arquivofttermo = $id_edit ."_". "termo". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['fttermo'], "imagens_cliente/" . $nome_arquivofttermo);
$Sql_update = "UPDATE `fotos_clientes` SET `fttermo`='$nome_arquivofttermo' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}


$nome_arquivo_inport = $_FILES['foto']['name']['ftcertificado'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftcertificado );
$nome_arquivoftcertificado = $id_edit ."_". "certificado". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcertificado'], "imagens_cliente/" . $nome_arquivoftcertificado);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcertificado`='$nome_arquivoftcertificado' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftlocal );
$nome_arquivoftlocal = $id_edit ."_". "local". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal'], "imagens_cliente/" . $nome_arquivoftlocal);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal`='$nome_nome_arquivoftlocalarquivoftcertificado' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal2'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftlocal2 );
$nome_arquivoftlocal2 = $id_edit ."_". "local2". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal2'], "imagens_cliente/" . $nome_arquivoftlocal2);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal2`='$nome_arquivoftlocal2' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal3'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftlocal3 );
$nome_arquivoftlocal3 = $id_edit ."_". "local3". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal3'], "imagens_cliente/" . $nome_arquivoftlocal3);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal3`='$nome_arquivoftlocal3' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal4'];
if($nome_arquivo_inport == ""){
}else{
@unlink( "imagens_cliente/".$ftlocal4 );
$nome_arquivoftlocal4 = $id_edit ."_". "local4". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal4'], "imagens_cliente/" . $nome_arquivoftlocal4);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal4`='$nome_arquivoftlocal4' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}



// exit();
 if( $salvar == 1 ){
    ?>
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-12">
            
                      <div id="spiner" style="display: none;">
                
                <div class="text-center">
                  <div class="spinner-border" role="status">

                  </div>
                </div>
                <div class="text-center">
                  
                </div>
              </div>
       <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Alteraçã feita com Sucesso
                </div>
    <?php
       echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
  }else{
    ?>
    <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="col-12">
            
                      <div id="spiner" style="display: none;">
               
                <div class="text-center">
                  <div class="spinner-border" role="status">

                  </div>
                </div>
                <div class="text-center">
                 
                </div>
              </div>
     <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  Erro ao Salvar
                </div>
    <?php
  }


?>