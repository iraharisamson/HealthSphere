<?php
include 'db.php'; // Database connection

// Handle form submission to add medical records
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_record'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
    $treatment = mysqli_real_escape_string($conn, $_POST['treatment']);
    $medication = mysqli_real_escape_string($conn, $_POST['medication']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);

    $query = "INSERT INTO medical_history (name, email, diagnosis, treatment, medication, appointment_date) 
              VALUES ('$name', '$email', '$diagnosis', '$treatment', '$medication', '$appointment_date')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Medical record added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding medical record: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch medical records
$query = "SELECT * FROM medical_history ORDER BY appointment_date DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Health Records (EHR) | Healthcare System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --accent-color: #4fc3a1;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
            --error-color: #dc3545;
            --border-radius: 8px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: linear-gradient(rgba(74, 111, 165, 0.85), rgba(22, 96, 136, 0.9)), url('ehr.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        h2, h3 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
            position: relative;
        }

        h2 {
            font-size: 2rem;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        h3 {
            font-size: 1.5rem;
            margin-top: 2rem;
        }

        .form-container, .records-container {
            margin-bottom: 3rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
        }

        .required-field::after {
            content: " *";
            color: var(--error-color);
        }

        input, textarea, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(79, 195, 161, 0.2);
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        button {
            padding: 0.85rem 1.5rem;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background: #3daa8a;
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary-color);
        }

        .btn-primary:hover {
            background: #3a5a80;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 1rem;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .nav-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .nav-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .message {
            padding: 0.75rem 1rem;
            border-radius: var(--border-radius);
            margin: 1.5rem 0;
            text-align: center;
            font-weight: 500;
        }

        .success-message {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .error-message {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--error-color);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                width: 95%;
                padding: 1.5rem;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-heartbeat"></i> Electronic Health Records</h2>

        <?php if (isset($success_message)) { ?>
            <div class="message success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php } elseif (isset($error_message)) { ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <!-- Medical Record Entry Form -->
        <div class="form-container">
            <h3><i class="fas fa-plus-circle"></i> Add New Record</h3>
            <form method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="required-field">Patient Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter patient's full name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email" class="required-field">Email</label>
                        <input type="email" name="email" id="email" placeholder="patient@example.com" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="appointment_date" class="required-field">Appointment Date</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="medication" class="required-field">Medication</label>
                        <textarea name="medication" id="medication" placeholder="Prescribed medications and dosage" required></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="diagnosis" class="required-field">Diagnosis</label>
                    <textarea name="diagnosis" id="diagnosis" placeholder="Enter diagnosis details" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="treatment" class="required-field">Treatment Plan</label>
                    <textarea name="treatment" id="treatment" placeholder="Describe the treatment plan" required></textarea>
                </div>
                
                <button type="submit" name="submit_record" class="btn-primary">
                    <i class="fas fa-save"></i> Save Record
                </button>
            </form>
        </div>

        <!-- Medical Records Display -->
        <div class="records-container">
            <h3><i class="fas fa-clipboard-list"></i> Patient Records</h3>
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Email</th>
                        <th>Diagnosis</th>
                        <th>Treatment</th>
                        <th>Medication</th>
                        <th>Appointment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                        <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                        <td><?php echo htmlspecialchars($row['medication']); ?></td>
                        <td><?php echo date('M j, Y g:i A', strtotime($row['appointment_date'])); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="nav-links">
            <a href="healthcarefrontend1.php" class="nav-link">
                <i class="fas fa-home"></i> Back to Dashboard
            </a>
            <a href="view_appointments.php" class="nav-link">
                <i class="fas fa-calendar-alt"></i> View Appointments
            </a>
        </div>
    </div>

    <script>
        // Set minimum date to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().slice(0, 16);
            document.getElementById('appointment_date').min = today;
        });
    </script>
</body>
</html>