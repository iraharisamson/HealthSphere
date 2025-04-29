<?php
$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS hiv_aids_info";
$conn->query($sql);
$conn->close();

// Connect to the newly created database
$conn = new mysqli($servername, $username, $password, "hiv_aids_info");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn’t exist
$tableQuery = "CREATE TABLE IF NOT EXISTS information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
)";
$conn->query($tableQuery);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIV/AIDS Information</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background: linear-gradient(to right, #e53935, #b71c1c);
            color: white;
            text-align: center;
            padding: 3rem 0;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
        }
        main {
            padding: 40px 20px;
            max-width: 1000px;
            margin: auto;
            background: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        main:hover {
            transform: scale(1.02);
        }
        section {
            margin-bottom: 30px;
        }
        section h2 {
            font-size: 1.6rem;
            color: #e53935;
            margin-bottom: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #e53935;
            padding-bottom: 10px;
        }
        section p, section ul {
            font-size: 1.1rem;
            line-height: 1.6;
        }
        section ul {
            margin-left: 20px;
        }
        section li {
            margin-bottom: 8px;
        }
        a {
            color: #e53935;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            padding: 20px 0;
            background: linear-gradient(to right, #b71c1c, #e53935);
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            header {
                font-size: 1.8rem;
                padding: 2rem 0;
            }
            main {
                padding: 20px;
            }
            section h2 {
                font-size: 1.4rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>HIV/AIDS Information</h1>
    </header>
    <main>
        <section>
            <h2>What is HIV/AIDS?</h2>
            <p>HIV (Human Immunodeficiency Virus) attacks the body's immune system, making it harder to fight infections and diseases. If left untreated, it can lead to AIDS (Acquired Immunodeficiency Syndrome).</p>
        </section>
        <section>
            <h2>How is HIV Transmitted?</h2>
            <ul>
                <li>Unprotected sexual contact with an infected person.</li>
                <li>Sharing contaminated needles or syringes.</li>
                <li>From mother to child during childbirth or breastfeeding.</li>
                <li>Blood transfusions with infected blood (rare due to modern screening methods).</li>
            </ul>
        </section>
        <section>
            <h2>Effects of HIV/AIDS</h2>
            <ul>
                <li><strong>Weakened immune system:</strong> Increased susceptibility to infections and diseases.</li>
                <li><strong>Chronic health issues:</strong> Weight loss, fatigue, and prolonged fever.</li>
                <li><strong>Neurological effects:</strong> Memory loss, confusion, and difficulty concentrating.</li>
                <li><strong>Social and emotional impact:</strong> Stigma, discrimination, and mental health challenges.</li>
            </ul>
        </section>
        <section>
            <h2>Useful Resources</h2>
            <ul>
                <li><a href="https://www.who.int/health-topics/hiv-aids" target="_blank">WHO - HIV/AIDS</a></li>
                <li><a href="https://www.unaids.org/" target="_blank">UNAIDS</a></li>
                <li><a href="https://www.cdc.gov/hiv/" target="_blank">CDC - HIV</a></li>
                <li><a href="https://www.avert.org/" target="_blank">Avert - HIV & AIDS</a></li>
            </ul>
        </section>
    </main>
    <footer>
        &copy; 2025 HIV/AIDS Awareness Initiative
    </footer>
</body>
</html>
