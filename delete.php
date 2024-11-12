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

// Handle the deletion request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // SQL query to delete the user from the database
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Logout the user after successful deletion
        session_destroy();
        echo "<p>Your account has been deleted successfully. You will be redirected to the homepage.</p>";
        // Redirect to homepage or login page
        header("Location: index.php"); // Change this to wherever you want
        exit();
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }

    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/c
