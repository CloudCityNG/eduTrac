<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * NSLC Extraction View
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Libraries\fpdf\Fpdf;

class PDF extends Fpdf {
    
    function __construct()
       {
          parent::Fpdf();
       }
       
function subWrite($h, $txt, $link='', $subFontSize=12, $subOffset=0)
{
    // resize font
    $subFontSizeold = $this->FontSizePt;
    $this->SetFontSize($subFontSize);
    
    // reposition y
    $subOffset = ((($subFontSize - $subFontSizeold) / $this->k) * 0.3) + ($subOffset / $this->k);
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX, $subY - $subOffset);

    //Output text
    $this->Write($h, $txt, $link);

    // restore y position
    $subX        = $this->x;
    $subY        = $this->y;
    $this->SetXY($subX,  $subY + $subOffset);

    // restore font size
    $this->SetFontSize($subFontSizeold);
}
}

// Instanciation of inherited class
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Write(5,'Hello World!');
$pdf->SetX(100);
$pdf->Write(5,"This is standard text.\n");
$pdf->Ln(12);

$pdf->subWrite(10,'H','',33);
$pdf->Write(10,'ello World!');
$pdf->SetX(100);
$pdf->Write(10,"This is text with a capital first letter.\n");
$pdf->Ln(12);

$pdf->subWrite(5,'Y','',6);
$pdf->Write(5,'ou can also begin the sentence with a small letter. And word wrap also works if the line is too long!');
$pdf->SetX(100);
$pdf->Write(5,"This is text with a small first letter.\n");
$pdf->Ln(12);

$pdf->Write(5,'The world has a lot of km');
$pdf->subWrite(5,'2','',6,4);
$pdf->SetX(100);
$pdf->Write(5,"This is text with a superscripted letter.\n");
$pdf->Ln(12);

$pdf->Write(5,'The world has a lot of H');
$pdf->subWrite(5,'2','',6,-3);
$pdf->Write(5,'O');
$pdf->SetX(100);
$pdf->Write(5,"This is text with a subscripted letter.\n");

$pdf->Output();