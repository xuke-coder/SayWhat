<?php

class conf
{
	var		$server;
	var		$port;
	var		$user;
	var		$password;
	var		$data_base;
	var		$log;
	var		$conf_file;
	var		$debug;
	
	function __construct($conf_file) 
	{
		$this->server = "";
		$this->port = "";
		$this->user = "";
		$this->password = "";
		$this->data_base = "";
		$this->log = "./log";
		$this->conf_file = $conf_file;
		$this->DB_parse_conf();
	}
	
	function DB_parse_conf() 
	{
		$xmlDoc = new DOMDocument();
		
		$ret = $xmlDoc->load($this->conf_file);
		if (!$ret) {
			return FALSE;
		}
		
		$conf = $xmlDoc->getElementsByTagName("conf");
		foreach($conf as $elem) {
			$server = $elem->getElementsByTagName("server");
			$this->server = $server->item(0)->nodeValue;
			
			$port = $elem->getElementsByTagName("port");
			$this->port = $port->item(0)->nodeValue;
			
			$password = $elem->getElementsByTagName("password");
			$this->password = $password->item(0)->nodeValue;
			
			$user = $elem->getElementsByTagName("user");
			$this->user = $user->item(0)->nodeValue;
			
			$data_base = $elem->getElementsByTagName("data_base");
			$this->data_base = $data_base->item(0)->nodeValue;
			
			$log = $elem->getElementsByTagName("log_path");
			$this->log = $log->item(0)->nodeValue;
			
			$debug = $elem->getElementsByTagName("debug");
			$this->debug = $debug->item(0)->nodeValue;
		}
		
		return TRUE;
	}
}

?>