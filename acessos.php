<?php 
include_once("starter.php");
include_once("conexao.php");

?>
<form id="Form" action="" method="POST">

    <br>

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    <div id="add_pedido_acesso"></div>

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
                                <h3 class="card-title">Acesso</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                
                                    <!-- <div class="col-lg-12"> -->
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Usuario:</label>
                                            <select id="usuario" name="usuario" class="form-control select2"
                                                style="width: 100%;">
                                                <option selected=""></option>
                                                <?php
                                                    $select_sql = ("SELECT * FROM `user`");
                                                    
                                                    $recebidos = mysqli_query($conn, $select_sql);
                                                    
                                                    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                                                        $usuario = $row_usuario['usuario'];
                                                        $id = $row_usuario['id'];
                                                        echo "<option value='$id'> $usuario </option>";
                                                        }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>

                             
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $("#usuario").change(function() {
                                    // document.getElementById('spiner').style = 'display:block;';
                                    let id = document.getElementById("usuario").value;
                                    if (id == "") {} else {
                                        var vData = {
                                            id: id
                                        };
                                        console.log(vData);
                                        $.ajax({
                                            url: 'ver_acessos.php',
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



<div id="add_pedido"></div>


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

                        <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
                        <!-- Bootstrap 4 -->
                        <!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
                        <!-- AdminLTE App -->
                        <script src="dist/js/adminlte.min.js"></script>