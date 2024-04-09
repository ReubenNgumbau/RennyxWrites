<?php
include 'session.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rennyx Writes</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <style>
        .expert {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 5px;
            padding: 15px;
            flex-basis: calc(25% - 10px);
            box-sizing: border-box;
        }

        .expert img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .expert-info {
            margin: 8px 0;
            text-align: center;
        }

        .choose-expert-btn {
            background-color: crimson;
            font-weight: bold;
            color: white;
            padding: 8px 16px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .reviews-btn {
            background-color: #4CAF50;
            font-weight: bold;
            color: white;
            padding: 8px 16px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>
<body>
<?php
include 'connection.php'; // Ensure you have your database connection setup

if (isset($_GET['subcategory_id'])) {
    $subcategoryId = intval($_GET['subcategory_id']);

    // Adjusted query to include average rating calculation
    $query = "SELECT e.id AS expert_id, e.name, e.available, e.profile_picture,
              AVG(r.rating) AS average_rating
              FROM experts e
              JOIN expert_subcategory es ON e.id = es.expert_id
              LEFT JOIN orders o ON e.id = o.expert_id AND o.order_status = 'uncompleted'
              LEFT JOIN reviews r ON e.id = r.expert_id
              WHERE es.subcategory_id = ?
              AND o.order_id IS NULL
              GROUP BY e.id, e.name, e.available, e.profile_picture";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $subcategoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<div class="experts-container" style="display: flex; flex-wrap: wrap;">';
            while ($row = $result->fetch_assoc()) {
                $profilePicturePath = htmlspecialchars($row['profile_picture']);
                $averageRating = number_format((float)$row['average_rating'], 1, '.', ''); // Format to one decimal place
                echo '<div class="expert">';
                // Display average rating
                echo '<div style="align-self: flex-start;">' . ($averageRating ?: 'No Ratings') . ' <i class="fas fa-star"></i></div>';
                echo '<img src="' . $profilePicturePath . '" alt="Profile Picture">';
                echo '<div class="expert-info">';
                echo '<h4>' . htmlspecialchars($row['name']) . '</h4>';
                echo '<p>Status: ' . ($row['available'] ? 'Available' : 'Unavailable') . '</p>';
                echo '<button type="button" class="choose-expert-btn" data-expert-id="' . $row['expert_id'] . '">Choose</button>';
                echo '<a href="fetch_reviews.php?expert_id=' . $row['expert_id'] . '" class="reviews-btn">Reviews</a>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Kindly wait, Experts have ongoing tasks. They will reach out to you.</p>';
        }
        $stmt->close();
    } else {
        echo '<p>Unable to process request. Please try again later.</p>';
    }
} else {
    echo '<p>Subcategory ID not provided.</p>';
}

if (isset($conn) && $conn) {
    $conn->close();
}
?>

<script>
$(document).ready(function() {
    $('.choose-expert-btn').on('click', function() {
        const expertId = $(this).data('expert-id');
        $.ajax({
            url: 'process_order.php',
            type: 'POST',
            data: { expert_id: expertId },
            success: function(response) {
                alert(response); // Display success message
            },
            error: function() {
                alert('Error creating order.'); // Display error message
            }
        });
    });
});
</script>
</body>
</html>
