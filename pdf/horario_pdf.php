<?php
//error_reporting(0);
require_once '../db/db.php';
require('../librerias/pdf/fpdf.php');

class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

//==========================================================================                Configuracion de tablas
function Row($data,$alinea)
{
    //Calculate the height of the row
    $nb=0;
    for($i=1;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=6*$nb;//alto de la fila
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    $fill = true;
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        if($i<=0)// verifico menor que 5 para alinear las columnas
         $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        else // verifico si es encabezado para alinearlo a la izquierda
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border

        $this->Rect($x,$y,$w,$h);
        $this->MultiCell($w,6,$data[$i],8,$a,'true'); //aqui modifique ante 5,1
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);

    }
    //Go to the next line
    $this->Ln($h);
}

//==========================================================================                Configuracion de tablas

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

//==========================================================================             Encabezados

function Header()
{

$this->Image('../statics/logo.jpg',7,4,40,30);
//$this->Image('img/logo' ,240,5,25,20);

    $this->SetFont('Arial','B',12);
    $this->SetXY(70,16);
    $this->Cell(10,6,utf8_decode("COLEGIO DE BACHILLERES DE TABASCO"),0,1,'L');
    $this->SetFont('Arial','B',9);
    $this->SetXY(90,20);
    $this->Cell(0,6,utf8_decode("HORARIO DE CLASES DEL GRUPO :"),0,1,'L');
    $this->SetFont('Arial','',9);
    $this->SetXY(70,23);
    $this->Cell(0,6,utf8_decode("PLANTEL NO. 11"),0,1,'L');

}

//==========================================================================             Pie de la pagina

function Footer()
{





   $this->SetY(-25);
  $this->SetFont('Arial','',9);
  $this->Cell(187,10,'  ',0,0,'C');
  $this->SetY(-20);
  $this->Cell(187,10,' ',0,0,'C');
   $this->SetY(-15);
   $this->SetFont('Arial','I',8);
  $this->Cell(187,10,'Impreso:'.date("d/m/Y").', Hora:'.date("G:i:s"),0,0,'C');


}


//==========================================================================      Cuerpo del programas

}

    $pdf=new PDF('L','mm','Letter'); //P es verical y L horizontal
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetMargins(10,10,10);

//    $conexion = Conectar::conexion();
require_once '../db/db.php';
$conexion=Conectar::conexion();
require_once '../models/horario_model.php';
require_once '../models/asignatura_model.php';
require_once '../models/horario_model.php';

$hor = new Horario_model();
$horario = $hor->get_horario();
$horas = array();
foreach($horario as $hora){
    $horas[] = $hora["horario"]; 
}

$horario = array();
$horario2 = array();
$horario3 = array();
$horario4 = array();
$horario5 = array();


$gru = $_GET['gru'];



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

   // $turno = $_GET['turno'];


    $pdf->Ln(10);
     $pdf->SetWidths(array(16,48,48,48,48,48));
     $pdf->SetFont('Arial','B',9,'L');
     $pdf->SetFillColor(1,113,185);//color blanco rgb
     $pdf->SetTextColor(255);
     $pdf->SetLineWidth(.3);
    for($i=0;$i<1;$i++)
            {
                $pdf->Row(array(('Hora/Dia'),('Lunes'),('Martes'),('Miercoles'),'Jueves','Viernes'),'L');
            }

    //***************-------------------------encabezados de las tablas
    $pdf->SetWidths(array(16,48,48,48,48,48));
    $pdf->SetFont('Arial','',10,'L');
  //  $pdf->SetFillColor(224,235,255);
    $pdf->SetFillColor(255,255,255);//color blanco rgb
    $pdf->SetTextColor(0);

    $pdf->SetFont('Arial','',8);

//(1 == $v) ? 'Yes' : 'No';
//(isset($_POST['Balumno'])) ? $_POST['Balumno'] : '';
    for($i=1;$i<=9;$i++)

        {
        $pdf->Row(array( $horas[$i-1],
        (empty($horario[$i]) ? '-' : utf8_decode($horario[$i])),
        (empty($horario2[$i]) ? '-' : utf8_decode($horario2[$i])),
        (empty($horario3[$i]) ? '-' : utf8_decode($horario3[$i])),
        (empty($horario4[$i]) ? '-' : utf8_decode($horario4[$i])),
        (empty($horario5[$i]) ? '-' : utf8_decode($horario5[$i])),
    
    ),'L');
        }


$pdf->Output();
?>