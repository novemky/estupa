<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection settings
$servername = "localhost"; // Change this if necessary
$username = "root";        // Your MySQL username (typically root)
$password = "";            // Your MySQL password (usually empty for local development)
$dbname = "mydb";          // Your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session to manage user login
session_start();

// Assuming user is logged in and their id is stored in session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user's id from the session
$user_id = $_SESSION['user_id'];

// Fetch the current user's data from the database
$sql = "SELECT firstname, lastname, email, password FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($firstname, $lastname, $email, $password);
$stmt->fetch();
$stmt->close();

// Handle the form submission to update the data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_firstname = $_POST['firstname'];
    $new_lastname = $_POST['lastname'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($new_firstname) || empty($new_lastname) || empty($new_email)) {
        echo "<p>Please fill in all fields.</p>";
    } elseif ($new_password !== $confirm_password) {
        echo "<p>Passwords do not match.</p>";
    } else {
        // Update password if a new one is entered, otherwise keep the old one
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql_update = "UPDATE users SET firstname = ?, lastname = ?, email = ?, password = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssssi", $new_firstname, $new_lastname, $new_email, $hashed_password, $user_id);
        } else {
            $sql_update = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("sssi", $new_firstname, $new_lastname, $new_email, $user_id);
        }

        if ($stmt_update->execute()) {
            echo "<p>Profile updated successfully.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }

        $stmt_update->close();
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Profile</h2>
        <form action="edit.php" method="POST">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
