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
		foreach($sql as $data) {
			$_SESSION['nivel']=$data['Nivel'];
			$_SESSION['user']=$data['usuario'];
			$_SESSION['idalu']=$data['idalumno'];
			}

			$sql2=$this->db->query("SELECT Matricula from alumnos where id='".$_SESSION['idalu']."'");
			foreach($sql2 as $data) {
				$_SESSION['matricula']=$data['Matricula'];
				}


		if($sql->rowCount() > 0){
			return 1;
			
		}else{
			return 0;
		}
	}

    public function saveUser($datos){
		
		$nivel = ($dato[2] == 'Profesor') ? '2' : '3';

		$this->db->exec("INSERT INTO user(usuario,password,Tipo,idprofesor,idalumno,Nivel) values('$datos[0]','$datos[1]','$datos[2]','$datos[3]','$datos[4]','$nivel')");
		}

		public function xUser($datos){

			$this->db->exec("DELETE FROM user  where id = '$datos[0]'  ");
				
		}

}



 ?>