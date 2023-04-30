<?php
// Start a session
session_start();

// If the user isn't logged in, redirect to the login page
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

// Set the page title
$page_title = "Resources";
?>

<?php include 'includes/header.php'; ?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <!-- The same sidebar menu from your dashboard.php page -->
</nav>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <h1 class="mt-4">Resources</h1>
  <p>Welcome to the resources page! Here, you'll find useful materials, links, and tools to help you with your studies.</p>
  
  <!-- You can add your resources here -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-4">
        <div class="card mb-4">
          <img src="path/to/resource-image.jpg" class="card-img-top" alt="Resource Image">
          <div class="card-body">
            <h5 class="card-title">Resource Title</h5>
            <p class="card-text">Resource description goes here.</p>
            <a href="path/to/resource-link" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div>
      <!-- Add more resource cards as needed -->
    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
