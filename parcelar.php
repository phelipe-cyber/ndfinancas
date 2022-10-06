<?php 
include_once("starter.php");
include_once("conexao.php");
// exit();

// print_r($_POST);

$id_cliente = $_POST['id_cliente'];
$id_solicitacao = $_POST['id_solicitacao'];
$total_em_atraso = $_POST['total_em_atraso'];
$id_servico = $_POST['id_servico'];

?>

<form id="Form" action="salvar_parcelamento.php" method="POST">

<input id="id_cliente" name="id_cliente" type="hidden" class="form-control" value="<?php  echo $id_cliente ?>" >
<input id="id_solicitacao" name="id_solicitacao" type="hidden" class="form-control" value="<?php  echo $id_solicitacao ?>" >
<input id="total_em_atraso" name="total_em_atraso" type="hidden" class="form-control" value="<?php  echo $total_em_atraso ?>" >
<input id="id_servico" name="id_servico" type="hidden" class="form-control" value="<?php  echo $id_servico ?>" >

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
                                <h3 class="card-title">Parcelamento</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                <div class="col-2">
                                        <div class="form-group">
                                            <label>Data Pagamento:</label>
                                            <div class="input-group date" id="datetimepicker4"
                                                data-target-input="nearest">
                                                <input required name="dt_solicitacao" type="text"
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

                                    <div class="col-2">
                                        <label>Total de Parcelas:</label>
                                        <input autofocus id="total_parcelas"  name="total_parcelas" type="text" class="form-control" value="" >
                                    </div>
                                    
                                    <div class="col-2">
                                        <label>Valor:</label>
                                        <input readonly id="valor"  name="valor" type="text"
                                            class="form-control" value="<?php  echo "R$ " .number_format($total_em_atraso, 2, ',', '.'); ?>" >
                                       
                                            <input id="valor_somar" name="valor_somar" type="hidden" class="form-control" value="<?php  echo $total_em_atraso ?>" >
                                    </div>


                                    <div class="col-2">
                                        <label>Valor Bruto:</label>
                                        <input id="valor_bruto" readonly name="valor_bruto" value="<?php  echo "R$ " .number_format($total_em_atraso *2 , 2, ',', '.'); ?>"
                                            name="valor" type="text" class="form-control">
                                    </div>

                                    <div class="col-2">
                                        <label>Valor da parcela:</label>
                                        <input id="valor_parcela" readonly name="valor_parcela"
                                             name="valor" type="text" class="form-control">
                                    </div>
                                    <!-- </div> -->

                                </div>
                             
                                <br>
                               <div class="row">
                                  <div class="col-2">
                                            <button type="submit" class="btn btn-block btn-success">Salvar</button>
                                  </div>
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
                                $("#total_parcelas").on('keyup', function(event) {
                                   
                                        let valor = document.getElementById("valor_somar").value;
                                        let total_parcelas = document.getElementById("total_parcelas").value;
                                        
                                        // var percentual = 2;
                                        var valor_atual = valor * 2;
                                        // console.log(valor_atual);

                                        var valor_parcela = valor_atual / total_parcelas;
                                        
                                        // console.log(valor_parcela);

                                        // var valor_bruto = valor + juros;
                                        // var valor_parcela = (valor_bruto / 2);
                                        // var juros = juros.toLocaleString('pt-br', {
                                        //     style: 'currency',
                                        //     currency: 'BRL'
                                        // });
                                        var valor_atual = valor_atual.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });
                                        var valor_parcela = valor_parcela.toLocaleString('pt-br', {
                                            style: 'currency',
                                            currency: 'BRL'
                                        });

                                        // document.getElementById("juros").value = valor_atual;
                                        document.getElementById("valor_bruto").value = valor_atual;
                                        document.getElementById("valor_parcela").value = valor_parcela;


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
                        <script src="../../dist/js/adminlte.min.js"></script>
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
