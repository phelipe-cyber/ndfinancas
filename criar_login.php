<?php 
include("verifica_login.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ND Finanças - Login</title>
  <link rel="shortcut icon" href="/dist/img/ndicon.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <script src="https://code.jquery.com/jquery-1.9.1.js"></script>

</head>
<form  method="POST" action="salvar_login.php" enctype="multipart/form-data">

<body class="hold-transition login-page" background="./dist/img/nd.jpg">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>NDFINANCAS Criar Login</b></a>
    </div>
    <div class="card-body">
     
    <?php
                if (isset($_SESSION['nao_autenticado'])) :
                ?>
                    <div class="alert alert-danger text-center " role="alert">
                        ERRO: Usuário ou senha inválidos.
                    </div>
                <?php
                endif;
                unset($_SESSION['nao_autenticado']);
                ?>

      <form action="login.php" method="post">
        <div class="input-group mb-3">
          <input name="login" type="text" class="form-control" placeholder="Login">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" name="password" type="password" class="form-control" placeholder="Senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password2" name="password2" type="password" class="form-control" placeholder="Confirmar senha">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <script>
                      $(document).ready(function() {
                        $("#password2").on('keyup', function(event) {
                        
                            password = document.getElementById("password").value ;
                            password2 = document.getElementById("password2").value  ;
                            console.log(password2);
                            console.log(password);

                            if( password == password2   ){

                                document.getElementById("btn").style = "display: block";

                            }else{

                                document.getElementById("btn").style = "display: none";

                            }                            
                          
                        });
                      });

                    </script>


        <div class="row">
         
          <!-- /.col -->
          <div class="col-4">
            <button id="btn" style="display: none;" type="submit" class="btn btn-primary btn-block">Criar login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      <!-- <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
