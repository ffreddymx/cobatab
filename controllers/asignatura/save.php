<?php

require_once '../../db/db.php';
require_once("../../models/asignatura_model.php"); //aqui estan todas las clases

$per=new Asignatura_model();
$datos=array($_POST['asignatura'],$_POST['grupo'],$_POST['profesor'],$_POST['horario'],$_POST['dia']);
$per->saveAsignatura($datos);
return 1;

?>