<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
?>


<p class="lead" style="margin-top: 0px" >Lista de Alumnos</p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar alumno
   </a>
    </div>



    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="1">
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
                  <label>Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" maxlength="250" 
 placeholder="Dirección"  >
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
                  <label>Email</label>
                  <input type="text" class="form-control" id="email" name="email" maxlength="40"
 placeholder="Correo electronico"   >
              </div>
            </div>


                <div class="col-sm-3">
                <div class="form-group">
                  <label>Matrícula</label>
                  <input type="text" class="form-control" id="matricula" name="matricula" maxlength="40"
 placeholder="Matrícula"   >
              </div>
            </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Tutor</label>
                  <input type="text" class="form-control" id="tutor" name="tutor" maxlength="40"
 placeholder="tutor"   >
              </div>
            </div>


      <div class="col-sm-3">
            <div class="form-group">
          <input type="hidden" name="ID" id="ID" >
         <span  class="btn btn-info" id="saveAlumno">Guardar</span>
         <a data-toggle="collapse" href="#collapseExample" class="btn btn-danger">Cancelar</a>
           </form>
       </div>
     </div>
</div></div></div>





<div class="collapse" id="xAlumno" style="margin-bottom: 10px; margin-top: 10px;">
  <div class="card card-body ">
  <form action="nuevo_objeto.php" method="post" >
    <input type="hidden" name="opc" value="4">
<div class="alert alert-danger" role="alert">
  Confirme si desea eliminar el Emprendedor ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <button id="xAlumno" type="submit" class="btn btn-danger">Eliminar emprendedor</button>
         <a   data-toggle="collapse" href="#xAlumno" class="btn btn-success">Cancelar</a>
  </form>
  </div>
</div>



            <?php
            $table = new tablacuerpo();

            echo "<table class='table table-sm table-hover'  >";//iniciamos la tabla
             $table->alumnos("SELECT * FROM alumnos order by Nombre",1);
             ?>
            </tbody>
            </table>

 <?php include 'footer.php'; ?>

      <script>
      $(document).ready(function(){

      
       $('#saveAlumno').click(function(){
        // salvar los datos del alumno
          datos=$('#formAlumno').serialize();
            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/save_alumno.php",
              success:function(data){
                  window.location="../views/alumnos.php";
                 }
            });
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var nombre  = $('#'+id).children('td[data-target=Nombre]').text();
                var apellido  = $('#'+id).children('td[data-target=Apellido]').text();
                var direccion  = $('#'+id).children('td[data-target=Direccion]').text();
                var movil  = $('#'+id).children('td[data-target=Movil]').text();
                var mail  = $('#'+id).children('td[data-target=Mail]').text();
                var opc = 3;

                $('#ID').val(id);
                $('#nombre').val(nombre);
                $('#apellido').val(apellido);
                $('#direccion').val(direccion);                   
                $('#movil').val(movil);
                $('#email').val(mail);
                $('#opc').val(opc);
          });

          $(document).on('click','a[data-role=xAlumno]',function(){
                var id  = $(this).data('id');
                $('#IDx').val(id);

          });

    });
</script>

