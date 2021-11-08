<?php

require_once '../../db/db.php';
require_once("../../models/nota_model.php"); //aqui estan todas las clases

$per=new Nota_model();
$datos=array($_POST['IDx']);
$per->xNota($datos);
return 1;



?>