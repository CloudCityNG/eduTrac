<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Cron Model
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

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class CronModel {
	
	public function index() {}
    
    public function cronList() {
        $q = DB::inst()->query( "SELECT * FROM cronjob ORDER BY id" );
        return $q->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function cron($id) {
        $array = [];
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "cronjob","id = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runStuTerms() {
        $datetime = date( 'Y-m-d H:i:s' );
        $q1 = DB::inst()->query( "SELECT 
                    stuID,
                    courseSecID,
                    termID,
                    acadLevelCode,
                    SUM(attCred) 
                FROM 
                    stu_acad_cred 
                GROUP BY 
                    stuID,termID,acadLevelCode"
        );
        $r1 = $q1->fetch(\PDO::FETCH_ASSOC);
        
        $stuID = $r1['stuID'];$termID = $r1['termID'];
        $credits = $r1['SUM(attCred)'];$level = $r1['acadLevelCode'];
        
        $q2 = DB::inst()->query( "SELECT 
                    * 
                FROM 
                    stu_term 
                WHERE 
                    stuID = '$stuID' 
                AND 
                    termID = '$termID' 
                AND 
                    acadLevelCode = '$level'" 
        );
        
        if($q1->rowCount() > 0) {
            if($q2->rowCount() <= 0) {
                $q3 = DB::inst()->query( "INSERT INTO stu_term 
                            (stuID,termID,termCredits,acadLevelCode,addDateTime) 
                            VALUES('$stuID','$termID','$credits','$level','$datetime')");
            }
        }
    }
    
    public function runStuLoad() {
        $q1 = DB::inst()->query( "SELECT 
                    stuID,
                    termID,
                    acadLevelCode,
                    termCredits 
                FROM 
                    stu_term 
                GROUP BY 
                    stuID,termID,acadLevelCode" 
        );
        $r1 = $q1->fetch(\PDO::FETCH_ASSOC);
                
        $stuID = $r1['stuID'];$termID = $r1['termID'];
        $load = getStuLoad($r1['termCredits']);
        $level = $r1['acadLevelCode'];
        
        $q2 = DB::inst()->query( "SELECT 
                    * 
                FROM 
                    stu_term_load 
                WHERE 
                    stuID = '$stuID' 
                AND 
                    termID = '$termID' 
                AND 
                    acadLevelCode = '$level'" 
        );
        
        if($q1->rowCount() > 0) {
            if($q2->rowCount() <= 0) {
                $q3 = DB::inst()->query( "INSERT INTO stu_term_load 
                            (stuID,termID,stuLoad,acadLevelCode) 
                            VALUES('$stuID','$termID','$load','$level')");
            }
        }
    }
    
    public function updateStuTerms() {
        $q1 = DB::inst()->query( "SELECT 
                    SUM(a.attCred) as Credits,
                    a.stuID as stuAcadCredID,
                    a.termID as termAcadCredID,
                    a.acadLevelCode as acadCredLevel,
                    b.stuID AS stuTermID,
                    b.termID AS TermID,
                    b.acadLevelCode as termAcadLevel,
                    b.termCredits AS TermCredits 
                FROM 
                    stu_acad_cred a 
                LEFT JOIN 
                    stu_term b 
                ON 
                    a.stuID = b.stuID 
                WHERE 
                    a.termID = b.termID 
                AND 
                    a.acadLevelCode = b.acadLevelCode"
        );
        $r = $q1->fetch(\PDO::FETCH_ASSOC);
        
        if($r['Credits'] != $r['TermCredits']) {
            $update = [ 
                    "termCredits" => $r['Credits'] 
                    ];
                    
            $bind = [ 
                    ":stuID" => $r['stuTermID'],":termID" => $r['TermID'],
                    ":acadLevelCode" => $r['termAcadLevel']
                    ];
                    
            $q2 = DB::inst()->update( 
                            "stu_term",
                            $update,
                            "stuID = :stuID 
                        AND 
                            termID = :termID 
                        AND 
                            acadLevelCode = :acadLevelCode",
                        $bind
            );
        }
    }
    
    public function updateStuLoad() {
        $termID = Hooks::get_option('current_term_id');
        $q1 = DB::inst()->query( "SELECT 
                    a.termCredits,
                    a.stuID AS StudentID,
                    a.termID AS TermID,
                    a.acadLevelCode AS AcademicLevel,
                    a.LastUpdate AS termLatest,
                    b.LastUpdate AS stuTermLatest 
                FROM 
                    stu_term a 
                LEFT JOIN 
                    stu_term_load b 
                ON 
                    a.stuID = b.stuID 
                WHERE 
                    a.termID = b.termID 
                AND 
                    a.acadLevelCode = b.acadLevelCode 
                AND 
                    a.termID = '$termID'" 
        );
        $r1 = $q1->fetch(\PDO::FETCH_ASSOC);
        
        $update = [ "stuLoad" => getStuLoad($r1['termCredits']) ];
        
        $bind = [ 
                ":stuID" => $r1['StudentID'],":termID" => $r1['TermID'],
                ":acadLevelCode" => $r1['AcademicLevel']
                ];
        
        if($r1['termLatest'] > $r1['stuTermLatest']) {
            DB::inst()->update( 
                        "stu_term_load",
                        $update,
                        "stuID = :stuID 
                    AND 
                        termID = :termID 
                    AND 
                        acadLevelCode = :acadLevelCode",
                    $bind
            );
        }
    }
    
    public function runEditCron($data) {
        if ($data['minutes'] > 0) $time_interval = $data['minutes'] * 60;
        elseif ($data['hours'] > 0) $time_interval = $data['hours'] * 3600;
        elseif ($data['days'] > 0) $time_interval = $data['days'] * 86400;
        else $time_interval = $data['weeks'] * 604800;
        
        $data['time_last_fired'] = ($data['time_last_fired'])? $data['time_last_fired']:time();
        $fire_time = $data['time_last_fired'] + $time_interval;
        
        $update = [ 
                    "name" => $data['name'],"scriptpath" => $data['scriptpath'],
                    "time_interval" => $time_interval,"fire_time" => $fire_time,
                    "run_only_once" => $data['run_only_once']
                  ];
                  
        $bind = [ ":id" => $data['id'] ];
        
        $q = DB::inst()->update( "cronjob",$update,"id = :id",$bind );
        
        redirect( BASE_URL . 'cron/view/' . $data['id'] . '/' . bm() );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}