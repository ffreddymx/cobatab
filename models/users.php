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
		if($sql->rowCount() > 0){
			return 1;
		}else{
			return 0;
		}
	}

    public function saveUser($datos){
		$this->db->exec("INSERT INTO user(usuario,password,Tipo,idprofesor,idalumno) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]')");
		}

		public function xUser($datos){

			$this->db->exec("DELETE FROM user  where id = '$datos[0]'  ");
				
		}

}



 ?>