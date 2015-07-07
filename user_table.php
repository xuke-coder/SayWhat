<?php

class user_table extends table {
	
	function get_table($array)
	{
		$this->table_name = "user";
		
		return TRUE;
	}
	
	function generate_query_str($array)
	{
		if ($array["insert"]) {
			if (!$array["user"] || !$array["password"]) {
				return FALSE;
			}
			$where_str = "user_name = " . '"' . $array["user"] . '"';
			$this->query_str = "select user_name, password from $this->table_name where $where_str";
			
			$ret = $this->do_query_sql();
			$ret = $this->get_result($array);

			if ($ret != 0) {
				print("already in use  ");
				return -1;
			}

			$values = '"' . $array["user"] . '"' . ", " . '"'. $array["password"] . '"';
			$this->query_str = "insert into $this->table_name (user_name, password) values($values)";
		}
		
		if ($array["select"]) {
			$where_str = "user_name = " . '"' . $array["user"] . '"';
			$this->query_str = "select user_name, password from $this->table_name where $where_str";
		}
		
		return TRUE;
	}
	
	
	//按规定顺序打印
	function get_result($array)
	{
		if (!$this->query_result) {
			return 0;
		}
		
		$row = mysql_fetch_array($this->query_result);

		if (!$row) {

			return 0;
		}
		
		if (strcmp($row["password"], $array["password"]) == 0) {
			return 1;
		} else {

			return -1;
		}
	}

}
?>