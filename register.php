<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RennyxWrites Registration</title>
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

            background-image: url('images/pic2.jpg');
            background-size: cover;
            background-position: center;
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            max-width: 450px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            color: #000;
        }

        h2 {
            color: black;
            position: relative;
        }

        h2 img {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            max-height: 100px;
            margin-left: 10px;
        }

        label {
            position: relative;
            display: flex;
            align-items: center;
            margin: 15px 0 8px;
            color: black;
            font-weight: bold;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #4caf50;
        }

        input::placeholder {
            color: #555;
            font-style: italic;
            margin-left: 10px;
            /* Adjust this value as needed */
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            font-family: Open Sans, sans-serif;
        }

        button.register {
            background-color: crimson;
            /* Light Blue */
        }

        /* Updated style for the login button */
        button.login {
            background-color: #4caf50;
            /* Light Green */
            opacity: 0.7;
            /* Adjust the opacity value as needed */
        }

        button.login:hover {
            filter: brightness(100%);
            opacity: 1;
        }

        button:hover {
            filter: brightness(90%);
        }

        .message {
            text-align: center;
            margin-top: 20px;
        }

        .message p {
            margin: 0;
            padding: 10px;
            border-radius: 4px;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Additional style for the Font Awesome icons */
        label i {
            font-size: 18px;
            color: #555;
            margin-right: 5px;
            margin-top: -10px;
        }

        /* Updated style for the eye password icon */
        .password-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #555;
            transition: color 0.3s;
            /* Add transition effect for color change */
        }

        .password-icon:hover {
            color: #4caf50;
            /* Change color on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>RennyxWrites Registration <img src="" alt=""></h2>

        <?php
        // Process form data when form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate input
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $password = $_POST["password"];

            if (empty($name) || empty($phone) || empty($email) || empty($password)) {
                echo "<div class='message error'>All fields are required.</div>";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='message error'>Invalid email format.</div>";
            } else {
                // Perform database operations or other necessary tasks here
                echo "<div class='message success'>Registration successful!</div>";
            }
        }
        ?>

        <form method="post" action="reg_process.php">
            <label for="name"><i class="fas fa-user"></i>
                <input type="text" id="name" name="name" required placeholder="Name">
            </label>

            <label for="phone"><i class="fas fa-phone"></i>
                <input type="text" id="phone" name="phone" required placeholder="Phone No">
            </label>

            <label for="email"><i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" required placeholder="Email">
            </label>

            <label for="password"><i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" required placeholder="Password">
                <i class="fas fa-eye password-icon" onclick="togglePasswordVisibility()"></i>
            </label>

            <div class="button-container">
                <button type="submit" class="register">Create Account</button>
                <a href="login.php"><button type="button" class="login">Login</button></a>
            </div>
        </form>
    </div>
    <script>
        // JavaScript function to toggle password visibility
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.querySelector(".password-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>