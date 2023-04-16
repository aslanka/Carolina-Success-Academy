<?php
// Start a session
session_start();

// Include database connection file
include 'db_connect.php';

// Check if the form was submitted
if (isset($_POST['submit'])) {
	// Get the user's username and password
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	// Query the database for the user
	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result = mysqli_query($conn, $query);

	// If the user was found, log them in
if (mysqli_num_rows($result) == 1) {
	// Get the user's data
	$row = mysqli_fetch_assoc($result);

	// Set session variables
	$_SESSION['user_id'] = $row['id'];
	$_SESSION['username'] = $row['username'];
	$_SESSION['user_type'] = $row['user_type'];

	// Redirect to the dashboard page
	header("Location: dashboard.php");
	exit;
}
 else {
		// If the user wasn't found, show an error message
		echo "Invalid username or password.";
	}
}
?>

<?php
// Set the page title
$page_title = "Login";
?>

<?php include 'includes/header.php'; ?>

<form method="post" action="login.php">
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" required>

	<label for="password">Password:</label>
	<input type="password" name="password" id="password" required>

	<input type="submit" name="submit" value="Login">
</form>

<p>Don't have an account? <a href="register.php">Register now.</a></p>
