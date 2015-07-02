<!DOCTYPE html>
<html lang = "zh-CN">
	<head>
		<title> SayWhat 登录 </title>
		<meta http-equiv = "Content-Type" content= "text/html; charset=UTF-8">
		
		<!--css-->
		<link rel = "stylesheet" type = "text/css" href = "css/good.css" />
		
		<!--js-->
		<script type = "text/JavaScript" src = "js/validate.js"></script>
		
		<script type = "text/JavaScript">
			function check(form) {
				if (validate_user_id(form.userid) == false) {
					return false;
				}
				
				if (validate_password(form.passwd) == false) {
					return false;
				}
			}
			
			function Focusonname() {
				document.enter.userid.focus();
			}
		</script>
		
	</head>
		
			
	<body onload = "javascript:Focusonname();">
		<p><h1 align = "center">Say What Login </h1></p>
		
		<form name = "enter" method = "post" action = "submit_login.php" onsubmit = "return check(this)">
			<div>
				<label for = "userid">UserName: </label>
				<input  type = "text" name = "userid" id = "userid" value = "" size = "20" maxlength = "64"/><span
					class = "message"></span><br /><br />
			</div>
			<div>
				<label for = "passwd">Password: </label>
				<input type = "password" name = "passwd" id = "passwd" value = "" size = "20" maxlength = "64"/><span
					class = "message"></span>
			</div>
			<div>
				<input type = "submit" value = "Enter"/>
			</div>
		</form>
		
		<p>New user? <a href = "Register.php">Register Here</a> | <a href = "ForgetPassword.php">Forget Password</a></p>
	</body>
</html>

<?php

?>