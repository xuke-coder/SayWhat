function validate_user_id(object) {
	user = document.getElementById(object.id);
	user.nextSibling.innerHTML = "";

	if (user.value.length < 4) {
		user.nextSibling.innerHTML = "user name length must >= 4";
		return false;
	}
	
	if (!(user.value[0] >= 'a' && user.value[0] <= 'z') && 
		!(user.value[0] >= 'A' && user.value[0] <= 'Z')) {
		user.nextSibling.innerHTML = "the first must be char";
	    return false;
	}
	
	for (i = 0; i < user.value.length; i++) {
		if (!(user.value[i] >= 'a' && user.value[i] <= 'z') && 
			!(user.value[i] >= 'A' && user.value[i] <= 'Z') &&
			!(user.value[i] >= '0' && user.value[i] <= '9')) {
			user.nextSibling.innerHTML = "user name length must be char or int";	
			return false;
		}
	}
	
	return true;
}

function validate_password(object) {
	password = document.getElementById(object.id);
	password.nextSibling.innerHTML = "";
	
	if (password.value.length < 8) {
		password.nextSibling.innerHTML = "password length must >= 8";
		return false;
	}
	
	return true;
}