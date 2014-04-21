<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * PDF Catalog View
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
 * @since       4.0.1
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

// create new PDF document
$pdf = new \eduTrac\Classes\tcpdf\Tcpdf('landscape', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle($this->pdf[0]['termCode'].' Course Catalog');

// set default header data
$pdf->SetHeaderData("", "", $this->pdf[0]['termCode'].' Course Catalog', "");

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
$pdf->SetFont('helvetica', '', 10);

// column titles
$table = '<table cellpadding="4" cellspacing="5" border="0" class="table table-striped" id="table-example">';
$table .= '<thead><tr>';
$table .= '<th><b>Course Section</b></th>';
$table .= '<th><b>Title</b></th>';
$table .= '<th><b>Instructor</b></th>';
$table .= '<th><b>Meeting Days</b></th>';
$table .= '<th><b>Meeting Time</b></th>';
$table .= '<th><b>Room</b></th>';
$table .= '</tr></thead>';
$table .= '<tbody>';
foreach($this->pdf as $k => $v) {
     $table .= '<tr>';
     $table .= '<td>'._h($v['courseSecCode']).'</td>';
     $table .= '<td>'._h($v['secShortTitle']).'</td>';
     $table .= '<td>'.get_name(_h($v['facID'])).'</td>';
     $table .= '<td>'._h($v['dotw']).'</td>';
     $table .= '<td>'._h($v['startTime']).' to '._h($v['endTime']).'</td>';
     $table .= '<td>'._h($v['roomCode']).'</td>';
     $table .= '</tr>';
}
$table .= '</tbody>';
$table .= '</table>';

$pdf->AddPage();
$pdf->writeHTML($table, true, 0);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('pdf/?term='.$this->pdf[0]['termCode'], 'I');

//============================================================+
// END OF FILE
//============================================================+