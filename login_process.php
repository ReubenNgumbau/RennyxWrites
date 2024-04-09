<?php
include 'connection.php';
// Start a session to store user information
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL query to check if the user exists in the agents database
    $sql = "SELECT * FROM agents WHERE email = ? AND password = ?";
    
    // Prepare statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ss", $email, $password);
        // Execute the query
        $stmt->execute();
        // Store the result
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // User exists
            $user = $result->fetch_assoc();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $user["email"];

            // Now check if the user is also listed in the experts table by email
            $sql_expert = "SELECT * FROM experts WHERE email = ?";
            if ($stmt_expert = $conn->prepare($sql_expert)) {
                $stmt_expert->bind_param("s", $email); // Corrected to use $email
                $stmt_expert->execute();
                $result_expert = $stmt_expert->get_result();
                
                if ($result_expert->num_rows > 0) {
                    // User is also an expert, redirect to another dashboard
                    header("Location: Experts/dashboard.php");
                    exit();
                } else {
                    // User is not an expert, redirect to the regular dashboard
                    header("Location: dashboard.php");
                    exit();
                }
            } else {
                echo "Error preparing query for experts table.";
            }
        } else {
            // User does not exist or credentials are incorrect, display an error message
            echo '<div class="message error"><p>Login failed. Please check your email and password.</p></div>';
        }
        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing query for agents table.";
    }

    // Close the database connection
    $conn->close();
}
?>
