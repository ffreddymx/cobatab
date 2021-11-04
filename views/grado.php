<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/grupo_model.php';
require_once '../models/profesor_model.php';

$per=new Grupo_model();
$grupo = $per->get_grupo();

$per=new Profesor_model();
$profe = $per->get_profesor();


?>


<p class="lead" style="margin-top: 0px" >Asignar grado y grupo al Profesor</p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Asignar Grado y Grupo
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">

                  <label>Grado</label>
                <div class="mb-3">
                    <select class="form-select" name="grado" id="grado">
                        <option selected>Seleccione el grado</option>
                        <option value="1ro">1ro</option>
                        <option value="2do">2do</option>
                        <option value="3ro">3ro</option>
                        <option value="4to">4to</option>
                        <option value="5to">5to</option>
                        <option value="6to">6to</option>
                    </select>
              </div>
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
            
            
            <div class="col-sm-3">
                <div class="form-group">
             <label>Profesor</label>
                <div class="mb-3">
                    <select class="form-select" name="profesor" id="profesor">
                        <option selected>Seleccione al profesor</option>
                        <?php
                        foreach($profe as $profesor){ 
                        echo "<option value='".$profesor['id']."'>".$profesor['Nombre']." ".$profesor['Apellido']."</option>";
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
  Confirme si desea eliminar el Grado asignado al Profesor ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar Grupo</span>
         <a data-toggle="collapse" href="#collapselumno"  class="btn btn-success">Cancelar</a>

  </form>

</div>
</div>

            <?php
            $table = new tablacuerpo();
             $table->grado("SELECT G.id,P.id as Prof,gru.id as Gru,grado as Grado, CONCAT(gru.Grupo,' ',gru.Turno,' ',gru.Ciclo) as Grupo, CONCAT(P.Nombre,' ',P.Apellido) as Profesor 
             FROM grado as G
             inner join grupo as gru on G.idgrupo=gru.id
             inner join profesor as P on G.idprofesor = P.id",1,2);
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
              url:"../controllers/grado/save.php",
              success:function(data){
                  window.location="../views/grado.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/grado/update.php",
              success:function(data){
                  window.location="../views/grado.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var grado  = $('#'+id).children('td[data-target=Grado]').text();
                var grupo  = $('#'+id).children('td[data-target=Gru]').text();
                var profesor  = $('#'+id).children('td[data-target=Prof]').text();
           
                var opc = 1;

                $('#ID').val(id);
                $('#grupo').val(grupo);               
                $('#opc').val(opc);

                $('#grado > option[value="'+grado+'"]').attr('selected', 'selected');
                $('#grupo > option[value="'+grupo+'"]').attr('selected', 'selected');
                $('#profesor > option[value="'+profesor+'"]').attr('selected', 'selected');

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
                url:"../controllers/grado/delete.php",
                success:function(data){
                    window.location="../views/grado.php";
                  }
              }); 
          });

    });
</script>