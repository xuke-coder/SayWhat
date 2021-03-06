<?php
include 'database_class.php';
include 'conf.php';
include 'log.php';

class main_page {
	var 	$conf_file;
	var		$db;
	var		$array;
	var		$page_list;
	
	
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
		$this->array["article"] = TRUE;
		$this->array["user"] = $_COOKIE["user"];
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
$main = new main_page("./conf.xml", $ret);

if ($ret == FALSE) {
	exit();
}

$result_list = $main->run();

/*
for ($i = 0; $i < count($result_list); $i++) {
	$one = $result_list[$i];
	echo $one["title"] . $one["content"];
}
*/
$main->stop();

?>

<!DOCTYPE html>
<html lang = "zh-CN">
	<head>
		<title> 我的博客</title>
		<meta http-equiv = "Content-Type" content= "text/html; charset=gb2312">
	</head>


	<body>
		<?php
		if ($result_list != false) {
			for ($i = 0; $i < count($result_list); $i++) {
				$one = $result_list[$i];
				$title = iconv('UTF-8', 'GB2312', $one["title"]);
				$content = iconv('UTF-8', 'GB2312', $one["content"]);
				echo "<p><b>" . "标题：" . "</b>" . $title . "<b>作者：</b>" . $_COOKIE["user"] . "</p>";
				echo "<p><b>" . "内容" . "</b>" . "<br />" . $content . "<br /><br />";
			}
		}
		
		?>
		
		<a href = "edit_text.php">创建新文件</a> 
		
	</body>
		
