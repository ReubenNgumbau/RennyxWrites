<?php
include 'connection.php'; // Include your database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);

    // Check if the subcategory already exists
    $checkQuery = "SELECT * FROM subcategories WHERE category_id = ? AND name = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("is", $category_id, $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "This subcategory already exists.";
    } else {
        // Subcategory does not exist, proceed with insertion
        $insertQuery = "INSERT INTO subcategories (category_id, name) VALUES (?, ?)";
        if ($stmt = $conn->prepare($insertQuery)) {
            $stmt->bind_param("is", $category_id, $name);
            
            // Execute the statement and check if successful
            if ($stmt->execute()) {
                echo "Subcategory added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    $conn->close();
}
?>

