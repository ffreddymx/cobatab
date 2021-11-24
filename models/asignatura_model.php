<?php

class Asignatura_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();
        $this->personas=array();
    }
    
    public function get_asignatura2($dia,$grupo){
        $consulta=$this->db->query("SELECT CONCAT(A.Asignatura,'-',P.Nombre,' ',P.Apellido) as Asignatura,A.Hora, A.Dia
        FROM asignatura as A 
        INNER JOIN grupo as G on A.idgrupo = G.id
        INNER JOIN profesor as P on A.idprofesor = P.id

        WHERE A.Dia = '$dia' and A.idgrupo = $grupo ");
        while($filas=$consulta->fetch()){
            $this->personas[]=$filas;
        }
        return $this->personas;
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

        $this->db->exec("INSERT INTO asignatura(Asignatura,idgrupo,idprofesor,Hora,Dia) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]')");
    
    }

    public function updateAsignatura($datos){

        $this->db->exec("UPDATE asignatura set Asignatura='$datos[0]',idgrupo='$datos[1]',idprofesor='$datos[2]',Hora='$datos[3]',Dia='$datos[4]' where id = '$datos[5]'  ");
        
    }

    public function xAsignatura($datos){

        $this->db->exec("DELETE FROM asignatura  where id = '$datos[0]'  ");
            
    }

}

?>