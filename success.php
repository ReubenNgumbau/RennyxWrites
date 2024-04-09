<?php
session_start(); // Start the session

// Check if the 'status' session variable is set and contains the expected value
if (isset($_SESSION['status']) && $_SESSION['status'] == 'message sent') {
    $status = $_SESSION['status'];
    $message = $_SESSION['more'];
    $status_code = $_SESSION['status_code'];

    // Clear the session variables to avoid displaying the message again on a page refresh
    unset($_SESSION['status']);
    unset($_SESSION['more']);
    unset($_SESSION['status_code']);
} else {
    // Redirect to another page or handle the case when the 'status' session variable is not set
    header("Location: index.php"); // Change 'index.php' to your actual home page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        div {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #008000; /* Green color for success */
        }

        p {
            color: #333;
        }

        a {
            color: #007bff; /* Blue color for links */
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            div {
                margin: 20px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

<div>
    <?php if ($status_code == 'success'): ?>
        <h2>Success!</h2>
        <p><?php echo $message; ?></p>
    <?php else: ?>
        <h2>Error!</h2>
        <p>Sorry, an error occurred.</p>
    <?php endif; ?>
    <p><a href="index.html">Back to Home</a></p> <!-- Change 'index.php' to your actual home page -->
</div>

</body>
</html>

