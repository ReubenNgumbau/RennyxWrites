<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RennyxWrites</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="icon" type="image/png" href="images/New.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <script src="" defer></script>
</head>

<body>
  <main>
    <!-- Header Start -->
    <header>
      <nav class="nav container">
        <h2 class="nav_logo"><a href="#">RennyxWrites</a></h2>

        <ul class="menu_items">
          <img src="images/times.svg" alt="times icon" id="menu_toggle" />
          <li class="dropdown">
            <a href="#" class="nav_link">Home <i class="fas fa-caret-down dropdown-toggle"></i></a>
            <div class="dropdown_content">
              <a href="team.php" class="dropdown_link">Teams</a><br>
              <a href="how_to.php" class="dropdown_link">How to Connect</a><br>
              <a href="#" class="dropdown_link">When, where & How to make payments</a>
            </div>

          </li>
          <li><a href="about.php" class="nav_link">About</a></li>
          <li class="dropdown">
            <a href="#" class="nav_link">Services <i class="fas fa-caret-down dropdown-toggle"></i></a>
            <div class="dropdown_content">
              <a href="#">Graphic Design</a><br>
              <a href="#">Online Writing</a><br>
              <a href="#">Website Development</a>
            </div>
          </li>
          <li><a href="#" class="nav_link">Reviews</a></li>
          <li><a href="#" class="nav_link">Contact</a></li>
          <li><a href="login.php" class="nav_link">Login</a></li>
        </ul>

        <img src="images/bar.png" alt="timesicon" id="menu_toggle" />
      </nav>
    </header>
    <section class="hero">
      <div class="row container">
        <div class="column"><br>
          <h2>Top free tool and extension to <br />radiply grow your business by connecting to your design experts</h2>
          <p>
            Welcome to RennyxWrites where creativity meets expertise in the world of graphic design and website
            creation. At RennyxWrites, we bridge the gap between you and seasoned professionals, ensuring your vision
            comes to life with precision and flair. Looking to revamp your brand or kickstart a new project, our
            platform connects you to the expert tailored to your unique needs, making the journey from concept to
            creation seamless and inspiring!</p>
          <div class="buttons">
            <a href="read_more.php" class="btn">Read More</a>
            <a href="contact.php" class="btn">Contact Us</a>
          </div><br>
          <?php
          include 'connection.php';

          $sql = "SELECT e.id, e.name, e.email, e.profile_picture, AVG(r.rating) AS average_rating 
        FROM experts e
        LEFT JOIN reviews r ON e.id = r.expert_id
        GROUP BY e.id, e.name, e.email, e.profile_picture";

          $result = $conn->query($sql);
          ?>
          <section class="experts-section">
            <div class="container">
              <h2>Meet Our Design Experts</h2>
              <div class="experts">
                <?php if ($result->num_rows > 0): ?>
                  <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="expert">
                      <img src="./<?php echo htmlspecialchars($row['profile_picture']); ?>"
                        alt="<?php echo htmlspecialchars($row['name']); ?>" class="expert-img">
                      <h3>
                        <?php echo htmlspecialchars($row['name']); ?>
                      </h3>
                      <!-- Display the average rating in stars -->
                      <p class="average-rating">Average Rating:
                        <?php echo generateRatingStars(isset($row['average_rating']) ? $row['average_rating'] : null); ?>
                      </p>
                    </div>
                  <?php endwhile; ?>
                <?php else: ?>
                  <p>No experts found.</p>
                <?php endif; ?>
              </div>
            </div>
          </section>
          <?php
          $conn->close();

          // Function to generate star rating
          function generateRatingStars($rating)
          {
            if ($rating === null) {
              return "No ratings";
            }

            $starFull = "&#9733;"; // Unicode for filled star
            $starEmpty = "&#9734;"; // Unicode for empty star
            $ratingRounded = round($rating * 2) / 2; // Round to nearest half
            $stars = "";

            for ($i = 1; $i <= 5; $i++) {
              if ($i <= $ratingRounded) {
                $stars .= $starFull; // Full star
              } elseif ($i - 0.5 === $ratingRounded) {
                $stars .= "&#189;"; // Half star (assuming you have a way to represent half stars, adjust as needed)
              } else {
                $stars .= $starEmpty; // Empty star
              }
            }

            return "<span style='color: #FFD700;'>$stars</span>";
          }
          ?>


        </div>
        <?php
        include 'connection.php';

        $sql = "SELECT review_text FROM reviews ORDER BY rating DESC LIMIT 3"; // Selecting top 3 review_text based on rating
        $result = $conn->query($sql);
        ?>
        <div class="reviews-container">
          <h2>Top Reviews</h2>
          <div class="reviews">
            <?php if ($result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <div class="review-card">
                  <p>
                    <?php echo htmlspecialchars($row['review_text']); ?>
                  </p>
                </div>
              <?php endwhile; ?>
            <?php else: ?>
              <p>No reviews found.</p>
            <?php endif; ?>
          </div>
        </div>
        <?php
        $conn->close();
        ?>


        <div class="column">
          <img src="images/hero.png" alt="heroImg" class="hero_img" />
        </div>
      </div>
      <img src="images/bg-bottom-hero.png" alt="" class="curveImg" />
    </section>
  </main>
  <script>
    const header = document.querySelector("header");
    const menuToggler = document.querySelectorAll("#menu_toggle");

    menuToggler.forEach(toggler => {
      toggler.addEventListener("click", () => header.classList.toggle("showMenu"));
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Select all dropdown-toggle icons
    var toggles = document.querySelectorAll('.dropdown-toggle');

    toggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            // Prevent the default hyperlink action
            e.preventDefault();

            // Find the nearest parent dropdown-content div and toggle its visibility
            var dropdownContent = this.closest('.dropdown').querySelector('.dropdown_content');

            // Toggle a class that controls visibility
            dropdownContent.classList.toggle('is-visible');

            // Toggle the rotation of the caret icon
            this.classList.toggle('rotate');
        });
    });
});

  </script>

</body>

</html>