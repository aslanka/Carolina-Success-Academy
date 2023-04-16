<?php
// Start a session
session_start();

// Include database connection file
include 'db_connect.php';

// Check if the form was submitted
if (isset($_POST['submit'])) {
	// Get the user's username, password, email, and user type
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

	// Query the database to check if the username already exists
	$query = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($conn, $query);

	// If the username is already taken, show an error message
	if (mysqli_num_rows($result) > 0) {
		echo "That username is already taken.";
		exit;
	}

	// Insert the new user into the database
	$query = "INSERT INTO users (username, password, email, user_type) VALUES ('$username', '$password', '$email', '$user_type')";
    $result = mysqli_query($conn, $query);

	// If the user was added successfully, log them in
	if ($result) {
		// Get the user's ID
		$user_id = mysqli_insert_id($conn);

		// Set session variables
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['user_type'] = $user_type;

		// Redirect to the home page
		header("Location: index.php");
		exit;
	} else {
		// If there was an error, show an error message
		echo "An error occurred while registering. Please try again.";
	}
}
?>

<form method="post" action="register.php">
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" required>

	<label for="password">Password:</label>
	<input type="password" name="password" id="password" required>

	<label for="email">Email:</label>
	<input type="email" name="email" id="email" required>

	<label for="user_type">User type:</label>
	<select name="user_type" id="user_type" required>
		<option value="">Select user type</option>
		<option value="admin">Admin</option>
		<option value="tutor">Tutor</option>
		<option value="student">Student</option>
		<option value="parent">Parent</option>
	</select>

	<input type="submit" name="submit" value="Register">
</form>
