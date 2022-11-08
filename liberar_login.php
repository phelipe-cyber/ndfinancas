<?php
include_once("starter.php");
include_once("conexao.php");
?>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Liberar login ao sistema</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th class="text-center" >Liberar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $usuario = $_SESSION['login'];
                                  
                          $select_sql = (" SELECT * FROM `user` ORDER BY id ASC ");
                            
                            $recebidos = mysqli_query($conn, $select_sql);
                            
                            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                                // print_r($row_usuario);
                              
                                $cliente = $row_usuario['usuario'];
                                $id = $row_usuario['id'];
                                $status_login = $row_usuario['status_login'];


                                echo "<tr>";
                                echo "<td >$cliente</td>";

                                if( $status_login == 1 ){
                                    ?>
                                     <td class="text-center">
                                   
                                        <div class="custom-control custom-switch">
                                            <input checked value="<?php echo($id) ?>" type="checkbox" class="custom-control-input"
                                            id="customSwitch<?php echo $id ?>">
                                            <label class="custom-control-label"
                                            for="customSwitch<?php echo($id) ?>"></label>
                                                
                                            <input id="id_user<?php echo($id) ?>" value="<?php echo($id) ?>" type="hidden">
                                            
                                            </div>
                                    </td>
                                    <?php
                                }else{

                                    ?>
                                     <td class="text-center">
                                   
                                        <div class="custom-control custom-switch">
                                            <input value="<?php echo($id) ?>" type="checkbox" class="custom-control-input"
                                            id="customSwitch<?php echo $id ?>">
                                            <label class="custom-control-label"
                                            for="customSwitch<?php echo($id) ?>"></label>
                                                
                                            <input id="id_user<?php echo($id) ?>" value="<?php echo($id) ?>" type="hidden">
                                            
                                            </div>
                                    </td>
                                    <?php

                                }

                               ?>
                              

                                <script>
                                              $(document).ready(function() {
                                        $("#customSwitch<?php echo $id ?>").click(function() {

                                            var isChecked = document.getElementById("customSwitch<?php echo $id ?>").checked;
                                            // console.log(isChecked);

                                            if (isChecked == false) {

                                                        let id_user = document.getElementById("id_user<?php echo($id) ?>").value;

                                                var vData = {
                                                                status: 0,
                                                                id_user: id_user
                                                            };
                                                            console.log(vData);
                                                            $.ajax({
                                                                url: 'liberar_login_user.php',
                                                                dataType: 'html',
                                                                type: 'POST',
                                                                data: vData,
                                                                success: function(html) {
                                                                    //   console.log(html);
                                                                    //html é a resposta que a URL que pesquisamos retornou
                                                                    // depois adicionamos o html dentro do html da div form_content
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                    // document.getElementById('add_pedido').style = 'display:block;';
                                                                    $('#add_pedido_acesso').html(html);
                                                                    // document.location.reload(true);
                                                                },
                                                                error: function(err) {
                                                                    // console.log(err);
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                },
                                                            });
                                              

                                            } else {

                                                        let id_user = document.getElementById("id_user<?php echo($id) ?>").value;

                                                var vData = {
                                                                status: 1,
                                                                id_user: id_user
                                                            };
                                                            console.log(vData);
                                                            $.ajax({
                                                                url: 'liberar_login_user.php',
                                                                dataType: 'html',
                                                                type: 'POST',
                                                                data: vData,
                                                                success: function(html) {
                                                                    //   console.log(html);
                                                                    //html é a resposta que a URL que pesquisamos retornou
                                                                    // depois adicionamos o html dentro do html da div form_content
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                    // document.getElementById('add_pedido').style = 'display:block;';
                                                                    $('#add_pedido_acesso').html(html);
                                                                    // document.location.reload(true);
                                                                },
                                                                error: function(err) {
                                                                    // console.log(err);
                                                                    // document.getElementById('spiner').style = 'display:none;';
                                                                },
                                                            });

                                            }

                                        });
                                    });

                                        </script>

                               <?php
                               
                              
                                echo "</tr>";
                                }
                ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- jQuery -->
                    <script src="../../plugins/jquery/jquery.min.js"></script>
                    <!-- Bootstrap 4 -->
                    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- DataTables  & Plugins -->
                    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
                    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                    <script src="../../plugins/jszip/jszip.min.js"></script>
                    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
                    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
                    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
                    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
                    <!-- AdminLTE App -->
                    <!-- <script src="../../dist/js/adminlte.min.js"></script> -->
                    <!-- AdminLTE for demo purposes -->

                    <!-- Page specific script -->
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "responsive": true,
                                "lengthChange": false,
                                "autoWidth": true,
                                "ordering": false,
                                "searching": true,
                                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                                "buttons": ["excel"],
                                "language": {
                                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                                }
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            // $('#example2').DataTable({
                            //   "paging": true,
                            //   "lengthChange": false,
                            //   "searching": false,
                            //   "ordering": false,
                            //   "info": true,
                            //   "autoWidth": false,
                            //   "responsive": true,
                            // });
                        });
                    </script>