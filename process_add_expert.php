<?php
include 'connection.php'; // Database connection

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $available = $_POST['available'];
    $subcategoryIds = $_POST['subcategory_ids']; // Adjusted to handle multiple selections
    $profilePicture = $_FILES['profile_picture'];

    $targetDirectory = "uploads/"; // Specify the directory where you want to save the file
    $targetFile = $targetDirectory . basename($profilePicture["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($profilePicture["tmp_name"]);
    if($check !== false) {
        // File is an image - proceed with upload
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($profilePicture["size"] > 500000) { // 500KB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($profilePicture["tmp_name"], $targetFile)) {
            // File has been uploaded successfully, now insert expert details into the database
            $query = $conn->prepare("INSERT INTO experts (name, email, available, profile_picture) VALUES (?, ?, ?,?)");
            $query->bind_param("ssis", $name, $email, $available, $targetFile);
            if($query->execute()) {
                // Get the ID of the newly inserted expert
                $expertId = $query->insert_id;

                // Insert the expert's associations with selected subcategories into the database
                $subcategoryQuery = $conn->prepare("INSERT INTO expert_subcategory (expert_id, subcategory_id) VALUES (?, ?)");
                $subcategoryQuery->bind_param("ii", $expertId, $subcategoryId);

                // Loop through selected subcategory IDs and insert associations
                foreach($subcategoryIds as $subcategoryId) {
                    $subcategoryQuery->execute();
                }

                echo "The expert has been added successfully.";
            } else {
                echo "Error adding expert: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
