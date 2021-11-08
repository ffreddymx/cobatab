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
    $this->SetFont('Arial','',7);
    $this->SetXY(100,20);
    $this->Cell(0,6,utf8_decode("LISTA DE ALUMNOS"),0,1,'L');
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

    $pdf=new PDF('P','mm','Letter'); //P es verical y L horizontal
    $pdf->Open();
    $pdf->AddPage();
    $pdf->SetMargins(10,10,10);

    $conexion = Conectar::conexion();

    $alumno=$conexion->query("SELECT I.id, Nombre,Apellido,Matricula, GG.grado as Grado,G.Grupo,G.Turno, G.Ciclo	
    FROM `inscrito` as I 
    INNER JOIN alumnos as A on I.idalumno = A.id
    INNER JOIN grupo as G on I.idgrupo = G.id
    INNER JOIN grado as GG on GG.idgrupo = G.id
    WHERE G.Turno = 'Matutino' ");

    $pdf->Ln(10);

     $pdf->SetWidths(array(50,50,50,50));
     $pdf->SetFont('Arial','B',9,'L');
     $pdf->SetFillColor(1,113,185);//color blanco rgb
     $pdf->SetTextColor(255);
     $pdf->SetLineWidth(.3);
    for($i=0;$i<1;$i++)
            {
                $pdf->Row(array(utf8_decode('Matricula'),utf8_decode('Nombre'),utf8_decode('Apellido'),utf8_decode('Grupo')),'L');
            }

    //***************-------------------------encabezados de las tablas
    $pdf->SetWidths(array(50,50,50,50));
    $pdf->SetFont('Arial','',10,'L');
  //  $pdf->SetFillColor(224,235,255);
    $pdf->SetFillColor(255,255,255);//color blanco rgb
    $pdf->SetTextColor(0);

    $pdf->SetFont('Arial','',8);

        foreach( $alumno as $alumnos ){
        $pdf->Row(array( utf8_decode($alumnos['Matricula']), utf8_decode($alumnos['Nombre']),utf8_decode($alumnos['Apellido']),$alumnos['Grupo']),'L');
        }


$pdf->Output();
?>