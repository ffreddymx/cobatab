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


    public function get_buscar($alumno){
        $consulta=$this->db->query("SELECT * from alumnos where Nombre like '$alumno' or Matricula = '$alumno' ");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function saveAlumno($datos){

    $this->db->exec("INSERT INTO alumnos(Nombre,Apellido,Direccion,Movil,Email,Matricula) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')");
    
    }

    public function updateAlumno($datos){

        $this->db->exec("UPDATE alumnos set Nombre='$datos[0]',Apellido='$datos[1]',Direccion='$datos[2]',Movil='$datos[3]', Email='$datos[4]', Matricula='$datos[5]' where id = '$datos[6]'  ");
        
    }

    public function xAlumno($datos){

        $this->db->exec("DELETE FROM alumnos  where id = '$datos[0]'  ");
            
    }

}

?>