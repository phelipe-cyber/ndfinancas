<?php

use WhichBrowser\Constants\Id;

include_once("starter.php");

 $id_edit = $_GET['id'];
 $usuario = $_SESSION['login'];

 $select_sql = ("SELECT *, nc.id as id_servico FROM `clientes` c LEFT JOIN fotos_clientes ft on ft.id_cliente = c.id  LEFT JOIN nome_cliente nc on c.id_cliente = nc.id where c.id = $id_edit and c.user_created = '$usuario' ");
                            
 $recebidos = mysqli_query($conn, $select_sql);
 
 while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
    // print_r($row_usuario);

    $id_cliente = $row_usuario['id_cliente'];
    $status_solicitacao = $row_usuario['status_solicitacao'];
    $class = $row_usuario['class'];
    $cliente_c = $row_usuario['nome'];
    $cnpj = $row_usuario['cnpj'];
    $cep = $row_usuario['cep'];
    $sobrenome = $row_usuario['sobrenome'];
    $socio = $row_usuario['socio'];
    $id = $row_usuario['id'];
    $atividade = $row_usuario['atividade'];
    $endereco = $row_usuario['endereco'];
    $cpf = $row_usuario['cpf'];
    $rg = $row_usuario['rg'];
    $tel = $row_usuario['tel'];
    $tel2 = $row_usuario['tel2'];
    $numero = $row_usuario['numero'];
    $bairro = $row_usuario['bairro'];
    $municipio = $row_usuario['municipio'];
    $uf = $row_usuario['uf'];
    $uf_emp = $row_usuario['uf_emp'];
    $complemento = $row_usuario['complemento'];
    $referencia = $row_usuario['referencia'];
    $cep_emp = $row_usuario['cep_emp'];
    $lougadouro_emp = $row_usuario['lougadouro_emp'];
    $number_emp = $row_usuario['number_emp'];
    $municipio_emp = $row_usuario['municipio_emp'];
    $bairro_emp = $row_usuario['bairro_emp'];
    $complemento_emp = $row_usuario['complemento_emp'];
    $referencia_emp = $row_usuario['referencia_emp'];
    $nome_servico = $row_usuario['nome_servico'];
    $id_servico = $row_usuario['id_servico'];
    $ftcliente = $row_usuario['ftcliente'];
    $ftrg = $row_usuario['ftrg'];
    $ftcpf = $row_usuario['ftcpf'];
    $ftcompres = $row_usuario['ftcompres'];
    $ftcompcomer = $row_usuario['ftcompcomer'];
    $fttermo = $row_usuario['fttermo'];
    $ftlocal = $row_usuario['ftlocal'];
    $ftlocal2 = $row_usuario['ftlocal2'];
    $ftlocal3 = $row_usuario['ftlocal3'];
    

 }

?>


<body class="hold-transition sidebar-mini">

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

            <!-- <form id="Form" action="salvar_cliente.php" method="POST"> -->

            <form  method="POST" action="salvar_edicao.php" enctype="multipart/form-data">
           
            <input type="hidden" value="<?php echo $id_edit ?>" name="id_edit" >

              <div id="danger-alert" class="alert alert-danger alert-dismissible" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Erro!</h5> <label id="msg_error"></label>
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Editar Cliente</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                  <div class="col-2">
                  <div class="form-group">
                  <label>VS ou Guerra</label>
                  <select name="servico" required class="form-control select2bs4" style="width: 100%;" placeholder="Select a State">
                  <option selected readonly value="<?php echo $id_servico ?>"><?php echo $nome_servico ?></option>

                  <?php 
                    $select_sql = ("SELECT c.* FROM `nome_cliente` c  ORDER BY c.id ASC ");
                            
                    $recebidos = mysqli_query($conn, $select_sql);
                    
                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                        // print_r($row_usuario);
                      
                        $id = $row_usuario['id'];
                        $cliente = $row_usuario['nome_servico'];
                        ?>
                            <option value="<?php echo $id ?>"><?php echo $cliente ?></option>
                        <?php
                    }
                  ?>
                  </select>
                </div>
                </div>

                    <div class="col-2">
                      <label>CNPJ:</label>
                      <input  id="cnpj" value="<?php echo $cnpj ?>" name="cnpj" type="text" class="form-control"
                        data-inputmask="'mask': ['99.999.999/9999-99']" data-mask>
                    </div>

                    <div class="col-2">
                      <label>CEP:</label>
                      <input  id="cep" name="cep" value="<?php echo $cep ?>" type="text" class="form-control"
                        data-inputmask="'mask': ['99999-999']" data-mask>
                    </div>

                  

                    <div class="col-5">
                      <label>Razão social:</label>
                      <input  id="razao_social" value="<?php echo $cliente_c ?>" name="razao_social" type="text" class="form-control">
                    </div>
                    <div class="col-4">
                      <label>Nome Fantasia:</label>
                      <input  id="sobrenome" value="<?php echo $sobrenome ?>" name="sobrenome" type="text" class="form-control">
                    </div>
                    <div class="col-5">
                      <label>Nome:</label>
                      <input  id="nome" name="nome" value="<?php echo $socio ?>" type="text" class="form-control">
                    </div>
                    <div class="col-1">
                      <label>RG:</label>
                      <input  id="rg" name="rg" value="<?php echo $rg ?>" type="text" class="form-control">
                    </div>
                    <div class="col-2">
                      <label>CPF:</label>
                      <input  id="cpf" name="cpf" value="<?php echo $cpf ?>" type="text" class="form-control"
                        data-inputmask="'mask': ['999.999.999-99']" data-mask>
                    </div>
                    <div class="col-2">
                      <label>Telefone 1:</label>
                      <input  id="tel" name="tel" value="<?php echo $tel ?>" type="text" class="form-control"
                        data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                    </div>

                    <div class="col-2">
                      <label>Telefone 2:</label>
                      <input id="tel2" name="tel2" value="<?php echo $tel2 ?>" type="text" class="form-control"
                        data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                    </div>
                    <div class="col-3">
                      <label>Atidade:</label>
                      <input  id="atividade" name="atividade" value="<?php echo $atividade ?>" type="text" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Endereço:</label>
                      <input  id="lougadouro" name="lougadouro" value="<?php echo $endereco ?>" type="text" class="form-control">
                    </div>

                    <div class="col-1">
                      <label>Número:</label>
                      <input  id="number" name="number" value="<?php echo $numero ?>" type="text" class="form-control">
                    </div>

                    <div class="col-2">
                      <label>Bairro:</label>
                      <input  id="bairro" name="bairro" value="<?php echo $bairro ?>" type="text" class="form-control">
                    </div>

                    <div class="col-2">
                      <label>Municipio:</label>
                      <input  id="municipio" name="municipio" value="<?php echo $municipio ?>" type="text" class="form-control">
                    </div>

                    <div class="col-1">
                      <label>UF:</label>
                      <input  id="uf" name="uf" value="<?php echo $uf ?>" type="text" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Complemento:</label>
                      <input id="complemento" name="complemento" value="<?php echo $complemento ?>" type="text" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Referencia:</label>
                      <input id="referencia" name="referencia" value="<?php echo $referencia ?>" type="text" class="form-control">
                    </div>

                    <!-- <div class="col-2">
                  <label>Valor:</label>
                      <input id="valor" onkeyup="formatarMoeda();" name="valor" type="text" class="form-control"  >
                  </div>

                      <script>
                                        function formatarMoeda() {
                                            var elemento = document.getElementById('valor');
                                            var valor = elemento.value;
                                            
                                            valor = valor + '';
                                            valor = parseInt(valor.replace(/[\D]+/g,''));
                                            valor = valor + '';
                                            valor = valor.replace(/([0-9]{2})$/g, ",$1");

                                            if (valor.length > 6) {
                                                valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                                            }

                                            elemento.value = valor;
                                            }
                        </script> -->

                  </div>
                </div>
              
                <br>
                <!-- /.card-body -->
              </div>

              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Endereço Cliente</h3>
                </div>
                <div class="card-body">
                  <div class="row">

                    <div class="col-2">
                      <label>CEP:</label>
                      <input  id="cep_emp" name="cep_emp" value="<?php echo $cep_emp ?>" type="text" class="form-control"
                        data-inputmask="'mask': ['99999-999']" data-mask>
                    </div>

                    <div class="col-4">
                      <label>Endereço:</label>
                      <input  id="lougadouro_emp" value="<?php echo $lougadouro_emp ?>" name="lougadouro_emp" type="text" class="form-control">
                    </div>

                    <div class="col-1">
                      <label>Número:</label>
                      <input  id="number_emp" name="number_emp" value="<?php echo $number_emp ?>" type="text" class="form-control">
                    </div>

                    <div class="col-2">
                      <label>Bairro:</label>
                      <input  id="bairro_emp" name="bairro_emp" value="<?php echo $bairro_emp ?>" type="text" class="form-control">
                    </div>

                    <div class="col-2">
                      <label>Municipio:</label>
                      <input  id="municipio_emp" name="municipio_emp" value="<?php echo $municipio_emp ?>" type="text" class="form-control">
                    </div>

                    <div class="col-1">
                      <label>UF:</label>
                      <input  id="uf_emp" name="uf_emp" value="<?php echo $uf_emp ?>" type="text" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Complemento:</label>
                      <input id="complemento_emp" name="complemento_emp" value="<?php echo $complemento_emp ?>" type="text" class="form-control">
                    </div>

                    <div class="col-4">
                      <label>Referencia:</label>
                      <input id="referencia_emp" name="referencia_emp" value="<?php echo $referencia_emp ?>" type="text" class="form-control">
                    </div>

                    <!-- <div class="col-2">
                  <label>Valor:</label>
                      <input id="valor" onkeyup="formatarMoeda();" name="valor" type="text" class="form-control"  >
                  </div>

                      <script>
                                        function formatarMoeda() {
                                            var elemento = document.getElementById('valor');
                                            var valor = elemento.value;
                                            
                                            valor = valor + '';
                                            valor = parseInt(valor.replace(/[\D]+/g,''));
                                            valor = valor + '';
                                            valor = valor.replace(/([0-9]{2})$/g, ",$1");

                                            if (valor.length > 6) {
                                                valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                                            }

                                            elemento.value = valor;
                                            }
                        </script> -->

                  </div>
                </div>
             
                <br>
                <!-- /.card-body -->
              </div>

              <div class="container-fluid">
                <div class="row">

                  <div class="col-md-4">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Comprovantes do Cliente</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">

                              <!-- <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Foto Cliente
                                    <input type="file" name="attachment">
                                  </div>
                                  <span class="badge float-right">12</span>
                                </a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> RG
                                    <input type="file" name="attachment">
                                  </div>
                                </a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> CPF
                                    <input type="file" name="attachment">
                                  </div>
                                </a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Comprovante Residência
                                    <input type="file" name="attachment">
                                  </div>
                                </a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Comprovante Comercial
                                    <input type="file" name="attachment">
                                  </div>
                                </a>
                              </li>
                              <li class="nav-item active">
                                <a class="nav-link">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Termo
                                    <input type="file" name="attachment">
                                  </div>
                                </a>
                              </li> -->

                              <li class="nav-item active">
                                <a class="nav-link">

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                            <div class="btn btn-default btn-file">
                                              <i class="fas fa-paperclip"></i> Foto Cliente Self
                                              <input accept="image/*" onchange="getFileData_ftcliente(this);" type="file" name="foto[ftcliente]">
                                            </div>
                                        </div>
                                      </div>
                                </div>

                                    <div class="container text-center">
                                      <div class="row">
                                        <div class="col-1">
                                          <span id="remove_ftcliente" class="fa fa-times-circle fa-lg closeBtn" onclick="removeLine(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="ftcliente" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function removeLine() {
                                    document.getElementById('ftcliente').value = ""
                                    document.getElementById('ftcliente').style = "display: none!important;"

                                    document.getElementById('remove_ftcliente').value = ""
                                    document.getElementById('remove_ftcliente').style = "display: none!important;"

                                    }
                                </script>
                                
                                <script>
                                  function getFileData_ftcliente(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftcliente').style = '';
                                    var labe1 = document.getElementById('ftcliente');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftcliente').style = "display: flex!important;"
                                    
                                  }
                                </script>


                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> RG
                                    <input accept="image/*" onchange="getFileData_ftrg(this);" type="file" name="foto[ftrg]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>

                                  <div class="container text-center">
                                        <div class="row">
                                          <div class="col">
                                            <span id="remove_ftrg" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_ftrg(this)" title="remove" style="display: none!important;"></span>
                                          </div>
                                          <div class="col">
                                            <span id="ftrg" class="badge float-right" style="display: none!important;"></span>
                                          </div>
                                        </div>
                                    </div>

                                </a>

                                <script>
                                  function remove_ftrg() {
                                    document.getElementById('ftrg').value = ""
                                    document.getElementById('ftrg').style = "display: none!important;"

                                    document.getElementById('remove_ftrg').value = ""
                                    document.getElementById('remove_ftrg').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_ftrg(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftrg').style = '';
                                    var labe1 = document.getElementById('ftrg');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftrg').style = "display: flex!important;"
                                  }
                                </script>

                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> CPF
                                    <input accept="image/*" onchange="getFileData_ftcpf(this);" type="file" name="foto[ftcpf]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_ftcpf" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_ftcpf(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="ftcpf" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_ftcpf() {
                                    document.getElementById('ftcpf').value = ""
                                    document.getElementById('ftcpf').style = "display: none!important;"

                                    document.getElementById('remove_ftcpf').value = ""
                                    document.getElementById('remove_ftcpf').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_ftcpf(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftcpf').style = '';
                                    var labe1 = document.getElementById('ftcpf');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftcpf').style = "display: flex!important;"

                                  }
                                </script>

                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Comprovante Residência
                                    <input accept="image/*,.pdf" onchange="getFileData_ftcomresi(this);" type="file" name="foto[ftcompres]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                  
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_ftcomresi" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_ftcomresi(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="ftcomresi" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_ftcomresi() {
                                    document.getElementById('ftcomresi').value = ""
                                    document.getElementById('ftcomresi').style = "display: none!important;"

                                    document.getElementById('remove_ftcomresi').value = ""
                                    document.getElementById('remove_ftcomresi').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_ftcomresi(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftcomresi').style = '';
                                    var labe1 = document.getElementById('ftcomresi');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftcomresi').style = "display: flex!important;"

                                  }
                                </script>
                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Comprovante Comercial
                                    <input accept="image/*,.pdf" onchange="getFileData_ftcomercial(this);" type="file" name="foto[ftcompcomer]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                 
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_ftcomercial" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_ftcomercial(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="ftcomercial" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_ftcomercial() {
                                    document.getElementById('ftcomercial').value = ""
                                    document.getElementById('ftcomercial').style = "display: none!important;"

                                    document.getElementById('remove_ftcomercial').value = ""
                                    document.getElementById('remove_ftcomercial').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_ftcomercial(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftcomercial').style = '';
                                    var labe1 = document.getElementById('ftcomercial');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftcomercial').style = "display: flex!important;"

                                  }
                                </script>
                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Termo
                                    <input accept="image/*,.pdf" onchange="getFileData_fttermo(this);" type="file" name="foto[fttermo]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_fttermo" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_fttermo(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="fttermo" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_fttermo() {
                                    document.getElementById('fttermo').value = ""
                                    document.getElementById('fttermo').style = "display: none!important;"

                                    document.getElementById('remove_fttermo').value = ""
                                    document.getElementById('remove_fttermo').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_fttermo(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('fttermo').style = '';
                                    var labe1 = document.getElementById('fttermo');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_fttermo').style = "display: flex!important;"

                                  }
                                </script>
                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Certificado
                                    <input accept="image/*,.pdf" onchange="getFileData_ftcertificado(this);" type="file" name="foto[ftcertificado]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_ftcertificado" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_ftcertificado(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="ftcertificado" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_ftcertificado() {
                                    document.getElementById('ftcertificado').value = ""
                                    document.getElementById('ftcertificado').style = "display: none!important;"

                                    document.getElementById('remove_ftcertificado').value = ""
                                    document.getElementById('remove_ftcertificado').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_ftcertificado(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('ftcertificado').style = '';
                                    var labe1 = document.getElementById('ftcertificado');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_ftcertificado').style = "display: flex!important;"

                                  }
                                </script>
                              </li>

                            </ul>
                          </div>
                          <!-- /.card-body -->
                        </div>

                      </div>

                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer -->
                  </div>
                  
                  <div class="col-md-4">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Fotos do local</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">

                              <li class="nav-item active">
                                <a class="nav-link">

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Local 1
                                    <input accept="image/*" onchange="getFileData_local(this);" type="file" name="foto[ftlocal]"   name="pecadetalhe[<?= $index ?>][destino]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_label_local" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_label_local(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="label_local" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_label_local() {
                                    document.getElementById('label_local').value = ""
                                    document.getElementById('label_local').style = "display: none!important;"

                                    document.getElementById('remove_label_local').value = ""
                                    document.getElementById('remove_label_local').style = "display: none!important;"

                                    }
                                </script>


                                <script>
                                  function getFileData_local(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('label_local').style = '';
                                    var labe1 = document.getElementById('label_local');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_label_local').style = "display: flex!important;"

                                  }
                                </script>

                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Local 2
                                    <input accept="image/*" onchange="getFileData_local_2(this);" type="file" name="foto[ftlocal2]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_label_local2" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_label_local2(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="label_local2" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_label_local2() {
                                    document.getElementById('label_local2').value = ""
                                    document.getElementById('label_local2').style = "display: none!important;"

                                    document.getElementById('remove_label_local2').value = ""
                                    document.getElementById('remove_label_local2').style = "display: none!important;"

                                    }
                                </script>

                                <script>
                                  function getFileData_local_2(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('label_local2').style = '';
                                    var labe1 = document.getElementById('label_local2');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_label_local2').style = "display: flex!important;"

                                  }
                                </script>

                              </li>

                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Local 3
                                    <input accept="image/*" onchange="getFileData_local_3(this);" type="file" name="foto[ftlocal3]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                                 
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_label_local3" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_label_local3(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="label_local3" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_label_local3() {
                                    document.getElementById('label_local3').value = ""
                                    document.getElementById('label_local3').style = "display: none!important;"

                                    document.getElementById('remove_label_local3').value = ""
                                    document.getElementById('remove_label_local3').style = "display: none!important;"

                                    }
                                </script>


                                <script>
                                  function getFileData_local_3(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('label_local3').style = '';
                                    var labe1 = document.getElementById('label_local3');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_label_local3').style = "display: flex!important;"

                                  }
                                </script>

                              </li>
                            
                              <li class="nav-item active">
                                <a class="nav-link">
                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col-12">
                                  <div class="btn btn-default btn-file">
                                    <i class="fas fa-paperclip"></i> Local 4
                                    <input accept="image/*" onchange="getFileData_local_4(this);" type="file" name="foto[ftlocal4]">
                                  </div>
                                  </div>
                                  </div>
                                  </div>
                              

                                <div class="container text-center">
                                      <div class="row">
                                        <div class="col">
                                          <span id="remove_label_local4" class="fa fa-times-circle fa-lg closeBtn" onclick="remove_label_local4(this)" title="remove" style="display: none!important;"></span>
                                        </div>
                                        <div class="col">
                                          <span id="label_local4" class="badge float-right" style="display: none!important;"></span>
                                        </div>
                                      </div>
                                  </div>

                                </a>

                                <script>
                                  function remove_label_local4() {
                                    document.getElementById('label_local4').value = ""
                                    document.getElementById('label_local4').style = "display: none!important;"

                                    document.getElementById('remove_label_local4').value = ""
                                    document.getElementById('remove_label_local4').style = "display: none!important;"

                                    }
                                </script>


                                <script>
                                  function getFileData_local_4(myFile) {
                                    var file = myFile.files[0];
                                    var filename = file.name;
                                    var error_gb = document.getElementById('label_local4').style = '';
                                    var labe1 = document.getElementById('label_local4');
                                    labe1.innerHTML = filename;
                                    document.getElementById('remove_label_local4').style = "display: flex!important;"

                                  }
                                </script>

                              </li>
                            
                            </ul>
                          </div>
                          <!-- /.card-body -->
                        </div>

                      </div>

                    </div>
                    <!-- /.card-body -->

                    <!-- /.card-footer -->
                  </div>

                    <div class="col-2">
                      <button type="submit" class="btn btn-block btn-success">Salvar Edição</button>
                    </div>
                  <!-- /.card -->

                  <!-- Summernote -->
                  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
                  <!-- AdminLTE for demo purposes -->
                  <script>
                    $(function() {
                      //Add text editor
                      $('#compose-textarea').summernote()
                    })
                  </script>

                  <!-- jQuery -->
                  <script src="../../plugins/jquery/jquery.min.js"></script>
                  <!-- Bootstrap 4 -->
                  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                  <!-- Select2 -->
                  <script src="../../plugins/select2/js/select2.full.min.js"></script>
                  <!-- Bootstrap4 Duallistbox -->
                  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
                  <!-- InputMask -->
                  <script src="../../plugins/moment/moment.min.js"></script>
                  <script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
                  <!-- date-range-picker -->
                  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
                  <!-- bootstrap color picker -->
                  <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
                  <!-- Tempusdominus Bootstrap 4 -->
                  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
                  <!-- Bootstrap Switch -->
                  <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
                  <!-- BS-Stepper -->
                  <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
                  <!-- dropzonejs -->
                  <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
                  <!-- AdminLTE App -->
                  <!-- <script src="../../dist/js/adminlte.min.js"></script> -->
                  <!-- AdminLTE for demo purposes -->
                  <!-- <script src="../../dist/js/demo.js"></script> -->
                  <!-- Page specific script -->
                  <script>
                    $(function() {
                      //Initialize Select2 Elements
                      $('.select2').select2()
                      //Initialize Select2 Elements
                      $('.select2bs4').select2({
                        theme: 'bootstrap4'
                      })
                      //Datemask dd/mm/yyyy
                      $('#datemask').inputmask('dd/mm/yyyy', {
                        'placeholder': 'dd/mm/yyyy'
                      })
                      //Datemask2 mm/dd/yyyy
                      $('#datemask2').inputmask('mm/dd/yyyy', {
                        'placeholder': 'mm/dd/yyyy'
                      })
                      //Money Euro
                      $('[data-mask]').inputmask()
                      //Date picker
                      $('#reservationdate').datetimepicker({
                        format: 'L'
                      });
                      //Date and time picker
                      $('#reservationdatetime').datetimepicker({
                        icons: {
                          time: 'far fa-clock'
                        }
                      });
                      //Date range picker
                      $('#reservation').daterangepicker()
                      //Date range picker with time picker
                      $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        locale: {
                          format: 'MM/DD/YYYY hh:mm A'
                        }
                      })
                      //Date range as a button
                      $('#daterange-btn').daterangepicker({
                          ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                              'month').endOf(
                              'month')]
                          },
                          startDate: moment().subtract(29, 'days'),
                          endDate: moment()
                        },
                        function(start, end) {
                          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                            'MMMM D, YYYY'))
                        }
                      )
                      //Timepicker
                      $('#timepicker').datetimepicker({
                        format: 'LT'
                      })
                      //Bootstrap Duallistbox
                      $('.duallistbox').bootstrapDualListbox()
                      //Colorpicker
                      $('.my-colorpicker1').colorpicker()
                      //color picker with addon
                      $('.my-colorpicker2').colorpicker()
                      $('.my-colorpicker2').on('colorpickerChange', function(event) {
                        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                      })
                      $("input[data-bootstrap-switch]").each(function() {
                        $(this).bootstrapSwitch('state', $(this).prop('checked'));
                      })
                    })
                    // BS-Stepper Init
                    document.addEventListener('DOMContentLoaded', function() {
                      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
                    })
                    // DropzoneJS Demo Code Start
                    Dropzone.autoDiscover = false
                    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                    var previewNode = document.querySelector("#template")
                    previewNode.id = ""
                    var previewTemplate = previewNode.parentNode.innerHTML
                    previewNode.parentNode.removeChild(previewNode)
                    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                      url: "/target-url", // Set the url
                      thumbnailWidth: 80,
                      thumbnailHeight: 80,
                      parallelUploads: 20,
                      previewTemplate: previewTemplate,
                      autoQueue: false, // Make sure the files aren't queued until manually added
                      previewsContainer: "#previews", // Define the container to display the previews
                      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
                    })
                    myDropzone.on("addedfile", function(file) {
                      // Hookup the start button
                      file.previewElement.querySelector(".start").onclick = function() {
                        myDropzone.enqueueFile(file)
                      }
                    })
                    // Update the total progress bar
                    myDropzone.on("totaluploadprogress", function(progress) {
                      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
                    })
                    myDropzone.on("sending", function(file) {
                      // Show the total progress bar when upload starts
                      document.querySelector("#total-progress").style.opacity = "1"
                      // And disable the start button
                      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
                    })
                    // Hide the total progress bar when nothing's uploading anymore
                    myDropzone.on("queuecomplete", function(progress) {
                      document.querySelector("#total-progress").style.opacity = "0"
                    })
                    // Setup the buttons for all transfers
                    // The "add files" button doesn't need to be setup because the config
                    // `clickable` has already been specified.
                    document.querySelector("#actions .start").onclick = function() {
                      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
                    }
                    document.querySelector("#actions .cancel").onclick = function() {
                      myDropzone.removeAllFiles(true)
                    }
                    // DropzoneJS Demo Code End
                  </script>
                  <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
                  <!-- Bootstrap 4 -->
                  <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                  <!-- AdminLTE App -->
                
</body>

</html>