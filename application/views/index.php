<html>
<head>
	<title>Log in and Registration</title>
</head>
<html lang='en'>
<head>
	<title>login/registration</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		.error{color:red;}
		.success{color:green;}
	</style>
</head>
<body>

<?php if(($error = $this->session->flashdata('errors')) != NULL) echo $error; ?>
	<h2>Register</h2>
	<form action="/registrars/process" method="post">
		First name: <input type="text" name="first_name"><br><br>
		Last name: <input type="text" name="last_name"><br><br>
		Email address: <input type="text" name="email"><br><br>
		Password: <input type="password" name="password"><br><br>
		Confirm Password: <input type="password" name="confirm_password"><br><br>
		<input type="submit" value="register">
		<input type="hidden" name="action" value="register">
	</form>
	<br><br>
	<h2>Login</h2>
	<form action="/registrars/process" method="post">
		Email address: <input type="text" name="email"><br><br>
		Password: <input type="password" name="password"><br><br>
		<input type="submit" value="Login">
		<input type="hidden" name="action" value="login">
	</form>

</body>
</html>