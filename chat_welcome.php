<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];
 $data_hoje = (date('Y-m-d'));


$id_user = $_SESSION['id_user'];

 $select_user = "SELECT * FROM `user` where id <> $id_user ";

 $recebidos = mysqli_query($conn, $select_user);
// print_r($_SESSION);


?>
<!-- <form method="POST" action="salvar_detalhes.php" enctype="multipart/form-data"> -->
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-12">

                        <section class="content">

                            <!-- Default box -->
                            <div class="card" style="width: 100%; height: 100%">
                                <div class="card-header">
                                    <h3 class="card-title">Chat</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body"  >
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-3 order-2 order-md-1">
                                            <?php 
                                                while ($rows = mysqli_fetch_assoc($recebidos)) {
                                                    ?>
                                           
                                            <!-- <div class="card-body"> -->
                                            <a href="?id_user_chat_value=<?php echo $rows['id'] ?>" method="post" enctype="multipart/form-data" class="brand-link">
                                                <img src="dist/img/nd.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                                                <span value="<?php echo $rows['id'] ?>" id="id_user_chat<?php echo $rows['id'] ?>" data-attr="<?php echo $rows['id'] ?>"  class="brand-text font-weight-light"><?php echo $rows['usuario'] ?></span>
                                                   <!-- <input id="id_user_chat_value<?php echo $rows['id'] ?>" type="text" name="id_user_chat_value<?php echo $rows['id'] ?>" value="<?php echo $rows['id'] ?>" > -->
                                                    
                                            </a>
                                           
                                           
                                            <!-- </div> -->
                                            <script>
                                                //  $(document).ready(function() {
                                                //      $("#id_user_chat<?php echo $rows['id'] ?>").on('click', function(event) {
                                                //        var id_user_chat = document.getElementById("id_user_chat_value<?php echo $rows['id'] ?>").value
                                                //              console.log("CLICK " + id_user_chat);
                                                     
                                                //      });
                                                //  });
                                             </script>

                                            <?php
                                                }
                                                
                                                ?>
                                                                    
                                        </div>

                                        <?php 
                                                       

                                                    //    print_r($_GET['id_user_chat_value']);

                                                    if( empty( $_GET['id_user_chat_value'])  ){

                                                    }else{
                                                       $id_user_chat_value = $_GET['id_user_chat_value'];
                                                        ?>
                                                         <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                                            <!-- DIRECT CHAT SUCCESS -->
                                                            <div class="card card-success card-outline direct-chat direct-chat-success">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Direct Chat</h3>

                                                                    <div class="card-tools">
                                                                        <span title="3 New Messages" class="badge bg-success">3</span>
                                                                        <button type="button" class="btn btn-tool"
                                                                            data-card-widget="collapse">
                                                                            <i class="fas fa-minus"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-tool" title="Contacts"
                                                                            data-widget="chat-pane-toggle">
                                                                            <i class="fas fa-comments"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-tool"
                                                                            data-card-widget="remove">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body">
                                                                    <!-- Conversations are loaded here -->
                                                                    <div class="direct-chat-messages" style="height: 800px;" >

                                                                    <?php
                                                                   echo $select_msg = "SELECT * FROM `tbchat` where left_user = '$id_user_chat_value' and right_user = '$id_user' ORDER BY id ASC ";
                                                                         $recebidos_msg = mysqli_query($conn, $select_msg);

                                                                         while ($rows_msg = mysqli_fetch_assoc($recebidos_msg)) {
                                                                            //  print_r($rows_msg);
                                                                              $left_user = ($rows_msg['left_user']);
                                                                              $right_user = ($rows_msg['right_user']);
                                                                              $mensagem = $rows_msg['mensagem'];

                                                                             if($id_user == $id_user){
                                                                                ?>
                                                                                  <div class="direct-chat-msg right">
                                                                            <div class="direct-chat-infos clearfix">
                                                                                <span class="direct-chat-name float-right">Sarah
                                                                                    Bullock</span>
                                                                                <span class="direct-chat-timestamp float-left">23 Jan
                                                                                    2:05 pm</span>
                                                                            </div>
                                                                            <!-- /.direct-chat-infos -->
                                                                            <img class="direct-chat-img"
                                                                                src="../dist/img/user3-128x128.jpg"
                                                                                alt="Message User Image">
                                                                            <!-- /.direct-chat-img -->
                                                                            <div class="direct-chat-text">
                                                                               <?php echo $mensagem ?>
                                                                            </div>
                                                                            <!-- /.direct-chat-text -->
                                                                        </div>
                                                                                <?php
                                                                             } if($right_user == $right_user){

                                                                                ?>
                                                                                <!-- Message. Default to the left -->
                                                                                <div class="direct-chat-msg">
                                                                                    <div class="direct-chat-infos clearfix">
                                                                                        <span class="direct-chat-name float-left">Alexander
                                                                                            Pierce</span>
                                                                                        <span class="direct-chat-timestamp float-right">23 Jan
                                                                                            2:00 pm</span>
                                                                                    </div>
                                                                                    <!-- /.direct-chat-infos -->
                                                                                    <img class="direct-chat-img"
                                                                                        src="../dist/img/user1-128x128.jpg"
                                                                                        alt="Message User Image">
                                                                                    <!-- /.direct-chat-img -->
                                                                                    <div class="direct-chat-text">
                                                                                         <?php echo $mensagem ?>
                                                                                    </div>
                                                                                    <!-- /.direct-chat-text -->
                                                                                </div>
                                                                                <?php

                                                                             }
                                                                            ?>
                                                                                
                                                                            <?php
                                                                        }
                                                                        // exit();
                                                                    ?>
                                                                        <!-- Message. Default to the left -->

                                                                        <!-- /.direct-chat-msg -->

                                                                        <!-- Message to the right -->
                                                                      
                                                                    
                                                                        <!-- /.direct-chat-msg -->
                                                                    </div>
                                                                    <!--/.direct-chat-messages-->

                                                                    <!-- Contacts are loaded here -->
                                                                   
                                                                    <!-- /.direct-chat-pane -->
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="card-footer">
                                                                    <form action="#" method="post">
                                                                        <div class="input-group">
                                                                            <input type="text" name="message"
                                                                                placeholder="Type Message ..." class="form-control">
                                                                            <span class="input-group-append">
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Send</button>
                                                                            </span>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- /.card-footer-->
                                                            </div>
                                                            <!--/.direct-chat -->
                                                            </div>
                                                        <?php


                                                    }
                                                   ?>


                                       


                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    </section>

                    <script src="./plugins/moment/moment.min.js"></script>
                    <script src="./plugins/daterangepicker/daterangepicker.js"></script>
                    <script src="./plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
                    </script>