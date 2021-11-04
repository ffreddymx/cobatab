<?php

require_once '../db/db.php';
require_once("../models/personas_model.php"); //aqui estan todas las clases

$per=new personas_model();
$datos=array($_POST['IDx']);
$per->xAlumno($datos);
return 1;



?>