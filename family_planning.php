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
$sql = "CREATE DATABASE IF NOT EXISTS family_planning";
$conn->query($sql);
$conn->close();

// Connect to the newly created database
$conn = new mysqli($servername, $username, $password, "family_planning");

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
    <title>Family Planning Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: url('fp1.webp') no-repeat center center fixed;
            background-size: cover;
    }

        header {
            background: linear-gradient(to right, #4CAF50, #2E8B57);
            color: white;
            text-align: center;
            padding: 2rem;
            font-size: 2rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        main {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background: rgba(255, 255, 255, 0.9); /* White with transparency */
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
}
        }
        section {
            margin-bottom: 20px;
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        section:last-child {
            border-bottom: none;
        }
        h2 {
            color: #2E8B57;
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        ul li {
            background: #e8f5e9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        ul li:hover {
            background: #c8e6c9;
        }
        footer {
            text-align: center;
            padding: 1.5rem;
            background: linear-gradient(to right, #2E8B57, #4CAF50);
            color: white;
            font-size: 1rem;
            font-weight: bold;
            box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <header>
        Family Planning Information
    </header>
    <main>
        <section>
            <h2>What is Family Planning?</h2>
            <p>Family planning is the ability of individuals and couples to plan and control the number of children they have and the spacing between births. It involves using contraceptive methods, fertility awareness, and other reproductive health services.</p>
        </section>
        <section>
            <h2>Why is Family Planning Important?</h2>
            <ul>
                <li><strong>Improves Maternal Health:</strong> Reduces the risk of complications during pregnancy and childbirth.</li>
                <li><strong>Reduces Infant Mortality:</strong> Allows better spacing between births, improving child health and survival rates.</li>
                <li><strong>Empowers Women:</strong> Gives women the ability to pursue education and careers.</li>
                <li><strong>Economic Stability:</strong> Helps families manage resources and avoid unplanned pregnancies.</li>
                <li><strong>Prevents Sexually Transmitted Infections (STIs):</strong> Some methods, such as condoms, provide protection against STIs.</li>
            </ul>
        </section>
        <section>
            <h2>Family Planning Methods</h2>
            <ul>
                <li><strong>Hormonal Methods:</strong> Birth control pills, patches, injections, and implants.</li>
                <li><strong>Barrier Methods:</strong> Condoms, diaphragms, and cervical caps.</li>
                <li><strong>Intrauterine Devices (IUDs):</strong> Long-term birth control inserted into the uterus.</li>
                <li><strong>Natural Family Planning:</strong> Tracking ovulation and fertility cycles.</li>
                <li><strong>Permanent Methods:</strong> Sterilization (vasectomy for men, tubal ligation for women).</li>
            </ul>
        </section>
        <section>
            <h2>Useful Resources</h2>
            <ul>
                <li><a href="https://www.who.int/health-topics/family-planning" target="_blank">WHO - Family Planning</a></li>
                <li><a href="https://www.plannedparenthood.org/" target="_blank">Planned Parenthood</a></li>
                <li><a href="https://www.unfpa.org/family-planning" target="_blank">UNFPA - Family Planning</a></li>
                <li><a href="https://www.cdc.gov/reproductivehealth/contraception/index.htm" target="_blank">CDC - Contraception</a></li>
            </ul>
        </section>
    </main>
    <footer>
        &copy; 2025 Family Planning Initiative
    </footer>
</body>
</html>