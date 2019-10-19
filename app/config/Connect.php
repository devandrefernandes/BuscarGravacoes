<?php 

class Connection { 
	public static $instance; 
    
    private function __construct() 
    { 
        //
    }
     
    public static function getInstance() 
    { 
        if (!isset(self::$instance)) 
        { 
            $host = '';
            $user = '';
            $pass = '';
            $db   = '';

			self::$instance = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass, []); 
			self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING); 
		} 
		return self::$instance; 
    } 
}
?>