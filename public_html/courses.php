<?php
session_start();

// If the user isn't logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

if ($_SESSION['user_type'] != 'admin') {
	header("Location: dashboard.php");
	exit;
}

include 'db_connect.php';

// Add new course
if (isset($_POST['add_course'])) {
	$course_name = $_POST['course_name'];
	$course_description = $_POST['course_description'];

	$sql = "INSERT INTO courses (course_name, course_description) VALUES (?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $course_name, $course_description);
	$stmt->execute();
}

// Remove course
if (isset($_POST['remove_course'])) {
	$course_id = $_POST['course_id'];

	$sql = "DELETE FROM courses WHERE id=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $course_id);
	$stmt->execute();
}

// Fetch courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);

$page_title = "Courses";
?>

<?php include 'includes/header.php'; ?>
</head>
<body>
	<h1>Courses</h1>

	<?php if ($result->num_rows > 0): ?>
		<table>
			<tr>
				<th>ID</th>
				<th>Course Name</th>
				<th>Course Description</th>
			</tr>
			<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['course_name']; ?></td>
					<td><?php echo $row['course_description']; ?></td>
				</tr>
			<?php endwhile; ?>
		</table>
	<?php else: ?>
		<p>No courses available.</p>
	<?php endif; ?>

	<h2>Add Course</h2>
	<form method="POST">
		<label for="course_name">Course Name:</label>
		<input type="text" id="course_name" name="course_name" required>
		<label for="course_description">Course Description:</label>
		<textarea id="course_description" name="course_description" required></textarea>
		<button type="submit" name="add_course">Add Course</button>
	</form>

	<h2>Remove Course</h2>
	<form method="POST">
		<label for="course_id">Course ID:</label>
		<input type="number" id="course_id" name="course_id" required>
		<button type="submit" name="remove_course">Remove Course</button>
	</form>
</body>
</html>
