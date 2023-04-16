<?php
// Start a session
session_start();

// Check if the user is an admin
if ($_SESSION['user_type'] != 'admin') {
	header("Location: dashboard.php");
	exit;
}

// Connect to the SQL database
// Replace with your own database connection details
include 'db_connect.php';


// Process the form submissions

?>

<h2>Create New Class</h2>
<form method="post">
	<label for="class_name">Class Name:</label>
	<input type="text" name="class_name" id="class_name" required>
	<input type="submit" name="add_class" value="Create Class">
</form>

<h2>Assign Students to Parents and Tutors</h2>
<form method="post">
	<label for="student_id">Student ID:</label>
	<input type="number" name="student_id" id="student_id" required>

	<label for="parent_id">Parent ID:</label>
	<input type="number" name="parent_id" id="parent_id" required>

	<label for="tutor_id">Tutor ID:</label>
	<input type="number" name="tutor_id" id="tutor_id" required>

	<input type="submit" name="assign_students" value="Assign">
</form>

<h2>Set Class Schedule</h2>
<form method="post">
	<label for="class_id">Class ID:</label>
	<input type="number" name="class_id" id="class_id" required>

	<label for="class_date">Class Date:</label>
	<input type="date" name="class_date" id="class_date" required>

	<label for="class_time">Class Time:</label>
	<input type="time" name="class_time" id="class_time" required>

	<input type="submit" name="set_class_schedule" value="Set Schedule">
</form>
