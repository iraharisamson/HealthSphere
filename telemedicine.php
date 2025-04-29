<?php
// db.php - Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "healthcare";  

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Consultation Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_consultation'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $symptoms = mysqli_real_escape_string($conn, $_POST['symptoms']);

    // Insert patient data
    $query = "INSERT INTO patients (name, email, phone) VALUES ('$name', '$email', '$phone')";
    if (mysqli_query($conn, $query)) {
        $patient_id = mysqli_insert_id($conn);
        
        // Insert consultation details
        $query2 = "INSERT INTO consultations (patient_id, symptoms, consultation_date) VALUES ('$patient_id', '$symptoms', NOW())";
        if (mysqli_query($conn, $query2)) {
            echo "Consultation request submitted successfully. A doctor will review it shortly.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle Prescription Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_prescription'])) {
    $consultation_id = $_POST['consultation_id'];
    $diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
    $treatment = mysqli_real_escape_string($conn, $_POST['treatment']);
    $prescription = mysqli_real_escape_string($conn, $_POST['prescription']);
    $prescribed_by = mysqli_real_escape_string($conn, $_POST['prescribed_by']);

    // Insert prescription data
    $query = "INSERT INTO prescriptions (consultation_id, diagnosis, treatment, prescription, prescribed_by) 
              VALUES ('$consultation_id', '$diagnosis', '$treatment', '$prescription', '$prescribed_by')";
    if (mysqli_query($conn, $query)) {
        echo "Prescription submitted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare System - Consult a Doctor</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background: url('tele.jpg') no-repeat center center fixed;
    background-size: cover;
    margin: 0;
    padding: 0;
}

.container {
    width: 60%;
    margin: 50px auto;
    background-color: rgba(255, 255, 255, 0.9); /* semi-transparent white */
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
}

        h2, h3 {
            text-align: center;
        }
        input, textarea, button {
            width: 85%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            font-size: 18px;
        }
        button:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        table th {
            background-color: #f8f8f8;
        }
        .back-container {
            text-align: center;
            margin-top: 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Consult a Doctor</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="phone" placeholder="Your Phone Number" required>
            <textarea name="symptoms" placeholder="Describe your symptoms" required></textarea>
            <button type="submit" name="submit_consultation">Submit Consultation</button>
        </form>
        
        <h3>Doctor's Dashboard</h3>
        <table>
            <tr>
                <th>Patient Name</th>
                <th>Symptoms</th>
                <th>Consultation Date</th>
                <th>Actions</th>
            </tr>
            <?php
            $query = "SELECT * FROM consultations WHERE diagnosis IS NULL";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['patient_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['symptoms']) . '</td>';
                echo '<td>' . $row['consultation_date'] . '</td>';
                echo '<td><a href="?consultation_id=' . $row['id'] . '">Provide Prescription</a></td>';
                echo '</tr>';
            }
            ?>
        </table>
        
        <?php if (isset($_GET['consultation_id'])) { 
            $consultation_id = $_GET['consultation_id'];
            ?>
        
        <h3>Provide Diagnosis and Treatment</h3>
        <form method="POST">
            <input type="hidden" name="consultation_id" value="<?php echo $consultation_id; ?>">
            <textarea name="diagnosis" placeholder="Enter diagnosis" required></textarea>
            <textarea name="treatment" placeholder="Enter treatment plan" required></textarea>
            <textarea name="prescription" placeholder="Enter prescription" required></textarea>
            <input type="text" name="prescribed_by" placeholder="Doctor's Name" required>
            <button type="submit" name="submit_prescription">Submit Prescription</button>
        </form>
        
        <?php } ?>
    </div>
    <div class="back-container">
        <a href="healthcarefrontend1.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
