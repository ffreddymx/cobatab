<?php

class Nota_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_nota(){
        $consulta=$this->db->query("SELECT * from notas");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
    }


    public function saveNota($datos){

        $this->db->exec("INSERT INTO notas(idasignatura,idalumno,Nota1,Nota2,Nota3,Aprobado) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$datos[5]')");
    
    }

    public function updateNota($datos){

        $this->db->exec("UPDATE notas set Nota1='$datos[0]',Nota2='$datos[1]',Nota3='$datos[2]',Aprobado='$datos[3]' where id = '$datos[4]'  ");
        
    }

    public function xNota($datos){

        $this->db->exec("DELETE FROM notas  where id = '$datos[0]'  ");
            
    }

}

?>