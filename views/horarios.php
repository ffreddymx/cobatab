<?php
error_reporting(0);
session_start();
require_once '../db/db.php';
require_once 'dependencias.php';//parte del codigo html principal
require_once '../models/grupo_model.php';
require_once '../models/asignatura_model.php';
require_once '../models/horario_model.php';

$per=new Grupo_model();
$grupo = $per->get_grupo();

$hor = new Horario_model();
$horario = $hor->get_horario();
$horas = array();

foreach($horario as $hora){
    $horas[] = $hora["horario"]; 
}

$gru = $_POST["grupo"];

?>


<p class="lead" style="margin-top: 0px" >HORARIOS DE CLASES </p> <hr class="my-1" >
  
    <div class="" id="" style="margin-bottom: 0px; margin-top: 0px;">
      <div class="card card-body">
          <div class="row">

            <div class="col-sm-3">
                <div class="form-group">
                <form id="formAlumno"  action="horarios.php" method="POST" >

             <label>Grupo</label>
                <div class="mb-3">
                    <select class="form-select" name="grupo" id="grupo">
                        <option selected>Seleccione el Grupo</option>
                        <?php
                        foreach($grupo as $grupos){ 
                            if (  $grupos['id'] ==  $_POST["grupo"])
                        echo "<option value='".$grupos['id']."' selected='selected' >Grupo: ".$grupos['Grupo']." ".$grupos['Turno']." ".$grupos['Ciclo']."</option>";
                            else
                     echo "<option value='".$grupos['id']."' >Grupo: ".$grupos['Grupo']." ".$grupos['Turno']." ".$grupos['Ciclo']."</option>";

                    }
                        ?>
                    </select>
                </div>
                </div>
            </div>
            
      <div class="col-sm-2">
            <div class="form-group">
          <input type="hidden" name="ID" id="ID" >
         <input type="submit" style="margin-top:20px" class="btn btn-info" value="Mostrar Horario">
           </form>
       </div>
     </div>

     <div class="col-sm-1">
            <div class="form-group">
         <a href="../pdf/horario_pdf.php?gru=<?php echo $gru;?>  " style="margin-top:20px" class="btn btn-danger">Imprimir </a>
       </div>
     </div>

</div></div></div>


<?php

$horario = array();
$horario2 = array();
$horario3 = array();
$horario4 = array();
$horario4 = array();

$asig=new Asignatura_model();
$asignatura = $asig->get_asignatura2("Lunes",$gru);
$asig2=new Asignatura_model();
$asignatura2 = $asig2->get_asignatura2("Martes",$gru);
$asig3=new Asignatura_model();
$asignatura3 = $asig3->get_asignatura2("Miercoles",$gru);
$asig4=new Asignatura_model();
$asignatura4 = $asig4->get_asignatura2("Jueves",$gru);
$asig5=new Asignatura_model();
$asignatura5 = $asig5->get_asignatura2("Viernes",$gru);


foreach($asignatura as $asignaturas){ 
    for($y=1;$y<=9;$y++){ 
    if ($asignaturas['Hora'] == $y)
        $horario[$y] = $asignaturas['Asignatura'];
        else {
            if (empty($horario[$y]))
                $horario[$y] = "--";
        }
    }
}
$y = 1;
foreach($asignatura2 as $asignaturas2){ 
    for($y=1;$y<=9;$y++){ 
        if ($asignaturas2['Hora'] == $y)
            $horario2[$y] = $asignaturas2['Asignatura'];
            else {
                if (empty($horario2[$y]))
                    $horario2[$y] = "--";
            }
        }
}
$y = 1;
foreach($asignatura3 as $asignaturas3){ 
    for($y=1;$y<=9;$y++){ 
        if ($asignaturas3['Hora'] == $y)
            $horario3[$y] = $asignaturas3['Asignatura'];
            else {
                if (empty($horario3[$y]))
                    $horario3[$y] = "--";
            }
        }
}
$y = 1;
foreach($asignatura4 as $asignaturas4){ 
    for($y=1;$y<=9;$y++){ 
        if ($asignaturas4['Hora'] == $y)
            $horario4[$y] = $asignaturas4['Asignatura'];
            else {
                if (empty($horario4[$y]))
                    $horario4[$y] = "--";
            }
        }
}
$y = 1;
foreach($asignatura5 as $asignaturas5){ 
    for($y=1;$y<=9;$y++){ 
        if ($asignaturas5['Hora'] == $y)
            $horario5[$y] = $asignaturas5['Asignatura'];
            else {
                if (empty($horario5[$y]))
                    $horario5[$y] = "--";
            }
        }
}
echo "<table class='table table-dark' border='1'>";
echo "<tr>";
echo "<th>Horas/Dias</th>";
echo "<th>Lunes</th>";
echo "<th>Martes</th>";
echo "<th>Miercoles</th>";
echo "<th>Jueves</th>";
echo "<th>Viernes</th>";
echo "</tr>";

$y = 1;
while ( $y <= 9 ) {
    echo "<tr>";

    echo "<td>";
    echo $horas[$y-1];
    echo "</td>";

    echo "<td>";
    echo $horario[$y];
    echo "</td>";

    echo "<td>";
    echo $horario2[$y];
    echo "</td>";

    echo "<td>";
    echo $horario3[$y];
    echo "</td>";

    echo "<td>";
    echo $horario4[$y];
    echo "</td>";

    echo "<td>";
    echo $horario5[$y];
    echo "</td>";

    echo "</tr>";

    $y++;
}

echo "</table>";

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