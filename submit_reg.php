<?php
include 'database_class.php';
include 'conf.php';
include 'log.php';

class register {
	var 	$conf_file;
	var		$db;
	var		$array;
	
	
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
		$this->array["register"] = TRUE;
		$this->array["user"] = $_POST["user_name"];
		$this->array["password"] = $_POST["password1"];
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
$main = new register("./conf.xml", $ret);
if ($ret == FALSE) {
	exit();
}

$ret = $main->run();
if ($ret == 0) {
//	printf("register sucess");
	setcookie("user", $_POST["user_name"], time() + 3600);
	header("Location:/main_page.php");
} else {
	printf("register fail");
}
$main->stop();
?>

