<?php
// Set the page title
$page_title = "Contact Us";
?>

<?php include('includes/header.php'); ?>

<!-- Start of Contact Section -->
<div class="container">
  <div class="row">
    <div class="col">
      <h1 class="mt-5">Contact Us</h1>
      <p class="lead">If you have any questions or concerns, please feel free to reach out to us using the contact form below.</p>
      <hr class="my-4">
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <form action="send_email.php" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>
<!-- End of Contact Section -->

<?php include('includes/footer.php'); ?>
