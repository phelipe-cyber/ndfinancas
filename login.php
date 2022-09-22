<?php
session_start();
include('conexao.php');

if(empty($_POST['login']) || empty($_POST['password'])  ) {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}

$login = mysqli_real_escape_string($conn, $_POST['login']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$status = mysqli_real_escape_string($conn, $_POST['status']);

 $query = "select * from user where usuario = '{$login}' and senha = md5('{$password}') ";

$result = mysqli_query($conn, $query);
// print_r($result);

while ($row_usuario = mysqli_fetch_assoc($result)) {
	
	$id_user = $row_usuario['id'];
	$unique_id = $row_usuario['unique_id'];

}

$row = mysqli_num_rows($result);

if($row == 1) {
	$_SESSION['login'] = $login;
	$_SESSION['id_user'] = $id_user;
	$_SESSION['unique_id'] = $unique_id;

	$status = "Ativo agora";
	$sql = "UPDATE user SET status = '{$status}' WHERE unique_id= {$unique_id} ";
	$query = mysqli_query($conn, $sql);

	header('Location: starter.php');
	exit();
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: index.php');
	exit();
}



?>