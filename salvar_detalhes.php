<?php

include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
$data_hora = (date('Y-m-d H:i:s'));
$data_hora_salve = (date('Y-m-d_H:i:s'));
$usuario = $_SESSION['login'];
$id_user = $_SESSION['id_user'];
$id_solicitacao = $_POST['id_solicitacao'];
$id_cliente = $_POST['id_cliente'];
$dt_pgto = $_POST['dt_pgto'];
$ultimadata = $_POST['ultimadata'];
$nomeEvento = $_POST['nome_evento'];
$descricaoEvento = $_POST['descricao_evento'];
$imagem = $_FILES['imagem']['tmp_name'];
$tamanho = $_FILES['imagem']['size'];
$tipo = $_FILES['imagem']['type'];
$nome = $_FILES['imagem']['name'];

/**
 * Converte número em formato brasileiro para float
 * Ex: "1.234,56" -> 1234.56
 * Converte número em formato brasileiro para float
 * Aceita string ou null
 */

function brToFloat(?string $valor): float
{
  if ($valor === null || trim($valor) === '' || $valor === '0,00' || $valor === '0.00') {
    return 0.00;
  }

  $valor = trim($valor);

  // Caso tenha vírgula -> formato brasileiro (1.234,56)
  if (strpos($valor, ',') !== false) {
    $valor = str_replace('.', '', $valor);   // remove separador de milhar
    $valor = str_replace(',', '.', $valor);  // troca vírgula decimal por ponto
  } else {
    // Caso não tenha vírgula -> formato americano (1234.56)
    $valor = str_replace(',', '', $valor); // só garante que não tenha vírgula
  }

  return (float) $valor;
}

function floatToBr(float $valor): string
{
  return number_format($valor, 2, ',', '.');
}

// Converte automaticamente todos os campos do $_POST
$dados = array_map('brToFloat', $_POST);

// Agora você já tem os valores como float:
$parcela_pgto         = $dados['parcela_pgto']        ?? 0.00;
$total_em_atraso      = $dados['total_em_atraso']     ?? 0.00;
$valor_pago           = $dados['valor_pago']          ?? 0.00;
$atraso_diaria        = $dados['atraso_diaria']       ?? 0.00;
$juros_diaria         = $dados['juros_diaria']        ?? 0.00;
$total_atraso         = $dados['total_atraso']        ?? 0.00;
$atraso_parcela       = $dados['atraso_parcela']      ?? 0.00;
$abatimento           = $dados['abatimento']          ?? 0.00;
$valor_solicitado     = $dados['valor_solicitado']    ?? 0.00;
$juros_mensal         = $dados['juros_mensal']        ?? 0.00;
$quitacao             = $dados['quitacao']            ?? 0.00;
$sum_pgto             = $dados['sum_pgto']            ?? 0.00;
$juros                = $dados['juros']               ?? 0.00;
$atraso_juros_mensal  = $dados['atraso_juros_mensal'] ?? 0.00;
$porcento             = $dados['porcento']            ?? 0.00;
$valor_bruto          = $dados['valor_bruto']         ?? 0.00;

$valor_pago_comprovante = $valor_pago;
$valor_pago = $sum_pgto + $valor_pago;

// 1) Total Diária
if ($atraso_diaria == 0.00 && $total_em_atraso == 0.00 || $atraso_diaria == 0 && $total_em_atraso == 0 ) {
    $newTotalDiaria = 0;
} elseif( $atraso_diaria == 0 || $atraso_diaria == 0.00) {
  $newTotalDiaria = $total_em_atraso - $juros_diaria;
  // echo "newTotalDiaria Vazio " . floatToBr($newTotalDiaria) . PHP_EOL;
}else{
  $newTotalDiaria = $total_em_atraso + $atraso_diaria - $juros_diaria;
  // echo "newTotalDiaria Nao vazio " . floatToBr($newTotalDiaria) . PHP_EOL;
}
// 2) Capital
if ($abatimento == 0.00 || $abatimento == 0) {
  $newCapital = $valor_solicitado;
  $newJuros = $juros;
  $newValorBruto = $valor_bruto;
} else {
  $newCapital = $valor_solicitado - $abatimento;
  $newJuros = ($porcento / 100) * $newCapital;
  $newValorBruto = $newCapital + $newJuros;
}
// echo "newCapital " . floatToBr($newCapital) . PHP_EOL;
// echo "</br>";

// 3) Total Atraso
// if ($total_atraso == 0.00 || $atraso_diaria == 0.00) {
// $newTotalAtraso = 0.00;
// $newTotalAtraso = $juros_mensal - $juros;
// } else {
// $newTotalAtraso = $total_atraso - $juros_diaria - $juros_mensal;
// }
// echo 'juros_mensal pago '.$juros_mensal.'</br>';

// echo 'juros mensal a pagar '.$juros.'</br>';

// echo 'atraso_juros_mensal '.$atraso_juros_mensal.'</br>';

if ($atraso_juros_mensal == 0.00 || $atraso_juros_mensal == '' || $atraso_juros_mensal == 0) {
  $newTotalAtraso = $juros - $juros_mensal;
} else {
  $newTotalAtraso =  $atraso_juros_mensal - $juros_mensal;
}

// echo "newTotalAtraso " . floatToBr($newTotalAtraso) . PHP_EOL;
// echo "newValorPago " . floatToBr($valor_pago) . PHP_EOL;
// echo '</br>';

if ($quitacao <> 0.00 || $quitacao <> 0) {

  $update = "UPDATE clientes SET status_cliente = 4 WHERE id = $id_cliente";
  $salvar_update = mysqli_query($conn, $update);

  $update_status = "UPDATE `solicitacao` SET `status_solicitacao`= 4 WHERE id = $id_solicitacao";
  $salve_pgto = mysqli_query($conn, $update_status);
};


// echo $total_atraso;
// if( $total_atraso == "0.00" || $total_atraso == "" ){
//   $em_aberto = "0.00";
// }else{
//   $em_aberto = $total_atraso - $valor_pago;
// }

// print_r($_POST);

$nome_arquivo = $id_solicitacao . "_" . $data_hora_salve . "_" . $nome;

$sql_pago = "UPDATE valor_pago
SET
valor_pago='$valor_pago', 
atraso_diaria='$atraso_diaria', 
juros_mensal='$juros_mensal', 
juros_diaria='$juros_diaria', 
abatimento='$abatimento', 
quitacao='$quitacao',
atraso_parcela='$atraso_parcela', 
total_atraso='$newTotalAtraso', 
em_aberto='$newTotalDiaria', 
usuario=$id_user, 
data_valor_pago='$data_hora'
WHERE id_solicitacao= $id_solicitacao";
$salvar_pago = mysqli_query($conn, $sql_pago);

$call = "CALL sp_valor_pago_after_update($id_solicitacao, $valor_pago, $atraso_diaria, $juros_mensal, $juros_diaria, $abatimento, $quitacao,
$atraso_parcela, $newTotalAtraso, $newTotalDiaria, $usuario, $data_hora, NOW(), NOW(), NULL, 'UPDATE')";
$executar_proc = mysqli_query($conn, $call);

$update_pgto = "UPDATE `solicitacao` SET `dt_pgto`='$ultimadata' , `valor` ='$newCapital', `valor_bruto`='$newValorBruto', `juros`='$newJuros' WHERE id = $id_solicitacao";
$salve_pgto = mysqli_query($conn, $update_pgto);

move_uploaded_file($_FILES['imagem']['tmp_name'], "teste_comprovante/" . $nome_arquivo);

$queryInsercao ="INSERT INTO comprovantes
(id, id_solicitacao, comprovante, comprovante_nome, usuario, dt_pgto, data_comprovante, valor_total, juros_mensal, juros_diaria, abatimento, quitacao, parcela, obs, updated_at, created_at, deleted_at)
VALUES(NULL, '$id_solicitacao', '$nome_arquivo', NULL, '$id_user', '$dt_pgto', '$data_hora', '$valor_pago_comprovante', '$juros_mensal', '$juros_diaria', $abatimento, $quitacao, $parcela_pgto, '$obs', '$data_hora', '$data_hora', NULL)";

$salvar = mysqli_query($conn, $queryInsercao);

// exit();


if ($salvar_pago == 1) {
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
          echo '<meta http-equiv="refresh" content="3;URL=em_aberto.php" />';
          //  echo '<meta http-equiv="refresh" content="3;URL=starter.php" />';
} else {
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
                  $extensoes_autorizadas = array('.exe', '.jpg', '.mp4', '.mkv', '.txt', '.csv', '.jpeg');

                  // Caminho da pasta FTP
                  $caminho = './teste_comprovante/';

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
                  if (! isset($_FILES['imagem'])) {
                    exit('Nenhum arquivo enviado!');
                  }

                  // Aqui o arquivo foi enviado e vamos configurar suas variáveis
                  $arquivo = $_FILES['imagem'];

                  // Nome do arquivo enviado
                  $nome_arquivo = $arquivo['name'];

                  // Renomeado
                  $nome_arquivo = $id_solicitacao . "_" . $data_hora_salve . "_" . $nome_arquivo;

                  $queryInsercao = "INSERT INTO `comprovantes`(`id`, `id_solicitacao`, `comprovante`, `usuario`, `data_comprovante`)
                  VALUES (null, '$id_solicitacao', '$nome_arquivo', '$id_user', '$data_hora' )";

                  $salvar = mysqli_query($conn, $queryInsercao);


                  // Tamanho do arquivo enviado
                  $tamanho_arquivo = $arquivo['size'];

                  // Nome do arquivo temporário
                  $arquivo_temp = $arquivo['tmp_name'];

                  // Extensão do arquivo enviado
                  $extensao_arquivo = strrchr($nome_arquivo, '.');

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

                  if (! $sobrescrever && file_exists($destino)) {
                    exit('Arquivo já existe.');
                  }

                  /* 
Se a variável $limitar_tamanho tiver valor e o tamanho do arquivo enviado for
maior do que o tamanho limite, terminado aqui.
*/

                  if ($limitar_tamanho && $limitar_tamanho < $tamanho_arquivo) {
                    exit('Arquivo muito grande.');
                  }

                  /* 
Se as $extensoes_autorizadas não estiverem vazias e a extensão do arquivo não 
estiver entre as extensões autorizadas, terminamos aqui.
*/

                  if (! empty($extensoes_autorizadas) && ! in_array($extensao_arquivo, $extensoes_autorizadas)) {
                    exit('Tipo de arquivo não permitido.');
                  }

                  /*-----------------------------------------------------------------------------*
 * Parte 4: Conexão FTP
/*----------------------------------------------------------------------------*/

                  // Realiza a conexão
                  $conexao_ftp = ftp_connect($servidor_ftp);

                  // Tenta fazer login
                  $login_ftp = ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);

                  // Se não conseguir fazer login, termina aqui
                  if (! $login_ftp) {
                    exit('Usuário ou senha FTP incorretos.');
                  }

                  ftp_pasv($conexao_ftp, true);

                  // Envia o arquivo
                  if (@ftp_put($conexao_ftp, $destino, $arquivo_temp, FTP_BINARY)) {
                    // Se for enviado, mostra essa mensagem
                    echo 'Arquivo enviado com sucesso!';
                  } else {
                    // Se não for enviado, mostra essa mensagem
                    echo 'Erro ao enviar arquivo!';
                  }


                  // Fecha a conexão FTP
                  ftp_close($conexao_ftp);


                    ?>