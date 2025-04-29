<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tuberculosis_info";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.";
} else {
    echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();

// Reconnect to the tuberculosis_info database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if it doesn't exist
$tableQuery = "CREATE TABLE IF NOT EXISTS information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
)";
if ($conn->query($tableQuery) === TRUE) {
    echo "Table created successfully or already exists.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuberculosis (TB) Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4682b4;
            color: white;
            text-align: center;
            padding: 2rem;
            font-size: 2rem;
            font-weight: bold;
        }
        main {
            padding: 20px;
            max-width: 900px;
            margin: auto;
            background-color: white;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        section {
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #4682b4;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
        h2 {
            color: #4682b4;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 5px 0;
        }
        a {
            color: #4682b4;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        Tuberculosis (TB) Information
    </header>
    <main>
        <section>
            <h2>What is TB?</h2>
            <p>Tuberculosis (TB) is an infectious disease caused by bacteria called <i>Mycobacterium tuberculosis</i>. It primarily affects the lungs but can also impact other parts of the body, such as the kidneys, spine, and brain. TB is both preventable and curable. <a href="https://www.who.int/news-room/fact-sheets/detail/tuberculosis" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Causes and Transmission</h2>
            <p>TB is caused by bacteria that spread through the air when an infected person coughs, sneezes, or talks. People nearby may inhale these bacteria, leading to infection. Not everyone infected with TB bacteria becomes sick; those who do not feel sick and cannot spread TB germs to others have latent TB infection. Without treatment, latent TB can develop into active TB disease. <a href="https://www.cdc.gov/tb/about/index.html" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Symptoms</h2>
            <p>Common symptoms of active TB include:</p>
            <ul>
                <li><strong>Persistent cough:</strong> Lasting more than three weeks</li>
                <li><strong>Chest pain:</strong> Discomfort or pain in the chest area</li>
                <li><strong>Coughing up blood:</strong> Blood in sputum or phlegm</li>
                <li><strong>Fatigue:</strong> Feeling unusually tired</li>
                <li><strong>Weight loss:</strong> Unintended weight loss</li>
                <li><strong>Fever:</strong> Elevated body temperature</li>
                <li><strong>Night sweats:</strong> Excessive sweating during the night</li>
            </ul>
            <p>For more detailed information, visit the CDC's TB Fact Sheet. <a href="https://www.cdc.gov/tb/communication-resources/tuberculosis-fact-sheet.html" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Diagnosis</h2>
            <p>Diagnosing TB involves several steps:</p>
            <ul>
                <li><strong>Medical history review:</strong> Assessing risk factors and symptoms</li>
                <li><strong>Physical examination:</strong> Checking for signs of TB</li>
                <li><strong>Chest X-ray:</strong> Imaging to detect lung abnormalities</li>
                <li><strong>Microbiological tests:</strong> Analyzing sputum samples for TB bacteria</li>
                <li><strong>Skin and blood tests:</strong> Identifying TB infection</li>
            </ul>
            <p>Early detection is crucial for effective treatment. For comprehensive guidelines, refer to the CDC's Clinical Overview of TB. <a href="https://www.cdc.gov/tb/hcp/clinical-overview/tuberculosis-disease.html" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Treatment</h2>
            <p>TB is treatable with antibiotics. A typical treatment regimen involves taking multiple antibiotics for at least six months. It's crucial to complete the entire course of treatment to ensure all bacteria are eradicated and to prevent the development of drug-resistant TB. For detailed treatment protocols, consult the CDC's guidelines. <a href="https://www.cdc.gov/tb/hcp/clinical-overview/tuberculosis-disease.html" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Preventive Measures</h2>
            <p>Preventing TB includes:</p>
            <ul>
                <li><strong>Vaccination:</strong> Receiving the Bacillus Calmette-Guérin (BCG) vaccine, especially in countries with high TB prevalence</li>
                <li><strong>Screening:</strong> Regular testing for individuals at high risk</li>
                <li><strong>Ventilation:</strong> Ensuring proper airflow in living spaces</li>
                <li><strong>Hygiene:</strong> Practicing good hygiene, such as wearing masks in crowded or high-risk areas</li>
            </ul>
            <p>For more information on TB prevention, visit the WHO's TB Overview. <a href="https://www.who.int/news-room/fact-sheets/detail/tuberculosis" target="_blank">Learn more</a></p>
        </section>
        <section>
            <h2>Global Impact</h2>
            <p>TB remains a significant global health issue, causing 1.25 million deaths and infecting 8 million people in 2023, with rising case numbers in recent years. It is especially prevalent in regions like Southeast Asia, Africa, and the Western Pacific. Factors such as undernutrition, HIV, alcohol use, smoking, and diabetes contribute to its spread. For an in-depth analysis, refer
::contentReference[oaicite:0]{index=0}
 
