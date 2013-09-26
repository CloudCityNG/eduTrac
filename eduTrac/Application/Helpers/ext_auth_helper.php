<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac Auth Helper
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

use \eduTrac\Classes\Libraries\Hooks;
use \eduTrac\Classes\Core\DB;
 	
 	function hasPermission($perm) {
    	$auth = new \eduTrac\Classes\Libraries\Cookies;
		$acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
		
		if($acl->hasPermission($perm) || $acl->userHasRole(8)) {
			return true;
		} else {
			return false;
		}
	}
    
    function ae($perm) {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if(!$acl->hasPermission($perm) && !$acl->userHasRole(8)) {
            return ' style="display:none"';
        }
    }
    
    /**
     * General Inquiry only on Forms.
     */
    function gio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('general_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * General inquiry disable submit buttons.
     */
    function gids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('general_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Course Inquiry only.
     */
    function cio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('course_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Course inquiry disable submit buttons.
     */
    function cids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('course_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Course Sec Inquiry only.
     */
    function csio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('course_sec_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Course Sec disable submit buttons.
     */
    function csids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('course_sec_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Academic Program Inquiry only.
     */
    function apio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('acad_prog_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Acacemic Program disable submit buttons.
     */
    function apids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('acad_prog_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Address Inquiry only.
     */
    function aio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('address_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Address disable submit buttons.
     */
    function aids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('address_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Faculty Inquiry only.
     */
    function fio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('faculty_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Faculty disable submit buttons.
     */
    function fids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('faculty_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Student Inquiry only.
     */
    function sio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('student_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Student disable submit buttons.
     */
    function sids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('student_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Staff Inquiry only.
     */
    function staio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('student_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Staff disable submit buttons.
     */
    function staids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('student_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }
    
    /**
     * Person Inquiry only.
     */
    function pio() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('person_inquiry_only') && !$acl->userHasRole(8)) {
            return ' readonly="readonly"';
        }
    }
    
    /**
     * Person disable submit buttons.
     */
    function pids() {
        $auth = new \eduTrac\Classes\Libraries\Cookies;
        $acl = new \eduTrac\Classes\Libraries\ACL($auth->getPersonField('personID'));
        
        if($acl->hasPermission('person_inquiry_only') && !$acl->userHasRole(8)) {
            return ' style="display:none;"';
        }
    }