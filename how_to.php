<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>RennyxWrites</title>
  <link rel="stylesheet" href="team.css" />
  <link rel="icon" type="image/png" href="images/New.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
       body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .how-to-guide {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .step {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }

        .step:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .step h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .step p {
            font-size: 14px;
            line-height: 1.7;
            color: #34495e;
            margin-bottom: 15px;
        }

        .step a {
            display: inline-block;
            text-decoration: none;
            color: #3498db;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .step a:hover {
            background-color: #f4f4f4;
        }

        .guide-image {
            width: 100%;
            border-radius: 5px;
            transition: transform 0.2s ease;
        }

        .guide-image:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>
    <section class="how-to-guide">
        <div class="step">
            <h2>Step 1: Log In</h2>
            <p>To access our full range of services, please log in to your account. If you do not have an account, you
                can <a href="register.php">register here</a>.</p>
            <a href="login.php"><img src="images/login.png" alt="Login Page" class="guide-image"></a>
        </div>

        <div class="step">
            <h2>Step 2: Explore Services</h2>
            <p>Once logged in, navigate to our services page to explore the wide range of services we offer.</p>
            <a href="login.php"><img src="images/show.png" alt="Services Page" class="guide-image"></a>
        </div>

        <div class="step">
            <h2>Step 3: Select Your Service</h2>
            <p>Choose the service that best suits your needs from the following options:</p>
            <a href="login.php"><img src="images/services.png" alt="Services Page" class="guide-image"></a>
        </div>

        <div class="step">
            <h2>Step 4: Choose Subservices</h2>
            <p>After selecting a service of your choice, you'll see a list of subservices. Click on any subservice to
                view the available experts of your choice.</p>
            <!-- Dynamically load subservices based on the user's choice in Step 3 -->
        </div>

        <div class="step">
            <h2>Step 5: Connect with Experts</h2>
            <p>Explore the profiles of our experts including their Reviews and connect with the one that best fits your
                project needs.</p>
            <a href="login.php"><img src="images/experts.png" alt="Services Page" class="guide-image"></a>
        </div>
        </div>
    </section>
</body>

</html>