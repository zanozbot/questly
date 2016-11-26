window.addEventListener('load', function () {
	document.getElementById('register').addEventListener('submit', validatePasswords);
	document.getElementById('password2').addEventListener('input', validatePasswords);	
});
function validatePasswords(e) {
	var pass1 = document.getElementById('password1').value;
	var pass2 = document.getElementById('password2').value;

	if(pass1 == pass2 ) {
		document.getElementById('status').innerHTML = "&#x2714; ";
		document.getElementById('status').style.color = "green";
	}else {
		e.preventDefault();
		document.getElementById('status').innerHTML = "&#x2716; ";
		document.getElementById('status').style.color = "red";
	}
}