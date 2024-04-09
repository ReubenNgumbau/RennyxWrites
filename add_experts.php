<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expert</title>
    <link rel="stylesheet" href="experts.css">
</head>
<body>

<?php
include 'connection.php'; // Make sure to include the correct path to your database connection script

// Prepare and execute a query to fetch all subcategories
$query = "SELECT id, name FROM subcategories ORDER BY name ASC";
$subcategories = $conn->query($query);
?>

<form action="process_add_expert.php" method="POST" enctype="multipart/form-data" class="add-expert-form">
    <h2>Add New Expert</h2>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="available">Available:</label>
    <select id="available" name="available">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label for="subcategory">Subcategory:</label>
<select id="subcategory" name="subcategory_ids[]" multiple required>
    <?php if ($subcategories->num_rows > 0): ?>
        <?php while ($row = $subcategories->fetch_assoc()): ?>
            <option value="<?= htmlspecialchars($row['id']); ?>"><?= htmlspecialchars($row['name']); ?></option>
        <?php endwhile; ?>
    <?php else: ?>
        <option>No subcategories found</option>
    <?php endif; ?>
</select>

    <label for="profile_picture">Profile Picture:</label>
    <input type="file" id="profile_picture" name="profile_picture" required>

    <button type="submit">Add Expert</button>
</form>

</body>
</html>


