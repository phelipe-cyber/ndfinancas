<?php
include_once("starter.php");
include_once("conexao.php");

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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Clientes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Cliente</th>
                                        <th>Cliente</th>
                                        <th>CNPJ</th>
                                        <th>CPF</th>
                                        <th>VS | Guerra</th>
                                        <th class="text-center" >Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $usuario = $_SESSION['login'];

                        //  $select_sql = ("SELECT *, c.id as id FROM `clientes` c LEFT JOIN nome_cliente cl on cl.id = c.id_cliente where c.user_created = '$usuario' and c.id_cliente <> '0' ORDER BY c.socio, c.sobrenome, c.nome ASC ");
                         $select_sql = ("SELECT *, c.id as id,
                         CASE WHEN TRIM(LTRIM(c.sobrenome)) = '' and TRIM(LTRIM(c.nome)) = '' THEN TRIM(LTRIM(c.socio))
                             WHEN TRIM(LTRIM(c.nome)) = '' THEN TRIM(LTRIM(c.sobrenome))
                             ELSE TRIM(LTRIM(c.nome))
                         END nome_cliente
                         FROM `clientes` c LEFT JOIN nome_cliente cl on cl.id = c.id_cliente where c.user_created = '$usuario' and c.id_cliente <> '0'
                         ORDER BY `nome_cliente` ASC;
                         ");
                            
                            $recebidos = mysqli_query($conn, $select_sql);
                            
                            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                                // print_r($row_usuario);
                              
                                $cliente = $row_usuario['nome'];
                                $id = $row_usuario['id'];
                                $sobrenome = $row_usuario['sobrenome'];
                                $socio = $row_usuario['socio'];
                                $ftcliente = $row_usuario['ftcliente'];
                                $cpf = $row_usuario['cpf'];
                                $cnpj = $row_usuario['cnpj'];
                                $id_cliente = $row_usuario['id_cliente'];
                                $nome_servico = $row_usuario['nome_servico'];
                                // $nome_cliente = $socio ? : $cliente ? : $sobrenome ;
                                $nome_cliente = $row_usuario['nome_cliente'];
                                
                                // $salve->parcela = $this->input->post('parcela') ? : "";

                                echo "<tr>";
                                echo "<td >$id</td>";
                                echo "<td >$nome_cliente</td>";
                                echo "<td >$cnpj </td>";
                                echo "<td >$cpf </td>";
                                echo "<td >$nome_servico </td>";
                               
                               
                                // echo "<td>$status</td>";
                                // echo "<td class='project-state'><span class='$class'>$status</span></td>";

                                // echo "<td> <ion-icon name='eye-outline' href='teste.php' ></ion-icon> </td>";
                                // echo "<td class='text-center'> <a target='_blank' href='detalhes.php?id=$id_soli'> <i aria-hidden='true' class='fas fa-eye'> </i> </a> </td>";
                              echo "<td class='project-actions text-center'>
                                <a class='btn btn-primary btn-sm' href='profile.php?id=$id''>
                                    <i class='fas fa-folder'>
                                    </i>
                                    Ver
                                </a>
                               
                                <a class='btn btn-info btn-sm' href='cdclienteeditar.php?id=$id'>
                                <i class='fas fa-pencil-alt'>
                                </i>
                                Editar
                            </a>

                                </td>";
                                // <i class="fas fa-search"></i>
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