<?php


//Llamada al modelo
require_once("../db/db.php"); //aqui estan todas las clases
require_once("../models/personas_model.php"); //aqui estan todas las clases
$per=new personas_model();
$datos=$per->get_personas();
 
//Llamada a la vista
require_once("../views/personas_view.php");


?>