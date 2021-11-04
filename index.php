<?php
//require_once("db/db.php");//la conexion
//require_once("controllers/personas_controller.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>COBATAB</title>

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="librerias/login.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="row">
    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box">
                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">COBATAB</label> 
                	<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
                    <div class="login-space">
					<form id="frmLogin">
                        <div class="login">
                            <div class="group"> <label for="user" class="label">Usuario</label> 
                            	<input id="user" name="user" type="text" class="input" placeholder="Ingrese su usuario"> </div>
                            <div class="group"> <label for="pass" class="label">Password</label> 
                            	<input id="pass" name="pass" type="password" class="input" data-type="password" placeholder="Ingrese su password"> </div>
                            <div class="group"> 
       							<span class="btn btn-primary btn-sm" id="entrarSistema">Iniciar Sesión</span>

                            <div class="hr"></div>
                        </div>
					</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


<script type="text/javascript">
	$(document).ready(function(){


		$('#entrarSistema').click(function(){
/*		vacios=validarFormVacio('frmLogin');

			if(vacios > 0){
				alert("Debes llenar todos los campos!!");
				return false;
			}
*/
	datos=$('#frmLogin').serialize();

		$.ajax({
			type:"POST",
			data:datos,
			url:"controllers/login.php",
			success:function(r){

				if(r==1){
					window.location="views/inicio.php";
				}else{
					alert("No se pudo acceder :(");
				}
			}
		});
	   });




	});


</script>