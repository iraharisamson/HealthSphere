<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Healthcare System</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and Background */
        body {
            font-family: Arial, sans-serif;
            background-image: url('health.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            padding: 20px;
        }

        /* Semi-transparent background for content */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* white with slight transparency */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Header */
        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 2.5rem;
            color: #007BFF;
        }

        header p {
            font-size: 1.2rem;
            color: #555;
        }

        /* Navigation */
        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            font-size: 1.2rem;
            color: #007BFF;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #007BFF;
            transition: background 0.3s ease, color 0.3s ease;
        }

        nav ul li a:hover {
            background: #007BFF;
            color: white;
        }

        /* Info Section */
        .info {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .info h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #007BFF;
        }

        .info ul {
            list-style-type: disc;
            margin-left: 20px;
        }

        .info ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Our Healthcare System</h1>
            <p>Your health, our priority.</p>
        </header>
        
        <nav>
            <ul>
                <li><a href="healthcarefrontend1.php">Go to Healthcare System</a></li>
            </ul>
        </nav>

        <section class="info">
            <h2>Vision</h2>
            <p>Our vision is to provide affordable, accessible, and high-quality healthcare services to everyone, ensuring better health outcomes for individuals and communities.</p>

            <h2>Mission Statement</h2>
            <p>We are committed to delivering compassionate, patient-centered care, leveraging advanced technologies and best practices to enhance the health and well-being of our patients.</p>

            <h2>Aims</h2>
            <ul>
                <li>To improve access to healthcare services for all populations.</li>
                <li>To promote the adoption of advanced healthcare technologies.</li>
                <li>To maintain high standards of medical care and patient safety.</li>
                <li>To provide timely and accurate health information for decision-making.</li>
            </ul>

            <h2>Objectives</h2>
            <ul>
                <li>Provide a wide range of healthcare services including general and specialized care.</li>
                <li>Ensure patient satisfaction through dedicated and professional healthcare providers.</li>
                <li>Maintain the confidentiality of patient data and adhere to privacy regulations.</li>
                <li>Facilitate ongoing medical education and training for healthcare professionals.</li>
            </ul>
        </section>
    </div>
</body>
</html>
