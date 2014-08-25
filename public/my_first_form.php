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
		<label for="to">To: </label>
		<input type="email" id="to" name="to" placeholder="test@example.com" /><br>

		<label for="from">From: </label>
		<input type="email" id="from" name="from" placeholder="test@example.com" /><br>
	
	
		<label for="subject">Subject: </label>
		<input type="text" id="subject" name="subject" placeholder="Whatchu mean?"/><br>
	
	
		<label for="body">Body: </label>
		<textarea id="body" name="body" placeholder="Whatchu sayin?"></textarea><br>
		
		<label for name="save"><input type="checkbox" name="save" checked>Save a copy to your sent folder?</label><br>
		<input type="submit" />
	</form>
	<h2>Multiple Choice Test</h2>
	<form method="POST" action="/my_first_form.php">
		<ol>	
			<li>What color is the sky?<br>
			<label for="radio1A"><input type="radio" name="colorOfSky" id="radio1A" value="blue">Blue</label><br>
			<label for="radio1B"><input type="radio" name="colorOfSky" id="radio1B" value="green">Green</label><br>
			<label for="radio1C"><input type="radio" name="colorOfSky" id="radio1C" value="orange">Orange</label><br>
			<label for="radio1D"><input type="radio" name="colorOfSky" id="radio1D" value="purple">Purple</label><br>
			</li><br>
			<li>How old are you?<br>
			<label for="radio2A"><input type="radio" name="ageOfUser" id="radio2A" value="10-">Less than 10</label><br>
			<label for="radio2B"><input type="radio" name="ageOfUser" id="radio2B" value="11-17">11-17</label><br>				
			<label for="radio2C"><input type="radio" name="ageOfUser" id="radio2C" value="18-20">18-20</label><br>
			<label for="radio2D"><input type="radio" name="ageOfUser" id="radio2D" value="21+">21+</label><br>
			</li><br>
			<li>What do you need to survive?<br>
			<label for="check1A"><input type="checkbox" name="survivalNeeds[]" id="check1A" value="air">Air</label><br>
			<label for="check1B"><input type="checkbox" name="survivalNeeds[]" id="check1B" value="water">Water</label><br>
			<label for="check1C"><input type="checkbox" name="survivalNeeds[]" id="check1C" value="shelter">Shelter</label><br>
			<label for="check1D"><input type="checkbox" name="survivalNeeds[]" id="check1D" value="tacos">Tacos</label><br>
			</li>
			<li>Are you alive?<br>
				<select name="userAlive[]" multiple>
					<option value="1">Nope</option>
					<option value="2">Yes</option>
					<option value="3">That depends</option>
					<option value="4">Sure, why not?</option>
				</select>
			</li>
		</ol>
		<input type="submit">

	</form>

	<h2>Select Testing</h2>
	<form method="POST" action="/my_first_form.php">
		<label for="canUserRead">Can you read this?</label>
		<select name="canUserRead" id="canUserRead">
			<option value="-1">---- Choose One ----</option>
			<option value="1">Yes</option>
			<option value="0">No</option>
		</select>
		<input type="submit">
	</form>
</body>
</html>