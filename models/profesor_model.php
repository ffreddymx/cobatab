<?php

class Profesor_model{
    private $db;
    private $profesor;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->profesor=array();
    }
    
    public function get_profesor(){
        $consulta=$this->db->query("SELECT * from profesor");
        while($filas=$consulta->fetch()){
            $this->profesor[]=$filas;
        }
        return $this->profesor;
    }


    public function saveProfesor($datos){

        $this->db->exec("INSERT INTO profesor(Nombre,Apellido,Direccion,Movil,Profesion,Email) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')");
    
    }

    public function updateProfesor($datos){

        $this->db->exec("UPDATE profesor set Nombre='$datos[0]',Apellido='$datos[1]',Direccion='$datos[2]',Movil='$datos[3]',Profesion='$datos[4]',Email='$datos[5]' where id = '$datos[6]'  ");
        
    }

    public function xProfesor($datos){

        $this->db->exec("DELETE FROM profesor  where id = '$datos[0]'  ");
            
    }

}

?>