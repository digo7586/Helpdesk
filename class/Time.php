<?php
class Time extends Database {
    private $dbConnect = false;
	public function __construct(){		
        $this->dbConnect = $this->dbConnect();
    }	
    public function tempo($time) {
       /*  $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade"); */
        $periods = array("segundo", "minuto", "hora", "dia", "semana", "mês", "ano");
        $lengths = array("60","60","24","7","4.35","12");
        $now = time();
        $difference = $now - $time;
        
        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }        
        $difference = round($difference);   
        if($difference != 1) {
            $periods[$j].= "s";
        }
        return $difference . " " . $periods[$j] . " atrás";
    }       
}