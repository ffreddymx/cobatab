<?php

class Asignatura_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_asignatura(){
        $consulta=$this->db->query("SELECT * from asignatura");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }

    public function get_asignaturaunique(){
        $consulta=$this->db->query("SELECT DISTINCT Asignatura from asignatura");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }

    public function saveAsignatura($datos){

        $this->db->exec("INSERT INTO asignatura(Asignatura,idgrupo) values('$datos[0]','$datos[1]')");
    
    }

    public function updateAsignatura($datos){

        $this->db->exec("UPDATE asignatura set Asignatura='$datos[0]',idgrupo='$datos[1]' where id = '$datos[2]'  ");
        
    }

    public function xAsignatura($datos){

        $this->db->exec("DELETE FROM asignatura  where id = '$datos[0]'  ");
            
    }

}

?>