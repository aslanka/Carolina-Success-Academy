<?php
// Start a session
session_start();

// Check if the user is an admin or tutor

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

<!DOCTYPE html>
<html>
<head>
	<title>Tutor Admin Page</title>
	<!-- Include FullCalendar CSS and JS files -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
</head>
<body>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    	<h1 class="h2">Upcoming Classes</h1>
  	</div>

  	<!-- Create a div for the FullCalendar calendar -->
  	<div id="calendar"></div>

  	<!-- Display the table of upcoming classes as in the previous code snippet -->
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

  	<!-- Initialize FullCalendar on the calendar div -->
  	<script>
  		$(document).ready(function() {
  			$('#calendar').fullCalendar({
  				// Set the calendar options
  				header: {
  					left: 'prev,next today',
  					center: 'title',
  					right: 'month,agendaWeek,agendaDay'
},
defaultView: 'month',
events: [
// Add the events to the calendar
<?php foreach ($upcoming_classes as $class) : ?>
{
title: '<?= $class['event_name'] ?>',
start: '<?= $class['event_date'] ?>T<?= $class['event_time'] ?>',
duration: '<?= $class['event_duration'] ?>:00',
url: 'view_class.php?id=<?= $class['id'] ?>'
},
<?php endforeach; ?>
],
eventClick: function(event) {
// Open the event's URL in a new tab when clicked
window.open(event.url, '_blank');
return false;
}
});
});
</script>
<!-- Add links to other pages as needed -->
<a href="edit_users.php">Edit Users</a>
</body>
</html>
