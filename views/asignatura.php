<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/grupo_model.php';
require_once '../models/profesor_model.php';
require_once '../models/horario_model.php';

$per=new Grupo_model();
$grupo = $per->get_grupo();

$per=new Profesor_model();
$profe = $per->get_profesor();


$per=new Horario_model();
$horario = $per->get_horario();

?>


<p class="lead" style="margin-top: 0px" >Asignaturas </p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar Asignatura
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">


          <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
                  <label>Nombre de la Asignatura</label>
                  <input type="text" class="form-control" id="asignatura" name="asignatura" placeholder="Nombre" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
  >
              </div>
            </div>



            <div class="col-sm-3">
                <div class="form-group">
             <label>Grupo</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected>Seleccione el Grupo</option>
                        <?php
                        foreach($grupo as $grupos){ 
                        echo "<option value='".$grupos['id']."'>Grupo: ".$grupos['Grupo']." ".$grupos['Turno']." ".$grupos['Ciclo']."</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
            </div>
            


            <div class="col-sm-2.5">
                <div class="form-group">
             <label>Profesor</label>
                <div class="mb-3">
                    <select class="form-select" name="profesor" id="profesor">
                        <option selected>Seleccione el Profesor</option>
                        <?php
                        foreach($profe as $profesor){ 
                        echo "<option value='".$profesor['id']."'>".$profesor['Nombre']." ".$profesor['Apellido']."</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
            </div>




            <div class="col-sm-2">
                <div class="form-group">
             <label>Horario</label>
                <div class="mb-3">
                    <select class="form-select" name="horario" id="horario">
                        <option selected>Seleccione la hora</option>
                        <?php
                        foreach($horario as $horarios){ 
                        echo "<option value='".$horarios['id']."'>".$horarios['horario']."</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
            </div>



            <div class="col-sm-2">
                <div class="form-group">
             <label>Día</label>
                <div class="mb-3">
                    <select class="form-select" name="dia" id="dia">
                        <option selected>Seleccione el día</option>
                        <option value="Lunes">Lunes</option>";
                        <option value="Martes">Martes</option>";
                        <option value="Miercoles">Miercoles</option>";
                        <option value="Jueves">Jueves</option>";
                        <option value="Viernes">Viernes</option>";
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
             $table->asignatura("SELECT A.id,G.id as Grup, H.id as Hora,P.id as Profe,   A.Asignatura, CONCAT(G.Grupo,' ',G.Turno,' ',G.Ciclo) as Grupo,
             A.Dia, H.horario, concat(P.Nombre,' ',P.Apellido) as Profesor 
             FROM asignatura as A
             inner join horario as H on H.id = A.Hora
             inner join profesor as P on P.id = A.idprofesor
             inner join grupo as G on G.id = A.idgrupo",1,3);
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
                var hora  = $('#'+id).children('td[data-target=Hora]').text();
                var profe  = $('#'+id).children('td[data-target=Profe]').text();
                var dia  = $('#'+id).children('td[data-target=Dia]').text();
           
                var opc = 1;

                $('#ID').val(id);
                $('#asignatura').val(asignatura);               
                $('#opc').val(opc);

                $('#grupo > option[value="'+grupo+'"]').attr('selected', 'selected');
                $('#horario > option[value="'+hora+'"]').attr('selected', 'selected');
                $('#profesor > option[value="'+profe+'"]').attr('selected', 'selected');
                $('#dia > option[value="'+dia+'"]').attr('selected', 'selected');


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