<?php
include 'session.php';
include 'connection.php'; // Ensure you have your database connection setup

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['expert_id'])) {
    // Retrieve the expert ID from the POST data
    $expertId = intval($_POST['expert_id']);
    $orderStatus = 'uncompleted'; // Set the initial order status

    // Retrieve the user ID from session
    $userId = $_SESSION["user_id"];
    
    // Insert the order into the database with order_status
    // Corrected the prepared statement with the right number of placeholders
    $query = $conn->prepare("INSERT INTO orders (expert_id, user_id, order_status) VALUES (?, ?, ?)");
    
    // Corrected the order and types of parameters ('iis' for two integers and a string)
    $query->bind_param("iis", $expertId, $userId, $orderStatus);
    
    if ($query->execute()) {
        echo "Expert chosen successfully, kindly wait as we connect you with them.";
    } else {
        echo "Error creating order: " . $conn->error;
    }

    $query->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>


