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
			printf($this->query_str);
		}
		
		return TRUE;
	}
}

?>