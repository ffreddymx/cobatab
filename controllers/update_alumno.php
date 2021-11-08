
<?php

require_once '../db/db.php';
require_once("../models/personas_model.php"); //aqui estan todas las clases

$per=new personas_model();
$datos=array($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['movil'],$_POST['email'],$_POST['matricula'],$_POST['ID']);
$per->updateAlumno($datos);
return 1;

?>