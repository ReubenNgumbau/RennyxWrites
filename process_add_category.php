<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection setup (adjust these variables according to your setup)
include'connection.php';

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO categories (category_name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $category_name, $description);

    // Set parameters and execute
    $category_name = $_POST["category_name"];
    $description = $_POST["description"];
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect back to the form page with a success message
    header("Location: add_category.php?success=true");
    exit();
}
?>
