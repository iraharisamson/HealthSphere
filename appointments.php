<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, $_POST['message']) : '';
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $payment_details = isset($_POST['payment_details']) ? mysqli_real_escape_string($conn, $_POST['payment_details']) : '';

    $query = "INSERT INTO appointments (name, email, appointment_date, message, payment_method, payment_details) 
              VALUES ('$name', '$email', '$appointment_date', '$message', '$payment_method', '$payment_details')";
    if (mysqli_query($conn, $query)) {
        $success_message = "Appointment booked successfully!";
    } else {
        $error_message = "There was an error booking your appointment. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment | Healthcare Services</title>
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
            background-image: linear-gradient(rgba(74, 111, 165, 0.85), rgba(22, 96, 136, 0.9)), url('appoint.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: var(--dark-color);
            line-height: 1.6;
        }

        .appointment-container {
            background: var(--light-color);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 550px;
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
            font-size: 1.8rem;
            position: relative;
            padding-bottom: 10px;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            font-size: 0.95rem;
        }

        input, textarea, select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-family: inherit;
            font-size: 0.95rem;
            transition: var(--transition);
            background-color: #fff;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(79, 195, 161, 0.2);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        button {
            width: 100%;
            padding: 0.85rem;
            background: var(--accent-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background: #3daa8a;
            transform: translateY(-2px);
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

        .nav-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
        }

        .nav-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
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

        .required-field::after {
            content: " *";
            color: var(--error-color);
        }

        @media (max-width: 576px) {
            .appointment-container {
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            .nav-links {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .nav-link {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <div class="appointment-container">
        <h2>Book Your Appointment</h2>

        <?php if (isset($success_message)) { ?>
            <div class="message success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php } elseif (isset($error_message)) { ?>
            <div class="message error-message">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <form action="appointment.php" method="post">
            <div class="form-group">
                <label for="name" class="required-field">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Irahari" required>
            </div>

            <div class="form-group">
                <label for="email" class="required-field">Email Address</label>
                <input type="email" name="email" id="email" placeholder="ira@example.com" required>
            </div>

            <div class="form-group">
                <label for="appointment_date" class="required-field">Preferred Appointment Date</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="message">Additional Information</label>
                <textarea name="message" id="message" placeholder="Please share any special requests or details about your appointment"></textarea>
            </div>

            <div class="form-group">
                <label for="payment_method" class="required-field">Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="" disabled selected>Select payment method</option>
                    <option value="credit_card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="mobile_money">Mobile Money</option>
                </select>
            </div>

            <div class="form-group">
                <label for="payment_details" class="required-field">Payment Details</label>
                <textarea name="payment_details" id="payment_details" 
                    placeholder="Enter your payment details (e.g., card number, PayPal email, or mobile money number)" 
                    required></textarea>
            </div>

            <button type="submit">
                <i class="fas fa-calendar-check"></i> Confirm Appointment
            </button>
        </form>

        <div class="nav-links">
            <a href="view_appointments.php" class="nav-link">
                <i class="fas fa-list-alt"></i> View Appointments
            </a>
            <a href="healthcarefrontend1.php" class="nav-link">
                <i class="fas fa-home"></i> Back to Home
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
