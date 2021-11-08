<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
?>

<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
    Configuraciones
  </a>
  <a href="grupo.php" class="list-group-item list-group-item-action">Grupo</a>
  <a href="grado.php" class="list-group-item list-group-item-action">Grado</a>
  <a href="asignatura.php" class="list-group-item list-group-item-action">Asignaturas</a>
  <a href="nota.php" class="list-group-item list-group-item-action">Calificaciones</a>
  <a href="inscribir.php" class="list-group-item list-group-item-action">Inscripciones / Reinscripción</a>
</div>


<?php include 'footer.php'; ?>
