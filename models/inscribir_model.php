<?php

class Inscribir_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_gg(){
        $consulta=$this->db->query("SELECT G.id,CONCAT(GG.grado,' ',G.Grupo,' ',G.Turno,' ',G.Ciclo) AS Grupo 
        FROM grupo as G 
        INNER JOIN grado as GG on GG.idgrupo=G.id
        ORDER by GG.id DESC");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function saveInscribir($datos){

        $this->db->exec("INSERT INTO inscrito(idalumno,idgrupo) values('$datos[0]','$datos[1]')");
    
    }

    public function updateInscribir($datos){

        $this->db->exec("UPDATE inscrito set idalumno='$datos[0]',idgrupo='$datos[1]' where id = '$datos[2]'  ");
        
    }

    public function xInscribir($datos){

        $this->db->exec("DELETE FROM inscrito  where id = '$datos[0]'  ");
            
    }

}

?>