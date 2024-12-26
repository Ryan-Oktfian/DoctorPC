<?php

include ("../app/Controller.php");

$controller = new Controller();

if (isset($_GET['login'])) {
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

session_start();
$_SESSION['name'] = $username;


$controller->authenticationLogin($username, $password);

}

?>