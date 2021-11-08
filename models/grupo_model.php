<?php

class Grupo_model{
    private $db;
    private $grupo;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->grupo=array();
    }
    
    public function get_grupo(){
        $consulta=$this->db->query("SELECT * from grupo");
        //$resultado = $consulta->fetch();
        while($filas=$consulta->fetch()){
            $this->grupo[]=$filas;
        }
        return $this->grupo;
        //return $resultado;
    }


    public function get_grupounique(){
        $consulta=$this->db->query("SELECT DISTINCT Grupo from grupo");
        //$resultado = $consulta->fetch();
        while($filas=$consulta->fetch()){
            $this->grupo[]=$filas;
        }
        return $this->grupo;
        //return $resultado;
    }


    public function saveGrupo($datos){

        $this->db->exec("INSERT INTO grupo(Grupo,Turno,Ciclo) values('$datos[0]','$datos[1]','$datos[2]')");
    
    }

    public function updateGrupo($datos){

        $this->db->exec("UPDATE grupo set Grupo='$datos[0]',Turno='$datos[1]',Ciclo='$datos[2]' where id = '$datos[3]'  ");
        
    }

    public function xGrupo($datos){

        $this->db->exec("DELETE FROM grupo  where id = '$datos[0]'  ");
            
    }

}

?>