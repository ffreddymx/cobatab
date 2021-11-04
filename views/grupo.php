<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
?>


<p class="lead" style="margin-top: 0px" >Grupos</p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar Grupos 
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
                  <label>Grupo</label>
                  <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Grupo" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
  >
              </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">

             <label>Turno</label>
                <div class="mb-3">
                    <select class="form-select" name="turno" id="turno">
                        <option selected>Seleccione el turno</option>
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                    </select>
                </div>

                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
             <label>Ciclo</label>
                <div class="mb-3">
                    <select class="form-select" name="ciclo" id="ciclo">
                        <option selected>Seleccione el ciclo</option>
                        <option value="2019-2022">2019-2022</option>
                        <option value="2022-2025">2022-2025</option>
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
  Confirme si desea eliminar el Grupo ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar Grupo</span>
         <a data-toggle="collapse" href="#collapselumno"  class="btn btn-success">Cancelar</a>

  </form>

</div>
</div>



            <?php
            $table = new tablacuerpo();
             $table->grupo("SELECT * FROM grupo ",1);
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
              url:"../controllers/grupo/save.php",
              success:function(data){
                  window.location="../views/grupo.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/grupo/update.php",
              success:function(data){
                  window.location="../views/grupo.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var grupo  = $('#'+id).children('td[data-target=Grupo]').text();
                var turno  = $('#'+id).children('td[data-target=Turno]').text();
                var ciclo  = $('#'+id).children('td[data-target=Ciclo]').text();
           
                var opc = 1;

                $('#ID').val(id);
                $('#grupo').val(grupo);               
                $('#opc').val(opc);

                $('#turno > option[value="'+turno+'"]').attr('selected', 'selected');
                $('#ciclo > option[value="'+ciclo+'"]').attr('selected', 'selected');

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
                url:"../controllers/grupo/delete.php",
                success:function(data){
                    window.location="../views/grupo.php";
                  }
              }); 
          });

    });
</script>