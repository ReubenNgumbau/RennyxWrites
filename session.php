<?php
include 'connection.php';
session_start();

// Check if user_id is not set in the session and redirect to login page
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Optional: Fetch user details from database using the user_id stored in session
// This can be useful if you need to display user information or perform further checks
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM agents WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Now you have $user array to use for displaying user info or for further access checks
} else {
    // Handle case where the user ID stored in session doesn't exist in the database
    // This might happen if the user was deleted after they logged in
    echo 'User not found. Please login again.';
    // Optionally, clear session and redirect to login
    // session_destroy();
    // header("Location: login.php");
    // exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
