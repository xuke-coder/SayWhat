<?php

class output {
	var			$errno;
	var			$data;
	var			$msg;
	var			$interval;
	var			$result_array;

	function print_result()
	{

	}
}

class table extends output{
	var			$table_name;
	var			$query_str;
	var			$query_result;
	var			$log;
	var			$conf;


	function __construct(&$log, &$conf) {
		$this->log = $log;
		$this->conf = $conf;
	}
	
	function get_table($array)
	{
		
	}

	function do_query_sql()
	{
		$this->log->log_write($this->query_str, 'LOG_LEVEL_INFO', 1);

		$this->query_result = mysql_query($this->query_str);
		
		if ($this->query_result == false) {
			return false;
		}
		return true;
	}

	function generate_query_str($array)
	{
	}


	function get_result($array)
	{

	}

	function run($array)
	{

		$ret = $this->get_table($array);
		if (!$ret)
			goto error;

		$ret = $this->generate_query_str($array);
		if (!$ret) {
			goto error;
		}

		$ret = $this->do_query_sql();
		if ($ret == false) {
			return false;
		}

		return $this->get_result($array);

	error:
		$this->print_result();
	}

}




?>