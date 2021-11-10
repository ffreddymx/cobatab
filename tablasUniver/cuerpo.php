<?php


class tablacuerpo{


    private $db;
		private $alumnos;
    private $target;

    public function __construct(){
        $this->db=Conectar::conexion();
        $this->alumnos = array();
        $this->target = array();
    }


public function alumnos($a,$link)
    {           
      $consulta = $this->db->query($a);
			while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
				$this->alumnos[] = $filas;
			}
      echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla
            
        foreach($this->alumnos[0] as $key=>$value){
                  echo'<th>' . ($key) . '</th>';
                  $this->target[] = $key;
               }
  
               echo "<th colspan='2' style='width:50px;' >Acciones</th>";
               echo '</tr></thead><tbody border="1">';

                foreach ( $this->alumnos as $r ) {
                 echo '<tr id='.$r["id"].'>';
                 $i = 0;
                    foreach ( $r as $v ) {
                    echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
                    $i++;
                }
                if($link!=0){
                  ?>
            <td style='width:30px;'><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></i></a></td>     
            <td style='width:30px;'><a class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#xAlumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
             <?php       
                   } 
                echo '</tr>';
                }
        echo '</tbody> </table>';
    }

  //==============================================================

    public function profesor($a,$link)
    {           
      $consulta = $this->db->query($a);
			while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
				$this->alumnos[] = $filas;
			}
      echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla
            
        foreach($this->alumnos[0] as $key=>$value){
                  echo'<th>' . ($key) . '</th>';
                  $this->target[] = $key;
               }
  
               echo "<th colspan='2' style='width:50px;' >Acciones</th>";
               echo '</tr></thead><tbody border="1">';

                foreach ( $this->alumnos as $r ) {
                 echo '<tr id='.$r["id"].'>';
                 $i = 0;
                    foreach ( $r as $v ) {
                    echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
                    $i++;
                }
                if($link!=0){
                  ?>
            <td style="width:30px;"><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></a></td>     
            <td style="width:30px;"><a class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#xAlumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
             <?php       
                   } 
                echo '</tr>';
                }
        echo '</tbody> </table>';
    }


  //==============================================================GRUPO

  public function grupo($a,$link)
  {           
    $consulta = $this->db->query($a);
    while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
      $this->alumnos[] = $filas;
    }
    echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla
          
      foreach($this->alumnos[0] as $key=>$value){
                echo'<th>' . ($key) . '</th>';
                $this->target[] = $key;
             }
             echo "<th colspan='2' style='width:50px;' >Acciones</th>";
             echo '</tr></thead><tbody border="1">';

              foreach ( $this->alumnos as $r ) {
               echo '<tr id='.$r["id"].'>';
               $i = 0;
                  foreach ( $r as $v ) {
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
                  $i++;
              }
              if($link!=0){
                ?>
          <td style="width:30px;"><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></a></td>     
          <td style="width:30px;"><a class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#collapselumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
           <?php       
                 } 
              echo '</tr>';
              }
      echo '</tbody> </table>';
  }


//==============================================================grado

public function grado($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }
           echo "<th colspan='2' style='width:50px;' >Acciones</th>";
           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }
            if($link!=0){
              ?>
        <td style="width:30px;" ><a  class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></i></a></td>     
        <td style="width:30px;"><a  class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#collapselumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
         <?php       
               } 
            echo '</tr>';
            }
    echo '</tbody> </table>';
}


//==============================================================asignatura
public function asignatura($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }
           echo "<th colspan='2' style='width:50px;' >Acciones</th>";
           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }
            if($link!=0){
              ?>
        <td style="width:30px;" ><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></a></td>     
        <td style="width:30px;" ><a class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#collapselumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
         <?php       
               } 
            echo '</tr>';
            }
    echo '</tbody> </table>';
}


//==============================================================nota
public function notas($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }
           echo "<th colspan='2' style='width:50px;' >Acciones</th>";
           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }
            if($link!=0){
              ?>
        <td style="width:30px;"><a  class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-edit"></i></a></td>     
        <td style="width:30px;"><a  class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#collapselumno" data-role="xAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>        
         <?php       
               } 
            echo '</tr>';
            }
    echo '</tbody> </table>';
}


//==============================================================inscribir
public function inscribir($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }
           echo "<th style='width:50px;'>Inscribir</th>";
           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }
            if($link!=0){
              ?>
        <td style="width:30px;" align="center" ><a  class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $r['id']; ?>"><i class="fas fa-atlas"></i></a></td>     
         <?php       
               } 
            echo '</tr>';
            }
    echo '</tbody> </table>';
}

//==============================================================irregulares
public function irregulares($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }
           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }
            echo '</tr>';
            }
    echo '</tbody> </table>';
}


//==============================================================grupo matutinovespertino
public function matutinovespertino($a,$link,$oculto)
{           
  $consulta = $this->db->query($a);
  while($filas = $consulta->fetch(PDO::FETCH_ASSOC) ){
    $this->alumnos[] = $filas;
  }
  echo "<table class='table table-sm table-hover'><thead class='thead-dark'><tr> ";//iniciamos la tabla

    $i=0;//para ocultar las columnas
    foreach($this->alumnos[0] as $key=>$value){
              if($i<=$oculto)
              echo'<th style="display:none;">' . ($key) . '</th>';
              else 
              echo'<th >' . ($key) . '</th>';
              $this->target[] = $key;
              $i++;
           }

           echo '</tr></thead><tbody border="1">';
            foreach ( $this->alumnos as $r ) {
             echo '<tr id='.$r["id"].'>';
             $i = 0;
                foreach ( $r as $v ) {
                  if($i<=$oculto)
                  echo '<td style="display:none;" data-target="'.$this->target[$i].'">'.$v.'</td>';
                  else
                  echo '<td data-target="'.$this->target[$i].'">'.$v.'</td>';
   
                  $i++;
            }

            echo '</tr>';
            }
    echo '</tbody> </table>';
}












}

?>
