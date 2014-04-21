<?php namespace eduTrac\Classes\Models;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * Mailer Model
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
use \eduTrac\Classes\Libraries\Cookies;
class MailerModel {
    
    private $_auth;
    private $_sql;
    private $_email;
    private $_log;
    private $_uname;
    
    public function __construct() {
        $this->_auth = new Cookies;
        $this->_sql = new \eduTrac\Classes\DBObjects\SavedQuery;
        $this->_email = new \eduTrac\Classes\DBObjects\EmailTemplate;
        $this->_log = new \eduTrac\Classes\Libraries\Log;
        $this->_uname = $this->_auth->getPersonField('uname');
    }
    
    public function cmgmtList() {
        $bind = [ ":id" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                    a.etID,
                    a.email_key,
                    a.email_name,
                    a.email_value,
                    a.deptCode 
                FROM 
                    email_template a 
                LEFT JOIN 
                    staff b 
                ON 
                    a.deptCode = b.deptCode 
                WHERE 
                    b.staffID = :id",
                $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function deptID() {
        $bind = [ ":id" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                    a.deptCode 
                FROM 
                    department a 
                LEFT JOIN 
                    staff b 
                ON 
                    a.deptCode = b.deptCode 
                WHERE 
                    b.staffID = :id",
                $bind
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function emailTemp($id) {
        $bind = [ ":id" => $id ];
        $q = DB::inst()->select( "email_template","etID = :id","","*",$bind );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function queue() {
        $bind = [ ":id" => $this->_auth->getPersonField('personID') ];
        $q = DB::inst()->query( "SELECT 
                    CASE 
                        a.processed 
                    WHEN 
                        '1' 
                    THEN 
                        'Yes' 
                    ELSE 
                        'No' 
                    END AS 
                        'Status',
                        a.id,
                        a.personID,
                        a.subject,
                        b.savedQueryName 
                    FROM 
                        email_hold a 
                    LEFT JOIN 
                        saved_query b 
                    ON 
                        a.queryID = b.savedQueryID 
                    WHERE 
                        a.personID = :id",
                    $bind 
        );
        foreach($q as $r) {
            $array[] = $r;
        }
        return $array;
    }
    
    public function runTemplate($data) {
        $bind = [ 
                "email_key" => $data['email_key'],
                "email_name" => $data['email_name'],
                "email_value" => $data['email_value'],
                "deptCode" => $data['deptCode']
                ];
                
        $q = DB::inst()->insert("email_template",$bind);
        $ID = DB::inst()->lastInsertId('etID');
        
        if(!$q){ 
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Email Template',$data['email_name'],$this->_uname);
            redirect( BASE_URL . 'mailer/view/' . $ID . '/' . bm() );
        }
    }
    
    public function runEditTemplate($data) {
        $update = [ 
                    "email_key" => $data['email_key'],
                    "email_name" => $data['email_name'],
                    "email_value" => $data['email_value']
                  ];
                  
        $bind = [ ":etID" => $data['etID'],":deptCode" => $data['deptCode'] ];
        $q = DB::inst()->update("email_template",$update,"etID = :etID AND deptCode = :deptCode",$bind);
        if(!$q) {
            redirect( BASE_URL . 'error/update_record/' );
        } else {
            $this->_log->setLog('Update','Email Template',$data['email_name'],$this->_uname);
            redirect( BASE_URL . 'mailer/view/' . $data['etID'] . '/' . bm() );
        }
    }
    
    public function runSchedule($data) {
        $this->_email->Load_from_key($data['etID']);
        $body = $this->_email->getEmailValue();
        $bind = [ 
                "personID" => $data['personID'],"queryID" => $data['queryID'],
                "subject" => $data['subject'],"fromName" => $data['fromName'],
                "fromEmail" => $data['fromEmail'],"body" => $body
                ];
        $q = DB::inst()->insert("email_hold",$bind);
        if(!$q) {
            redirect( BASE_URL . 'error/save_data/' );
        } else {
            $this->_log->setLog('New Record','Email Queue',$data['subject'],$this->_uname);
            redirect( BASE_URL . 'mailer/queue/' . bm() );
        }
    }
    
    public function deleteQueue($id) {
	    $bind = [ ":id" => $id, ":personID" => $this->_auth->getPersonField('personID')];
		$q = DB::inst()->query( "DELETE FROM email_hold WHERE id = :id AND personID = :personID",$bind );
		if(!$q) {
		    redirect( BASE_URL . 'error/delete_record/' );
		} else {
		    redirect( BASE_URL . 'mailer/queue/' . bm() );
		}
	}
    
    public function __destruct() {
        DB::inst()->close();
    }

}