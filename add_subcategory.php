<?php
include 'connection.php'; // Make sure to use the correct path to your connection script

// Fetch categories to populate the dropdown
$categoriesQuery = "SELECT id, category_name FROM categories";
$categoriesResult = mysqli_query($conn, $categoriesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subcategory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            max-width: 400px;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Add Subcategory</h2>
        <form action="process_add_subcategory.php" method="POST">
            <div class="form-group">
                <label for="category">Category:</label>
                <select id="category" name="category_id" required>
                    <option value="">Select a Category</option>
                    <?php while($category = mysqli_fetch_assoc($categoriesResult)): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Subcategory Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit">Add Subcategory</button>
        </form>
    </div>
</body>
</html>

