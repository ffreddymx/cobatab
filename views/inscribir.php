<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/personas_model.php';
require_once '../models/inscribir_model.php';

$per=new personas_model();
$alumno = $per->get_alumnos();

$inscri=new inscribir_model();
$grupo = $inscri->get_gg();


?>


<p class="lead" style="margin-top: 0px" >Realizar Inscripción / Preinscripción </p> <hr class="my-1" >
 
<form id="formBuscar" action="" method="POST" >
<div class="input-group mb-3">
  <input type="text" class="form-control" name="Balumno"  placeholder="Nombre del alumno o Matrícula" aria-label="Recipient's username" aria-describedby="button-addon2">
  <input type="submit"  class="btn btn-secondary" name="buscarNombre" id="button-addon2" value="Buscar">
</div>
</form>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">


          <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
  
              <label>Alumnos</label>
                <div class="mb-3">
                    <select class="form-select" name="alumno" id="alumno" >
                        <?php
                        foreach($alumno as $alumnos){ 
                        echo "<option  value='".$alumnos['id']."'>".$alumnos['Matricula']." ".$alumnos['Nombre']." ".$alumnos['Apellido']."</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
            </div>

 

            <div class="col-sm-3">
             <div class="form-group">
              <label>Grupo y Grado</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected>Seleccione el Grupo/Grado</option>
                        <?php
                        foreach($grupo as $grupos){ 
                        echo "<option value='".$grupos['id']."'>".$grupos['Grupo']."</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
            </div>
            

        
            
      <div class="col-sm-3">
            <div class="form-group">
          <input type="hidden" name="ID" id="ID" >
         <span  class="btn btn-info" data-toggle="collapse" href="#collapseExample" id="saveAlumno">Guardar</span>
         <a data-toggle="collapse" href="#collapseExample" class="btn btn-danger">Cancelar</a>
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
            $alumno = "";
            if(isset($_POST['buscarNombre'])){ //check if form was submitted
              $alumno = $_POST['Balumno']; //get input text
              $table->inscribir("SELECT * FROM alumnos where Nombre like '$alumno' or Matricula = '$alumno' or '$alumno'=''  " ,1,0);

            }  
            else { 
             $table->inscribir("SELECT * FROM alumnos",1,0);
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