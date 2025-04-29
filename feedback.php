<?php
include 'db.php';

$successMessage = '';
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Simple validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);  // 'sss' means 3 string parameters
        
        // Execute the query and check for success
        if ($stmt->execute()) {
            $successMessage = "Thank you for your feedback!";
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close(); // Close the prepared statement
    } else {
        $errorMessage = "Please fill in all fields.";
    }
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Tab</title>
    <meta name="description" content="Book appointments, consult doctors, and manage health records online with our easy-to-use healthcare platform.">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('feedb.webp'); /* Background Image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        /* Success and Error Messages */
        .success {
            color: green;
            font-weight: bold;
            text-align: center;
        }
        .error {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        /* Contact Section */
        .contact {
            text-align: center;
            padding: 60px 20px;
            background-color: rgba(247, 247, 247, 0.85); /* Semi-transparent background */
        }

        .contact h2 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
        }

        .contact form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .contact input,
        .contact textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #f4f7fa;
            color: #333;
            transition: border 0.3s ease;
            margin-bottom: 15px;
        }

        .contact input:focus,
        .contact textarea:focus {
            border-color: #ff7f50;
            outline: none;
        }

        .contact button {
            padding: 15px 30px;
            background-color: #ff7f50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 50px;
            font-size: 18px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .contact button:hover {
            background-color: #ff5722;
            transform: scale(1.05);
        }

        .view-feedback-btn,
        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }

        .view-feedback-btn:hover,
        .back-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <section class="contact" id="contact">
        <!-- Feedback Form -->
        <form action="feedback.php" method="POST">
            <h2>Feedback</h2>
            
            <!-- Success or Error Message -->
            <?php if ($successMessage): ?>
                <p class="success"><?php echo $successMessage; ?></p>
            <?php elseif ($errorMessage): ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php endif; ?>
            
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
            <a href="view_feedback.php" class="view-feedback-btn">View Feedback</a>

            <a href="healthcarefrontend1.php" class="back-link">Back to Home</a>
        </form>
    </section>
</body>
</html>
