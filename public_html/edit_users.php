<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'admin') {
    header("Location: login.php");
    exit;
}

$page_title = "Edit Users";

require_once 'includes/header.php';
require_once 'db_connect.php';

// Fetch all users
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h1>Edit Users</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>User Type</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Education Level</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['user_type']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['education_level']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td>
                        <?php echo $row['address_street'] . ", " . $row['address_city'] . ", " . $row['address_state'] . " " . $row['address_zip']; ?>
                    </td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>

<?php
include 'includes/footer.php';
?>
