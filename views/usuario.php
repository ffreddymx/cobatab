<?php
session_start();
require_once '../db/db.php';
require_once "../tablasUniver/cuerpo.php";
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/profesor_model.php';
require_once '../models/personas_model.php';

$per=new Profesor_model();
$profe = $per->get_profesor();

$per=new personas_model();
$alumno = $per->get_alumnos();

?>


<p class="lead" style="margin-top: 0px" >Lista de Usuarios</p> <hr class="my-1" >
    <div  align="left" style="margin-bottom: 5px; margin-top: 0px;">
      <a  class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    Agregar Usuario
   </a>
    </div>

    <div class="collapse" id="collapseExample" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno" >
                  <input type="hidden" name="opc" id="opc" value="0">
                  <label>Usuario</label>
                  <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
  >
              </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                                    <label>Contraseña</label>
                  <input type="text" class="form-control" id="password" name="password" maxlength="30" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+"
 placeholder="Contraseña"  >
              </div>
            </div>


            <div class="col-sm-2">
                <div class="form-group">
             <label>Tipo</label>
                <div class="mb-3">
                    <select class="form-select" name="tipo" id="tipo">
                        <option selected>Seleccione el tipo</option>
                        <option value="Profesor">Profesor</option>";
                        <option value="Alumno">Alumno</option>";
                    </select>
                </div>
                </div>
            </div>


            <div class="col-sm-3">
                <div class="form-group">
             <label>Profesor</label>
                <div class="mb-3">
                    <select class="form-select" name="profesor" id="profesor">
                        <option value='0'  selected>Seleccione el Profesor</option>
                        <?php
                        foreach($profe as $profesor){ 
                        echo "<option value='".$profesor['id']."'>".$profesor['Nombre']." ".$profesor['Apellido']."</option>";
                        }
                        ?>
                    </select>
                </div>
                </div>
            </div>      


            <div class="col-sm-2.5">
                <div class="form-group">
             <label>Alumno</label>
                <div class="mb-3">
                    <select class="form-select" name="alumno" id="alumno">
                        <option value='0'  selected>Seleccione el Alumno</option>
                        <?php
                        foreach($alumno as $alumnos){ 
                        echo "<option value='".$alumnos['id']."'>".$alumnos['Nombre']." ".$alumnos['Apellido']."</option>";
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


<div class="collapse" id="xAlumno" style="margin-bottom: 10px; margin-top: 10px;">
  <div class="card card-body ">
  <form id="formXAlumno" >
<div class="alert alert-danger" role="alert">
  Confirme si desea eliminar el Usuario ?
  <input type="hidden" name="IDx" id="IDx" class="form-control">
</div>
         <span id="xAlumno" data-toggle="collapse"  class="btn btn-danger">Eliminar el usuario</span>
         <a   data-toggle="collapse" href="#xAlumno" class="btn btn-success">Cancelar</a>


  </form>
  </div>
</div>


            <?php
            $table = new tablacuerpo();
             $table->usuarios("SELECT U.id, U.usuario, concat(P.Nombre,' ',P.Apellido) as Usuarios, U.Tipo
                  FROM user as U
                    inner join profesor as P on P.id = U.idprofesor
                    UNION
                    SELECT U.id, U.usuario, concat(A.Nombre,' ',A.Apellido) as Usuarios,U.Tipo
                    FROM user as U
                      inner join alumnos as A on A.id = U.idalumno ",1);
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
              url:"../controllers/user/save.php",
              success:function(data){
                  window.location="../views/usuario.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/update_alumno.php",
              success:function(data){
                  window.location="../views/alumnos.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var nombre  = $('#'+id).children('td[data-target=Nombre]').text();
                var apellido  = $('#'+id).children('td[data-target=Apellido]').text();
                var direccion  = $('#'+id).children('td[data-target=Direccion]').text();
                var matricula  = $('#'+id).children('td[data-target=Matricula]').text();
                var tutor  = $('#'+id).children('td[data-target=Tutor]').text();
                var opc = 1;

                $('#ID').val(id);
                $('#nombre').val(nombre);
                $('#apellido').val(apellido);
                $('#direccion').val(direccion);                   
                $('#matricula').val(matricula);
                $('#tutor').val(tutor);
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
                url:"../controllers/user/delete.php",
                success:function(data){
                    window.location="../views/usuario.php";
                  }
              }); 
          });

    });
</script>

