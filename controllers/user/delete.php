<?php

require_once '../../db/db.php';
require_once("../../models/users.php"); //aqui estan todas las clases

$per=new User();
$datos=array($_POST['IDx']);
$per->xUser($datos);
return 1;



?>