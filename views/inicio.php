<?php 
    session_start();
    if(isset($_SESSION['usuario'])){
        
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>inicio</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php require_once "dependencias.php"; ?>
    <link rel="stylesheet" href="../css/estilos.css">

  <style media="screen">
  body {
  background-image: url(../statics/fondo.jpg);
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  }

h1 { 
    color: #FF0000; 
    margin-top: 5px;
    text-shadow: 2px 2px 2px white;
}

h2 { 
    color: #FF0000; 
    text-shadow: 2px 2px 2px white;
}

p{
    color: black;
    font-size: 25px;
    text-shadow: 2px 2px 2px white;
    font-weight: 700;
}
</style>

</head>
<body>

    <?php require_once "menu.php"; ?>


<div class="card">
    <img class="card-img-top" src="holder.js/100x180/" alt="">
    <div class="card-body">

    <h1>Colegio de Bachilleres de Tabasco Plantel No. 11</h1>

<h2>MISIÓN</h1>
    <p>Formar jóvenes y adultos aptos para el desarrollo laboral y la formación académica superior </p>
<h2>VISIÓN</h1>
    <p>Se lider en la educación media y superior en la entidad y en el país, garantizando el egreso de individuos éticos, competentes y comprometidos con el entorno social y global.</p>
    
    </div>
</div>


    <?php require_once 'footer.php'; ?>

</body  >
</html>
<?php 
    }else{
        header("location:../index.php");
    }
 ?>