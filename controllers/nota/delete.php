<?php

require_once '../../db/db.php';
require_once("../../models/grado_model.php"); //aqui estan todas las clases

$per=new Grado_model();
$datos=array($_POST['IDx']);
$per->xGrado($datos);
return 1;



?>