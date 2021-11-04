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
             $table->asignatura("SELECT A.id,G.id as Grup,A.Asignatura, CONCAT(G.Grupo,' ',G.Turno,' ',G.Ciclo) as Grupo 
             FROM asignatura as A
             inner join grupo as G on G.id = A.idgrupo",1,1);
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