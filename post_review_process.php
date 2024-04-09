<?php
include 'connection.php'; // Include your connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary POST data exists
    if (isset($_POST['expert_id'], $_POST['review_text'], $_POST['rating'])) {
        $expertId = intval($_POST['expert_id']);
        $reviewText = trim($_POST['review_text']);
        $rating = floatval($_POST['rating']);

        // Simple validation
        if (empty($reviewText)) {
            $error = "Please enter a review text.";
        } elseif ($rating < 0 || $rating > 5) {
            $error = "Rating must be between 0 and 5.";
        } else {
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO reviews (expert_id, review_text, rating) VALUES (?, ?, ?)");
            $stmt->bind_param("isd", $expertId, $reviewText, $rating);

            // Execute and check for success
            if ($stmt->execute()) {
                echo "<p>Review submitted successfully!</p>";
            } else {
                echo "<p>Error submitting review: " . $conn->error . "</p>";
            }

            $stmt->close();
        }
    } else {
        echo "<p>Missing information.</p>";
    }

    $conn->close();
} else {
    // If not a POST request, display the review submission form
    if (isset($_GET['expert_id'])) {
        $expertId = intval($_GET['expert_id']);
        ?>
        <form action="post_review.php" method="post" style="padding: 20px; max-width: 500px; margin: auto;">
            <input type="hidden" name="expert_id" value="<?php echo $expertId; ?>">
            <div>
                <label for="review_text">Review:</label><br>
                <textarea id="review_text" name="review_text" rows="4" style="width: 100%;"></textarea>
            </div>
            <div style="margin-top: 10px;">
                <label for="rating">Rating (0-5):</label><br>
                <input type="number" id="rating" name="rating" step="0.1" min="0" max="5" style="width: 100%;">
            </div>
            <div style="margin-top: 20px; text-align: center;">
                <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Submit Review</button>
            </div>
        </form>
        <?php
    } else {
        echo "<p>Expert ID not provided.</p>";
    }
}
?>
