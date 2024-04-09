<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RennyxWrites</title>
  <link rel="stylesheet" href="team.css" />
  <link rel="icon" type="image/png" href="images/New.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <script src="" defer></script>
</head>
<?php
include 'connection.php';

$sql = "SELECT e.id, e.name, e.email, e.profile_picture, COALESCE(AVG(r.rating), 0) AS average_rating
        FROM experts e
        LEFT JOIN reviews r ON e.id = r.expert_id
        GROUP BY e.id, e.name, e.email, e.profile_picture
        ORDER BY average_rating DESC";

$result = $conn->query($sql);
?>
<div class="experts-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="expert-card">
                <img src="./<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="expert-image">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p>Email: <?php echo htmlspecialchars($row['email']); ?></p>
                <p class="rating">Rating: <span><?php echo number_format($row['average_rating'], 1); ?></span></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No experts found.</p>
    <?php endif; ?>
</div>
<?php
$conn->close();
?>
