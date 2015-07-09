<?php
include 'database_class.php';
include 'conf.php';
include 'log.php';

class login {
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
		$this->array["select"] = TRUE;
		$this->array["user"] = $_POST["userid"];
		$this->array["password"] = $_POST["password"];
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
$main = new login("./conf.xml", $ret);
if ($ret == FALSE) {
	exit();
}

$ret = $main->run();
if ($ret == 1) {
	//printf("login sucess");
	setcookie("user", $_POST["userid"], time() + 3600);
	//header("Location:/edit_text.php");
	header("Location:/main_page.php");
} else {
	printf("login fail");
}

$main->stop();
?>

