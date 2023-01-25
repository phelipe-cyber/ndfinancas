<?php 
    // include_once("starter.php");
    include_once("conexao.php");
    // print_r($_POST);
    // die();
$cpf = $_POST['cpf'];
$cnpj_completo = $_POST['cnpj_completo'];
$cnpj = $_POST['cnpj'];

if( $cpf <> "" ){
     $select_sql = ("SELECT cpf FROM `clientes` where cpf = '$cpf' GROUP BY cpf ");
     $recebidos = mysqli_query($conn, $select_sql);
     while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        $cpf_validacao = $row_usuario['cpf'];
    }

    }else{
     $select_sql = ("SELECT cnpj FROM `clientes` where cnpj = '$cnpj_completo'  GROUP BY cnpj ");
     $recebidos = mysqli_query($conn, $select_sql);
     while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        $validacao = $row_usuario['cnpj'];
    }
}


// echo $validacao;
// die();
if( $validacao > 0 || $cpf_validacao > 0 ){
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
                    <div id="danger-alert-cliente" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                        Cliente Já cadastrado!
                    </div>

                    <script>

                        // document.getElementById('button').style = 'display:none;';
                            $("#danger-alert-cliente").fadeTo(4000, 500).slideUp(500, function() {
                            $("#danger-alert-cliente").slideUp(500);
                        });


                    </script>
        <?php

    //    echo '<meta http-equiv="refresh" content="4;URL=starter.php" />';
}else{
        ?>
        <script>
             var cnpj_completo = document.getElementById("cnpj").value
             var cnpj = cnpj_completo.replace(/[^0-9]/g, '');
                 console.log(cnpj);
                         
            // document.getElementById('button').style = 'display:flex;';
             $.ajax({
                            url: 'https://brasilapi.com.br/api/cnpj/v1/' + cnpj,
                            method: "GET",
                            success: function(response) {
                              // console.log(response.qsa[0].nome_socio);
                              // console.log(response.message);
                              document.getElementById("spiner").style = 'display:none;';
                              
                              nomeRazao = response.razao_social;
                              document.getElementById("razao_social").value = nomeRazao;
                              
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

                              nome_socios = response.qsa[0].nome_socio;
                              if( nome_socios == "" ){
                              }else{
                                document.getElementById("nome").value = nome_socios;
                              }

                              // document.getElementById("pedido").focus();
                            },
                            error: function(err) {
                              document.getElementById("spiner").style = 'display:none;';
                              // console.log(err.responseJSON.message);
                              // console.log(err.message);
                               Erro = err.responseJSON.message;
                              // document.getElementById("nome").value = Erro;
                              document.getElementById("sobrenome").value = "";
                              document.getElementById("cep").value = "";
                              document.getElementById("lougadouro").value = "";
                              document.getElementById("bairro").value = "";
                              document.getElementById("municipio").value = "";
                              document.getElementById("uf").value = "";
                              document.getElementById("complemento").value = "";
                              document.getElementById("msg_error").innerText = Erro;
                              document.getElementById("danger-alert").style = "display: block";
                              $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
                                $("#danger-alert").slideUp(500);
                              });
                            },
                            // complete: () => loading(false),
                          });
        </script>

            <?php
                
        }
        ?>

