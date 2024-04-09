<?php
// Include the database connection file (assuming you have a file named "connection.php")
include "connection.php";

// Process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($name) || empty($phone) || empty($email) || empty($password)) {
        echo "<div class='message error'>All fields are required.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='message error'>Invalid email format.</div>";
    } else {
        // Check if the email already exists in the database
        $checkEmailQuery = "SELECT * FROM agents WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            echo "<div class='message error'>Email already exists. Choose a different email.</div>";
        } else {
            // Insert user details into the database
            $insertQuery = "INSERT INTO agents (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";

            if ($conn->query($insertQuery) === TRUE) {
                // Registration success message
                echo "<div class='message success'>Registration successful! Redirecting to the login page in 2 seconds.</div>";
                // JavaScript for redirecting after 4 seconds
                echo "<script>setTimeout(function(){ window.location.href = 'login.php'; }, 2000);</script>";
            } else {
                echo "<div class='message error'>Error: " . $insertQuery . "<br>" . $conn->error . "</div>";
            }
        }
    }

    // Close the database connection
    $conn->close();
}
?>