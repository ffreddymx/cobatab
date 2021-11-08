<?php

class Grado_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_grado(){
        $consulta=$this->db->query("SELECT * from grado");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function get_gradounique(){
        $consulta=$this->db->query("SELECT DISTINCT grado from grado");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }



    public function saveGrado($datos){

        $this->db->exec("INSERT INTO grado(grado,idgrupo,idprofesor) values('$datos[0]','$datos[1]','$datos[2]')");
    
    }

    public function updateGrado($datos){

        $this->db->exec("UPDATE grado set grado='$datos[0]',idgrupo='$datos[1]',idprofesor='$datos[2]' where id = '$datos[3]'  ");
        
    }

    public function xGrado($datos){

        $this->db->exec("DELETE FROM grado  where id = '$datos[0]'  ");
            
    }

}

?>