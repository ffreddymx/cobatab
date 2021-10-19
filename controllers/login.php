<?php 

session_start();
require_once '../db/db.php';
require_once '../models/users.php';

	$obj= new User();

	$datos=array($_POST['user'],$_POST['pass']);

	echo $obj->loginUser($datos);

 ?>