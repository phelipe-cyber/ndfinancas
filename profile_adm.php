<?php
include_once("starter.php");
include_once("conexao.php");

date_default_timezone_set('America/Recife');
 $data_hora = (date('Y-m-d H:i:s'));
 $usuario = $_SESSION['login'];

 $id = $_GET['id'];

 $select_sql = ("SELECT c.*, ft.* ,
GROUP_CONCAT( DISTINCT ft.ftrg,'|-separator-sql-|', ft.ftcpf ,'|-separator-sql-|',ft.ftcompres,'|-separator-sql-|', ft.ftcompcomer,'|-separator-sql-|', ft.fttermo,'|-separator-sql-|', ft.ftcertificado,'|-separator-sql-|', ft.ftlocal,'|-separator-sql-|', ft.ftlocal2,'|-separator-sql-|', ft.ftlocal3,'|-separator-sql-|', ft.ftlocal4 ) as `fotos`
FROM `clientes` c LEFT JOIN fotos_clientes ft on ft.id_cliente = c.id where c.id = $id ");
             
             $recebidos = mysqli_query($conn, $select_sql);
             $row = mysqli_num_rows($recebidos);
            //  print_r($row);
             
             while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
                 
                  $fotos = $row_usuario['fotos'];
                
    $status_solicitacao = $row_usuario['status_solicitacao'];
    $class = $row_usuario['class'];
    $cliente = $row_usuario['nome'];
    $sobrenome = $row_usuario['sobrenome'];
    $socio = $row_usuario['socio'];
    $id = $row_usuario['id'];
    $atividade = $row_usuario['atividade'];
    $endereco = $row_usuario['endereco'];
    $cpf = $row_usuario['cpf'];
    $rg = $row_usuario['rg'];
    $tel = $row_usuario['tel'];
    $tel2 = $row_usuario['tel2'];
    $numero = $row_usuario['numero'];
    $bairro = $row_usuario['bairro'];
    $municipio = $row_usuario['municipio'];
    $uf = $row_usuario['uf'];
    $uf_emp = $row_usuario['uf_emp'];
    $complemento = $row_usuario['complemento'];
    $referencia = $row_usuario['referencia'];
    $cep_emp = $row_usuario['cep_emp'];
    $lougadouro_emp = $row_usuario['lougadouro_emp'];
    $number_emp = $row_usuario['number_emp'];
    $municipio_emp = $row_usuario['municipio_emp'];
    $bairro_emp = $row_usuario['bairro_emp'];
    $complemento_emp = $row_usuario['complemento_emp'];
    $referencia_emp = $row_usuario['referencia_emp'];

    $ftcliente = $row_usuario['ftcliente'];
    $ftrg = $row_usuario['ftrg'];
    $ftcpf = $row_usuario['ftcpf'];
    $ftcompres = $row_usuario['ftcompres'];
    $ftcompcomer = $row_usuario['ftcompcomer'];
    $fttermo = $row_usuario['fttermo'];
    $ftlocal = $row_usuario['ftlocal'];
    $ftlocal2 = $row_usuario['ftlocal2'];
    $ftlocal3 = $row_usuario['ftlocal3'];
    

 }

?>

<!-- <div class="content-wrapper"> -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li> -->
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">

                        <!-- <div class="card bg-light d-flex flex-fill"> -->
                            <div class="lead card-header text-muted border-bottom-0"><b>
                                <?php echo $cliente." ".$sobrenome ?>
                            </b>
                            </div>
                            <div class="lead card-header text-muted border-bottom-0"><b>
                                <?php echo $socio ?>
                            </b>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>RG:</b> <?php echo $rg?></h2>
                                        <h2 class="lead"><b>CPF: </b><?php echo $cpf?></h2>
                                        <p class="text-muted text-sm"><b>Atividade: </b>  <?php echo $atividade ?> </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li">
                                                <i class="fas fa-lg fa-building"></i></span>
                                                 Endereço:  <?php echo $endereco .", ". $numero ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Municipio:  <?php echo $municipio ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Cidade:  <?php echo $uf ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 CEP:  <?php echo $cep ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Complemento:  <?php echo $complemento ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Referência:  <?php echo $referencia?>
                                            </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $tel ?> </li>
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span> Phone #: <?php echo $tel2 ?></li>
                                        </ul>
                                        <br>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span> Endereço Empresa : <?php echo $lougadouro_emp .", ". $number_emp ?> </li>
                                                        <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Municipio:  <?php echo $municipio_emp ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Cidade:  <?php echo $uf_emp ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 CEP:  <?php echo $cep_emp ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                 Complemento:  <?php echo $complemento_emp ?>
                                            </li>
                                            <li class="small"><span class="fa-li">
                                                <i class="f"></i></span>
                                                Referência:  <?php echo $referencia_emp ?>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img src="./imagens_cliente/<?php echo $ftcliente ?>" alt="user-avatar"
                                            class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>

                        <!-- </div> -->

                    </div>
                </div>
                <!-- /.card-body -->
                <!-- </div> -->
                <!-- /.card -->

                <!-- About Me Box -->

                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">

                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->

                                <style>
                                    div#imagens img {
                                        width: 900px !important;
                                        height: 460px !important;
                                    }
                                </style>
                                <!-- Post -->

                                <div class="card-footer bg-white">
                                 <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                
                
                                    <?php
                                        $sep_fotos = explode('|-separator-sql-|', $fotos);
                                        
                                        foreach( $sep_fotos as $Fotos ):
                                            
                                            $ext = explode('.', $Fotos );
                                             
                                            $ult_ext = end($ext);

                                            // echo $ult_ext;

                                            if($Fotos == ""){
                        
                                            }else{
                                                if( $ult_ext == 'pdf' ){
                                                    ?>
                                                      <li> 
                                                <!-- <span class="mailbox-attachment-icon has-img"><img src="./imagens_cliente/<?php echo $Fotos ?>" alt="Attachment"></span> -->
                                                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                                
                                                <div class="mailbox-attachment-info">
                                                    <a href="./imagens_cliente/<?php echo $Fotos ?>" target='_blank' class="mailbox-attachment-name"><i class="fas fa-camera"></i> <?php echo $Fotos ?></a>
                                                      </div>
                                        
                                                </li>
                                                    <?php
                                                }else{
                                                    ?>
                                                      <li> 
                                                <span class="mailbox-attachment-icon has-img"><img src="./imagens_cliente/<?php echo $Fotos ?>" alt="Attachment"></span>
                                
                                                <div class="mailbox-attachment-info">
                                                    <a href="./imagens_cliente/<?php echo $Fotos ?>" target='_blank' class="mailbox-attachment-name"><i class="fas fa-camera"></i> <?php echo $Fotos ?></a>
                                                      </div>
                                        
                                                </li>
                                                    <?php
                                                }
                                                ?>
                                              
                                                
                                                <?php
                                        };
                                            endforeach;

                                        ?>

             
                                </ul>
                                </div>
                                <!-- <div id="imagens">
                                    <div class="post">
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid "
                                                            src="./imagens_cliente/<?php echo $ftrg ?>"
                                                            alt="Photo">
                                                        <img class="img-fluid"
                                                            src="./imagens_cliente/<?php echo $ftcpf ?>"
                                                            alt="Photo">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid "
                                                            src="./imagens_cliente/<?php echo $ftcompres ?>"
                                                            alt="Photo">
                                                        <img class="img-fluid"
                                                            src="./imagens_cliente/<?php echo $ftcompcomer ?>"
                                                            alt="Photo">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid "
                                                            src="./imagens_cliente/<?php echo $fttermo ?>"
                                                            alt="Photo">
                                                        <img class="img-fluid"
                                                            src="./imagens_cliente/<?php echo $ftlocal ?>"
                                                            alt="Photo">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid "
                                                            src="./imagens_cliente/<?php echo $ftlocal2 ?>"
                                                            alt="Photo">
                                                        <img class="img-fluid"
                                                            src="./imagens_cliente/<?php echo $ftlocal3 ?>"
                                                            alt="Photo">
                                                    </div>
                                                    </div>
                                                </div>

                                            
                                           
                                        </div>
                                       
                                    </div>
                                </div> -->
                                </div>
                            

                          
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

          
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>