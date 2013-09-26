<?php

use \eduTrac\Classes\Libraries\PDF\Cezpdf;

     //data
     $colw = array(      90 ,    110,   50,    40,     40,  50, 90  );//column widths
     $rows1 = array(
         array('Course','Title','Grade','Att Cr','Cpl Cr','Grd Pts','Course Dates'),
     );
     
     foreach($this->courses as $k => $v) {
         $array1[] = array(_h($v['courseSecCode']),_h($v['secShortTitle']),_h($v['grade']),_h($v['acadAttCred']),_h($v['acadCompCred']),_h($v['acadGradePoints']),_h($v['startDate']).' - '._h($v['endDate']) );
         $array2 = array('Term Totals: ','','',$v['termAttCred'],$v['termCompCred'],$v['termGradePoints'],"GPA = ".$v['termGPA']);
     }
     
     $rows2 = $array1;
     $rows3 = array(
         $array2,
     );
     
     //x is 0-600, y is 0-780 (origin is at bottom left corner)
     $pdf = new Cezpdf(isGetSet('size'));

     $pdf->selectFont(BASE_PATH . 'eduTrac/Classes/Libraries/PDF/fonts/Helvetica.afm');
     $pdf->setColor(0/255,0/255,0/255);
     $pdf->addText(250,750,14,_h($this->stuInfo[0]['Level']) . " Level");
     $pdf->addText(40,700,10,get_name(_h($this->stuInfo[0]['stuID'])));
     $pdf->addText(40,686,10,_h($this->stuInfo[0]['address1'].' '.$this->stuInfo[0]['address2']));
     $pdf->addText(40,674,10,_h($this->stuInfo[0]['city'].', '.$this->stuInfo[0]['state'].' '.$this->stuInfo[0]['zip'] ));
     
     $pdf->addText(220,700,10,"Student ID: " . _h($this->stuInfo[0]['stuID']));
     $pdf->addText(220,686,10,"SSN: " . _h($this->stuInfo[0]['ssn']));
     $pdf->addText(220,674,10,"DOB: " . _h($this->stuInfo[0]['dob'] ));
     
     /*if($this->courses != '') : foreach($this->courses as $k => $v) {
         $pdf->ezSetMargins(200,10,10);
         $pdf->ezText(_h($v['courseSecCode']), 10, array('left' => 30));
         $pdf->ezText(_h($v['secShortTitle']), 10, array('left' => 110));
         //$pdf->addText(40,580,10,_h($v['courseSecCode']));
         //$pdf->addText(110,600,10,_h($v['secShortTitle']));
     } endif;*/

     $pdf->setLineStyle(0.5);
     $pdf->line(40,598,570,598);
     $pdf->setStrokeColor(0,0,0);

     $pdf->setColor(0/255,0/255,0/255);
     $pdf->addText(30,16,8,"<b>Printed ".date("m/d/Y"));

     $total=0;
     $curr_x=40;
     $curr_y=600;
     foreach($rows1 as $r1)
     {
         $xoffset = $curr_x;
         foreach($r1 as $i=>$data)
         {
             $pdf->setColor(0/255,0/255,0/255);
             $pdf->addText( $xoffset, $curr_y , 10, $data );
             $xoffset+=$colw[$i];
         }
         $curr_y-=20;
     }
     
     foreach($rows2 as $r2)
     {
         $xoffset = $curr_x;
         foreach($r2 as $i=>$data)
         {
             $pdf->setColor(0/255,0/255,0/255);
             $pdf->addText( $xoffset, $curr_y , 10, $data );
             $xoffset+=$colw[$i];
         }
         $curr_y-=20;
     }
     
     foreach($rows3 as $r3)
     {
         $xoffset = $curr_x;
         foreach($r3 as $i=>$data)
         {
             $pdf->setColor(0/255,0/255,0/255);
             $pdf->addText( $xoffset, $curr_y , 10, $data );
             $xoffset+=$colw[$i];
         }
         $curr_y-=20;
     }

     $pdf->ezStream(); 