<?php

require_once '../../db/db.php';
require_once("../../models/inscribir_model.php"); //aqui estan todas las clases

$per=new Inscribir_model();
$datos=array($_POST['alumno'],$_POST['grupo']);
$per->saveInscribir($datos);
return 1;

?>