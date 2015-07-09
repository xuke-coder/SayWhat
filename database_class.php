<?php
include 'table.php';
include 'user_table.php';
include 'article_table.php';

class DataBase extends output{
	
	var		$conf;
	var 	$conn;
	var		$log;
	var		$table;
	
	function __construct($conf_file, &$ret) 
	{	
		//$this->errno = DB_ERRNO_NO_ERROR;
		//$this->data = "";
		//$this->msg = get_error_msg(DB_ERRNO_NO_ERROR);
		//$this->interval = 60;
		$this->conf = new conf($conf_file);
		
		$ret = $this->conf->DB_parse_conf();
		
		if (!$ret) {
			//$this->errno = DB_ERRNO_CONF_PARSE_ERROR;
			//$this->msg = get_error_msg(DB_ERRNO_CONF_PARSE_ERROR);
			$ret = FALSE;
			goto error;
		}
		
		$this->log = new log($this->conf->log);
		
		$ret = $this->DB_connect_mysql();
		if (!$ret) {
			$this->log->log_write("connect mysql error", 'LOG_LEVEL_ERROR', $this->conf->debug);
			$ret = FALSE;
			goto error;
		}
		
		$this->log->log_write("connect mysql ok", 'LOG_LEVEL_INFO', $this->conf->debug);
		
		$ret = $this->DB_select_db();
		if (!$ret) {
			$this->log->log_write("select db error", 'LOG_LEVEL_ERROR', $this->conf->debug);
			$ret = FALSE;
			goto error;
		}
		
		$this->log->log_write("select db ok", 'LOG_LEVEL_INFO', $this->conf->debug);
		
		$ret = TRUE;
		
		return;
		
	error:
		$this->print_result();
	}
	
	function __destruct()
	{
		if ($this->conn) {
			$ret = mysql_close($this->conn);
		}
	}
	
	
	function DB_connect_mysql()
	{
		if ($this->conn) {
			return TRUE;
		}
		
		$connection = mysql_connect($this->conf->server . ":" . $this->conf->port, $this->conf->user, $this->conf->password);

		if (!$connection) {
			return FALSE;
		}
		
		$this->conn = $connection;
		return TRUE;
	}
	
	function DB_close_mysql()
	{
		if (!$this->conn) {
			return;
		}
		
		mysql_close($this->conn);
		$this->conn = "";
	}
	
	function DB_select_db()
	{
		if (!$this->conf->data_base) {
			return FALSE;
		}
		
		$link = mysql_select_db($this->conf->data_base, $this->conn);
		if (!$link) {
			return FALSE;
		}
		
		return TRUE;
	}
	
	function DB_request_handler($array)
	{
		if ($array["user"] && $array["password"]) {
			$this->table = new user_table($this->log, $this->conf);
			return $this->table->run($array);
		}
		
		if ($array["insert"] && $array["article"]) {
			$this->table = new article_table($this->log, $this->conf);
			return $this->table->run($array);
		}
		
		if ($array["select"] && $array["article"]) {
			$this->table = new article_table($this->log, $this->conf);
			return $this->table->run($array);
		}
	}
	
}

?>