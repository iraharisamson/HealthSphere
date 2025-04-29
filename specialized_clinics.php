<?php
// clinic.php
if (isset($_GET['clinic'])) {
    $clinic = $_GET['clinic'];

    switch ($clinic) {
        case 'dermatology':
            echo "<h2>Dermatology Clinic</h2>
                  <p>Our Dermatology Clinic provides expert care for skin, hair, and nail health. 
                  Services include acne treatment, skin cancer screening, cosmetic dermatology, and more. 
                  Our team ensures your skin stays healthy and glowing.</p>";
            break;
        case 'dental':
            echo "<h2>Dental Clinic</h2>
                  <p>Our Dental Clinic offers a range of services to ensure your oral health, including 
                  teeth cleaning, cavity filling, braces, and cosmetic dentistry. Book an appointment today for a confident smile!</p>";
            break;
        case 'mental_health':
            echo "<h2>Mental Health Clinic</h2>
                  <p>The Mental Health Clinic provides compassionate support for mental well-being. 
                  Services include counseling, therapy sessions, stress management, and psychiatric consultations. 
                  Your mental health matters, and we’re here to help.</p>";
            break;
        default:
            echo "<h2>Welcome</h2>
                  <p>Select a clinic from the menu to explore our specialized services and learn more about how we can assist you.</p>";
            break;
    }
} else {
    echo "<h2>Welcome</h2>
          <p>Select a clinic from the menu to explore our specialized services and learn more about how we can assist you.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Specialized Clinics</title>
</head>
<body>
    <style>
        /* styles.css */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

header {
    background: #0073e6;
    color: white;
    padding: 1em 0;
    text-align: center;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    padding: 0;
    background-color: #333;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    display: block;
}

nav ul li a:hover {
    background-color: #0073e6;
    border-radius: 4px;
}

main {
    padding: 20px;
    text-align: center;
}

footer {
    text-align: center;
    padding: 1em 0;
    background: #0073e6;
    color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
}
    </style>
    <header>
        <h1>Welcome to Our Specialized Clinics</h1>
    </header>
    <nav>
        <ul>
            <li><a href="?clinic=dermatology">Dermatology</a></li>
            <li><a href="?clinic=dental">Dental</a></li>
            <li><a href="?clinic=mental_health">Mental Health</a></li>
        </ul>
    </nav>
    <main>
        <section id="clinic-info">
            <?php include 'clinic.php'; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Specialized Clinics</p>
    </footer>
</body>
</html>