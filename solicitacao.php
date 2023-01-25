<?php 
include_once("starter.php");
include_once("conexao.php");
// exit();
$usuario = $_SESSION['login'];

?>

<form id="Form" action="salvar_solicitacao.php" method="POST">

    <div id="add_pedido"></div>
    <br>

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

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

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Solicitação</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <!-- <div class="container"> -->
                                    <!-- <div class="row"> -->
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Data Solicitação:</label>
                                            <div class="input-group date" id="datetimepicker4"
                                                data-target-input="nearest">
                                                <input required name="dt_solicitcao" type="text"
                                                    class="form-control datetimepicker-input"
                                                    data-target="#datetimepicker4" />
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
                                    <!-- </div> -->
                                    <!-- </div> -->

                                    <!-- <div class="col-lg-12"> -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Cliente:</label>
                                            <select id="cliente" name="cliente" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected=""></option>
                                                <?php
                                                    $select_sql = ("SELECT *, CASE WHEN TRIM(LTRIM(c.sobrenome)) = '' and TRIM(LTRIM(c.nome)) = '' THEN TRIM(LTRIM(c.socio))
                                                   WHEN TRIM(LTRIM(c.nome)) = '' THEN TRIM(LTRIM(c.sobrenome))
                                                   ELSE TRIM(LTRIM(c.nome))
                                                  END nome_cliente FROM `clientes` c where c.user_created = '$usuario' and c.id_cliente <> '0' ORDER BY `nome_cliente` ASC ");
                                                    
                                                    $recebidos = mysqli_query($conn, $select_sql);
                                                    
                                                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                                                        $status_solicitacao = $row_usuario['status_solicitacao'];
                                                        $cliente = $row_usuario['nome'];
                                                        $sobrenome = $row_usuario['sobrenome'];
                                                        $id = $row_usuario['id'];
                                                        $socio = $row_usuario['socio'];
                                                        $id_cliente = $row_usuario['id_cliente'];
                                                        // $nome_cliente = $socio ? : $cliente ? : $sobrenome ;
                                                        $nome_cliente = $row_usuario['nome_cliente'] ;

                                                        echo "<option value='$id.$id_cliente'>$nome_cliente</option>";
                                                        
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="input-group mb-5">

                                        <input id="id_cliente" name="id_servico" type="hidden" value="" class="form-control">
                                        <div class="col-1">
                                            <label>Porcentagem:</label>
                                            <input id="porcento" name="porcento" type="text"
                                                class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <label>Valor:</label>
                                            <input id="valor" onkeyup="formatarMoeda();" name="valor" type="text"
                                                class="form-control">
                                        </div>

                                        <div class="col-2">
                                            <label>Juros:</label>
                                            <input readonly id="juros" name="juros" onkeyup="formatarMoeda();"
                                                type="text" class="form-control">
                                        </div>

                                        <div class="col-2">
                                            <label>Valor Bruto:</label>
                                            <input id="valor_bruto" readonly name="valor_bruto" onkeyup="formatarMoeda();"
                                                name="valor" type="text" class="form-control">
                                        </div>
                                        
                                        <div id="valor_parcela" class="col-2">
                                            <label>Valor da parcela:</label>
                                            <input id="value_parcela" readonly name="valor_parcela"
                                            onkeyup="formatarMoeda();" name="valor" type="text" class="form-control">
                                        </div>
                                </div>
                            </div>
                                    <script>
                                        function formatarMoeda() {
                                            var elemento = document.getElementById('valor');
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
                                    <!-- </div> -->
                                <div id="button" class="col-2">
                                    <button type="submit" class="btn btn-block btn-success">Salvar</button>
                                </div>

                            </div>
                        </div>

                        <script>
                            function conversor(str) {
                                if (typeof str == 'number') return str;
                                var nr;
                                var virgulaSeparaDecimais = str.match(/(,)\d{2}$/);
                                if (virgulaSeparaDecimais) nr = str.replace(/\./g, '').replace(',', '.')
                                else nr = str.replace(',', '');
                                return parseFloat(nr);
                            }
                            $(document).ready(function() {
                                //   $("#valor").change(function() {
                                $("#valor").on('keyup', function(event) {
                                    // document.getElementById('spiner').style = 'display:block;';

                                    let id_result = document.getElementById("cliente").value;
                                    var idarray = id_result.split(".");
                                    // console.log(idarray);
                                    var id = idarray[0];
                                    var id_cliente = idarray[1];

                                    // console.log(id_cliente);
                                        
                                    if( id_cliente == 1){

                                        let valor = conversor(document.getElementById("valor").value);
                                        var porcento = document.getElementById("porcento").value;
                                        
                                        if(  porcento == "" ){
                                            var percentual = 0.20;
                                            var percentual_parcela =  "20";
                                        }else{
                                            var percentual = "0." + porcento;
                                            var percentual_parcela =  porcento ;
                                        }

                                        // var percentual = 0.20;
                                        var juros = valor * percentual;
                                        var valor_bruto = valor + juros;
                                        // console.log(juros);
                                        // console.log(valor_bruto);
                                        var valor_parcela = (valor_bruto / percentual_parcela);
                                        var juros = juros.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                        var valor_bruto = valor_bruto.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                        var valor_parcela = valor_parcela.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                        // console.log(valor_parcela);
                                        document.getElementById("juros").value = juros;
                                        document.getElementById("valor_bruto").value = valor_bruto;
                                        document.getElementById("value_parcela").value = valor_parcela;

                                    }else{

                                        let valor = conversor(document.getElementById("valor").value);
                                        var porcento = document.getElementById("porcento").value;
                                        
                                        if(  porcento == "" ){
                                            var percentual = 20;
                                        }else{
                                            var percentual =  porcento;

                                        }
                                        var juros = (valor / 100) * percentual;
                                        var valor_bruto = valor + juros;
                                       
                                        var juros = juros.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                        var valor_bruto = valor_bruto.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                       
                                        document.getElementById("juros").value = juros;
                                        document.getElementById("valor_bruto").value = valor_bruto;
                                        document.getElementById("valor_parcela").style = 'display: none';


                                    }

                                })
                            });
                        </script>

                        <script>
                            $(document).ready(function() {
                                $("#cliente").change(function() {
                                    // document.getElementById('spiner').style = 'display:block;';
                                    
                                    let id_result = document.getElementById("cliente").value;
                                    var idarray = id_result.split(".");
                                    // console.log(idarray);
                                    var id = idarray[0];
                                    var id_cliente = idarray[1];

                                    document.getElementById("id_cliente").value = id_cliente;
                                    console.log(id_cliente);
                                    if (id_cliente == "" || id_cliente == 2 || id_cliente == 3 ) {

                                        document.getElementById('button').style = 'display:flex;';

                                    } else {
                                        var vData = {
                                            id: id
                                        };
                                        // console.log(vData);
                                        $.ajax({
                                            url: 'validar_cliente.php',
                                            dataType: 'html',
                                            type: 'POST',
                                            data: vData,
                                            success: function(html) {
                                                //   console.log(html);
                                                //html é a resposta que a URL que pesquisamos retornou
                                                // depois adicionamos o html dentro do html da div form_content
                                                // document.getElementById('spiner').style = 'display:none;';
                                                // document.getElementById('add_pedido').style = 'display:block;';
                                                $('#add_pedido').html(html);
                                                // document.location.reload(true);
                                            },
                                            error: function(err) {
                                                // console.log(err);
                                                // document.getElementById('spiner').style = 'display:none;';
                                            },
                                        });
                                    };
                                })
                            });
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
                        <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
                        </script>
                        <!-- Bootstrap Switch -->
                        <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
                        <!-- BS-Stepper -->
                        <script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>
                        <!-- dropzonejs -->
                        <script src="../../plugins/dropzone/min/dropzone.min.js"></script>
                        <!-- AdminLTE App -->
                        <!-- <script src="../../dist/js/adminlte.min.js"></script> -->
                        <!-- AdminLTE for demo purposes -->

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
                                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1,
                                                'days')],
                                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                                            'This Month': [moment().startOf('month'), moment().endOf(
                                                'month')],
                                            'Last Month': [moment().subtract(1, 'month').startOf('month'),
                                                moment().subtract(1, 'month').endOf('month')
                                            ]
                                        },
                                        startDate: moment().subtract(29, 'days'),
                                        endDate: moment()
                                    },
                                    function(start, end) {
                                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' +
                                            end
                                            .format('MMMM D, YYYY'))
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
                                    $('.my-colorpicker2 .fa-square').css('color', event.color
                                        .toString());
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
                                document.querySelector("#total-progress .progress-bar").style.width = progress +
                                    "%"
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
