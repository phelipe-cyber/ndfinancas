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
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Usuario | Carteira</th>
                                        <th class="text-center" >Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $usuario = $_SESSION['login'];
                                    $id_user = $_SESSION['id_user'];

                        //  $select_sql = ("SELECT *, c.id as id FROM `clientes` c LEFT JOIN nome_cliente cl on cl.id = c.id_cliente where c.user_created = '$usuario' and c.id_cliente <> '0' ORDER BY c.socio, c.sobrenome, c.nome ASC ");
                         $select_sql = ("SELECT *, c.id as id, u.usuario as user_usuario
                         FROM `clientes` c 
                         LEFT JOIN nome_cliente cl on cl.id = c.id_cliente
                         LEFT JOIN user u on u.id = c.user_created 
                         where c.id_cliente <> '0'
                         ORDER BY `nome` ASC;
                         ");
                            
                            $recebidos = mysqli_query($conn, $select_sql);
                            
                            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                                // print_r($row_usuario);
                                // die();
                                $cliente = $row_usuario['nome'];
                                $id = $row_usuario['id'];
                                $sobrenome = $row_usuario['sobrenome'];
                                $socio = $row_usuario['socio'];
                                $ftcliente = $row_usuario['ftcliente'];
                                $cpf = $row_usuario['cpf'];
                                $telefone = $row_usuario['tel'];
                                $id_cliente = $row_usuario['id_cliente'];
                                // $nome_cliente = $socio ? : $cliente ? : $sobrenome ;
                                $nome_cliente = $row_usuario['nome_cliente'];
                                $user_usuario = $row_usuario['user_usuario'];
                                
                                // $salve->parcela = $this->input->post('parcela') ? : "";

                                echo "<tr>";
                                echo "<td >$id</td>";
                                echo "<td >$cliente</td>";
                                echo "<td >$cpf</td>";
                                echo "<td >$telefone</td>";
                                echo "<td >$user_usuario</td>";
                               
                               
                                // echo "<td>$status</td>";
                                // echo "<td class='project-state'><span class='$class'>$status</span></td>";

                                // echo "<td> <ion-icon name='eye-outline' href='teste.php' ></ion-icon> </td>";
                                // echo "<td class='text-center'> <a target='_blank' href='detalhes.php?id=$id_soli'> <i aria-hidden='true' class='fas fa-eye'> </i> </a> </td>";
                              echo "<td class='project-actions text-center'>
                                <a class='btn btn-primary btn-sm' href='profile_adm.php?id=$id''>
                                    <i class='fas fa-folder'>
                                    </i>
                                    Ver
                                </a>
                               
                                <a class='btn btn-info btn-sm' href='cdclienteeditar_adm.php?id=$id'>
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
                    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
                    
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
                    <!-- Page specific script -->
                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                // Adiciona os botões e define a ordem dos elementos
                                "dom": 'Bfrtip',
                                "responsive": true,
                                "lengthChange": false,
                                "autoWidth": false, // Recomenda-se false com responsive
                                "ordering": false,
                                "searching": true,
                                
                                // Define quais botões serão exibidos
                                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

                                // Tradução para Português-Brasil
                                "language": {
                                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                                }
                            });
                        });
                    </script>