<?php

require 'config.php'; // Database connection
require 'PHPMailer/PHPMailerAutoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prescription_id'])) {
    $prescription_id = $_POST['prescription_id'];

    // Fetch prescription details
    $stmt = $pdo->prepare("SELECT * FROM prescriptions WHERE id = ?");
    $stmt->execute([$prescription_id]);
    $prescription = $stmt->fetch();

    if (!$prescription) {
        echo json_encode(['status' => 'error', 'message' => 'Prescription not found']);
        exit;
    }

    // Update prescription as erroneous
    $updateStmt = $pdo->prepare("UPDATE prescriptions SET error_flag = 1 WHERE id = ?");
    $updateStmt->execute([$prescription_id]);

    // Fetch user details
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$prescription['user_id']]);
    $user = $stmt->fetch();

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
        exit;
    }

    // Insert notification into database
    $notifStmt = $pdo->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
    $notifStmt->execute([$user['id'], "There was an error in your prescription ({$prescription['medication']}). Please consult your doctor."]);

    // Send email notification
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@gmail.com';
        $mail->Password = 'your_email_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your_email@gmail.com', 'Healthcare Team');
        $mail->addAddress($user['email']);
        $mail->Subject = 'Prescription Error Notification';
        $mail->Body = "Dear {$user['name']},\n\nThere was an error in your prescription for {$prescription['medication']}. Please contact your doctor for clarification.\n\nBest Regards,\nHealthcare Team";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Notification sent successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Mail could not be sent.']);
    }
}
?>

<!-- Frontend (healthcarefrintend1.php) -->
<form id="errorForm" method="POST" action="notify_prescription_error.php">
    <input type="hidden" name="prescription_id" id="prescription_id" value="123"> <!-- Dynamic Prescription ID -->
    <button type="submit">Report Error</button>
</form>

<script>
document.getElementById("errorForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission
    
    const formData = new FormData(this);

    fetch("notify_prescription_error.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message); // Show success or error message
    })
    .catch(error => console.error("Error:", error));
});
</script>
