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
 * @since       1.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Libraries\PDF\Cezpdf;

class Creport extends Cezpdf {
    function Creport($p,$o){
        $this->__construct($p, $o,'none',array());
        $this->isUnicode = true;
        // always embed the font for the time being
        //$this->embedFont = false;
        // since version 0.11.8 it is required to allow custom callbacks
        $this->allowedTags .= "|uline"; 
    }
}
$pdf = new Creport('Letter','portrait');
$pdf->ezSetMargins(20,20,20,20);
//$pdf->rtl = true; // all text output to "right to left"
//$pdf->setPreferences('Direction','R2L'); // optional: set the preferences to "Right To Left"

$f = (isset($_GET['font']))?$_GET['font']:'Helvetica';

$mainFont = BASE_PATH . 'eduTrac/Classes/Libraries/PDF/fonts/'.$f;
// select a font
$pdf->selectFont($mainFont);
$pdf->openHere('Fit');

$heading = 'NSLC Verification Report' . "\n" . "\n";
$pdf->ezText($heading, 14, array('justification'=>'center'));

$content = str_pad("<u>Student ID</u>", 25," ",STR_PAD_RIGHT);
$content .= str_pad("<u>Load</u>", 25," ",STR_PAD_RIGHT);
$content .= str_pad("<u>Date</u>", 20," ",STR_PAD_RIGHT) . "\n" . "\n";

if($this->nslc != '') : foreach($this->nslc as $k => $v) {
    $content .= str_pad(_h($v['stuID']), 25," ",STR_PAD_RIGHT);
    $content .= str_pad(_h($v['stuLoad']), 25," ",STR_PAD_RIGHT);
    $content .= str_pad(_h($v['LastUpdate']), 20," ",STR_PAD_RIGHT) . "\n";
} else :
    $content .= "There are no errors to check. You may now proceed with writing the data to the nslc file.";
endif;

$pdf->ezText($content, 10, array('justification'=>'left'));

if (isset($_GET['d']) && $_GET['d']){
  $pdfcode = $pdf->ezOutput(1);
  $pdfcode = str_replace("\n","\n<br>",htmlspecialchars($pdfcode));
  echo '<html><body>';
  echo trim($pdfcode);
  echo '</body></html>';
} else {
  $pdf->ezStream();
}