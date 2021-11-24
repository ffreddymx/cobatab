<?php

require_once '../../db/db.php';
require_once("../../models/users.php"); //aqui estan todas las clases

$per=new User();
$datos=array($_POST['usuario'],$_POST['password'],$_POST['tipo'],$_POST['profesor'],$_POST['alumno']);
$per->saveUser($datos);
return 1;

//Nombre,Apellido,Direccion,Movil,Profesion

?>
