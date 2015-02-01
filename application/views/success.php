<html>
</head>
<html lang='en'>
<head>
	<title>Welcome</title>
	<style type="text/css">
		*{
			font-family: sans-serif;
		}
		.error{color:red;}
		.success{color:green;}
	</style>
</head>
<body>
	<p>Welcome <?= $user['first_name'] ?></p>
	<fieldset>
		<legend>User Information</legend>
		<p>First Name: <?= $user['first_name'] ?> </p>
		<p>Last Name: <?= $user['last_name'] ?> </p>
		<p>Email Address: <?= $user['email'] ?></p>
		<a href='/Registrars/logoff'>log off</a>
	</fieldset>
</body>
</html>