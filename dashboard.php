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
<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <div class="logo"><a href="#">Rennyx<span>Writes</span></a></div>
            <ul class="menu">
                <li><a href="#home" class="menu-btn">Home</a></li>
                <li><a href="#about" class="menu-btn">About</a></li>
                <li><a href="#services" class="menu-btn">Services</a></li>
                <li><a href="#skills" class="menu-btn">Reviews</a></li>
                <li><a href="#teams" class="menu-btn">Teams</a></li>
                <li><a href="#contact" class="menu-btn">Contact</a></li>
                <li><a href="logout.php" class="menu-btn">Logout</a></li>
            </ul>
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-1">Hello, this is</div>
                <div class="text-2">RennyxWrites</div>
                <div class="text-3">And we offer services for activities like <span class="typing"></span></div>
                <a href="#services">Connect to your Expert</a>
            </div>
        </div>
    </section>

    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <h2 class="title">About Us</h2>
            <div class="about-content">
                <div class="column left">
                    <img src="images/pic3.jpg" alt="">
                </div>
                <div class="column right">
                    <div class="text">Hello,Thanks for Visiting our website and we offer services for activities such
                        like <span class="typing-2"></span></div>
                    <p>Welcome to RennyxWrites, a vibrant online platform designed to seamlessly connect talented
                        writers with clients seeking their expertise. At RennyxWrites, we believe in the power of words
                        and the incredible impact they can have when the right minds come together. Whether you're an
                        author looking for your next freelance opportunity or a business in need of compelling content,
                        our community is here to bridge the gap.</p>

                    <p>Our platform is tailored to cater to a wide array of writing needs including but not limited to
                        article writing, blog posts, copywriting, and creative writing projects. RennyxWrites is built
                        on a foundation of simplicity, efficiency, and collaboration, ensuring that writers can easily
                        showcase their work, and clients can find the perfect voice for their projects.</p>

                    <p>Join our community today and start your journey towards creating connections that not only
                        fulfill your professional needs but also enrich your experiences in the world of online writing.
                        Welcome to the future of writing connections, welcome to RennyxWrites.</p>

                    <a href="#services">Start Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Our services</h2>
            <?php
include 'connection.php'; // Include your database connection

// Fetch categories to populate the dropdown
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);
?>

<div class="serv-content">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <div class="box">
                    <i class="fas fa-paint-brush"></i> <!-- You might want to change the icon based on the category or remove it entirely -->
                    <div class="text"><?php echo htmlspecialchars($row['category_name']); ?></div>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <!-- Apply button with onclick event to show subcategories -->
                    <button class="apply-btn" data-category-id="<?php echo $row['id']; ?>">Apply</button>
                    <!-- Container to display subcategories -->
                    <div class="subcategories-container" style="display: none;"></div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to Apply buttons
    document.querySelectorAll('.apply-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var categoryId = this.getAttribute('data-category-id');
            // Redirect to fetch_categories.php with the selected category ID
            window.location.href = 'fetch_subcategories.php?category_id=' + categoryId;
        });
    });
});

</script>



        </div>
        </div>
    </section>    <!-- skills section start -->
    <section class="skills" id="skills">
        <div class="max-width">
            <h2 class="title">My skills</h2>
            <div class="skills-content">
                <div class="column left">
                    <div class="text">My creative skills & experiences.</div>
                    <p>Posesses great programming skills together with leadership qualities. Worked under Pesafy Africa Company at Roysambu,Kenya dealing with accounting and HR management software that tracks sales, stock, employees and cash flow.</p>
                    <a href="read_more.php">Read more</a>
                </div>
                <div class="column right">
                    <div class="bars">
                        <div class="info">
                            <span>HTML</span>
                            <span>90%</span>
                        </div>
                        <div class="line html"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>CSS</span>
                            <span>60%</span>
                        </div>
                        <div class="line css"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>JavaScript</span>
                            <span>80%</span>
                        </div>
                        <div class="line js"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>PHP</span>
                            <span>50%</span>
                        </div>
                        <div class="line php"></div>
                    </div>
                    <div class="bars">
                        <div class="info">
                            <span>MySQL</span>
                            <span>70%</span>
                        </div>
                        <div class="line mysql"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- teams section start -->
    <section class="teams" id="teams">
        <div class="max-width">
            <h2 class="title">My teams</h2>
            <div class="carousel owl-carousel">
                <div class="card">
                    <div class="box">
                        <img src="images/wicky.jpg" alt="">
                        <div class="text">Wycliff Ngei</div>
                        <p>Senior Programmer.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/vinny.jpg" alt="">
                        <div class="text">Vinton Mutembei</div>
                        <p>Senior Programmer.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/profile-3.jpeg" alt="">
                        <div class="text">Tony James</div>
                        <p>Senior Programmer.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/profile-4.jpeg" alt="">
                        <div class="text">Stephen Mutuku</div>
                        <p>Senior Programmer.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <img src="images/profile-5.jpeg" alt="">
                        <div class="text">Mathew Muli</div>
                        <p>Senior Programmer.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contact me</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="text">Get in Touch</div>
                    <p>Do you love to see your ideas go wide? How much are you attached to success? .Are you in need of making your business grow? Then! Reach us via our email or through 'Message Me' and we'll be able to make you snatch big deals.</p>
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Name</div>
                                <div class="sub-title">Reuben Ngumbau</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Roysambu, Nairobi</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">reubenngumbau87@gmail.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Message me</div>
                    <form action="#">
                        <div class="fields">
                            <div class="field name">
                                <input type="name" placeholder="Name" required>
                            </div>
                            <div class="field email">
                                <input type="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="field textarea">
                            <textarea cols="30" rows="10" placeholder="Message.." required></textarea>
                        </div>
                        <div class="button-area">
                            <button type="submit">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <footer>
        <span>Created By <a href="https://www.ngumbaureuben.great-site.net">ReubenNgumbau</a> | <span class="far fa-copyright"></span> 2024 All rights reserved.</span>
    </footer>

    <script src="script.js"></script>
</body>
</html>