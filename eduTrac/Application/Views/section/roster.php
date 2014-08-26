<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Student Roster View
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
 * @since       4.0.9
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

// create new PDF document
$pdf = new \eduTrac\Classes\tcpdf\Tcpdf('portrait', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);

// set default header data
$pdf->SetHeaderData('', '', 'Section Roster', '', '', '');

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
$txt1 = \eduTrac\Classes\Libraries\Hooks::get_option('site_title')."<br />";
$txt1 .= "Section: "._h($this->roster[0]['courseSecCode'])." "._h($this->roster[0]['secShortTitle'])."<br />";
$txt1 .= "Instructor: ".get_name(_h($this->roster[0]['facID']))."<br />";

// writeHTMLCell
$pdf->writeHTMLCell(0, 0, '', '', $txt1, 0, 1, 0, true, 'L', true);

$schedule = '- - - - - - - - - - - - - - - - - - - - - - - - - - Schedule - - - - - - - - - - - - - - - - - - - - - - - - - -<br />';
$schedule .= _h($this->roster[0]['startDate']) .' '. _h($this->roster[0]['endDate']) .'&nbsp;&nbsp;&nbsp;&nbsp;'. _h($this->roster[0]['roomCode']) .'&nbsp;&nbsp;&nbsp;&nbsp;'. _h($this->roster[0]['instructorMethod']) .'&nbsp;&nbsp;&nbsp;&nbsp;'. _h($this->roster[0]['dotw']) .'&nbsp;&nbsp;&nbsp;&nbsp;'. _h($this->roster[0]['startTime']) .' ' . _h($this->roster[0]['endTime']);

 // print a block of text using Write()
$pdf->writeHTMLCell(0, 0, '', '', $schedule, 0, 1, 0, true, 'C', true);

// column titles
$table = '<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="table-example">';
$table .= '<thead><tr>';
$table .= '<th><b>'._t( 'ID' ).'</b></th>';
$table .= '<th><b>'._t( 'Name' ).'</b></th>';
$table .= '<th><b>'._t( 'Acad Level' ).'</b></th>';
$table .= '<th><b>'._t( 'Acad Program' ).'</b></th>';
$table .= '<th><b>'._t( 'Acad Credit Status' ).'</b></th>';
$table .= '</tr></thead>';
$table .= '<tbody>';
foreach($this->roster as $k => $v) {
     $table .= '<tr>';
     $table .= '<td>'._h($v['stuID']).'</td>';
     $table .= '<td>'.get_name(_h($v['stuID'])).'</td>';
     $table .= '<td>'._h($v['acadLevelCode']).'</td>';
     $table .= '<td>'._h($v['acadProgCode']).'</td>';
     $table .= '<td>'._h($v['Status']).'</td>';
     $table .= '</tr>';
}
 
$table .= '</tbody>';
$table .= '</table>';

$pdf->writeHTML($table, true, 0);

$students = '<p>'._h($this->rosterCount[0]['StuCount']).' students currently enrolled.</p>';
$students .= '<p>&nbsp;</p>';

$pdf->writeHTML($students, true, 0);

$txt3 = 'Printed on ' . date("m/d/Y @ h:i A");    

 // print a block of text using Write()
$pdf->Write($h=0, $txt3, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);

// close and output PDF document
$pdf->Output('roster.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+