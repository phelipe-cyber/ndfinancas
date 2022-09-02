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

        <div id="danger-alert" class="alert alert-danger alert-dismissible" style="display: none;" >
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Erro!</h5> <label id="msg_error" ></label>
        </div>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Cadastro Cliente</h3>
              </div>
              <div class="card-body">
                <div class="row">


                <div class="col-2">
                  <label>CPF ou CNPJ:</label>
                    <input required id="cnpj" name="cpf" type="text" class="form-control" data-inputmask="'mask': ['999.999.999-99', '99.999.999/9999-99']" data-mask >
                </div>
                  
                  <script> 
                        $(document).ready(function() {

                            document.getElementById("nome").value = "";

                            $("#cnpj").on('keyup', function(event) {
                                // $("#cnpj").on('keydown', function(event) {
                                // $("#cnpj").on('onclick', function(event) {
                                // console.log(event);
                                // if (event.keyCode === 9 || event.keyCode === 13 || event.keyCode === 86) {

                                document.getElementById("nome").value = "";
                                document.getElementById("sobrenome").value = "";
                                document.getElementById("lougadouro").value = "";
                                document.getElementById("bairro").value = "";
                                document.getElementById("municipio").value = "";
                                document.getElementById("uf").value = "";
                                document.getElementById("complemento").value = "";
                                document.getElementById("cep").value = "";


                                document.getElementById("spiner").style = 'display:block;';
                                document.getElementById("danger-alert").style = "display: none";


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
                                      // document.getElementById("nome").value = Erro;
                                      document.getElementById("sobrenome").value = "";
                                      document.getElementById("cep").value = "";
                                      document.getElementById("lougadouro").value = "";
                                      document.getElementById("bairro").value = "";
                                      document.getElementById("municipio").value = "";
                                      document.getElementById("uf").value = "";
                                      document.getElementById("complemento").value = "";

                                      document.getElementById("msg_error").innerText = Erro ;
                                      document.getElementById("danger-alert").style = "display: block";

                                      $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
                                          $("#danger-alert").slideUp(500);
                                      });


                                  },
                                  complete: () => loading(false),

                              });
                              

                                // };

                            });
                        });
                  </script>

                <div class="col-2">
                  <label>CEP:</label>
                      <input required id="cep" name="cep" type="text" class="form-control" data-inputmask="'mask': ['99999-999']" data-mask >
                </div>

                  <script> 
                        $(document).ready(function() {

                            document.getElementById("nome").value = "";

                            $("#cep").on('keyup', function(event) {
                                // $("#cnpj").on('keydown', function(event) {
                                // $("#cnpj").on('onclick', function(event) {
                                // console.log(event);
                                // if (event.keyCode === 9 || event.keyCode === 13 || event.keyCode === 86) {
                                document.getElementById("danger-alert").style = "display: none";
                                document.getElementById("lougadouro").value = "";
                                document.getElementById("municipio").value = "";
                                document.getElementById("uf").value = "";
                                document.getElementById("bairro").value = "";

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
                                      // document.getElementById("lougadouro").value = Erro;
                                      document.getElementById("municipio").value = "";
                                      document.getElementById("uf").value = "";
                                      document.getElementById("bairro").value = "";

                                      document.getElementById("msg_error").innerText = Erro ;
                                      document.getElementById("danger-alert").style = "display: block";

                                      $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
                                          $("#danger-alert").slideUp(500);
                                      });

                                  },
                                  // complete: () => loading(false),

                              });
                              

                                // };

                            });
                        });
                  </script>
                   
                  <div class="col-5">
                  <label>Nome:</label>
                    <input required id="nome" name="nome" type="text" class="form-control" >
                  </div>
                  <div class="col-4">
                  <label>Sobrenome:</label>
                    <input required id="sobrenome" name="sobrenome" type="text" class="form-control" >
                  </div>
                  <div class="col-2">
                  <label>RG:</label>
                    <input required id="rg" name="rg" type="text" class="form-control" >
                  </div>
                
                  <div class="col-2">
                  <label>Telefone 1:</label>
                      <input required id="tel" name="tel" type="text" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                  </div>

                  <div class="col-2">
                  <label>Telefone 2:</label>
                      <input id="tel2" name="tel2" type="text" class="form-control" data-inputmask="'mask': ['(99) 9999-9999', '(99) 99999-9999']" data-mask>
                  </div>
                  <div class="col-3">
                  <label>Atidade:</label>
                      <input required id="atividade" name="atividade" type="text" class="form-control" >
                  </div>


                  <div class="col-4">
                  <label>Endereço:</label>
                      <input required id="lougadouro" name="lougadouro" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>Número:</label>
                      <input required id="number" name="number" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Bairro:</label>
                      <input required id="bairro" name="bairro" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Municipio:</label>
                      <input required id="municipio" name="municipio" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>UF:</label>
                      <input required id="uf" name="uf" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Complemento:</label>
                      <input required id="complemento" name="complemento" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Referencia:</label>
                      <input required id="referencia" name="referencia" type="text" class="form-control" >
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
              <!-- <div class="col-2">
              <button type="submit" class="btn btn-block btn-success">Salvar</button>
              </div> -->
              <br>
              <!-- /.card-body -->
            </div>

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Endereço Empresa</h3>
              </div>
              <div class="card-body">
                <div class="row">

                <div class="col-2">
                  <label>CEP:</label>
                      <input required id="cep_emp" name="cep_emp" type="text" class="form-control" data-inputmask="'mask': ['99999-999']" data-mask >
                </div>

                  <script> 
                        $(document).ready(function() {

                            $("#cep_emp").on('keyup', function(event) {
                                // $("#cnpj").on('keydown', function(event) {
                                // $("#cnpj").on('onclick', function(event) {
                                // console.log(event);
                                // if (event.keyCode === 9 || event.keyCode === 13 || event.keyCode === 86) {

                                document.getElementById("lougadouro_emp").value = "";
                                document.getElementById("municipio_emp").value = "";
                                document.getElementById("uf_emp").value = "";
                                document.getElementById("bairro_emp").value = "";
                                document.getElementById("bairro_emp").value = "";
                                document.getElementById("bairro_emp").value = "";


                                document.getElementById("spiner").style = 'display:block;';

                                var cep = document.getElementById("cep_emp").value

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
                                      document.getElementById("lougadouro_emp").value = street;
                                      
                                      municipio = response.city;
                                      document.getElementById("municipio_emp").value = municipio;
                                      
                                      uf = response.state
                                      document.getElementById("uf_emp").value = uf;
                                      
                                      cep = response.cep
                                      document.getElementById("cep_emp").value = cep;

                                      bairro = response.neighborhood
                                      document.getElementById("bairro_emp").value = bairro; 

                                      // document.getElementById("pedido").focus();
                                  },
                                  error: function(err) {
                                      document.getElementById("spiner").style = 'display:none;';
                                      // console.log(err.responseJSON.message);
                                      // console.log(err.message);
                                      Erro = err.responseJSON.message;
                                      document.getElementById("lougadouro_emp").value = Erro;
                                      document.getElementById("municipio_emp").value = "";
                                      document.getElementById("uf_emp").value = "";
                                      document.getElementById("bairro_emp").value = "";

                                  },
                                  complete: () => loading(false),

                              });
                              

                                // };

                            });
                        });
                  </script>


                  <div class="col-4">
                  <label>Endereço:</label>
                      <input required id="lougadouro_emp" name="lougadouro_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>Número:</label>
                      <input required id="number_emp" name="number_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Bairro:</label>
                      <input required id="bairro_emp" name="bairro_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-2">
                  <label>Municipio:</label>
                      <input required id="municipio_emp" name="municipio_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-1">
                  <label>UF:</label>
                      <input required id="uf_emp" name="uf_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Complemento:</label>
                      <input required id="complemento_emp" name="complemento_emp" type="text" class="form-control" >
                  </div>

                  <div class="col-4">
                  <label>Referencia:</label>
                      <input required id="referencia_emp" name="referencia_emp" type="text" class="form-control" >
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
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

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
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
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

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
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
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
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
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>