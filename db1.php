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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $symptoms = $_POST['symptoms'];

    // Prepare and bind patient insertion query
    $stmt = $conn->prepare("INSERT INTO patients (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);
    $stmt->execute();

    $patient_id = $stmt->insert_id; // Get last inserted patient ID

    // Prepare and bind consultation insertion query
    $stmt2 = $conn->prepare("INSERT INTO consultations (patient_id, symptoms, consultation_date) VALUES (?, ?, NOW())");
    $stmt2->bind_param("is", $patient_id, $symptoms);
    $stmt2->execute();

    echo "Consultation request submitted successfully. A doctor will review it shortly.";
}

// Handle Prescription Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_prescription'])) {
    $consultation_id = $_POST['consultation_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $prescription = $_POST['prescription'];
    $prescribed_by = $_POST['prescribed_by'];

    // Prepare and bind prescription insertion query
    $stmt = $conn->prepare("INSERT INTO prescriptions (consultation_id, diagnosis, treatment, prescription, prescribed_by) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $consultation_id, $diagnosis, $treatment, $prescription, $prescribed_by);
    $stmt->execute();

    echo "Prescription submitted successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthcare System - Consult a Doctor</title>
    <style>
        /* Your existing CSS here */
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
            // Get consultations without diagnosis
            $query = "SELECT consultations.*, patients.name AS patient_name FROM consultations 
                      JOIN patients ON consultations.patient_id = patients.id WHERE consultations.diagnosis IS NULL";
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
            $consultation_id = (int)$_GET['consultation_id']; // Safely cast to integer
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
