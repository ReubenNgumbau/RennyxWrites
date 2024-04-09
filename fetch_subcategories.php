<?php
include 'session.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rennyx Writes</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>

</head>
<div id="experts-container">
    <!-- Experts will be loaded here -->
</div>

<?php
include 'connection.php'; // Include your database connection file

// Check if category_id is provided
if (isset ($_GET['category_id'])) {
    $categoryId = intval($_GET['category_id']); // Get the category ID and ensure it's an integer

    // Prepare SQL query to fetch subcategories for the given category ID
    $query = "SELECT * FROM subcategories WHERE category_id = ?";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $categoryId); // Bind the category ID as an integer parameter to the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Start the HTML output
        $output = '<div class="cards-container">';

        // Fetch all subcategories and create cards for them
        while ($row = $result->fetch_assoc()) {
            $output .= '<div class="subcategory-card" style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px;">';
            $output .= '<h3 style="margin: 0;">' . htmlspecialchars($row['name']) . '</h3>';
            // Here, add other subcategory details you want to display
            $output .= '<button class="apply-subcategory-btn" data-subcategory-id="' . $row['id'] . '">Choose Your Expert</button>';
            $output .= '</div>'; // Close the container div

        }

        // Return the HTML content
        echo $output;

        $stmt->close(); // Close the statement
    }
} else {
    // If category_id is not provided, send an error message
    echo 'Category ID not provided.';
}
?>
<script>
    function fetchSubcategories(categoryId, container) {
        // AJAX request to fetch subcategories
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Replace the container's content with the fetched HTML
                    container.innerHTML = xhr.responseText;
                    container.style.display = 'block'; // Display the subcategories container
                } else {
                    // Handle error
                    console.error('Error fetching subcategories: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', 'fetch_subcategories.php?category_id=' + categoryId, true);
        xhr.send();
    }
    $(document).ready(function() {
    // Use event delegation to handle button clicks
    $(document).on('click', '.apply-subcategory-btn', function() {
        const subcategoryId = $(this).data('subcategory-id');
        $.ajax({
            url: 'fetch_experts.php', // Ensure this points to your PHP script for fetching experts
            type: 'GET',
            data: {subcategory_id: subcategoryId},
            success: function(response) {
                $('#experts-container').html(response);
                // Optionally, hide the subcategories container if it's a separate element
                $('.cards-container').hide();
            },
            error: function() {
                console.error('Failed to fetch experts.');
            }
        });
    });
});


</script>

<style>
/* Base styles */
.cards-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 10px;
}

.subcategory-card {
    
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    background-color: gray;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    font-size: clamp(14px, 2vw, 16px); /* Responsive font size */
}

.apply-subcategory-btn {
    background-color: crimson;
    color: white;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
    align-self: center;
    font-weight: bold;
    width: auto; /* Adjust button width on small screens */
}

.apply-subcategory-btn:hover {
    background-color: #0056b3;
}

/* Mobile responsiveness */
@media screen and (max-width: 768px) {
    .subcategory-card {
        flex: 0 1 100%; /* Make cards take full width on small screens */
        padding: 10px; /* Adjust padding */
    }
    
    .apply-subcategory-btn {
        width: 100%; /* Full width button on small screens */
    }
}

@media screen and (min-width: 769px) and (max-width: 1024px) {
    .subcategory-card {
        flex: 0 1 calc(50% - 10px); /* 2 cards per row on medium screens */
    }
}

@media screen and (min-width: 1025px) {
    .subcategory-card {
        flex: 0 1 calc(20% - 10px); /* 5 cards per row on large screens, as originally designed */
    }
}
</style>
