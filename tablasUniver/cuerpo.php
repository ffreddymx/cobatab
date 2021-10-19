<?php



class tablacuerpo{


    private $db;

    public function __construct(){
        $this->db=Conectar::conexion();
    }


           public function alumnos($a,$link)
                {
                                    $sql =  $this->db->query($a); //parte1
                                      echo "<thead class='thead-dark'> <tr>";
                                      for($i=0;$i<$sql->field_count;$i++) 
                                      {
                                         echo "<th scope='col'>"; 
                                         print_r($sql->fetch_field_direct($i)->name); 
                                         echo"</th>";
                                       }
                                         echo "<th>Modificar</th>
                                         <th>Eliminar</th>
                                         </tr></thead><tbody>";
                                         while ($row= $sql->fetch_assoc()) //finparte1
                                       {  
                                                   echo "<tr id=".$row['id'].">"; //hacen las filas
                                                     for($i=0;$i<$sql->field_count;$i++) //parte2
                                                      {
                                                        echo "<td data-target='"; 
                                                        print_r($sql->fetch_field_direct($i)->name);
                                                        echo "' >";
                                                        print_r($row[$sql->fetch_field_direct($i)->name]); 
                                                        echo "</td>"; //finparte2
                                                      }
            if($link!=0){
          ?>
           <td><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $row["id"] ?>">Modificar</a></td>     

                <td><a class="btn btn-danger btn-sm" aria-controls="xAlumno" data-toggle="collapse" href="#xAlumno" data-role="xAlumno" data-id="<?php echo $row["id"] ?>">Eliminar</a></td>        
                 <?php       
               }
            echo "</tr>";
                                                                            }
            mysqli_free_result($sql);
                 }

           


 public static function proyecto($a,$link,$conexion)
                {
                                    $query =  mysqli_query($conexion,$a); //parte1
                                      echo "<thead class='thead-dark'> <tr>";
                                      for($i=0;$i<mysqli_num_fields($query);$i++) 
                                      {
                                         echo "<th scope='col'>"; 
                                         print_r(mysqli_fetch_field_direct($query,$i)->name); 
                                         echo"</th>";
                                       }
                                         echo "<th>Modificar</th>
                                         <th>Eliminar</th>
                                         </tr></thead><tbody>";
                                         while ($row=mysqli_fetch_assoc($query)) //finparte1
                                       {  
           echo "<tr id=".$row['id'].">"; //hacen las filas
             for($i=0;$i<mysqli_num_fields($query);$i++) //parte2
                                      {
                                        echo "<td data-target='"; 
                                        print_r(mysqli_fetch_field_direct($query, $i)->name);
                                        echo "' >";
                                        print_r($row[mysqli_fetch_field_direct($query,$i)->name]); 
                                        echo "</td>"; //finparte2
                                      }
            if($link!=0){
          ?>
           <td><a class="btn btn-info btn-sm" aria-controls="collapseExample" data-toggle="collapse" href="#collapseExample" data-role="updateAlumno" data-id="<?php echo $row["id"] ?>">Modificar</a></td>     

                <td><a class="btn btn-danger btn-sm" aria-controls="xProyecto" data-toggle="collapse" href="#xProyecto" data-role="xProyecto" data-id="<?php echo $row["id"] ?>">Eliminar</a></td>        
                 <?php       
               }
            echo "</tr>";
                                                                            }
            mysqli_free_result($query);
                 }



}



?>
