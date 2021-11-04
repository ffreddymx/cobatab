<?php 



class Conectar{
 
  public static  function conexion(){
    $conexion = new PDO("mysql:host=localhost;dbname=cobatab", "root", "");
    //$conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }

}



?>