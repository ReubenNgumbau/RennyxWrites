<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hire Me</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            text-align: center;
        }

        h1 {
            color: #ff0000; /* Red color for the header */
        }

        p {
            font-size: 18px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 10px;
            text-align: left;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #ff0000; /* Red color for the submit button */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #cc0000; /* Darker red color on hover */
        }
    </style>
</head>
<body>

    <h1>Hire Me</h1>

    <p>If you're interested in hiring me, please fill out the form below:</p>

    <form action="mail.php" method="post">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Your Subject:</label>
        <textarea id="subject" name="subject" required></textarea>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" name="send" value="Send Now">
    </form>

</body>
</html>

