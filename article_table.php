<?php

class article_table extends table {
	function get_table($array)
	{
		$this->table_name = "article";
		
		return TRUE;
	}
	
	function generate_query_str($array)
	{
		if ($array["insert"]) {
			$values = '"' . $array["user"] . '"' . ", " . '"' . $array["title"] . '"' . ", " . '"' . $array["content"] . '"';
			$this->query_str = "insert into $this->table_name (user, title, content) values ($values)";
		}
		
		if ($array["select"]) {
			$values = '"' . $array["user"] . '"';
			$this->query_str = "select title, content from $this->table_name where user = $values";
		}
		
		return TRUE;
	}
	
	function get_result($array)
	{
		$result_list = array();
		
		if ($array["select"]) {
			while ($row = mysql_fetch_array($this->query_result)) {
				$result_list[] = array("title" =>$row["title"], "content" =>$row["content"]);
				
			}

			return $result_list;
		}
	}
}

?>