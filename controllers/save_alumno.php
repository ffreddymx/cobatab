<?php


//Llamada al modelo
require_once("models/personas_model.php"); //aqui estan todas las clases



$per=new personas_model();
 

$datos=array($_POST['nombre'],$_POST['apellido'],$_POST['direccion'],$_POST['movil'],$_POST['email'],$_POST['matricula'],$_POST['tutor']);


 $per->saveAlumno($datos);

return 1;
//Llamada a la vista
//require_once("views/alumnos.php");


?>