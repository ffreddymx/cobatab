<?php 

class User{

    private $db;

    public function __construct(){
        $this->db=Conectar::conexion();
       // $this->personas=array();
    }


	public function loginUser($datos){

		$password=$datos[1];

		$_SESSION['usuario']=$datos[0];
		//$_SESSION['iduser']=self::traeID($datos);

		$sql=$this->db->query("SELECT * from user where usuario='$datos[0]' and password='$password'");
		if($sql->num_rows > 0){
			return 1;
		}else{
			return 0;
		}
	}


}



 ?>