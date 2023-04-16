<?php
// Start a session
session_start();

// If the user isn't logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

// Get the user's ID and username from the session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
// Set the page title
$page_title = "Dashboard";
?>

<?php include 'includes/header.php'; ?>

</head>
<body>
	<h1>Welcome, <?php echo $username; ?>!</h1>
	<p>This is your dashboard page.</p>
	<p>You can add your own content here.</p>
    you are of type <?php echo $user_type; ?>

    <?php
	if ($user_type == 'admin') {
        include 'admin_dashboard.php';
    } elseif ($user_type == 'tutor') {
        include 'tutor_dashboard.php';
    } elseif ($user_type == 'student') {
        include 'student_dashboard.php';
    } elseif ($user_type == 'parent') {
        include 'parent_dashboard.php';
    } else {
        echo "<p>Invalid user type.</p>";
    }    
	?>
</body>
</html>
