<?php 

include_once("starter.php");

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

        <form id="Form" action="salvar_cliente.php" method="POST">


            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Cadastro de Cliente</h3>
              </div>
              <div class="card-body">
                <div class="row">


                <div class="col-2">
                  <label>CPF ou CNPJ:</label>
                    <input id="cnpj" name="cpf" type="text" class="form-control" data-inputmask="'mask': ['999.999.999-99', '99.999.999/9999-99']" data-mask >
                  </div>
                  
                  <script> 
                        $(document).ready(function() {

                            document.getElementById("nome").value = "";

                            $("#cnpj").on('keyup', function(event) {
                                // $("#cnpj").on('keydown', function(event) {
                                // $("#cnpj").on('onclick', function(event) {
                                // console.log(event);
                                // if (event.keyCode === 9 || event.keyCode === 13 || event.keyCode === 86) {

                                document.getElementById("spiner").style = 'display:block;';

                                var cnpj_completo = document.getElementById("cnpj").value

                                var cnpj = cnpj_completo.replace(/[^0-9]/g, '');
                                    
                                    console.log(cnpj);

                                var vData = {
                                    cnpj: cnpj
                                };

                                $.ajax({
                                  url: 'https://brasilapi.com.br/api/cnpj/v1/' +  cnpj,
                                  method: "GET",
                                  success: function(response) {
                                      // console.log(response);
                                      // console.log(response.message);
                                      document.getElementById("spiner").style = 'display:none;';
                                      
                                      nomeRazao = response.razao_social;
                                      document.getElementById("nome").value = nomeRazao;
                                      
                                      municipio = response.municipio;
                                      document.getElementById("municipio").value = municipio;
                                      
                                      uf = response.uf
                                      document.getElementById("uf").value = uf;
                                      
                                      cnpj = response.cnpj
                                      document.getElementById("cnpj").value = cnpj;

                                      bairro = response.bairro
                                      document.getElementById("bairro").value = bairro;

                                      logradouro = response.logradouro
                                      document.getElementById("lougadouro").value = logradouro;

                                      cep = response.cep
                                      document.getElementById("cep").value = cep;

                                      complemento = response.complemento
                                      document.getElementById("complemento").value = complemento;

                                      nome_fantasia = response.nome_fantasia
                                      document.getElementById("sobrenome").value = nome_fantasia;

                                      // document.getElementById("pedido").focus();
                                  },
                                  error: function(err) {
                                      document.getElementById("spiner").style = 'display:none;';
                                      // console.log(err.responseJSON.message);
                                      // console.log(err.message);
                                      Erro = err.responseJSON.message;
                                      document.getElementById("nome").value = Erro;

                                  },
                                  complete: () => loading(false),

                              });
                              

                                // };

                            });
                        });
                  </script>

                <div class="col-2">
                  <label>CEP</label>
                      <input id="cep" name="cep" type="text" class="form-control" >
                </div>

                  <script> 
                        $(document).ready(function() {

                            document.getElementById("nome").value = "";

                            $("#cep").on('keyup', function(event) {
                                // $("#cnpj").on('keydown', function(event) {
                                // $("#cnpj").on('onclick', function(event) {
                                // console.log(event);
                                // if (event.keyCode === 9 || event.keyCode === 13 || event.keyCode === 86) {

                                document.getElementById("spiner").style = 'display:block;';

                                var cep = document.getElementById("cep").value

                                var cep = cep.replace(/[^0-9]/g, '');
                                    
                                    console.log(cep);

                                var vData = {
                                    cep: cep
                                };

                                $.ajax({
                                  url: 'https://brasilapi.com.br/api/cep/v1/' +  cep,
                                  method: "GET",
                                  success: function(response) {
                                      console.log(response);
                                      // console.log(response.message);
                                      document.getElementById("spiner").style = 'display:none;';
                                      
                                      street = response.street;
                                      document.getElementById("lougadouro").value = street;
                                      
                                      municipio = response.city;
                                      document.getElementById("municipio").value = municipio;
                                      
                                      uf = response.state
                                      document.getElementById("uf").value = uf;
                                      
                                      cep = response.cep
                                      document.getElementById("cep").value = cep;

                                      bairro = response.neighborhood
                                      document.getElementById("bairro").value = bairro; 

                                      // document.getElementById("pedido").focus();
                                  },
                                  error: function(err) {
                                      document.getElementById("spiner").style = 'display:none;';
                                      // console.log(err.responseJSON.message);
                                      // console.log(err.message);
                                      Erro = err.responseJSON.message;
                                      document.getElementById("lougadouro").value = Erro;

                                  },
                                  complete: () => loading(false),

                              });
                              

                                // };

                            });
                        });
                  </script>
                   
                  <div class="col-5">
                  <label>Nome:</label>
                    <input id="nome" name="nome" type="text" class="form-control" >
                  </div>
                  <div class="col-4">
                  <label>Sobrenome:</label>
                    <input id="sobrenome" name="sobrenome" type="text" class="form-control" >
                  </div>
                  <div class="col-2">
                  <label>RG:</label>
                    <input id="rg" name="rg" type="text" class="form-control" >
                  </div>
                
                  <div class="col-2">
                  <label>Telefone 1:</label>
                      <input id="tel" name="tel" type="text" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                  </div>

                  <div class="col-2">
                  <label>Telefone 2:</label>
                      <input id="tel2" name="tel2" type="text" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                  </div>
                  <div class="col-3">
                  <label>Atidade:</label>
                      <input id="atividade" name="atividade" type="text" class="form-control" >
                  </div>


                  <div class="col-4">
                  <label>Endereço:</label>
                      <input id="lougadouro" name="lougadouro" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>Número:</label>
                      <input id="number" name="number" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Bairro:</label>
                      <input id="bairro" name="bairro" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Municipio:</label>
                      <input id="municipio" name="municipio" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>UF:</label>
                      <input id="uf" name="uf" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Complemento:</label>
                      <input id="complemento" name="complemento" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Referencia:</label>
                      <input id="referencia" name="referencia" type="text" class="form-control" >
                  </div>

                  
                </div>
              </div>
              <div class="col-2">
              <button type="submit" class="btn btn-block btn-success">Salvar</button>
              </div>
              <br>
              <!-- /.card-body -->
            </div>


          </div>
        </div>

      </div>

    </div>
  </div>

</body>

</html>