<?php
require_once 'rb.php';
if (isset($_GET['login'])){
R::setup('mysql:host=localhost;dbname=users','root','root');
$user = R::dispense('users');
$user['login'] = $_GET['login'];
$user['password'] = md5('test');
$user['email'] = 'test@test.com';
$id = R::store($user);
}else{
	echo 'GET REQUEST WITH LOGIN, password = test';
}
?>