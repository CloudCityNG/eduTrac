<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Transcript View
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

// create new PDF document
$pdf = new \eduTrac\Classes\tcpdf\Tcpdf('landscape', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

// set default header data
$pdf->SetHeaderData('', '', _h($this->stuInfo[0]['Level']) . ' Transcript', '', '', '');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, "20", PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin("12");
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for student info
$txt1 = get_name(_h($this->stuInfo[0]['stuID'])) . "<br />";
$txt1 .= _h($this->stuInfo[0]['address1']) . ' ' . _h($this->stuInfo[0]['address2']) . "<br />";
$txt1 .= _h($this->stuInfo[0]['city']) . ' ' . _h($this->stuInfo[0]['state']) . ' ' . _h($this->stuInfo[0]['zip']) . "<br />";

// set some text for student info
$txt2 = _t( 'Student ID: ' ) . _h($this->stuInfo[0]['stuID']) . "<br />";
$txt2 .= _t( 'Social Security #: ' ) . _h($this->stuInfo[0]['ssn']) . "<br />";
$txt2 .= _t( 'Graduation Date: ' ) . _h($this->stuInfo[0]['graduationDate']) . "<br />";

// writeHTMLCell
$pdf->writeHTMLCell(0, 0, '', '', $txt1, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, 234, 20, $txt2, 0, 1, 0, true, 'L', true);

// column titles
$table = '<table cellpadding="4" cellspacing="5" border="0" class="table table-striped" id="table-example">';
$table .= '<thead><tr>';
$table .= '<th><b>'._t( 'Course' ).'</b></th>';
$table .= '<th><b>'._t( 'Course Title' ).'</b></th>';
$table .= '<th><b>'._t( 'Grade' ).'</b></th>';
$table .= '<th><b>'._t( 'Attempted Credits' ).'</b></th>';
$table .= '<th><b>'._t( 'Completed Credits' ).'</b></th>';
$table .= '<th><b>'._t( 'Grade Points' ).'</b></th>';
$table .= '<th><b>'._t( 'Dates' ).'</b></th>';
$table .= '</tr></thead>';
$table .= '<tbody>';
foreach($this->courses as $k => $v) {
     $table .= '<tr>';
     $table .= '<td>'._h($v['courseCode']).'</td>';
     $table .= '<td>'._h($v['secShortTitle']).'</td>';
     $table .= '<td>'._h($v['grade']).'</td>';
     $table .= '<td>'._h($v['acadAttCred']).'</td>';
     $table .= '<td>'._h($v['acadCompCred']).'</td>';
     $table .= '<td>'._h($v['acadGradePoints']).'</td>';
     $table .= '<td>'._h($v['startDate']).' to ' . _h($v['endDate']) . '</td>';
     $table .= '</tr>';
}

$table .= '<tr>';
$table .= '<td colspan="3"><b>'._t( 'Totals' ).'</b></td>';
$table .= '<td>CRED.ATT = '._h($this->tranGPA[0]['Attempted']).'</td>';
$table .= '<td>CRED.CPT = '._h($this->tranGPA[0]['Completed']).'</td>';
$table .= '<td>GRADE.PTS = '._h($this->tranGPA[0]['Points']).'</td>';
$table .= '<td>GPA = '._h($this->tranGPA[0]['GPA']).'</td>';
$table .= '</tr>';
 
$table .= '</tbody>';
$table .= '</table>';

$pdf->writeHTML($table, true, 0);

$footer = "<p>*******************************************************************************************************************************************************</p>";
$footer .= '<table cellpadding="4" cellspacing="5" border="0" class="table table-striped" id="table-example">';
$footer .= '<thead><tr>';
$footer .= '<th><b>'._t( 'Degree' ).'</b></th>';
$footer .= '<th><b>'._t( 'Major' ).'</b></th>';
$footer .= '<th><b>'._t( 'Minor' ).'</b></th>';
$footer .= '<th><b>'._t( 'Specialization' ).'</b></th>';
$footer .= '<th><b>'._t( 'CCD' ).'</b></th>';
$footer .= '</tr></thead>';

$footer .= '<tbody>';
$footer .= '<tr>';
if(_h($this->stuInfo[0]['graduationDate']) != '0000-00-00') {
$footer .= '<td>'._h($this->stuInfo[0]['degreeCode']).' - ' . _h($this->stuInfo[0]['degreeName']) . ' Awarded on ' . _h($this->stuInfo[0]['gradudationDate']) . '</td>';
} else {
    $footer .= '<td>&nbsp;</td>';
}

if(_h($this->stuInfo[0]['majorCode']) != 'NULL') {
$footer .= '<td>'._h($this->stuInfo[0]['majorCode']).' - '._h($this->stuInfo[0]['majorName']).'</td>';
} else {
    $footer .= '<td>&nbsp;</td>';
}

if(_h($this->stuInfo[0]['minorCode']) != 'NULL') {
$footer .= '<td>'._h($this->stuInfo[0]['minorCode']).' - '._h($this->stuInfo[0]['minorName']).'</td>';
} else {
    $footer .= '<td>&nbsp;</td>';
}

if(_h($this->stuInfo[0]['specCode']) != 'NULL') {
$footer .= '<td>'._h($this->stuInfo[0]['specCode']).' - '._h($this->stuInfo[0]['specName']).'</td>';
} else {
    $footer .= '<td>&nbsp;</td>';
}

if(_h($this->stuInfo[0]['ccdCode']) != 'NULL') {
$footer .= '<td>'._h($this->stuInfo[0]['ccdCode']).' - '._h($this->stuInfo[0]['ccdName']).'</td>';
} else {
    $footer .= '<td>&nbsp;</td>';
}

$footer .= '</tr>';
$footer .= '</tbody>';
$footer .= '</table>';
$footer .= "<p>*******************************************************************************************************************************************************</p>";


$pdf->writeHTML($footer, true, 0);

$txt3 = 'Printed on ' . date("m/d/Y @ h:i A");    

 // print a block of text using Write()
$pdf->Write($h=0, $txt3, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);

// ---------------------------------------------------------

/*$pdf->Button('print', 30, 10, 'Print', 'Print()', array('lineWidth'=>2, 'borderStyle'=>'beveled', 'fillColor'=>array(128, 196, 255), 'strokeColor'=>array(64, 64, 64)));

// Form validation functions
$js = <<<EOD
function Print() {
    print();
}
EOD;

// Add Javascript code
$pdf->IncludeJS($js);*/

// close and output PDF document
$pdf->Output('transcript.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+