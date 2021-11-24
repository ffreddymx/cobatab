<?php

class Horario_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_horario(){
        $consulta=$this->db->query("SELECT * from horario");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


}

?>