<?php
session_start();
// require '../../vendor/autoload.php';
require './vendor/autoload.php';
// $dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


if(!$_SESSION['login']) {
	header('Location: index.php');
	exit();
}

// $status = session_status();

// print_r($_SESSION['login']);

// if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
//     // session isn't started
//     session_start();
// }

// if ($_ENV["MANUTENCAO"] == "true") {
//     header("Location: manutencao.php");
//     exit();
// }

// if(!$_SESSION['login']) {
// 	header('Location: starter.php');
// 	exit();
// }else{
//     header('Location: index.php');
// 	exit();
// }