<?php
// require '../vendor/autoload.php';
require_once implode(DIRECTORY_SEPARATOR, [__DIR__, 'vendor/autoload.php']);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('HOST', $_ENV["DATABASE_HOST"]);
define('USUARIO', $_ENV["DATABASE_USER"]);
define('SENHA', $_ENV["DATABASE_PASSWORD"]);
define('DB', $_ENV["DATABASE_NAME"]);

$conn = mysqli_connect(HOST, USUARIO, SENHA, DB);

// $hostname = "db";
// $username = "root";
// $password = "#tr0caf0ne#";
// $dbname = "u841971040_ndfinancas";

// $conn = mysqli_connect($hostname, $username, $password, $dbname);
if(!$conn){
  echo "Database connection error".mysqli_connect_error();
}

?>
