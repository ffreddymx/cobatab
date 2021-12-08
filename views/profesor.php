<?php
session_start();
require_once '../db/db.php'; //conexion
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
?>


<p class="lead" style="margin-top: 0px" >Lista de Profesor</p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar profesor
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
                  <label>Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
  >
              </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                                    <label>Apellido</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
 placeholder="Apellidos"  >
              </div>
            </div>


              <div class="col-sm-3">
                <div class="form-group">
                  <label>Tel Movil</label>
                  <input type="text" class="form-control" id="movil" name="movil" placeholder="Numero Movil" maxlength="10" pattern="^[0-9]+"  >
              </div>
            </div>


                <div class="col-sm-3">
                <div class="form-group">
                  <label>Email personal</label>
                  <input type="text" class="form-control" id="email" name="email" maxlength="40"
 placeholder="Email personal"   >
              </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                  <label>Email escolar</label>
                  <input type="text" class="form-control" id="profesion" name="profesion" maxlength="40"
 placeholder="Email escolar"   >
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


<div class="collapse" id="xAlumno" style="margin-bottom: 10px; margin-top: 10px;">
  <div class="card card-body ">
  <form id="formXAlumno" >
<div class="alert alert-danger" role="alert">
  Confirme si desea eliminar al profesor ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar Alumno</span>
         <a   data-toggle="collapse" href="#xAlumno" class="btn btn-success">Cancelar</a>
  </form>
  </div>
</div>



            <?php
            $table = new tablacuerpo();
             $table->alumnos("SELECT id, Nombre, Apellido, Email as EmailPersonal,Movil,Profesion as EmailEscolar FROM profesor order by Nombre",1);
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
              url:"../controllers/profesor/save.php",
              success:function(data){
                  window.location="../views/profesor.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/profesor/update.php",
              success:function(data){
                  window.location="../views/profesor.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var nombre  = $('#'+id).children('td[data-target=Nombre]').text();
                var apellido  = $('#'+id).children('td[data-target=Apellido]').text();
                var emailp  = $('#'+id).children('td[data-target=EmailPersonal]').text();
                var matricula  = $('#'+id).children('td[data-target=Matricula]').text();
                var movil  = $('#'+id).children('td[data-target=Movil]').text();
                var emaile  = $('#'+id).children('td[data-target=EmailEscolar]').text();
                var opc = 1;

                $('#ID').val(id);
                $('#nombre').val(nombre);
                $('#apellido').val(apellido);
                $('#email').val(emailp);                   
                $('#matricula').val(matricula);
                $('#movil').val(movil);
                $('#profesion').val(emaile);
                $('#opc').val(opc);
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
                url:"../controllers/profesor/delete.php",
                success:function(data){
                    window.location="../views/profesor.php";
                  }
              }); 
          });

    });
</script>
