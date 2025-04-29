<?php
// Include database connection
include('db.php');

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch doctors with error handling
$query = "SELECT * FROM doctors";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Debug: Count number of doctors
$doctor_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Doctors</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
        }
        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .doctor-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        .doctor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }
        .doctor-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4f46e5;
            margin: 0 auto;
        }
        .doctor-card h3 {
            margin: 15px 0 5px;
            color: #333;
        }
        .specialty {
            color: #4f46e5;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .doctor-card p {
            color: #777;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .view-btn {
            display: inline-block;
            margin-top: 10px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .view-btn:hover {
            background-color: #3730a3;
            transform: translateY(-2px);
        }
        .no-doctors {
            text-align: center;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            grid-column: 1 / -1;
        }
        .debug-info {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <!-- Debug information (remove in production) -->
    <div class="debug-info">
        <strong>Debug Information:</strong><br>
        Database Connection: <?php echo $conn ? "Successful" : "Failed"; ?><br>
        Doctors Found: <?php echo $doctor_count; ?><br>
        Last Error: <?php echo mysqli_error($conn); ?>
    </div>

    <h2 style="text-align:center; margin-bottom:30px;">Meet Our Doctors</h2>
    
    <div class="doctor-grid">
        <?php if ($doctor_count > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="doctor-card">
                    <?php 
                    $profile_img = !empty($row['profile_picture']) ? 
                        'uploads/doctors/' . htmlspecialchars($row['profile_picture']) : 
                        'images/default-doctor.jpg';
                    ?>
                    <img src="<?php echo $profile_img; ?>" alt="Doctor Photo" class="doctor-img" 
                         onerror="this.src='images/default-doctor.jpg'">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p class="specialty"><?php echo htmlspecialchars($row['specialty']); ?></p>
                    <p><?php echo htmlspecialchars($row['phone'] ?? 'Phone not provided'); ?></p>
                    <a href="doctor_profile.php?id=<?php echo $row['id']; ?>" class="view-btn">View Profile</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-doctors">
                <h3>No Doctors Found</h3>
                <p>We currently don't have any doctors registered in our system.</p>
                <a href="login_register.php" class="view-btn">Register a Doctor</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>