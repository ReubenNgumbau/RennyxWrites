<?php
include 'session.php';
include 'connection.php'; // Ensure you have your database connection setup

function displayReviews($conn, $expertId) {
    $query = "SELECT r.review_text, r.rating, DATE_FORMAT(r.review_date, '%M %d, %Y') AS formatted_date, a.name AS agent_name 
              FROM reviews r 
              INNER JOIN agents a ON r.user_id = a.id 
              WHERE r.expert_id = ? 
              ORDER BY r.review_date DESC";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $expertId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="review">';
                echo '<p class="agent-name"> ' . htmlspecialchars($row['agent_name']) . '</p>';
                echo '<p class="review-text">' . htmlspecialchars($row['review_text']) . '</p>';
                echo '<div class="rating">Rating: ' . str_repeat('★', htmlspecialchars($row['rating'])) . '</div>';
                echo '<p class="review-date">Date: ' . $row['formatted_date'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No reviews found for this expert.</p>';
        }
        $stmt->close();
    } else {
        echo '<p>Unable to process request. Please try again later.</p>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['expert_id'], $_POST['review_text'], $_POST['rating'])) {
    $expertId = intval($_POST['expert_id']);
    $reviewText = trim($_POST['review_text']);
    $rating = intval($_POST['rating']);
    $reviewDate = date('Y-m-d H:i:s'); // Current date and time

    // Corrected the assignment operator for $userId
    $userId = $_SESSION["user_id"];
    // Corrected the number of placeholders in the SQL statement
    $query = "INSERT INTO reviews (expert_id, user_id, review_text, rating, review_date) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        // Corrected the bind_param function arguments
        $stmt->bind_param("iisis", $expertId, $userId, $reviewText, $rating, $reviewDate);
        if ($stmt->execute()) {
            echo "<p>Thank you for your review!</p>";
        } else {
            echo "<p>Error: Unable to save your review. Please try again.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Unable to process your request. Please try again later.</p>";
    }
}

if (isset($_GET['expert_id']) || isset($_POST['expert_id'])) {
    $expertId = isset($_GET['expert_id']) ? intval($_GET['expert_id']) : intval($_POST['expert_id']);
    displayReviews($conn, $expertId);
    include 'post_review.php'; // Correct file reference comment
} else {
    echo "<p>Expert ID not provided.</p>";
}

if (isset($conn) && $conn) {
    $conn->close();
}
?>

