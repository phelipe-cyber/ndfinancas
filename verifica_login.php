<?php

// require '../../vendor/autoload.php';
require './vendor/autoload.php';

// $dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$status = session_status();

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session isn't started
    session_start();
}

if ($_ENV["MANUTENCAO"] == "true") {
    header("Location: manutencao.php");
    exit();
}

if(!$_SESSION['usuario']) {
	header('Location: index.php');
	exit();
}