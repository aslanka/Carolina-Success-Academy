<?php
// Start a session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Connect to the SQL database
// Replace with your own database connection details
include 'db_connect.php';

// Get the user's data from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Process the form submissions
if (isset($_POST['update_profile'])) {
    // Get the new profile data from the form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $education_level = $_POST['education_level'];
    $bio = $_POST['bio'];
    $phone_number = $_POST['phone_number'];
    $address_street = $_POST['address_street'];
    $address_city = $_POST['address_city'];
    $address_state = $_POST['address_state'];
    $address_zip = $_POST['address_zip'];
    
    // Update the user's data in the database
    $query = "UPDATE users SET first_name='$first_name', last_name='$last_name', education_level='$education_level', bio='$bio', phone_number='$phone_number', address_street='$address_street', address_city='$address_city', address_state='$address_state', address_zip='$address_zip' WHERE username='$username'";
    mysqli_query($conn, $query);
    
    // Redirect to the profile page
    header("Location: profile.php");
    exit;
}
?>

<h2>Edit Profile</h2>
<form method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" value="<?php echo $user_data['username']; ?>" readonly>
    
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo $user_data['first_name']; ?>">
    
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo $user_data['last_name']; ?>">
    
    <label for="education_level">Education Level:</label>
    <select name="education_level" id="education_level">
        <option value="High School" <?php if ($user_data['education_level'] == 'High School') echo 'selected'; ?>>High School</option>
        <option value="College" <?php if ($user_data['education_level'] == 'College') echo 'selected'; ?>>College</option>
        <option value="Graduate School" <?php if ($user_data['education_level'] == 'Graduate School') echo 'selected'; ?>>Graduate School</option>
    </select>
    
    <label for="bio">Bio:</label>
    <textarea name="bio" id="bio"><?php echo $user_data['bio']; ?></textarea>
    
    <label for="phone_number">Phone Number:</label>
    <input type="text" name="phone_number" id="phone_number" value="<?php echo $user_data['phone_number']; ?>">
    
    <label for="address_street">Address Street:</label>
    <input type="text" name="address_street" id="address_street" value="<?php echo $user_data['address_street']; ?>">


    <label for="address_city">Address City:</label>
    <input type="text" name="address_city" id="address_city" value="<?php echo $user_data['address_city']; ?>">

    <label for="address_state">Address State:</label>
    <input type="text" name="address_state" id="address_state" value="<?php echo $user_data['address_state']; ?>">

    <label for="address_zip">Address Zip:</label>
    <input type="text" name="address_zip" id="address_zip" value="<?php echo $user_data['address_zip']; ?>">

    <input type="submit" name="update_profile" value="Update Profile">
    </form>