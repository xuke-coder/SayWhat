<?php

include 'database_class.php';
include 'conf.php';
include 'log.php';


class submit_text {
	var 	$conf_file;
	var 	$db;
	var 	$array;
	
	function __construct($conf_file, &$ret)
	{
		$this->conf_file = $conf_file;
		$this->array = array();
		
		$this->db = new DataBase($conf_file, $ret);
		if ($ret == FALSE) {
			return;
		}
	}
	
	function generate_query_array()
	{
		$this->array["insert"] = TRUE;
		$this->array["article"] = TRUE;
		$this->array["user"] = $_COOKIE["user"];
		$this->array["title"] = $_POST["title1"];
		$this->array["content"] = $_POST["content"];
		
	}
	
	function run()
	{
		$this->generate_query_array();
		
		return $this->db->DB_request_handler($this->array);
	}
	
	function stop()
	{
		$this->db->DB_close_mysql();
	}

}

$ret = "";
$main = new submit_text("./conf.xml", $ret);
if ($ret == FALSE) {
	exit();
}

$ret = $main->run();

if ($ret == 0) {
	//printf("submit sucess");
	header("Location:/main_page.php");
} else {
	printf("submit fail");
}
$main->stop();

?>
