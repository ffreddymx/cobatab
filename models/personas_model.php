<?php

class personas_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_personas(){
        $consulta=$this->db->query("SELECT * from user");
        while($filas=$consulta->fetch_assoc()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function saveAlumno($datos){

    $this->db->exec("INSERT INTO alumnos(Nombre,Apellido,Matricula,Tutor,Direccion) values('$datos[0]','$datos[1]','$datos[5]','$datos[6]','$datos[2]')");

    }





}

?>