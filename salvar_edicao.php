<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
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

$cpf;$cep;$nome;$rg;$tel;$tel2;$atividade;$lougadouro;$number;$bairro;$municipio;$uf;$complemento;$referencia;$id_edit;

$end_servico_id;$cep_servico;$lougadouro_servico;$number_servico;$bairro_servico;$uf_servico;$municipio_servico;$complemento_servico;
$referencia_servico;$servico = 2;

// dump($_POST);
// dump($_FILES);
// die();

 $Sql_update_cliente = "UPDATE `clientes` SET `nome`='$nome',`cpf`='$cpf',
`rg`='$rg',`tel`='$tel',`tel2`='$tel2',`atividade`='$atividade',`endereco`='$lougadouro',`cep`='$cep',
`numero`='$number',`bairro`='$bairro',`municipio`='$municipio',`uf`='$uf',
`complemento`='$complemento',`referencia`='$referencia', `id_cliente` = '$servico' WHERE id = '$id_edit' ";
$salvar = mysqli_query($conn, $Sql_update_cliente);


$call = "CALL sp_clientes_after_update(
  $id_edit,'$nome','$cpf','$rg','$tel','$tel2','$atividade','$lougadouro','$cep','$number',
  '$bairro','$municipio','$uf','$complemento','$referencia',0, $servico, $id_user, NOW(), NOW(), NULL)";
$executar_proc = mysqli_query($conn, $call);        

$sql_update_end_servico = "UPDATE clientes_endereco_servico
SET endereco='$lougadouro_servico', cep='$cep_servico', numero='$number_servico', 
bairro='$bairro_servico', municipio='$municipio_servico', uf='$uf_servico', complemento='$complemento_servico', referencia='$referencia_servico'
WHERE id_cliente = $id_edit";
$salvar_end_cliente = mysqli_query($conn, $sql_update_end_servico);


if($end_servico_id == ''){

  $Sql_servico = "INSERT INTO clientes_endereco_servico
  (id_cliente, endereco, cep, numero, bairro, municipio, uf, complemento, referencia,user_created) 
  VALUES ('$id_edit', '$lougadouro_servico', '$cep_servico', '$number_servico', '$bairro_servico', '$municipio_servico'
  ,'$uf_servico', '$complemento_servico', '$referencia_servico', '$id_user')";
  $salvar_end_servico = mysqli_query($conn, $Sql_servico);
  
  $call_end_servico = "CALL sp_clientes_endereco_servico_after_insert(
  $id_edit, '$lougadouro_servico', '$cep_servico', '$number_servico', '$bairro_servico','$municipio_servico',
  '$uf_servico', '$complemento_servico', '$referencia_servico', '$id_user', NOW(), NOW(), NULL)";
  $executar_proc_end_sevico = mysqli_query($conn, $call_end_servico);

}else{

  $sql_update_end_servico = "UPDATE clientes_endereco_servico
  SET endereco='$lougadouro_servico', cep='$cep_servico', numero='$number_servico', 
  bairro='$bairro_servico', municipio='$municipio_servico', uf='$uf_servico', complemento='$complemento_servico', referencia='$referencia_servico'
  WHERE id_cliente = $id_edit";
  $salvar_end_cliente = mysqli_query($conn, $sql_update_end_servico);

  $call_end_servico = "CALL sp_clientes_endereco_servico_after_update(
    $id_edit, '$lougadouro_servico', '$cep_servico', '$number_servico', '$bairro_servico','$municipio_servico',
    '$uf_servico', '$complemento_servico', '$referencia_servico', '$id_user', NOW(), NOW(), NULL)";
    $executar_proc_end_sevico = mysqli_query($conn, $call_end_servico);
}

$select_sql = ("SELECT * FROM `fotos_clientes` where id_cliente = '$id_edit' ");

$recebidos = mysqli_query($conn, $select_sql);
             
while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

  $id_insert_foto = $row_usuario['id'];
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
  //@unlink( "imagens_cliente/".$ftcliente );
  $nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
  $nome_arquivoftcliente = $id_edit ."_". "self". "_". $data_hora_salve ."_". $nome_arquivo_inport;
  move_uploaded_file($_FILES['foto']['tmp_name']['ftcliente'], "imagens_cliente/" . $nome_arquivoftcliente);
  $Sql_update = "UPDATE `fotos_clientes` SET `ftcliente`='$nome_arquivoftcliente' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftrg'];
if($nome_arquivo_inport == ""){
}else{
  //@unlink( "imagens_cliente/".$ftrg );
  $nome_arquivoftrg = $id_edit ."_". "rg". "_". $data_hora_salve ."_". $nome_arquivo_inport;
  move_uploaded_file($_FILES['foto']['tmp_name']['ftrg'], "imagens_cliente/" . $nome_arquivoftrg);
  $Sql_update = "UPDATE `fotos_clientes` SET `ftrg`='$nome_arquivoftrg' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcpf'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftcpf );
$nome_arquivoftcpf = $id_edit ."_". "cpf". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcpf'], "imagens_cliente/" . $nome_arquivoftcpf);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcpf`='$nome_arquivoftcpf' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompres'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftcompres );
$nome_arquivoftcompres = $id_edit ."_". "compres". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompres'], "imagens_cliente/" . $nome_arquivoftcompres);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcompres`='$nome_arquivoftcompres' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftcompcomer'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftcompcomer );
$nome_arquivoftcompcomer = $id_edit ."_". "compcomer". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcompcomer'], "imagens_cliente/" . $nome_arquivoftcompcomer);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcompcomer`='$nome_arquivoftcompcomer' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['fttermo'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$fttermo );
$nome_arquivofttermo = $id_edit ."_". "termo". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['fttermo'], "imagens_cliente/" . $nome_arquivofttermo);
$Sql_update = "UPDATE `fotos_clientes` SET `fttermo`='$nome_arquivofttermo' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}


$nome_arquivo_inport = $_FILES['foto']['name']['ftcertificado'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftcertificado );
$nome_arquivoftcertificado = $id_edit ."_". "certificado". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftcertificado'], "imagens_cliente/" . $nome_arquivoftcertificado);
$Sql_update = "UPDATE `fotos_clientes` SET `ftcertificado`='$nome_arquivoftcertificado' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftlocal );
$nome_arquivoftlocal = $id_edit ."_". "local". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal'], "imagens_cliente/" . $nome_arquivoftlocal);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal`='$nome_nome_arquivoftlocalarquivoftcertificado' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal2'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftlocal2 );
$nome_arquivoftlocal2 = $id_edit ."_". "local2". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal2'], "imagens_cliente/" . $nome_arquivoftlocal2);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal2`='$nome_arquivoftlocal2' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal3'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftlocal3 );
$nome_arquivoftlocal3 = $id_edit ."_". "local3". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal3'], "imagens_cliente/" . $nome_arquivoftlocal3);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal3`='$nome_arquivoftlocal3' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

$nome_arquivo_inport = $_FILES['foto']['name']['ftlocal4'];
if($nome_arquivo_inport == ""){
}else{
//@unlink( "imagens_cliente/".$ftlocal4 );
$nome_arquivoftlocal4 = $id_edit ."_". "local4". "_". $data_hora_salve ."_". $nome_arquivo_inport;
move_uploaded_file($_FILES['foto']['tmp_name']['ftlocal4'], "imagens_cliente/" . $nome_arquivoftlocal4);
$Sql_update = "UPDATE `fotos_clientes` SET `ftlocal4`='$nome_arquivoftlocal4' WHERE id_cliente =  '$id_edit' ";
  $salvar = mysqli_query($conn, $Sql_update);
}

if($id_insert_foto == ''){

 $salve_foto = "INSERT INTO `fotos_clientes`(`id_cliente`,`ftcliente`, `ftrg`, `ftcpf`, `ftcompres`, 
  `ftcompcomer`, `fttermo`, `ftcertificado`,  `ftlocal`, `ftlocal2`, `ftlocal3`,`ftlocal4`, `usuario`, 
  `data_fotos_clientes`) 
  VALUES ($id_edit,'$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres','$nome_arquivoftcompcomer',
  '$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal','$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$id_user','$data_hora')";
  $salvar_foto = mysqli_query($conn, $salve_foto) or die(mysqli_error($conn));
  $id_insert_foto = mysqli_insert_id($conn);
  
  $callfoto ="CALL sp_fotos_clientes_after_insert(
    $id_insert_foto, $id_edit,'$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres',
    '$nome_arquivoftcompcomer','$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal',
    '$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$id_user', NOW(), NOW(),NOW(), NULL)";
  $executar_proc_foto = mysqli_query($conn, $callfoto) or die(mysqli_error($conn));
  
  
}else{
  $callfoto ="CALL sp_fotos_clientes_after_update(
    $id_insert_foto, $id_edit,'$nome_arquivoftcliente','$nome_arquivoftrg','$nome_arquivoftcpf','$nome_arquivoftcompres',
    '$nome_arquivoftcompcomer','$nome_arquivofttermo','$nome_arquivoftcertificado', '$nome_arquivoftlocal',
    '$nome_arquivoftlocal2','$nome_arquivoftlocal3', '$nome_arquivoftlocal4', '$id_user', NOW(), NOW(),NOW(), NULL)";
  $executar_proc_foto = mysqli_query($conn, $callfoto) or die(mysqli_error($conn));

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