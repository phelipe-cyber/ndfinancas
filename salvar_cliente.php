<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $data_hora_salve = (date('Y-m-d_H:i:s'));

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
$socio = $_POST['servico'];



    $Sql = "INSERT INTO `clientes`(`id`, `nome`, `sobrenome`, `socio`,`cpf`, `rg`, `tel`, `tel2`, `atividade`, `endereco`, `cep`, `cnpj`, `numero`, `bairro`, `municipio`, `uf`, `complemento`, `referencia`, `cep_emp`, `lougadouro_emp`, `number_emp`, `municipio_emp`, `uf_emp`, `bairro_emp`, `complemento_emp`, `referencia_emp`, `status_cliente`, `id_cliente`, `user_created`, `data_hora_cliente`)
     VALUES (null,'$razao_social', '$sobrenome', '$nome','$cpf', '$rg', '$tel', '$tel2', '$atividade', '$lougadouro', '$cep', '$cnpj', '$number',
    '$bairro', '$municipio', '$uf', '$complemento', '$referencia', '$cep_emp', '$lougadouro_emp', '$number_emp', 
    '$municipio_emp', '$uf_emp', '$bairro_emp', '$complemento_emp', '$referencia_emp', '0', '$servico', '$usuario', '$data_hora')";

$salvar = mysqli_query($conn, $Sql);
$id_insert = mysqli_insert_id($conn);
// print_r($id_insert);
// exit();


$nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftcliente = $id_insert ."_". "self". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcliente'], "imagens_cliente/" . $nome_arquivoftcliente);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftrg'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftrg = $id_insert ."_". "rg". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftrg'], "imagens_cliente/" . $nome_arquivoftrg);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcpf'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftcpf = $id_insert ."_". "cpf". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcpf'], "imagens_cliente/" . $nome_arquivoftcpf);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompres'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftcompres = $id_insert ."_". "compres". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompres'], "imagens_cliente/" . $nome_arquivoftcompres);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompcomer'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftcompcomer = $id_insert ."_". "compcomer". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompcomer'], "imagens_cliente/" . $nome_arquivoftcompcomer);
}

$nome_arquivo_inport = $_FILES['foto']['name']['fttermo'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivofttermo = $id_insert ."_". "termo". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['fttermo'], "imagens_cliente/" . $nome_arquivofttermo);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcertificado'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftcertificado = $id_insert ."_". "termo". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcertificado'], "imagens_cliente/" . $nome_arquivoftcertificado);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftlocal = $id_insert ."_". "local". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal'], "imagens_cliente/" . $nome_arquivoftlocal);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal2'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftlocal2 = $id_insert ."_". "local2". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal2'], "imagens_cliente/" . $nome_arquivoftlocal2);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal3'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftlocal3 = $id_insert ."_". "local3". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal3'], "imagens_cliente/" . $nome_arquivoftlocal3);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal4'];
if($nome_arquivo_inport == ""){
}else{
$nome_arquivoftlocal4 = $id_insert ."_". "local4". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal4'], "imagens_cliente/" . $nome_arquivoftlocal4);
}

$salve_foto = "INSERT INTO `fotos_clientes`(`id`, `id_cliente`,`ftcliente`, `ftrg`, `ftcpf`, `ftcompres`, 
`ftcompcomer`, `fttermo`, `ftcertificado`,  `ftlocal`, `ftlocal2`, `ftlocal3`,`ftlocal4`, `usuario`, 
`data_fotos_clientes`) 
VALUES (null,'$id_insert','$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres','$nome_arquivoftcompcomer',
'$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal','$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$usuario','$data_hora')";

$salvar_foto = mysqli_query($conn, $salve_foto) or die(mysqli_error($conn));


// exit();
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
       <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  Salvo com Sucesso
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
                  Erro ao Salvar
                </div>
    <?php
}


?>