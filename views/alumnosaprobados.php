<?php
error_reporting(0);
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


<p class="lead" style="margin-top: 0px; background:#DAF7A6;" ><b>Asignaturas Aprobadas</b></p> <hr class="my-1" >

      <form id="formBuscar" action="" method="POST"  >
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="Balumno"   placeholder="Nombre del alumno o Matrícula" aria-label="Recipient's username" aria-describedby="button-addon2">
        <input type="submit"  class="btn btn-info" name="buscarNombre" id="button-addon2" value="Buscar Alumno">
        <?php
          echo '<a href="../pdf/aprobados_pdf.php" class="btn btn-danger">Imprimir</a>';
          ?>
      </div>
  </form>

       


            <?php
              $table = new tablacuerpo();

            $alumno = "";
            if( $_SESSION['nivel'] == 1 or $_SESSION['nivel'] == 2 ){ 

            if(isset($_POST['buscarNombre'])){ //check if form was submitted
              $alumno = (isset($_POST['Balumno'])) ? $_POST['Balumno'] : '';
              if(isset($_POST['buscarNombre'])) { 

             $table->irregulares("SELECT DISTINCT N.id,A.id as Asi,AA.id as Alu, Asignatura, AA.Matricula, CONCAT(AA.Nombre,' ',AA.Apellido) as Alumno, GG.Grado,G.Grupo,Nota1,Nota2,Nota3,FORMAT(((Nota1+Nota2+Nota3)/3),2) as Promedio, Aprobado
                            from notas as N 
                            inner join asignatura as A on N.idasignatura=A.id
                            inner join grupo as G on G.id = A.idgrupo
                            inner join Grado as GG on GG.idgrupo = G.id
                            inner join alumnos as AA on AA.id = N.idalumno where N.Aprobado = 'Si' 
                            and (AA.Nombre like '$alumno' or AA.Matricula = '$alumno' or '$alumno'='') ",1,2);
                  }
                  else {
                    $table->irregulares("SELECT DISTINCT N.id,A.id as Asi,AA.id as Alu, Asignatura,AA.Matricula,  CONCAT(AA.Nombre,' ',AA.Apellido) as Alumno, GG.Grado, G.Grupo,Nota1,Nota2,Nota3,FORMAT(((Nota1+Nota2+Nota3)/3),2) as Promedio, Aprobado
                    from notas as N 
                    inner join asignatura as A on N.idasignatura=A.id
                    inner join grupo as G on G.id = A.idgrupo
                    inner join Grado as GG on GG.idgrupo = G.id
                    inner join alumnos as AA on AA.id = N.idalumno 
                    where N.Aprobado = 'Si'",1,2);
                  }

            } else {

              $table->irregulares("SELECT DISTINCT N.id,A.id as Asi,AA.id as Alu, Asignatura,AA.Matricula,  CONCAT(AA.Nombre,' ',AA.Apellido) as Alumno,GG.Grado,G.Grupo, Nota1,Nota2,Nota3,FORMAT(((Nota1+Nota2+Nota3)/3),2) as Promedio, Aprobado
              from notas as N 
              inner join asignatura as A on N.idasignatura=A.id
              inner join grupo as G on G.id = A.idgrupo
              inner join Grado as GG on GG.idgrupo = G.id
              inner join alumnos as AA on AA.id = N.idalumno 
              where N.Aprobado = 'Si'",1,2);

            }
          }else 

            if( $_SESSION['nivel'] == 3){ 
                $mat = $_SESSION['matricula'];
              $table->irregulares("SELECT DISTINCT N.id,A.id as Asi,AA.id as Alu, Asignatura,AA.Matricula,  CONCAT(AA.Nombre,' ',AA.Apellido) as Alumno,GG.Grado,G.Grupo, Nota1,Nota2,Nota3,FORMAT(((Nota1+Nota2+Nota3)/3),2) as Promedio, Aprobado
              from notas as N 
              inner join asignatura as A on N.idasignatura=A.id
              inner join grupo as G on G.id = A.idgrupo
              inner join Grado as GG on GG.idgrupo = G.id
              inner join alumnos as AA on AA.id = N.idalumno 
              where N.Aprobado = 'Si' and AA.Matricula='$mat'  ",1,2);

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
              url:"../controllers/nota/save.php",
              success:function(data){
                  window.location="../views/nota.php";
                 }
            }); 

          }
          else {

            $.ajax({
              type:"POST",
              data:datos,
              url:"../controllers/nota/update.php",
              success:function(data){
                  window.location="../views/nota.php";
                 }
            }); 
             }
          });


          $(document).on('click','a[data-role=updateAlumno]',function(){

                var id  = $(this).data('id');
                var asignatura  = $('#'+id).children('td[data-target=Asi]').text();
                var alumno  = $('#'+id).children('td[data-target=Alu]').text();
                var nota1  = $('#'+id).children('td[data-target=Nota1]').text();
                var nota2  = $('#'+id).children('td[data-target=Nota2]').text();
                var nota3  = $('#'+id).children('td[data-target=Nota3]').text();
                var aprobado  = $('#'+id).children('td[data-target=Aprobado]').text();
           
                var opc = 1;

                $('#ID').val(id);
                //$('#asignatura').val(asignatura);               
                $('#opc').val(opc);
                $('#nota1').val(nota1);
                $('#nota2').val(nota2);
                $('#nota3').val(nota3);

                $('#asignatura > option[value="'+asignatura+'"]').attr('selected', 'selected');
                $('#alumno > option[value="'+alumno+'"]').attr('selected', 'selected');
                $('#aprobado > option[value="'+aprobado+'"]').attr('selected', 'selected');



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
                url:"../controllers/nota/delete.php",
                success:function(data){
                    window.location="../views/nota.php";
                  }
              }); 
          });

    });
</script>