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


// Fetch classes for the upcoming week
$current_date = date("Y-m-d");
$next_week_date = date("Y-m-d", strtotime("+1 week"));

$sql = "SELECT * FROM class_events WHERE event_date BETWEEN '$current_date' AND '$next_week_date' ORDER BY event_date, event_time";
$result = mysqli_query($conn, $sql);

$upcoming_classes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $upcoming_classes[] = $row;
}


?>

  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Upcoming Classes</h1>
  </div>
  
  <h2>Upcoming Classes this week</h2>
  <table class="table table-bordered table-striped">
      <thead>
          <tr>
              <th>ID</th>
              <th>Course ID</th>
              <th>Teacher ID</th>
              <th>Event Name</th>
              <th>Event Date</th>
              <th>Event Time</th>
              <th>Event Duration</th>
              <th>Event Description</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($upcoming_classes as $class) : ?>
              <tr>
                  <td><?= $class['id'] ?></td>
                  <td><?= $class['course_id'] ?></td>
                  <td><?= $class['teacher_id'] ?></td>
                  <td><?= $class['event_name'] ?></td>
                  <td><?= $class['event_date'] ?></td>
                  <td><?= $class['event_time'] ?></td>
                  <td><?= $class['event_duration'] ?></td>
                  <td><?= $class['event_description'] ?></td>
              </tr>
          <?php endforeach; ?>
      </tbody>
  </table>

  <!-- (additional content, if any, can go here) -->
  <a href="edit_users.php">Edit Users</a>
  
