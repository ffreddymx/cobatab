<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/asignatura_model.php';
require_once '../models/personas_model.php';

$per=new Asignatura_model();
$asignatura = $per->get_asignatura();

$per=new personas_model();
$alumno = $per->get_alumnos();


?>


<p class="lead" style="margin-top: 0px" >Calificaciones </p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar Calificación
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">


          <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
  
            <label>Asignatura</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected>Seleccione la Asignatura</option>
                        <?php
                        foreach($asignatura as $asignaturas){ 
                        echo "<option value='".$asignaturas['id']."'>".$asignaturas['Asignatura']."</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
            </div>



            <div class="col-sm-3">
             <div class="form-group">
              <label>Alumnos</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected>Seleccione el Alumno</option>
                        <?php
                        foreach($alumno as $alumnos){ 
                        echo "<option value='".$alumnos['id']."'>".$alumnos['Matricula']." ".$alumnos['Nombre']." ".$alumnos['Apellido']."</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
            </div>
            

            <div class="col-sm-3">
                <div class="form-group">
                  <label>Nota 1</label>
                  <input type="text" class="form-control" id="nota1" name="nota1" placeholder="Nota 1" pattern=""  >
              </div>
            </div>

                    
            <div class="col-sm-3">
                <div class="form-group">
                  <label>Nota 2</label>
                  <input type="text" class="form-control" id="nota2" name="nota2" placeholder="Nota 2" pattern=""  >
              </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
                  <label>Nota 3</label>
                  <input type="text" class="form-control" id="nota3" name="nota3" placeholder="Nota 3" pattern=""  >
              </div>
            </div>



<div class="col-sm-3">
             <div class="form-group">
              <label>Aprobado ?</label>
                <div class="mb-3">
                <select class="form-select" name="aprobado" id="aprobado">
                  <option selected>El alumno esta aprobado ?</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
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
  Confirme si desea eliminar la Asignatura ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar Asignatura</span>
         <a data-toggle="collapse" href="#collapselumno"  class="btn btn-success">Cancelar</a>

  </form>

</div>
</div>

            <?php
            $table = new tablacuerpo();
             $table->notas("SELECT N.id, Asignatura, CONCAT(AA.Nombre,' ',AA.Apellido) as Alumno, Nota1,Nota2,Nota3,Promedio, Aprobado
                            from notas as N 
                            inner join asignatura as A on N.idasignatura=A.id
                            inner join alumnos as AA on AA.id = N.idalumno",1,0);
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
              url:"../controllers/asignatura/save.php",
              success:function(data){
                  window.location="../views/asignatura.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/asignatura/update.php",
              success:function(data){
                  window.location="../views/asignatura.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var asignatura  = $('#'+id).children('td[data-target=Asignatura]').text();
                var grupo  = $('#'+id).children('td[data-target=Grup]').text();
           
                var opc = 1;

                $('#ID').val(id);
                $('#asignatura').val(asignatura);               
                $('#opc').val(opc);

                $('#grupo > option[value="'+grupo+'"]').attr('selected', 'selected');


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
                url:"../controllers/asignatura/delete.php",
                success:function(data){
                    window.location="../views/asignatura.php";
                  }
              }); 
          });

    });
</script>