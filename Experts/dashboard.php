<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<title>Experts Dashboard</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet"
		href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
</head>

<body>
	<input type="checkbox" id="menu-toggle">
	<div class="sidebar">
		<div class="side-header">
			<h3>R<span>ennyxWrites</span></h3>
		</div>

		<div class="side-content">
			<?php
			include 'connection.php';
			// Start or resume a session
			session_start();

			// Check if the user is logged in
			if (isset($_SESSION['user_id'])) {
				$userId = $_SESSION['user_id'];

				// SQL to get user details from 'agents' table and 'experts' table
				$sql = "SELECT a.name, a.email, e.profile_picture FROM agents a 
            LEFT JOIN experts e ON a.email = e.email 
            WHERE a.id = ? LIMIT 1";

				// Prepare statement
				if ($stmt = $conn->prepare($sql)) {
					// Bind parameters and execute
					$stmt->bind_param("i", $userId);
					$stmt->execute();
					$result = $stmt->get_result();

					if ($result->num_rows > 0) {
						$userDetails = $result->fetch_assoc();
						// Assuming 'uploads/' is the directory where profile pictures are stored
						$profilePicture = !empty($userDetails['profile_picture']) ? '../' . $userDetails['profile_picture'] : 'img/default.png'; // Default profile picture
						$userName = $userDetails['name'];
						// Assuming 'Art Director' is a placeholder
						$userRole = 'Expert';
						?>
						<div class="profile">
							<div class="profile-img bg-img"
								style="background-image: url(<?php echo htmlspecialchars($profilePicture); ?>)"></div>
							<h4>
								<?php echo htmlspecialchars($userName); ?>
							</h4>
							<small>
								<?php echo htmlspecialchars($userRole); ?>
							</small>
						</div>
						<?php
					} else {
						echo '<p>User details not found.</p>';
					}
					$stmt->close();
				} else {
					echo '<p>Error preparing SQL statement.</p>';
				}
			} else {
				echo '<p>User is not logged in.</p>';
			}

			// Assuming you close the database connection elsewhere or at the end of the script
			?>


			<div class="side-menu">
				<ul>
					<li>
						<a href="" class="active">
							<span class="las la-home"></span>
							<small>Dashboard</small>
						</a>
					</li>
					<li>
						<a href="">
							<span class="las la-user-alt"></span>
							<small>Profile</small>
						</a>
					</li>
					<li>
						<a href="">
							<span class="las la-envelope"></span>
							<small>Mailbox</small>
						</a>
					</li>
					<li>
						<a href="">
							<span class="las la-clipboard-list"></span>
							<small>Projects</small>
						</a>
					</li>
					<li>
						<a href="">
							<span class="las la-shopping-cart"></span>
							<small>Orders</small>
						</a>
					</li>
					<li>
						<a href="">
							<span class="las la-tasks"></span>
							<small>Tasks</small>
						</a>
					</li>

				</ul>
			</div>
		</div>
	</div>

	<div class="main-content">

		<header>
			<div class="header-content">
				<label for="menu-toggle">
					<span class="las la-bars"></span>
				</label>

				<div class="header-menu">
					<label for="">
						<span class="las la-search"></span>
					</label>

					<div class="notify-icon">
						<span class="las la-envelope"></span>
						<span class="notify">4</span>
					</div>

					<div class="notify-icon">
						<span class="las la-bell"></span>
						<span class="notify">3</span>
					</div>

					<div class="user">
						<?php
						include 'connection.php';
						// Check if the user is logged in
						if (isset($_SESSION['user_id'])) {
							$userId = $_SESSION['user_id'];

							// SQL to get user details from 'agents' table and 'experts' table
							$sql = "SELECT a.name, a.email, e.profile_picture FROM agents a 
            LEFT JOIN experts e ON a.email = e.email 
            WHERE a.id = ? LIMIT 1";

							// Prepare statement
							if ($stmt = $conn->prepare($sql)) {
								// Bind parameters and execute
								$stmt->bind_param("i", $userId);
								$stmt->execute();
								$result = $stmt->get_result();

								if ($result->num_rows > 0) {
									$userDetails = $result->fetch_assoc();
									$profilePicture = !empty($userDetails['profile_picture']) ? '../' . $userDetails['profile_picture'] : 'uploads/avatar.jpeg'; // Default profile picture
								} else {
									// User details not found
									$profilePicture = 'uploads/avatar.jpeg'; // Default profile picture
								}

								// Close statement
								$stmt->close();
							} else {
								echo '<p>Error preparing SQL statement.</p>';
							}
						} else {
							// User is not logged in, set default profile picture
							$profilePicture = 'uploads/avatar.jpeg';
						}
						?>

						<!-- Display the profile picture -->
						<div class="bg-img"
							style="background-image: url(<?php echo htmlspecialchars($profilePicture); ?>)"></div>

						<a href="../login.php" style="color: inherit; text-decoration: none;">
							<span class="las la-power-off"></span>
							<span>Logout</span>
						</a>
					</div>
				</div>
			</div>
		</header>


		<main>
			<div class="page-header">
				<h1>Dashboard</h1>
				<?php
				// Check if the user's id is set in the session
				if (isset($_SESSION['user_id'])) {
					// Prepare a statement to get the user's name from the agents table
					$sql = "SELECT name FROM agents WHERE id = ?";
					if ($stmt = $conn->prepare($sql)) {
						// Bind the user_id from the session to the SQL query
						$stmt->bind_param("i", $_SESSION['user_id']);
						// Execute the query
						$stmt->execute();
						// Store the result
						$result = $stmt->get_result();
						if ($result->num_rows > 0) {
							// Fetch the row containing the user's name
							$row = $result->fetch_assoc();
							// Echo the user's name with a welcome message
							echo '<h2>Welcome back, ' . htmlspecialchars($row['name']) . '!</h2>';
						} else {
							// User's name not found
							echo '<h2>Welcome to the Dashboard</h2>';
						}
						// Close the statement
						$stmt->close();
					} else {
						// Error handling, if the SQL preparation fails
						echo '<h2>Error accessing user information.</h2>';
					}
				} else {
					// Message to display if the user_id is not found in the session
					echo '<h2>Welcome to the Dashboard</h2>';
				}
				?>
			</div>



			<div class="page-content">

				<div class="analytics">

					
				

					<div class="card">
						<div class="card-head">
							<h2>340,230</h2>
							<span class="las la-eye"></span>
						</div>
						<div class="card-progress">
							<small>Page views</small>
							<div class="card-indicator">
								<div class="indicator two" style="width: 80%"></div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-head">
							<h2>$653,200</h2>
							<span class="las la-shopping-cart"></span>
						</div>
						<div class="card-progress">
							<small>Monthly revenue growth</small>
							<div class="card-indicator">
								<div class="indicator three" style="width: 65%"></div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-head">
							<h2>47,500</h2>
							<span class="las la-envelope"></span>
						</div>
						<div class="card-progress">
							<small>New E-mails received</small>
							<div class="card-indicator">
								<div class="indicator four" style="width: 90%"></div>
							</div>
						</div>
					</div>

				</div>


				<div class="records table-responsive">

					<div class="record-header">
						<div class="add">
							<span>Entries</span>
							<select name="" id="">
								<option value="">ID</option>
							</select>
							<button>Add record</button>
						</div>

						<div class="browse">
							<input type="search" placeholder="Search" class="record-search">
							<select name="" id="">
								<option value="">Status</option>
							</select>
						</div>
					</div>

					<div>
					<?php

$loggedInUserId = $_SESSION['user_id'];

// Modify the SQL query to only fetch orders associated with the logged-in user's ID
$sql = "SELECT o.order_id, o.order_date, o.order_status, o.user_id, e.name, e.email 
        FROM orders o
        INNER JOIN experts e ON o.expert_id = e.id
        WHERE o.user_id = ?"; // Corrected to filter by user_id

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Bind the logged-in user's ID to the prepared statement
$stmt->bind_param("i", $loggedInUserId);

// Execute the prepared statement
$stmt->execute();

// Get the result of the query
$result = $stmt->get_result();
?>

<table width="100%">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Expert Name</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["order_id"]) . "</td>";
                echo "<td>";
                echo    "<div class=\"client\">";
                // Assuming you want to display the expert's name and email associated with each order
                echo    "<div class=\"client-info\">";
                echo        "<h4>" . htmlspecialchars($row["name"]) . "</h4>";
                echo        "<small>" . htmlspecialchars($row["email"]) . "</small>";
                echo    "</div>";
                echo    "</div>";
                echo "</td>";
                echo "<td>" . htmlspecialchars($row["order_date"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["order_status"]) . "</td>";
                echo "<td>";
                echo    "<div class=\"actions\">";
                // Update these actions as per your requirements
                echo        "<span class=\"lab la-telegram-plane\"></span>";
                echo        "<span class=\"las la-eye\"></span>";
                echo        "<span class=\"las la-ellipsis-v\"></span>";
                echo    "</div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }
        ?>
    </tbody>
</table>



					</div>

				</div>

			</div>

		</main>

	</div>
</body>

</html>