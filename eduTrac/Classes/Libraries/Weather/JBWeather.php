<?php namespace eduTrac\Classes\Libraries\Weather;
if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/*
 * @version     2.0
 * @package     J.B.Weather Widget
 * @copyright   Copyright (C) 2012. All rights reserved.
 * @author      J.B.MARKET <support@jbmarket.net>
 */

class JBWeather {
    protected $params;

    function __construct() {
        defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
    }
    
    function display() {
                
        require (dirname(__FILE__) . DS . "view" . DS . "tmpl.php");
        
        /*
         * Determine user location
         */
        if ($this->params['autoDetect'] == 1):
            $this->params['location'] = $this->detectLocation();
        endif;
        
        $this->_initScript();
    }
    
    function setParams($params) {
        $this->params = $params;
        $this->params["unique"] = $this->unique();
    }
    
    protected function _initScript() {
        
        foreach ($this->params as $opt => $value):
            $params[] = $opt . ':"' . $value . '"';
        endforeach;
        $params = implode(',', $params);
        
        echo "
            <script type='text/javascript'>
                (function($){
                    $(document).ready(function(){
                        new JBWeather('{$this->params["unique"]}').init({{$params}});;
                    });
                })(jQuery);
            </script>
        ";
    }
    
    protected function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet 
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        } return $ip;
    }
    
    private function simplexml_load_file_curl($url) {
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$xml = simplexml_load_string(curl_exec($ch));
	return $xml;
    }
    
    protected function detectLocation() {
        
        
         if ($this->params['detectType'] == 0) {
            /* Autodetect using HOSTIP service */
            
            if ($this->params['curl'] == "1") :
                $xml     = self::simplexml_load_file_curl('http://api.hostip.info/?ip=' . $this->getUserIP());
            else:
                $xml     = simplexml_load_file('http://api.hostip.info/?ip=' . $this->getUserIP());
            endif;
            
            $country = $xml->xpath('//gml:featureMember//Hostip//countryName');
            $city    = $xml->xpath('//gml:featureMember//Hostip//gml:name');

            if ($country[0] != '(Private Address)') :
                if ($city[0] == '(Unknown city)') :
                    return $this->params['location'];
                else:
                    return ucwords($city[0]) . ',' . ucwords($country[0]);
                endif;
            else :
                /* Unable to locate user location; return default */
                return $this->params['location'];
            endif;
        } else if ($this->params['detectType'] == 1) {

            /* Autodetect using geoip database */
            require_once dirname(__FILE__) . "/geoip/geoipcity.inc";
            require_once dirname(__FILE__) . "/geoip/geoipregionvars.php";

            $gi      = geoip_open(dirname(__FILE__) . "/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
            $record  = geoip_record_by_addr($gi, $this->getUserIP());
            $country = isset ($record->country_name) ? $record->country_name : false;
            $city    = isset ($record->city) ? $record->city : "";
            
            if ($country) :
                return ucwords($city) . ', ' . ucwords($country);
            else :
                /* Unable to locate user location; return default */
                return $this->params['location'];
            endif;

            geoip_close($gi);
        } else {
            /* Wrong detection type; return default */
            return $this->params['location'];
        }
    }
    
    public function unique() {
        $valid_chars = "QWERTYUIOPASDFGHJKLZXCVBNM";
        $length = 5;
        $unique = "";
        $num_valid_chars = strlen($valid_chars);
        for ($i = 0; $i < $length; $i++) {
            $random_pick = mt_rand(1, $num_valid_chars);
            $random_char = $valid_chars[$random_pick - 1];
            $unique .= $random_char;
        }
        return $unique;
    }
}