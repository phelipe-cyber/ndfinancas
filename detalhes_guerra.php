<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $data_hoje = (date('Y-m-d'));


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

 $select_sql = ("SELECT c.*, c.id as 'id_cliente', s.id as id_soli, s.*, st.* FROM `solicitacao` s INNER JOIN clientes c on s.id_cliente = c.id INNER JOIN status st on s.status_solicitacao = st.id where s.id = $id and s.id_servico = 2 ORDER by s.id DESC");
                           
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
    // $valor_parcela = $row_usuario['valor_parcela'];
    $data_hora = date('Y-m-d', strtotime($row_usuario['data_hora_solicitacao']));
    // $data_hora = date('d/m/Y H:i:s', strtotime($row_usuario['data_hora_solicitacao']));

};

$select_comprovante = ("SELECT * FROM `comprovantes` where id_solicitacao =  $id_solicitacao ");
$result_comprovante = mysqli_query($conn, $select_comprovante);

while ($row_data = mysqli_fetch_assoc($result_comprovante)) {
    // $data_compro[] = $row_data['data_comprovante'];

    $data_compro[] = date('Y-m-d', strtotime($row_data['dt_pgto']));


}

 $select_vl_pgto = ("SELECT sum(valor_pago) as valor_pago , sum(atraso_diaria) as atraso_diaria  FROM `valor_pago` where id_solicitacao =  $id_solicitacao ");
$result_vl_pgto = mysqli_query($conn, $select_vl_pgto);

while ($row_vl_pgto = mysqli_fetch_assoc($result_vl_pgto)) {
    // print_r($row_vl_pgto);

    $sum_pgto = $row_vl_pgto['valor_pago'];
    $atraso_diaria = $row_vl_pgto['atraso_diaria'];

  }
  
 $sum_pgto;

if($data_compro == "" ){
    $select_solicitacao = ("SELECT *  FROM `solicitacao` where id =  $id_solicitacao ");
    $result_solicitacao = mysqli_query($conn, $select_solicitacao);
    
    while ($row_sol = mysqli_fetch_assoc($result_solicitacao)) {
        // print_r($row_vl_pgto);
    
        $ult_array_data = $row_sol['dt_pgto'];
    
      }
//   $ult_array_data = $data_hora;

}else{
  
  @$ult_array_data = end($data_compro);

}

$ultimadata = date('Y-m-d', strtotime($ult_array_data));



if( $data_hoje == $ultimadata ){
  // echo "Igual";
  @$ult_array_data = "" ;

}else{
    @$ult_array_data ;
    // echo "Diferente";
}

//  $ultimadata;


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
                              <span class="info-box-number text-center text-muted mb-0"><?php echo $valor ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Total Juros</span>
                              <span class="info-box-number text-center text-muted mb-0"><?php echo $juros ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Valor Bruto</span>
                              <span
                                class="info-box-number text-center text-muted mb-0"><?php echo $valor_bruto ?></span>
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
                            
                                    $valor = preg_replace("/[^0-9,]+/i","",$valor_parcela);
                                    
                                    echo  ($sum_pgto - $atraso_diaria) / $valor . " / 20" ; 



                                ?></span>
                            </div>
                          </div>
                        </div> -->

                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-3">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Dias em Atraso</span>
                              <span class="info-box-number text-center text-muted mb-0">
                                <?php
                      
                                  $data1 = new DateTime($ult_array_data);
                                  $data2 = new DateTime();
                                  $intervalo = $data1->diff($data2);
                                  echo $dia_atraso = $intervalo->format('%a') ;
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
                                <input id="atraso_diaria"
                                  value="<?php echo number_format($atraso_Diario, 2, ',', '.') ?>" name="atraso_diaria"
                                  type="hidden" class="form-control">
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
                    
                     $valor = preg_replace("/[^0-9,]+/i","", $valor_parcela);
                     $valor = str_replace(",",".",$valor );

                          if($dia_atraso == 0){
                            $atrasoParcela = $valor * $dia_atraso;

                          }else{
                            $atrasoParcela = $valor * $dia_atraso + $valor;
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
                              <span class="info-box-text text-center text-muted">Valor em Atraso</span>
                              <span class="info-box-number text-center text-muted mb-0">
                                <?php 
                                    $juros = preg_replace("/[^0-9,]+/i","",$juros);
                                
                                        $valor_atraso = $juros + $atraso_Diario;
                                        echo "R$ " .number_format($valor_atraso, 2, ',', '.');

                                ?>
                                <input id="total_atraso" value="<?php echo number_format($valor_atraso, 2, ',', '.') ?>"
                                  name="total_atraso" type="hidden" class="form-control">

                              </span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                          <h4>Arquivos Recentes</h4>

                          <?php
            $index = 1;
            $select_comprovante = ("SELECT * FROM `comprovantes` where id_solicitacao =  $id_solicitacao ");
            $result_comprovante = mysqli_query($conn, $select_comprovante);
            while ($row_comprovante = mysqli_fetch_assoc($result_comprovante)) {
                // print_r($row_comprovante);

                $id_arquivo = $row_comprovante['id'];
                $arquivo = $row_comprovante['comprovante'];
                $usuario = $row_comprovante['usuario'];
                $data_comprovante = $row_comprovante['dt_pgto'];

                $data_comprovante = date('d/m/Y', strtotime($row_comprovante['dt_pgto']));

                $diasemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sabado');

                $data_semana = date('Y-m-d', strtotime($row_comprovante['dt_pgto']));
                
                $diasemana_numero = date('w', strtotime($data_semana));

                ?>
                          <div class="post">
                            <div class="user-block">
                              <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                alt="user image"> -->
                              <span class="username">
                                <a href=""><?php echo $usuario ?></a>
                              </span>
                              <span
                                class="description"><?php echo $data_comprovante . " - " . $diasemana[$diasemana_numero]?></span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                              <!-- Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore. -->
                            </p>

                            <p>
                              <a href="ver_comprovante.php?id=<?php echo $id_arquivo ?>" class="link-black text-sm"><i
                                  class="fas fa-link mr-1"></i> Arquivo <?php echo $index ?></a>
                            </p>
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
                        <?php echo $cliente . " " . $sobrenome ?> </h3>
                      <p class="text-muted">
                        <!-- <td class='project-state text-center'><span class='<?php echo $class ?>'> <?php echo $status ?></span></td> -->
                      </p>
                      <br>

                      <h5 class="mt-5 text-muted"></h5>
                      <ul class="list-unstyled">
                        <li>
                          <div class="row">
                            <div class="col-4">

                              <label>Valor Pago:</label>
                              <input id="valor_pago" name="valor_pago" onkeyup="formatarMoeda();" type="text"
                                class="form-control">
                              <!-- </div> -->

                              <script>
                                function formatarMoeda() {
                                  var elemento = document.getElementById('valor_pago');
                                  var valor = elemento.value;
                                  valor = valor + '';
                                  valor = parseInt(valor.replace(/[\D]+/g, ''));
                                  valor = valor + '';
                                  valor = valor.replace(/([0-9]{2})$/g, ",$1");
                                  if (valor.length > 6) {
                                    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                                  }
                                  elemento.value = valor;
                                }
                              </script>
                            </div>

                            <div class="col-4">
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
                              </div>
                            </div>
                            <script type="text/javascript">
                              $(function() {
                                $('#datetimepicker4').datetimepicker({
                                  format: 'YYYY-MM-DD'
                                });
                              });
                            </script>

                            <div class="col-4">
                              <label>Comprovante:</label>
                              <br>
                              <div class="btn btn-default btn-file">
                                <i class="fas fa-paperclip"></i> Anexar
                                <!-- <input type="file" name="imagem" accept="image/png, image/jpeg"> -->
                                <input required onchange="getFileData(this);" type="file" name="imagem">
                              </div>

                            </div>

                            <div id="message" class="ui positive message" style="display: none!important;">
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

                            <!-- <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a> -->
                        </li>

                      </ul>
                      <div class="text-center mt-5 mb-3">
                        <!-- <a href="#" class="btn btn-sm btn-primary">Add files</a> -->

                        <!-- <div class="form-group"> -->
                        <!-- <form id="Form" action="salvar_detalhes.php" method="POST"> -->

                        <!-- <div class="col-3"> -->

                        <!-- <div class="btn btn-default btn-file"> -->
                        <!-- <i class="fas fa-paperclip"></i> Adicionar comprovante -->
                        <!-- <input type="file" name="imagem" accept="image/png, image/jpeg"> -->
                        <!-- <input type="file" name="imagem"> -->
                        <!-- </div> -->

                        <input type="hidden" name="id_solicitacao" value="<?php echo $id_solicitacao ?>">

                        <div id="button" class="col-4">
                          <button type="submit" class="btn btn-block btn-success">Salvar</button>
                        </div>

</form>
<!-- <p class="help-block">Max. 32MB</p> -->
<!-- </div> -->

<!-- <a href="#" class="btn btn-sm btn-warning">Report contact</a> -->
</div>
</div>
</div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->

</section>

<script src="./plugins/moment/moment.min.js"></script>
<script src="./plugins/daterangepicker/daterangepicker.js"></script>
<script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
</script>