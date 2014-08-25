<?php

	var_dump($_POST);
	var_dump($_GET);

?>

<html>
<head>
	<title>My First Form</title>
</head>
<body>
	<h1>My First HTML Form</h1>
	<form method="POST" action="/my_first_form.php">
	    <p>
	        <label for="username">Username</label>
	        <input id="username" name="username"type="text">
	    </p>
	    <p>
	        <label for="password">Password</label>
	        <input id="password" name="password" type="password">
	    </p>
	    <p>
	        <input type="submit">
	    </p>
	</form>
</body>
</html>