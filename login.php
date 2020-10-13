<?php
require_once 'rb.php';
require_once 'lstart.php';
R::setup('mysql:host=localhost;dbname=users','root','root');
$user = R::findOne('users', 'login = ? and password = ?', [$_POST['login'], md5($_POST['password'])]);
if (isset($user)){
$_SESSION['login'] = $_POST['login'];
$_SESSION['uniquekey'] = $_POST['login'][0] . md5($_POST['password']) . $_POST['login'][1];
}
header('Location: index.php');
?>