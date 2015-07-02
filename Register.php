<?php



?>

<!DOCTYPE html>
<html>
	<head>
		<title>Register Page</title>
		<!--css-->
		<link rel = "stylesheet" type = "text/css" href = "css/good.css" />
		
		<!--js-->
		<script type = "text/JavaScript" src = "js/validate.js"></script>
		<script type = "text/JavaScript">
			function validate(form) {
				if (validate_user_id(form.user_name) == false) {
					return false;
				}
				
				if (validate_password(form.password1) == false) {
					return false;
				}
				
				if (form.password1.value != form.password2.value) {
					form.password2.nextSibling.innerHTML = "password not match";
					return false;
				}
				
			}
		</script>
	</head>
	
	<body>
		<form name = "register_form" method = "post" action = "submit_reg.php"
			onsubmit = "return validate(this)">
			<div>
				<label for = "user_name"> UserName: </label>
				<input type = "text" name = "user_name" id = "user_name" size = "12"/><span
					class = "message"></span>
			<div>
			<div>
				<label for = "password"> Password: </label>
				<input type = "password" name = "password1" id = "password1" size = "12"/><span
					class = "message"></span>
			</div>
			<div>
				<label for = "password"> Confirm Password: </label>
				<input type = "password" name = "password2" id = "password2" size = "12"/><span
					class = "message"></span>
			</div>
			<div>
				<input type = "submit" value = "Log in"/>
			</div>
		</form>
	</body>
</html>