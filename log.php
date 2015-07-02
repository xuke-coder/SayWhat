<?php

const LOG_LEVEL_INFO = 0x000001;
const LOG_LEVEL_ERROR = 0x000002;

class log {
	var 	$log_path;
	var		$handle;
	
	function __construct($log_path)
	{
		date_default_timezone_set("Asia/Chongqing");
		$this->log_path = $log_path;
		$this->handle = "";
	}
	
	function log_open()
	{
		if (!$this->log_path) {
			
			return FALSE;
		}

		if ($this->handle) {
			return TRUE;
		}

		$ret = $this->create_folders($this->log_path);

		if (substr($this->log_path, -1, 1) == '/') {
			$this->log_path = substr($this->log_path, 0, strlen($this->log_path) - 1); 
		}
		
		$log_file = $this->log_path . "/" . date("Y-m-d");

		$this->handle = fopen($log_file, "a");

		if (!$this->handle) {
			return FALSE;
		}

		return TRUE;
	}
	
	function log_write($msg, $level, $debug)
	{
		$ret = $this->log_open();
		if (!$ret) {
			return FALSE;
		}

		if (!$this->handle) {
			goto close;
		}

		if ($debug != "1") {
			goto close;
		}

		$t = time();
		if ($level == LOG_LEVEL_INFO) {
			$le = "[INFO]";
		} 
		if ($level == LOG_LEVEL_ERROR) {
			$le = "[ERROR]";
		}
		$buf = date("[Y-m-d-h-i-s]") . $le . " : " . $msg . "\n";
		$ret = fwrite($this->handle, $buf);
	
	close:
		$this->log_close();
		return TRUE;
	}
	
	function log_close()
	{
		if (!$this->handle) {
			return FALSE;
		}
		$ret = fclose($this->handle);
		
		if (!$ret) {
			return FALSE;
		}
		
		$this->handle = "";
		return TRUE;
	}
	
	function create_folders($dir)
	{
		return is_dir($dir) or ($this->create_folders(dirname($dir)) and mkdir($dir, 0777));  
	}
	
	function __destruct() 
	{
		if ($this->handle) {
			$this->log_close();
		}
	}
}

?>
