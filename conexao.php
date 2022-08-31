<?php
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('HOST', $_ENV["DATABASE_HOST"]);
define('USUARIO', $_ENV["DATABASE_USER"]);
define('SENHA', $_ENV["DATABASE_PASSWORD"]);
define('DB', $_ENV["DATABASE_NAME"]);
$conn = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possível conectar');
mysqli_set_charset($conn,"utf8");



?>