<?php

class personas_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_alumnos(){
        $consulta=$this->db->query("SELECT * from alumnos");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function saveAlumno($datos){

    $this->db->exec("INSERT INTO alumnos(Nombre,Apellido,Matricula,Tutor,Direccion) values('$datos[0]','$datos[1]','$datos[5]','$datos[6]','$datos[2]')");
    
    }

    public function updateAlumno($datos){

        $this->db->exec("UPDATE alumnos set Nombre='$datos[0]',Apellido='$datos[1]',Matricula='$datos[5]',Tutor='$datos[6]',Direccion='$datos[2]' where id = '$datos[7]'  ");
        
    }

    public function xAlumno($datos){

        $this->db->exec("DELETE FROM alumnos  where id = '$datos[0]'  ");
            
    }

}

?>