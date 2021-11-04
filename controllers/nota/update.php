<?php

require_once '../../db/db.php';
require_once("../../models/grado_model.php"); //aqui estan todas las clases

$per=new Grado_model();
$datos=array($_POST['grado'],$_POST['grupo'],$_POST['profesor'],$_POST['ID']);
$per->updateGrado($datos);
return 1;

?>