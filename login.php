<!DOCTYPE html>
<html lang = "zh-CN">
	<head>
		<title> SayWhat 登录 </title>
		<meta http-equiv = "Content-Type" content= "text/html; charset=UTF-8">
		
		<!--js-->
		<script type = "text/JavaScript">
			function check() {
				if (!document.enter.userid.value) {
					alert("must input userid!")
					return;
				}
				if (!document.enter.passwd.value) {
					alert("must input passwd")
					return;
				}
			}
			
			function Focusonname() {
				document.enter.userid.focus();
			}
		</script>
		
	</head>
		
			
	<body bgcolor = "#112233" onload = "javascript:Focusonname();">
		<p><h1 align = "center">Say What Login </h1></p>
		
		<form align = "center" name = "enter">
			UserName:
			<input  type = "text" name = "userid" value = "" size = "20" maxlength = "64"/><br /><br />
			Password:
			<input type = "password" name = "passwd" value = "" size = "20" maxlength = "64"/><br /><br />
			<input type = "button" value = "Enter" onclick = "check()"/><input type = "submit" value = "Register"/>
		</form>
	</body>
</html>

<?php

?>