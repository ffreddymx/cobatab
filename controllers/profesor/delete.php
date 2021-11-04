<?php

require_once '../../db/db.php';
require_once("../../models/profesor_model.php"); //aqui estan todas las clases

$per=new Profesor_model();
$datos=array($_POST['IDx']);
$per->xProfesor($datos);
return 1;



?>