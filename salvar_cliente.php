<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $id_user = $_SESSION['id_user'];

 $data_hora_salve = (date('Y-m-d_H:i:s'));

 function format_post_automatic($post) {
  $new_post = [];
  foreach ($post as $key => $value) {
      if (is_string($value)) {
          // Converter para maiúsculas
          $value = strtoupper($value);

          // Se o campo for telefone (contém "tel" no nome)
          if (stripos($key, 'tel') !== false) {
              // Remove tudo que não for número
              $numbers = preg_replace('/\D/', '', $value);

              // Adiciona prefixo 55 (Brasil) se não tiver
              if ($numbers && substr($numbers, 0, 2) != '55') {
                  $numbers = '55' . $numbers;
              }

              $value = $numbers;
          }
      }
      $new_post[$key] = $value;
  }
  return $new_post;
}

// Aplicar no $_POST
$_POST = format_post_automatic($_POST);

// Criar variáveis automaticamente
extract($_POST);

$cpf;$cep;$nome;$rg;$tel;$tel2;$atividade;$lougadouro;$number;$bairro;$municipio;$uf;$complemento;$referencia;

$cep_servico;$lougadouro_servico;$number_servico;$bairro_servico;$uf_servico;$municipio_servico;$complemento_servico;
$referencia_servico;$servico = 2;

// dump($_FILES);
// echo "</br>";
// dump($_POST);
// die();

$Sql = "INSERT INTO clientes
(nome, cpf, rg, tel, tel2, atividade, endereco, cep, numero, bairro, municipio, uf, complemento, 
referencia, status_cliente, id_cliente, user_created)
VALUES('$nome', '$cpf', '$rg', '$tel', '$tel2', '$atividade', 
'$lougadouro', '$cep', '$number', '$bairro', '$municipio', '$uf', '$complemento', '$referencia', 0, $servico, $id_user)";
$salvar = mysqli_query($conn, $Sql);
$id_insert = mysqli_insert_id($conn);
// print_r($id_insert);

$call = "CALL sp_clientes_after_insert(
  $id_insert,'$nome','$cpf','$rg','$tel','$tel2','$atividade','$lougadouro','$cep','$number',
  '$bairro','$municipio','$uf','$complemento','$referencia',0, $servico, $id_user, NOW(), NOW(), NULL)";
$executar_proc = mysqli_query($conn, $call);

$Sql_servico = "INSERT INTO clientes_endereco_servico
(id_cliente, endereco, cep, numero, bairro, municipio, uf, complemento, referencia,user_created) 
VALUES ('$id_insert', '$lougadouro_servico', '$cep_servico', '$number_servico', '$bairro_servico', '$municipio_servico'
,'$uf_servico', '$complemento_servico', '$referencia_servico', '$id_user')";
$salvar_end_servico = mysqli_query($conn, $Sql_servico);

$call_end_servico = "CALL sp_clientes_endereco_servico_after_insert(
$id_insert, '$lougadouro_servico', '$cep_servico', '$number_servico', '$bairro_servico','$municipio_servico',
'$uf_servico', '$complemento_servico', '$referencia_servico', '$id_user', NOW(), NOW(), NULL)";
$executar_proc_end_sevico = mysqli_query($conn, $call_end_servico);


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

$salve_foto = "INSERT INTO `fotos_clientes`(`id_cliente`,`ftcliente`, `ftrg`, `ftcpf`, `ftcompres`, 
`ftcompcomer`, `fttermo`, `ftcertificado`,  `ftlocal`, `ftlocal2`, `ftlocal3`,`ftlocal4`, `usuario`, 
`data_fotos_clientes`) 
VALUES ($id_insert,'$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres','$nome_arquivoftcompcomer',
'$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal','$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$id_user','$data_hora')";
$salvar_foto = mysqli_query($conn, $salve_foto) or die(mysqli_error($conn));
$id_insert_foto = mysqli_insert_id($conn);

$callfoto ="CALL sp_fotos_clientes_after_insert(
  $id_insert_foto, $id_insert,'$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres',
  '$nome_arquivoftcompcomer','$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal',
  '$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$id_user', NOW(), NOW(),NOW(), NULL)";
$executar_proc_foto = mysqli_query($conn, $callfoto) or die(mysqli_error($conn));

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