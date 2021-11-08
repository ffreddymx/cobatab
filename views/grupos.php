<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/grupo_model.php';
require_once '../models/grado_model.php';

$grup=new grupo_model();
$grupo = $grup->get_grupounique();

$grad=new grado_model();
$grado = $grad->get_gradounique();

$gradox = (isset($_POST['grado'])) ? $_POST['grado'] : '';
$grupox = (isset($_POST['grupo'])) ? $_POST['grupo'] : '';
$ciclox = (isset($_POST['ciclo'])) ? $_POST['ciclo'] : '';
$turno = $_GET['turno'];

?>

<p class="lead" style="margin-top: 0px" >Alumnos Inscritos en el Turno Matutino</p> <hr class="my-1" >

      <div class="card card-body">
          <div class="row">
          <div class="col-sm-2">
                <div class="form-group">
                <form id="formBuscar" action="" method="POST" >
                  <input type="hidden" name="opc" id="opc" value="0">
  
                  <label>Grupo</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected disabled> Selecciones el Grupo</option>
                        <?php
                        foreach($grupo as $grupos){ 
                        echo "<option value='".$grupos['Grupo']."'>".$grupos['Grupo']."</option>";
                        }
                        ?>
                    </select>
                </div>

              </div>
            </div>

            <div class="col-sm-2">
             <div class="form-group">
              <label>Grado</label>
                <div class="mb-3">
                    <select class="form-select" name="grado" id="grado">
                        <option selected disabled>Seleccione el Grado</option>
                        <?php
                        foreach($grado as $grados){ 
                        echo "<option value='".$grados['grado']."'>".$grados['grado']."</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
            </div>
            
            <div class="col-sm-2">
                <div class="form-group">
             <label>Ciclo</label>
                <div class="mb-3">
                    <select class="form-select" name="ciclo" id="ciclo">
                        <option selected disabled>Seleccione el ciclo</option>
                        <option value="2019-2022">2019-2022</option>
                        <option value="2022-2025">2022-2025</option>
                    </select>
                </div>
                </div>
            </div>


      <div class="col-sm-3">
            <div class="form-group">
          <input type="hidden" name="ID" id="ID" >
          <input style="margin-top: 25px;"  type="submit"  class="btn btn-info" name="buscarNombre" id="button-addon2" value="Mostrar los alumnos">
          <?php
          echo '<a href="../pdf/alumnos_pdf.php?turno='.$turno.'&grado='.$gradox.'&grupo='.$grupox.'&ciclo='.$ciclox.'" style="margin-top: 25px;" class="btn btn-danger">Imprimir</a>';
          ?>
           </form>
       </div>
     </div>
</div></div></div>


<div class="collapse" id="collapselumno" style="margin-bottom: 10px; margin-top: 10px;">
  <div class="card card-body ">
  <form id="formXAlumno" >
<div class="alert alert-danger" role="alert">
  Confirme si desea eliminar la Calificación ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar Calificación</span>
         <a data-toggle="collapse" href="#collapselumno"  class="btn btn-success">Cancelar</a>

  </form>
</div>
</div>

            <?php
            $table = new tablacuerpo();
            $turno = $_GET['turno'];
            if(isset($_POST['buscarNombre']) && (!empty($_POST['grado']) || !empty($_POST['grupo']) || !empty($_POST['ciclo']))  ){ //check if form was submitted

              $grado = (isset($_POST['grado'])) ? $_POST['grado'] : '';
              $grupo = (isset($_POST['grupo'])) ? $_POST['grupo'] : '';
              $ciclo = (isset($_POST['ciclo'])) ? $_POST['ciclo'] : '';

                  if(!empty($_POST['grado']) && !empty($_POST['grupo']) && !empty($_POST['ciclo'])) { 

                  $table->inscribir("SELECT I.id, Nombre,Apellido,Matricula, GG.grado as Grado,G.Grupo,G.Turno, G.Ciclo	
                  FROM `inscrito` as I 
                  INNER JOIN alumnos as A on I.idalumno = A.id
                  INNER JOIN grupo as G on I.idgrupo = G.id
                  INNER JOIN grado as GG on GG.idgrupo = G.id
                  WHERE G.Turno = '$turno' and G.Grupo = '$grupo' and Grado='$grado' and G.Ciclo = '$ciclo' " ,1,0);
                  }
                  else { 
                  $table->inscribir("SELECT I.id, Nombre,Apellido,Matricula, GG.grado as Grado,G.Grupo,G.Turno, G.Ciclo	
                  FROM `inscrito` as I 
                  INNER JOIN alumnos as A on I.idalumno = A.id
                  INNER JOIN grupo as G on I.idgrupo = G.id
                  INNER JOIN grado as GG on GG.idgrupo = G.id
                  WHERE G.Turno = '$turno' and (G.Grupo = '$grupo' or Grado='$grado' or G.Ciclo = '$ciclo') " ,1,0);
                  }

            }  
            else { 
             $table->inscribir("SELECT I.id, Nombre,Apellido,Matricula, GG.grado as Grado,G.Grupo,G.Turno, G.Ciclo	
             FROM `inscrito` as I 
             INNER JOIN alumnos as A on I.idalumno = A.id
             INNER JOIN grupo as G on I.idgrupo = G.id
             INNER JOIN grado as GG on GG.idgrupo = G.id
             WHERE G.Turno = '$turno' ",1,0);
            }

             ?>


 <?php include 'footer.php'; ?>


      <script>
      $(document).ready(function(){

      
       $('#saveAlumno').click(function(){
          datos=$('#formAlumno').serialize();
         var opc  = document.getElementById("opc").value;

         if(opc == 0) { 
            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/inscribir/save.php",
              success:function(data){
                  window.location="../views/inscribir.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/inscribir/update.php",
              success:function(data){
                  window.location="../views/inscribir.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');        
                var opc = 0;

                $('#ID').val(id);
                //$('#asignatura').val(asignatura);               
                $('#opc').val(opc);
                $('#alumno > option[value="'+id+'"]').attr('selected', 'selected');

          });


          $(document).on('click','a[data-role=xAlumno]',function(){
                var id  = $(this).data('id');
                $('#IDx').val(id);

          });


          $('#xAlumno').click(function(){
            datos=$('#formXAlumno').serialize();
              $.ajax({
                type:"POST",
                data:datos,
                url:"../controllers/inscribir/delete.php",
                success:function(data){
                    window.location="../views/inscribir.php";
                  }
              }); 
          });

    });
</script>