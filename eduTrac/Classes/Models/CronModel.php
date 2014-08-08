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
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
use \eduTrac\Classes\Libraries\Hooks;
class CronModel {
    
    private $_email;
	
	public function __construct() {
	    $this->_email = new \eduTrac\Classes\Libraries\PHPMailer;
	}
    
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
        /**
         * Select all records from the stu_acad_cred table.
         */
        $q1 = DB::inst()->query( "SELECT 
                    stuID,
                    courseSecCode,
                    termCode,
                    acadLevelCode,
                    SUM(attCred) 
                FROM 
                    stu_acad_cred 
                GROUP BY 
                    stuID,termCode,acadLevelCode"
        );
        
        if($q1->rowCount() > 0) {
            /**
             * If a student ID exists in the stu_acad_cred table, 
             * but does not exist in the stu_term table, then insert 
             * that new record into the stu_term table.
             */
			$q2 = DB::inst()->query(  
				"INSERT IGNORE INTO stu_term (stuID,termCode,termCredits,acadLevelCode) 
				SELECT stuID,termCode,SUM(attCred),acadLevelCode FROM stu_acad_cred 
				GROUP BY stuID,termCode,acadLevelCode"
			);
        }
    }
    
    public function runStuLoad() {
        $q1 = DB::inst()->query( "SELECT 
                    stuID,
                    termCode,
                    acadLevelCode,
                    termCredits 
                FROM 
                    stu_term" 
        );
        if($q1->rowCount() > 0) {
            foreach($q1 as $r1) {
            	$bind = [ "stuID" => _h($r1['stuID']),"termCode" => _h($r1['termCode']),
                       "stuLoad" => getstudentload(_h($r1['termCode']),_h($r1['termCredits']),_h($r1['acadLevelCode'])), "acadLevelCode" => _h($r1['acadLevelCode']) 
                        ];
                $q2 = DB::inst()->insert("stu_term_load",$bind);
            }
        }
    }
    
    public function runEmailHold() {
        $array1 = [];
        $array2 = [];
        $dt = date( "Y-m-d h:m:s" );
        /** 
         * SELECT all records from the email_hold table 
         * and join with the saved_query table to retrieve 
         * the savedQuery for $q2.
         */ 
        $q1 = DB::inst()->query( "SELECT 
                        a.*,
                        b.savedQuery 
                    FROM 
                        email_hold a 
                    LEFT JOIN 
                        saved_query b 
                    ON 
                        a.queryID = b.savedQueryID 
                    WHERE 
                        a.processed = '0'" 
        );
        foreach($q1 as $r1) {
            $array1[] = $r1;
        }
        
        /**
         * Use the savedQuery from $q1 to retrieve results 
         * to input into the email_queue table for processing.
         */
        $query = $r1['savedQuery'];
        $q2 = DB::inst()->query( $query );
        
        $bind1 = [ ":holdID" => _h($r1['id']) ];
        $q3 = DB::inst()->select( "email_queue","holdID = :holdID AND sent = '0'","","*",$bind1 );
        
        if(count($r1['fromEmail']) > 0) {
            if(count($q3) <= 0) {
                foreach($q2 as $r2) {
                    $body = $r1['body'];
                    $body = str_replace('#uname#',_h($r2['uname']),$body);
                    $body = str_replace('#email#',_h($r2['email']),$body);
                    $body = str_replace('#fname#',_h($r2['fname']),$body);
                    $body = str_replace('#lname#',_h($r2['lname']),$body);
                    $body = str_replace('#personID#',_h($r2['personID']),$body);
                    
                    $bind2 = [ 
                                "personID" => _h($r1['personID']),
                                "uname" => _h($r2['uname']),
                                "lname" => _h($r2['lname']),
                                "email" => _h($r2['email']),
                                "fname" => _h($r2['fname']),
                                "fromName" => _h($r1['fromName']),
                                "fromEmail" => _h($r1['fromEmail']),
                                "subject" => _h($r1['subject']),
                                "holdID" => _h($r1['id']),
                                "body" => $body 
                             ];
                    $q4 = DB::inst()->insert("email_queue",$bind2);
                }
            }
        }
        if($q4) {
            $update = [ "processed" => '1',"dateTime" => $dt ];
            DB::inst()->update("email_hold",$update,"id = :holdID AND processed = '0'",$bind1);
        }
    }
    
    public function runEmailQueue() {
        $q = DB::inst()->select('email_queue','sent = "0"');
        $sDate = date('Y-m-d');
        foreach($q as $k => $r) {
            if(Hooks::has_action('etMailer_init','et_smtp')) {
                $this->_email->IsSMTP();
                $this->_email->Mailer = "smtp";
                $this->_email->Host = _h(Hooks::get_option('et_smtp_host'));
                $this->_email->SMTPSecure = _h(Hooks::get_option('et_smtp_smtpsecure'));
                $this->_email->Port = _h(Hooks::get_option('et_smtp_port'));
                $this->_email->SMTPAuth = (_h(Hooks::get_option("et_smtp_smtpauth")) == "yes") ? TRUE : FALSE;
                    if($this->_email->SMTPAuth) {
                        $this->_email->Username = _h(Hooks::get_option('et_smtp_username'));
                        $this->_email->Password = _h(Hooks::get_option('et_smtp_password'));
                    }
                    $this->_email->AddAddress($r['email'],$r['lname'].', '.$r['fname']);
					$this->_email->From = $r['fromEmail'];
					$this->_email->FromName = $r['fromName'];
					$this->_email->Sender = $this->_email->From; //Return-Path
	                $this->_email->AddReplyTo($this->_email->From,$this->_email->FromName); //Reply-To
					$this->_email->IsHTML(true);
					$this->_email->Subject = $r['subject'];
					$this->_email->Body = $r['body'];
					$this->_email->Send();
					$this->_email->ClearAddresses();
					$this->_email->ClearAttachments();
			} else {
				$this->_email->AddAddress($r['email'],$r['lname'].', '.$r['fname']);
				$this->_email->From = $r['fromEmail'];
				$this->_email->FromName = $r['fromName'];
				$this->_email->Sender = $this->_email->From; //Return-Path
                $this->_email->AddReplyTo($this->_email->From,$this->_email->FromName); //Reply-To
				$this->_email->IsHTML(true);
				$this->_email->Subject = $r['subject'];
				$this->_email->Body = $r['body'];
				$this->_email->Send();
				$this->_email->ClearAddresses();
				$this->_email->ClearAttachments();
            }
            $update = [ "sent" => '1',"sentDate" => $sDate ];
            $bind = [ ":id" => $r['id'] ];
            DB::inst()->update("email_queue",$update,"id = :id AND sent = '0'",$bind);
        }
    }
    
    public function purgeEmailHold() {
        $today = date('Y-m-d');
        //$current_date = strtotime($today);
        /* 5 days after processing date */
        //$expire = date("Y-m-d",$current_date+=432000);
        $bind = [ ":expire" => $today ];
        $q = DB::inst()->delete( 'email_hold','processed = "1" AND DATE_ADD(dateTime, INTERVAL 5 DAY) <= :expire', $bind );
    }
    
    public function purgeEmailQueue() {
        $q = DB::inst()->delete('email_queue','sent = "1"');
    }
    
    public function updateStuTerms() {
        $q1 = DB::inst()->query( "SELECT 
                    SUM(a.attCred) as Credits,
                    a.stuID as stuAcadCredID,
                    a.termCode as termAcadCredCode,
                    a.acadLevelCode as acadCredLevel,
                    b.stuID AS stuTermID,
                    b.termCode AS TermCode,
                    b.acadLevelCode as termAcadLevel,
                    b.termCredits AS TermCredits 
                FROM 
                    stu_acad_cred a 
                LEFT JOIN 
                    stu_term b 
                ON 
                    a.stuID = b.stuID 
                WHERE 
                    a.termCode = b.termCode 
                AND 
                    a.acadLevelCode = b.acadLevelCode 
                GROUP BY 
                    a.stuID,a.termCode"
        );
        
        foreach($q1 as $r) {
            if($r['Credits'] != $r['TermCredits']) {
                $update = [ 
                        "termCredits" => $r['Credits'] 
                        ];
                        
                $bind = [ 
                        ":stuID" => $r['stuTermID'],":termCode" => $r['TermCode'],
                        ":acadLevelCode" => $r['termAcadLevel']
                        ];
                        
                $q2 = DB::inst()->update( 
                                "stu_term",
                                $update,
                                "stuID = :stuID 
                            AND 
                                termCode = :termCode 
                            AND 
                                acadLevelCode = :acadLevelCode",
                            $bind
                );
            }
        }
    }
    
    public function updateStuLoad() {
        $q1 = DB::inst()->query( "SELECT 
                    a.termCredits,
                    a.stuID AS StudentID,
                    a.termCode AS TermCode,
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
                    a.termCode = b.termCode 
                AND 
                    a.acadLevelCode = b.acadLevelCode" 
        );
        foreach($q1 as $r1) {
            if($r1['termLatest'] > $r1['stuTermLatest']) {
            $update = [ "stuLoad" => getstudentload(_h($r1['TermCode']),_h($r1['termCredits']),_h($r1['AcademicLevel'])) ];
            
            $bind = [ 
                    ":stuID" => $r1['StudentID'],":termCode" => $r1['TermCode'],
                    ":acadLevelCode" => $r1['AcademicLevel']
                    ];
                    
                DB::inst()->update( 
                            "stu_term_load",
                            $update,
                            "stuID = :stuID 
                        AND 
                            termCode = :termCode 
                        AND 
                            acadLevelCode = :acadLevelCode",
                        $bind
                );
            }
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
    
    public function runGraduation() {
        $array1 = [];
        $array2 = [];
        $date = date("Y-m-d");
        $q1 = DB::inst()->query( "SELECT 
                    a.id,
                    a.queryID,
                    a.gradDate,
                    b.savedQuery 
                FROM 
                    graduation_hold a 
                LEFT JOIN 
                    saved_query b 
                ON 
                    a.queryID = b.savedQueryID" 
        );
        foreach($q1 as $r1) {
            $array1[] = $r1;
        }
        
        /**
         * If the above query has at least one row, 
         * then process the savedQuery.
         */ 
        if($q1->rowCount() > 0) {
            $query = $r1['savedQuery'];
            $q2 = DB::inst()->query( "$query" );
        }
        
        /**
         * If the savedQuery above is successful, 
         * then graduate the students from the query.
         */ 
        if($q2) {
            foreach($q2 as $r2) {
                $update = [ 
                            "graduationDate" => $r1['gradDate'],
                            "currStatus" => 'G', "statusDate" => $date,"endDate" => $date
                          ];
                $bind = [ ":stuID" => $r2['stuID'] ];
                DB::inst()->update( "stu_program",$update,"stuID = :stuID",$bind );
            }
        }
        /* Delete records from graduation_hold after above queries have been processed. */
        DB::inst()->query( "TRUNCATE graduation_hold" );
    }
    
    public function runTermGPA() {
        $q = DB::inst()->query( "SELECT 
                        b.stuID,
                        b.termCode,
                        b.acadLevelCode,
                        SUM(b.attCred) AS Attempted,
                        SUM(b.compCred) AS Completed,
                        SUM(b.gradePoints) AS Points,
                        SUM(b.attCred*b.gradePoints)/SUM(b.attCred) AS GPA 
                    FROM 
                        grade_scale a 
                    LEFT JOIN 
                    	stu_acad_cred b 
                	ON 
                		a.grade = b.grade 
                    WHERE 
                        a.count_in_gpa = '1' 
                    AND 
                    	a.status = '1' 
                    AND 
                    	b.grade <> 'NULL' 
                	GROUP BY 
                		b.stuID,b.termCode,b.acadLevelCode" 
        );
        if($q->rowCount() > 0) {
        	foreach($q as $r) {
        		$bind = [ 
        					"stuID" => $r['stuID'],"termCode" => $r['termCode'],
        					"acadLevelCode" => $r['acadLevelCode'],"attCred" => $r['Attempted'],
        					"compCred" => $r['Completed'],"gradePoints" => $r['Points'],
        					"termGPA" => $r['GPA']
    					];
        		DB::inst()->insert("stu_term_gpa",$bind);
        	}
        }
    }
    
    public function runDBBackup() {
        $dbhost = DB_HOST;
        $dbuser = DB_USER;
        $dbpass = DB_PASS;
        $dbname = DB_NAME;
        $backupFile = HOLD_FILE_LOC . $dbname . '-' . date("Y-m-d-H-i-s") . '.gz';
		if(!file_exists($backupFile)) {
	        $command = "mysqldump --opt -h $dbhost -u $dbuser -p$dbpass $dbname | gzip > $backupFile";
	        system($command);
		}
        
        $files = glob( HOLD_FILE_LOC."*.gz" );
        foreach($files as $file) {
            if(is_file($file)
            && time() - filemtime($file) >= 20*24*3600) { // 20 days
                unlink($file);
            }
        }
    }
    
    public function updateTermGPA() {
        $array = [];
        $q1 = DB::inst()->query( "SELECT 
                    a.stuID,
                    a.termCode,
                    a.acadLevelCode,
                    SUM(a.gradePoints) AS GradePoints,
                    SUM(b.attCred) AS Attempted,
                    SUM(b.compCred) AS Completed,
                    SUM(b.gradePoints) AS termGradePoints,
                    SUM(b.attCred*b.gradePoints) AS Points 
                FROM 
                    stu_term_gpa a 
                LEFT JOIN 
                    stu_acad_cred b 
                ON 
                    a.stuID = b.stuID 
                LEFT JOIN 
                	grade_scale c 
            	ON 
            		b.grade = c.grade 
                WHERE 
                    a.termCode = b.termCode 
                AND 
                	b.grade <> 'NULL' 
        		AND 
        			c.count_in_gpa = '1' 
    			AND 
    				c.status = '1' 
                AND 
                    a.acadLevelCode = b.acadLevelCode 
                GROUP BY 
                	a.stuID,a.termCode,a.acadLevelCode" 
        );
        foreach($q1 as $r1) {
            if($r1['GradePoints'] != $r1['termGradePoints']) {
                //$points = $r1['Completed']*$r1['termGradePoints'];
                $GPA = $r1['Points']/$r1['Attempted'];
                $update = [ 
                            "attCred" => $r1['Attempted'],
                            "compCred" => $r1['Completed'],
                            "gradePoints" => $r1['termGradePoints'],
                            "termGPA" => $GPA
                        ];
                $bind = [ ":stuID" => $r1['stuID'],":termCode" => $r1['termCode'],":level" => $r1['acadLevelCode'] ];
                $q2 = DB::inst()->update( 'stu_term_gpa',$update,'stuID = :stuID AND termCode = :termCode AND acadLevelCode = :level',$bind );
            }
        }
    }
    
    public function purgeErrorLog() {
        $today = date('Y-m-d');
        $bind = [ ":expire" => $today ];
        $q = DB::inst()->delete( 'error','DATE_ADD(addDate, INTERVAL 5 DAY) <= :expire', $bind );
    }
    
    public function purgeSavedQuery() {
        $today = date('Y-m-d');
        $bind = [ ":expire" => $today, ":purge" => '1' ];
        $q = DB::inst()->delete( 'saved_query','DATE_ADD(createdDate, INTERVAL 30 DAY) <= :expire AND purgeQuery = :purge', $bind );
    }
    
    public function purgeCronLogs() {
        $q = DB::inst()->query( "TRUNCATE cronlog" );
    }
    
    public function __destruct() {
        DB::inst()->close();
    }

}