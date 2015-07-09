<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content = "text/html; charset=utf-8" />
		<title>edit</title>	
	</head>
	
	<body>
		<form name = "fm_text" method = "post" action = "submit_text.php">
			<table>
				<tr>
					<td>user:<?php echo $_COOKIE["user"];?></td>
				</tr>
				<tr>
					<td>标题</tr>
				</tr>
				<tr>
					<td><input type = "textbox" name = "title1" id = "title1" value = "" size = "50"/></td><br />
				</tr>
				<tr>
					<td>内容</td>
				</tr>
				<tr>
					<td><textarea name = "content" id = "content" rows = "20" cols = "100"></textarea></td><br />
				</tr>
				<tr>
					<td><input type = "submit" value = "提交"/></td>
				</tr>
			</table>	
		</form>
	</body>
</html>

<?php



?>
