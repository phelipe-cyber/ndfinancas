<?php
session_start();
include('conexao.php');

if(empty($_POST['login']) || empty($_POST['password'])  ) {
	header('Location: index.php');
	exit();
}
print_r($_POST);
exit();
$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$status = mysqli_real_escape_string($conn, $_POST['status']);

$query = "select * from user where usuario = '{$login}' and senha = md5('{$password}') and status = '1' ";

$result = mysqli_query($conn, $query);
// print_r($result);
$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['login'] = $login;
	header('Location: starter.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}

?>