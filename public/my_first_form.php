<?php

	var_dump($_POST);
	var_dump($_GET);

?>

<html>
<head>
	<title>My First Form</title>
</head>
<body>
	<h2>Login</h2>
	<form method="POST" action="/my_first_form.php">
	    <p>
	        <label for="username">Username</label>
	        <input id="username" name="username" type="text" placeholder="whatcho name?"/>
	    </p>
	    <p>
	        <label for="password">Password</label>
	        <input id="password" name="password" type="password" placeholder="gimme dat password!"/>
	    </p>
	    <input type="submit">

	</form>

	<h2>Compose an Email</h2>
	<form method="POST" action="/my_first_form.php">
		<p>
			<label for="to">To: </label>
			<input type="email" id="to" name="to" placeholder="test@example.com" />
		</p>
		<p>
			<label for="from">From: </label>
			<input type="email" id="from" name="from" placeholder="test@example.com" />
		</p>
		<p>
			<label for="subject">Subject: </label>
			<input type="text" id="subject" name="subject" />
		</p>
		<p>
			<label for="body">Body: </label>
			<textarea id="body" name="body" placeholder="Email Body..."></textarea>
		</p>
		<input type="submit" />
	</form>
</body>
</html>