<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $data_hoje = (date('Y-m-d'));
 $id_user = $_SESSION['id_user'];


//  0 = Domingo, 1 = Segunda, 2 = Terça, 3 = Quarta, 4 = quinta, 5 = sexta, 7 = sabado

// $data_comprovante = date('d/m/Y', strtotime($data_hoje));

// $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

// $data_semana = date('Y-m-d', strtotime($data_hoje));

// $diasemana_numero = date('w', strtotime($data_semana));

// $diasemana[$diasemana_numero];

// echo $diasemana[$diasemana_numero];
// exit();
// print_r($_GET);

$id = $_GET['id'];

$select_sql = ("SELECT
                  c.*,
                  c.id as 'id_cliente',
                  s.id as id_soli,
                  s.*,
                  st.*,
                  u.usuario as usuario_name
                  FROM
                  `solicitacao` s
                  INNER JOIN clientes c on s.id_cliente = c.id
                  INNER JOIN status st on s.status_solicitacao = st.id
                  inner join user u on u.id = s.usuario
                  where
                  s.id = $id
                  and s.id_servico = 2
                  and c.id_cliente <> '0'
                ");
                           
$recebidos = mysqli_query($conn, $select_sql);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    // print_r($row_usuario);
    $status_solicitacao = $row_usuario['status_solicitacao'];
    $class = $row_usuario['class'];
    $cliente = $row_usuario['nome'];
    $sobrenome = $row_usuario['sobrenome'];
    $id = $row_usuario['id'];
    $id_solicitacao = $row_usuario['id_soli'];
    $valor_bruto = $row_usuario['valor_bruto'];
    $valor = $row_usuario['valor'];
    $juros = $row_usuario['juros'];
    $status = $row_usuario['descricao'];
    $id_cliente = $row_usuario['id_cliente'];
    $id_servico = $row_usuario['id_servico'];
    $valor_parcela = $row_usuario['valor_parcela'];
    $socio = $row_usuario['socio'];
    $usuario_name = $row_usuario['usuario_name'];
    // $nome_cliente = $socio ? : $cliente ? : $sobrenome ;
    $nome_cliente = $row_usuario['nome'] ;
    $cpf = $row_usuario['cpf'] ;
    $porcento = $row_usuario['porcentagem'] ;
    // $valor_parcela = $row_usuario['valor_parcela'];
    $data_hora = date('Y-m-d', strtotime($row_usuario['data_hora_solicitacao']));
    // $data_hora = date('d/m/Y H:i:s', strtotime($row_usuario['data_hora_solicitacao']));

};

$select_comprovante = ("SELECT * FROM `comprovantes` where id_solicitacao =  $id_solicitacao and usuario = $id_user");
$result_comprovante = mysqli_query($conn, $select_comprovante);

while ($row_data = mysqli_fetch_assoc($result_comprovante)) {
    // $data_compro[] = $row_data['data_comprovante'];

    $data_compro[] = date('Y-m-d', strtotime($row_data['dt_pgto']));


}

 $select_vl_pgto = ("SELECT count(id_solicitacao) as parcelas, sum(valor_pago) as valor_pago , sum(atraso_diaria) as atraso_diaria , sum(em_aberto) as total_em_atraso FROM `valor_pago` where id_solicitacao =  $id_solicitacao ");
$result_vl_pgto = mysqli_query($conn, $select_vl_pgto);

while ($row_vl_pgto = mysqli_fetch_assoc($result_vl_pgto)) {
 
    $sum_pgto = $row_vl_pgto['valor_pago'];
    $atraso_diaria = $row_vl_pgto['atraso_diaria'];
   $parcelas = $row_vl_pgto['parcelas'];

  }
  
   $select_em_atraso = ("SELECT em_aberto as total_em_atraso, total_atraso as total_atraso FROM `valor_pago` where id_solicitacao =  $id_solicitacao  ORDER BY id DESC limit 1 ");
  $result_em_atraso = mysqli_query($conn, $select_em_atraso);
  
  while ($row_em_atraso = mysqli_fetch_assoc($result_em_atraso)) {
      
      $total_em_atraso = $row_em_atraso['total_em_atraso'];
      $atraso_juros_mensal = $row_em_atraso['total_atraso'];
  
    }
  
  
 $sum_pgto;

// if($data_compro == "" ){
    $select_solicitacao = ("SELECT *  FROM `solicitacao` where id =  $id_solicitacao ");
    $result_solicitacao = mysqli_query($conn, $select_solicitacao);
    
    while ($row_sol = mysqli_fetch_assoc($result_solicitacao)) {
        // print_r($row_vl_pgto);
    
        $ult_array_data = $row_sol['dt_pgto'];
        $dt_solicitacao = $row_sol['dt_solicitacao'];
    
      }

$ultimadata = date('Y-m-d', strtotime($ult_array_data . '+1 month' ));

$ProximoPagamento = (date('Y-m'))."-". date('d', strtotime($dt_solicitacao));

$dtProximoPagamento = date('Y-m-d', strtotime($ProximoPagamento . '+1 month' ));

?>
<form method="POST" action="salvar_detalhes.php" enctype="multipart/form-data">

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

            <section class="content">

              <!-- Default box -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detalhes - Guerra</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                      <div class="row">
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Valor Solicitado</span>
                              <span class="info-box-number text-center text-muted mb-0"><?php  echo "R$ " .number_format($valor, 2, ',', '.'); ?></span>

                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Total Juros</span>
                              <span class="info-box-number text-center text-muted mb-0"><?php  echo "R$ " .number_format($juros, 2, ',', '.'); ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Valor Bruto</span>
                              <span
                                class="info-box-number text-center text-muted mb-0"><?php  echo "R$ " .number_format($valor_bruto, 2, ',', '.'); ?></span>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Valor da Parcela</span>
                              <span
                                class="info-box-number text-center text-muted mb-0"><?php echo $valor_parcela ?></span>
                            </div>
                          </div>
                        </div> -->
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Valor Pago</span>
                              <span
                                class="info-box-number text-center text-muted mb-0"><?php  echo "R$ " .number_format($sum_pgto, 2, ',', '.'); ?></span>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Parcelas</span>
                              <span class="info-box-number text-center text-muted mb-0"><?php  
                            
                                    // $valor = preg_replace("/[^0-9,]+/i","",$valor_parcela);
                                    
                                    echo  ($sum_pgto - $atraso_diaria) / $valor_parcela . " / 20" ; 



                                ?></span>
                            </div>
                          </div>
                        </div> -->

                      </div>
                      <?php
                        if( $status_solicitacao == 3 ){
                              ?>
                               <div class="row">
                                  <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                      <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor da Parcela</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                          <?php
                                            echo "R$ ". number_format($valor_parcela, 2, ',', '.');
                                            ?>

                                        </span>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Parcelas</span>
                              <span class="info-box-number text-center text-muted mb-0"><?php  
               
               
                                  // $data1 = new DateTime($ult_array_data);
                                  // $data2 = new DateTime();
                                  // $intervalo = $data1->diff($data2);
                                  //  $dia_atraso = $intervalo->format('%a');
                                  
                                  // $valor = preg_replace("/[^0-9,]+/i","",$valor_parcela);
                                  
                                  echo  $parcelas . "/ " .round($valor_bruto / $valor_parcela) ; 

                                    ?>

                                      <input id="parcela_pgto" value="<?php echo ($parcela)+1 ?>" name="parcela_pgto" type="hidden" class="form-control">
                                      <input id="id_cliente" value="<?php echo ($id_cliente)?>" name="id_cliente" type="hidden" class="form-control">

                                </span>
                            </div>
                          </div>
                        </div>

                               </div>

                              <?php
                        }else{
                            ?>
                              <div class="row">
                                  <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                      <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Dias em Atraso</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                          <?php
                                             
                                            //  echo "Data vencimento: ".$ult_array_data;
                                            //  echo "</br>";
                                            //  echo "Data hoje: ".$data_hoje;
                                            //   echo "</br>";

                                              if( $data_hoje <= $ult_array_data ){
                                                  // echo $dia_atraso = 0;
                                              }else{
                                                $data1 = new DateTime($ult_array_data);
                                                $data2 = new DateTime();
                                                $intervalo = $data1->diff($data2);
                                                echo $dia_atraso = $intervalo->format('%a') ;
                                                
                                              }

                                            ?>

                                        </span>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                      <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Atraso Diário</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                          <?php  $atraso_Diario =  $dia_atraso * 50; echo "R$ " .number_format($atraso_Diario, 2, ',', '.');?>
                                        </span>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                      <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Atraso Parcela</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                          <?php 
                              
                                          //  $valor = preg_replace("/[^0-9,]+/i","", $valor_parcela);

                                          //  $valor = str_replace(",",".",$valor_parcela );

                                                if($dia_atraso == 0){
                                                  $atrasoParcela = $valor_parcela * $dia_atraso;

                                                }else{
                                                  $atrasoParcela = $valor_parcela * $dia_atraso + $valor_parcela;
                                                }

                                            echo "R$ " .number_format($atrasoParcela, 2, ',', '.');
                                          ?>
                                          <input id="atraso_parcela"
                                            value="<?php echo number_format($atrasoParcela, 2, ',', '.') ?>" name="atraso_parcela"
                                            type="hidden" class="form-control">

                                        </span>
                                      </div>
                                    </div>
                                  </div> -->

                                  <div class="col-12 col-sm-3">
                                    <div class="info-box bg-light">
                                      <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Valor Bruto + Diaria</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                          <?php 
                                              // $juros = preg_replace("/[^0-9,]+/i","",$juros);
                                              // $juros = preg_replace("/[^0-9,]+/i","",$juros);
                                              if($dia_atraso == 0){
                                                echo number_format(0, 2, ',', '.');
                                              }else{
                                                $valor_atraso2 = $valor_bruto + $atraso_Diario;
                                                $valor_atraso = $valor_bruto + $atraso_Diario;
                                                echo "R$ " .number_format($valor_atraso2, 2, ',', '.');
                                              }

                                          ?>

                                        </span>
                                      </div>
                                    </div>
                                  </div>

                                  <?php
                                    if($total_em_atraso == "0.00" || $total_em_atraso == "" ){

                                    }else{
                                      ?>
                                      <div class="col-12 col-sm-3">
                                        <div class="info-box bg-danger">
                                          <div class="info-box-content">
                                            <span class="info-box-text text-center text-white">Valor em Aberto Diaria</span>
                                            <span
                                              class="info-box-number text-center text-white mb-0"><?php   echo "R$ " .number_format($total_em_atraso, 2, ',' ,'.'); ?></span>
                                          </div>
                                        </div>
                                      </div>
                                    <?php
                                    }
                                    ?>

                                  <?php
                                    if($atraso_juros_mensal == '0.00' || $atraso_juros_mensal == '' || $atraso_juros_mensal == 0){

                                  } else{
                                      ?>
                                      <div class="col-12 col-sm-3">
                                        <div class="info-box bg-danger">
                                          <div class="info-box-content">
                                            <span class="info-box-text text-center text-white">Juros mensal atrasado</span>
                                            <span
                                            class="info-box-number text-center text-white mb-0"><?php   echo "R$ " .number_format($atraso_juros_mensal, 2, ',' ,'.'); ?></span>
                                          </div>
                                        </div>
                                      </div>
                                      <?php

                                  }

                                    ?>

                                </div>
                            <?php
                        }
                        ?>
                    

                      <div class="row">
                        <div class="col-12">
                          <h4>Arquivos Recentes</h4>

                          <?php
                              $index = 1;
                              $select_comprovante = ("SELECT
                                                            *
                                                          FROM
                                                            `comprovantes` c
                                                          inner join `user` u on u.id = c.usuario  
                                                          where
                                                            c.id_solicitacao =  $id_solicitacao 
                                                           order by c.id asc 
                                                            ");

                              $result_comprovante = mysqli_query($conn, $select_comprovante);
                              while ($row_comprovante = mysqli_fetch_assoc($result_comprovante)) {
                                  // print_r($row_comprovante);

                                  $id_arquivo = $row_comprovante['id'];
                                  $arquivo = $row_comprovante['comprovante'];
                                  $usuario_comprovante = $row_comprovante['usuario'];
                                  $data_comprovante = $row_comprovante['dt_pgto'];
                                  
                                  $valor_total_comprovante = $row_comprovante['valor_total'];
                                  $juros_mensal_comprovante = $row_comprovante['juros_mensal'];
                                  $juros_diaria_comprovante = $row_comprovante['juros_diaria'];
                                  $abatimento_comprovante = $row_comprovante['abatimento'];
                                  $quitacao_comprovante = $row_comprovante['quitacao'];
                                  $parcela = $row_comprovante['parcela'];
                                  $obs = $row_comprovante['obs'];

                                  $data_comprovante = date('d/m/Y', strtotime($row_comprovante['dt_pgto']));

                                  $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

                                  $data_semana = date('Y-m-d', strtotime($row_comprovante['dt_pgto']));
                                  
                                  $diasemana_numero = date('w', strtotime($data_semana));

                                  ?>
                                            <div class="post">
                                              <p>
                                                <div class="card-body">
                                                  <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                      <tr>
                                                       
                                                        <th>Valor</th>
                                                        <th>Juros Mensal</th>
                                                        <th>Juros Diaria</th>
                                                        <th>Abatimento</th>
                                                        <th>Quitação</th>
                                                        <th>Parcela</th>
                                                        <!-- <th>Usuario</th> -->
                                                        <th>Comprovante</th>
                                                        <th>Data no comprovante</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>

                                                      <?php
                                                       echo "<tr>";
                                                      
                                                        echo "<td >" ."R$ " .number_format($valor_total_comprovante, 2, ',' ,'.')."</td>"; 
                                                        echo "<td >" ."R$ " .number_format($juros_mensal_comprovante, 2, ',' ,'.')."</td>"; 
                                                        echo "<td >" ."R$ " .number_format($juros_diaria_comprovante, 2, ',' ,'.')."</td>"; 
                                                        echo "<td >" ."R$ " .number_format($abatimento_comprovante, 2, ',' ,'.')."</td>"; 
                                                        echo "<td >" ."R$ " .number_format($quitacao_comprovante, 2, ',' ,'.')."</td>"; 
                                                        echo "<td >" ."R$ " .number_format($parcela, 2, ',' ,'.')."</td>";
                                                        // echo "<td > $usuario_comprovante</td>";
                                                        echo "<td class='text-center'> 
                                                                  <a target='_blank' href='./teste_comprovante/$arquivo'> <i aria-hidden='true' class='fas fa-eye' style='font-size:30px;'> </i> </a> 
                                                                  </td>";
                                                        echo "<td >". $data_comprovante ."   ". $diasemana[$diasemana_numero]."</td>";
                                                       echo "</tr>";
                                                      
                                                      ?>
                                                    </tbody>
                                                  </table>
                                                </div>
                                              </p>
                                              <p><label for="">Observação: <? echo $obs ?> </label></p>
                                            </div>
                                            <?php
                                  $index ++;
                              }

                              ?>

                        </div>
                      </div>
                    </div>
                    
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                      <h3 class="text-primary"><i class="fas fa-paint-brush"></i>
                        <?php echo "ID: ". $id_cliente . " | " . $nome_cliente  . "<p> CPF: $cpf </p>"?> </h3>
                      <p class="text-muted">
                        <td class='project-state text-center'><span class='<?php echo $class ?>'> <?php echo $status ?></span></td>
                      </p>
                      <br>
                        
                      <? if( $status_solicitacao == 4 ){

                          }else{
                            ?>
                            <h5 class="mt-5 text-muted"></h5>
                            <ul class="list-unstyled">
                              <li>
                                <div class="row">
                                  <div class="col-5">

                                    <label>Valor Pago Total:</label>
                                    <input required id="valor_pago" name="valor_pago" type="text"
                                      class="form-control">
                                    <label>Juros Mensal:</label>
                                    <input id="juros_mensal" name="juros_mensal" type="text"
                                      class="form-control">
                                      <label>Juros Diaria:</label>
                                      <input id="juros_diaria" name="juros_diaria" type="text" class="form-control">
                                    <!-- </div> -->
                                    <br>
                                    <label>Comprovante:</label>
                                    <br>
                                    <div class="btn btn-default btn-file">
                                      <i class="fas fa-paperclip"></i> Anexar
                                      <!-- <input type="file" name="imagem" accept="image/png, image/jpeg"> -->
                                      <input onchange="getFileData(this);" type="file" name="imagem">
                                    </div>
                                    <br>
                                  </div>

                                  <div class="col-5">
                                    <div class="form-group">
                                      <label>Data Pagamento:</label>
                                      <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                        <input required name="dt_pgto" type="text"
                                          class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                        <div class="input-group-append" data-target="#datetimepicker4"
                                          data-toggle="datetimepicker">
                                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                      </div>
                                      <label>Quitação:</label>
                                        <input id="quitacao" name="quitacao" type="text"
                                          class="form-control">
                                          <label>Abatimento:</label>
                                    <input id="abatimento" name="abatimento" type="text"
                                      class="form-control">
                                    </div>
                                  </div>
                                  
                                  <script type="text/javascript">
                                    $(function() {
                                      $('#datetimepicker4').datetimepicker({
                                        format: 'YYYY-MM-DD'
                                      });
                                    });
                                  </script>

                                  <div id="message" class="ui positive message" style="display: none!important;">
                                    <br>
                                    <div class="callout callout-info">
                                      <p id="label"></p>
                                    </div>
                                    <!-- <button type="submit" onclick="load()" name="import" class="ui button">Importar</button> -->
                                  </div>

                                  <script>
                                    function getFileData(myFile) {
                                      var file = myFile.files[0];
                                      var filename = file.name;
                                      // console.log(filename);
                                      var error_gb = document.getElementById('message').style = '';
                                      var labe1 = document.getElementById('label');
                                      labe1.innerHTML = filename;
                                    }
                                  </script>
                                </div>
                                <div class="col-4">

                                  </ul>
                                  <div class="text-center mt-4 mb-3">

                                  <input type="hidden" name="total_em_atraso" value="<?php echo ($total_em_atraso) ?>">
                                  <input type="hidden" name="valor_bruto" value="<?php echo ($valor_bruto) ?>">
                                  <input type="hidden" name="atraso_juros_mensal" value="<?php echo ($atraso_juros_mensal) ?>">
                                  <input type="hidden" name="id_solicitacao" value="<?php echo $id_solicitacao ?>">
                                  <input type="hidden" name="valor_solicitado" value="<?php echo $valor ?>">
                                  <input type="hidden" name="juros" value="<?php echo $juros ?>">
                                  <input type="hidden" name="ultimadata" value="<?php echo $dtProximoPagamento ?>">
                                  <input type="hidden" name="atraso_diaria" value="<?php echo $atraso_Diario ?>">
                                  <input type="hidden" name="total_atraso" value="<?php echo $valor_atraso ?>">
                                  <input type="hidden" name="quitacao" value="<?php echo $valor_quitacao ?>">
                                  <input type="hidden" name="sum_pgto" value="<?php echo $sum_pgto ?>">
                                  <input type="hidden" name="porcento" value="<?php echo $porcento ?>">

                                    <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <button type="submit" class="btn btn-block btn-success">Salvar</button>
                                        </div>
                                </form>
                                      <?php 
                                      
                                      if( $status_solicitacao == 3 ){
                                      
                                      }else{
                                        ?>
                                        <div class="col">
                                          <form method="POST" action="parcelar.php" enctype="multipart/form-data">
                                          <input type="hidden" name="id_solicitacao" value="<?php echo $id ?>">
                                          <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>">
                                          <input type="hidden" name="total_em_atraso" value="<?php echo $total_em_atraso ?>">
                                          <input type="hidden" name="id_servico" value="<?php echo $id_servico ?>">

                                            <button type="submit" class="btn btn-block btn-warning">Parcelar</button>
                                        </form>
                                        </div>
                                        <?php

                                      }

                                      ?>
                                      
                                        <div class="col">
                                          <form method="POST" action="finalizar_cliente.php" enctype="multipart/form-data">
                                            <input type="hidden" name="id_solicitacao" value="<?php echo $id ?>">
                                            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>">
                                            <button type="submit" class="btn btn-block btn-info">Finalizar</button>
                                          </form>
                                          </div>
                                        
                                          <!-- <div class="col">
                                            <input type="hidden" id="id_solicitacao" name="id_solicitacao" value="<?php echo $id_solicitacao ?>">
                                            <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente ?>">
                                                
                                              <?php 
                                                $dia_solicitacao = date('d', strtotime($dt_solicitacao));
                                                $dt_alt = date('Y-m-'.$dia_solicitacao, strtotime($data_hoje));
                                              
                                              ?>
                                              <input type="hidden" id="dt_alt" name="dt_alt" value="<?php echo $dt_alt ?>">

                                              <label id="alt_dt" class="btn btn-block btn-dark">Alterar Data</label>
                                          
                                          </div> -->
                                        </div>
                                    </div>

                                  </div>

                                </div>
                              </li>

                          <?}?>
                    </div>
                    

<!-- <p class="help-block">Max. 32MB</p> -->
<!-- </div> -->

<!-- <a href="#" class="btn btn-sm btn-warning">Report contact</a> -->
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

</section>

<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/daterangepicker/daterangepicker.js"></script>
<script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>