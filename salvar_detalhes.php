<?php

include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $data_hora_salve = (date('Y-m-d_H:i:s'));
 $usuario = $_SESSION['login'];

 $id_solicitacao = $_POST['id_solicitacao'];
 $id_cliente = $_POST['id_cliente'];

$parcela_pgto = $_POST['parcela_pgto'];

$valor_pago = $_POST['valor_pago'];
$valor_pago = preg_replace("/[^0-9,]+/i","",$valor_pago);
$valor_pago = str_replace(",",".",$valor_pago);


$atraso_diaria = $_POST['atraso_diaria'];
$atraso_diaria = preg_replace("/[^0-9,]+/i","",$atraso_diaria);
$atraso_diaria = str_replace(",",".",$atraso_diaria);

$total_atraso = $_POST['total_atraso'];
$total_atraso = preg_replace("/[^0-9,]+/i","",$total_atraso);
$total_atraso = str_replace(",",".",$total_atraso);

$atraso_parcela = $_POST['atraso_parcela'];
$atraso_parcela = preg_replace("/[^0-9,]+/i","",$atraso_parcela);
$atraso_parcela = str_replace(",",".",$atraso_parcela);


$dt_pgto = $_POST['dt_pgto'];
$nomeEvento = $_POST['nome_evento'];
$descricaoEvento = $_POST['descricao_evento'];
$imagem = $_FILES['imagem']['tmp_name'];
$tamanho = $_FILES['imagem']['size'];
$tipo = $_FILES['imagem']['type'];
$nome = $_FILES['imagem']['name'];

// print_r($_POST);

if($parcela_pgto == 20){
  
  $update = "UPDATE clientes SET status_cliente = 4 WHERE id = $id_cliente";
  $salvar_update = mysqli_query($conn, $update);
  
  $update_status = "UPDATE `solicitacao` SET `status_solicitacao`= 4 WHERE id = $id_solicitacao";
  $salve_pgto = mysqli_query($conn, $update_status);
  
};
// echo $total_atraso;
if( $total_atraso == "0.00" || $total_atraso == "" ){
  $em_aberto = "0.00";
}else{
  $em_aberto = $total_atraso - $valor_pago;
}

// echo $em_aberto;
// print_r($_POST);
// exit();

$nome_arquivo = $id_solicitacao."_".$data_hora_salve."_".$nome;

 $queryInsercao = "INSERT INTO `comprovantes`(`id`, `id_solicitacao`, `comprovante`, `usuario`, `dt_pgto`, `data_comprovante`)
VALUES (null, '$id_solicitacao', '$nome_arquivo', '$usuario', '$dt_pgto', '$data_hora' )";

$salvar = mysqli_query($conn, $queryInsercao);

$sql_pago = "INSERT INTO `valor_pago`(`id`, `id_solicitacao`, `valor_pago`, `atraso_diaria`,  `atraso_parcela`, `total_atraso`, `em_aberto`, `usuario`, `data_valor_pago`) 
VALUES (null,'$id_solicitacao', '$valor_pago', '$atraso_diaria', '$atraso_parcela', '$total_atraso', '$em_aberto','$usuario', '$data_hora')";
$salvar_pago = mysqli_query($conn, $sql_pago);

$update_pgto = "UPDATE `solicitacao` SET `dt_pgto`='$dt_pgto' WHERE id = $id_solicitacao";
$salve_pgto = mysqli_query($conn, $update_pgto);


move_uploaded_file($_FILES['imagem']['tmp_name'], "comprovante/" . $nome_arquivo);

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
       echo '<meta http-equiv="refresh" content="3;URL=mes.php" />';
      //  echo '<meta http-equiv="refresh" content="3;URL=starter.php" />';
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

exit();


// dd($_POST);
// exit();
// if ( $imagem != "none" )
// {
//     $fp = fopen($imagem, "rb");
//     $conteudo = fread($fp, $tamanho);
//     $conteudo = addslashes($conteudo);
//     fclose($fp);


/*-----------------------------------------------------------------------------*
 * Parte 1: Configurações do Envio de arquivos via FTP com PHP
/*----------------------------------------------------------------------------*/

// IP do Servidor FTP
$servidor_ftp = 'ftp.ndfinancas.com.br';
// Usuário e senha para o servidor FTP
$usuario_ftp = 'u841971040.ndfinancas';
$senha_ftp   = 'Ph@20192008Vba';

// Extensões de arquivos permitidas
$extensoes_autorizadas = array( '.exe', '.jpg', '.mp4', '.mkv', '.txt', '.csv' , '.jpeg');

// Caminho da pasta FTP
$caminho = './comprovante/';

/* 
Se quiser limitar o tamanho dos arquivo, basta colocar o tamanho máximo 
em bytes. Zero é ilimitado
*/
$limitar_tamanho = 0;

/* 
Qualquer valor diferente de 0 (zero) ou false, permite que o arquivo seja 
sobrescrito
*/
$sobrescrever = 0;

/*-----------------------------------------------------------------------------*
 * Parte 2: Configurações do arquivo
/*----------------------------------------------------------------------------*/

// Verifica se o arquivo não foi enviado. Se não; termina o script.
if ( ! isset( $_FILES['imagem'] ) ) {
	exit('Nenhum arquivo enviado!');
}

// Aqui o arquivo foi enviado e vamos configurar suas variáveis
$arquivo = $_FILES['imagem'];

// Nome do arquivo enviado
 $nome_arquivo = $arquivo['name'];

// Renomeado
$nome_arquivo = $id_solicitacao."_".$data_hora_salve."_".$nome_arquivo;

 $queryInsercao = "INSERT INTO `comprovantes`(`id`, `id_solicitacao`, `comprovante`, `usuario`, `data_comprovante`)
VALUES (null, '$id_solicitacao', '$nome_arquivo', '$usuario', '$data_hora' )";

$salvar = mysqli_query($conn, $queryInsercao);


// Tamanho do arquivo enviado
$tamanho_arquivo = $arquivo['size'];

// Nome do arquivo temporário
 $arquivo_temp = $arquivo['tmp_name'];

// Extensão do arquivo enviado
 $extensao_arquivo = strrchr( $nome_arquivo, '.' );

// O destino para qual o arquivo será enviado
 $destino = $caminho . $nome_arquivo;

/*-----------------------------------------------------------------------------*
 *  Parte 3: Verificações do arquivo enviado
/*----------------------------------------------------------------------------*/

/* 
Se a variável $sobrescrever não estiver configurada, assumimos que não podemos 
sobrescrever o arquivo. Então verificamos se o arquivo existe. Se existir; 
terminamos aqui. 
*/

if ( ! $sobrescrever && file_exists( $destino ) ) {
	exit('Arquivo já existe.');
}

/* 
Se a variável $limitar_tamanho tiver valor e o tamanho do arquivo enviado for
maior do que o tamanho limite, terminado aqui.
*/

if ( $limitar_tamanho && $limitar_tamanho < $tamanho_arquivo ) {
	exit('Arquivo muito grande.');
}

/* 
Se as $extensoes_autorizadas não estiverem vazias e a extensão do arquivo não 
estiver entre as extensões autorizadas, terminamos aqui.
*/

if ( ! empty( $extensoes_autorizadas ) && ! in_array( $extensao_arquivo, $extensoes_autorizadas ) ) {
	exit('Tipo de arquivo não permitido.');
}

/*-----------------------------------------------------------------------------*
 * Parte 4: Conexão FTP
/*----------------------------------------------------------------------------*/

// Realiza a conexão
$conexao_ftp = ftp_connect( $servidor_ftp );

// Tenta fazer login
 $login_ftp = ftp_login( $conexao_ftp, $usuario_ftp, $senha_ftp );

// Se não conseguir fazer login, termina aqui
if ( ! $login_ftp ) {
	exit('Usuário ou senha FTP incorretos.');
}

ftp_pasv( $conexao_ftp, true );

// Envia o arquivo
if ( @ftp_put( $conexao_ftp, $destino, $arquivo_temp, FTP_BINARY ) ) {
	// Se for enviado, mostra essa mensagem
	echo 'Arquivo enviado com sucesso!';

} else {
	// Se não for enviado, mostra essa mensagem
    echo 'Erro ao enviar arquivo!';
}


// Fecha a conexão FTP
ftp_close( $conexao_ftp );


?>
