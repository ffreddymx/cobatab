<?php

require_once '../../db/db.php';
require_once("../../models/nota_model.php"); //aqui estan todas las clases

$per=new Nota_model();
$datos=array($_POST['asignatura'],$_POST['alumno'],$_POST['nota1'],$_POST['nota2'],$_POST['nota3'],$_POST['aprobado']);
$per->saveNota($datos);
return 1;

?>