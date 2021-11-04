<?php

require_once '../../db/db.php';
require_once("../../models/grupo_model.php"); //aqui estan todas las clases

$per=new Grupo_model();
$datos=array($_POST['grupo'],$_POST['turno'],$_POST['ciclo'],$_POST['ID']);
$per->updateGrupo($datos);
return 1;

?>