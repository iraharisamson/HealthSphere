<?php
include 'db.php'; // Database connection

$query = "SELECT * FROM medical_history ORDER BY appointment_date DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; }
        .container { width: 80%; margin: 20px auto; background: white; padding: 20px; border-radius: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background-color: #28a745; color: white; }
    </style>
</head>  
<body>
    <div class="container">
        <h2>Medical Records</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Diagnosis</th>
                <th>Treatment</th>
                <th>Medication</th>
                <th>Appointment Date</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                <td><?php echo htmlspecialchars($row['medication']); ?></td>
                <td><?php echo $row['appointment_date']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
