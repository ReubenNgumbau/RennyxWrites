<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label, input, textarea, button {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form action="process_add_category.php" method="POST">
    <h2>Add Category</h2>
    <label for="category_name">Category Name:</label>
    <input type="text" id="category_name" name="category_name" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <button type="submit">Add Category</button>
</form>

</body>
</html>
