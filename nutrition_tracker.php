<?php
// Database Connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'nutrition';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$createTable = "CREATE TABLE IF NOT EXISTS food_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    food_item VARCHAR(255) NOT NULL,
    calories INT NOT NULL,
    meal_time VARCHAR(50) NOT NULL,
    meal_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!$conn->query($createTable)) {
    die("Error creating table: " . $conn->error);
}

// Handle form submission
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_item = $conn->real_escape_string($_POST['food_item']);
    $calories = (int)$_POST['calories'];
    $meal_time = $conn->real_escape_string($_POST['meal_time']);
    $meal_date = $conn->real_escape_string($_POST['meal_date']);

    $stmt = $conn->prepare("INSERT INTO food_logs (food_item, calories, meal_time, meal_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $food_item, $calories, $meal_time, $meal_date);

    if ($stmt->execute()) {
        $message = "<div class='alert success'>Data saved successfully!</div>";
    } else {
        $message = "<div class='alert error'>Error: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Fetch all food logs
$result = $conn->query("SELECT * FROM food_logs ORDER BY meal_date DESC, meal_time");
$food_logs = [];
if ($result) {
    $food_logs = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nutrition Tracker</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #388E3C;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .tracker-container {
            background: white;
            border-radius: 15px;
            box-shadow: var(--shadow-md);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        h2 {
            text-align: center;
            color: var(--primary-dark);
            margin-bottom: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
        }
        
        input:focus, select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        
        button {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin: 20px 0;
            font-weight: 500;
            text-align: center;
        }
        
        .alert.success {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success);
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        .alert.error {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger);
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .nutrition-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: var(--shadow-sm);
        }
        
        .nutrition-table th, .nutrition-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .nutrition-table th {
            background-color: var(--primary);
            color: white;
            font-weight: 600;
        }
        
        .nutrition-table tr:nth-child(even) {
            background-color: var(--light);
        }
        
        .nutrition-table tr:hover {
            background-color: rgba(76, 175, 80, 0.05);
        }
        
        .action-btn {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            margin-right: 5px;
        }
        
        .edit-btn {
            background-color: var(--warning);
            color: var(--dark);
        }
        
        .delete-btn {
            background-color: var(--danger);
            color: white;
        }
        
        .total-calories {
            margin-top: 20px;
            padding: 15px;
            background-color: var(--light);
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .tracker-container {
                padding: 20px;
            }
            
            .nutrition-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="tracker-container">
            <h2><i class="fas fa-utensils"></i> Nutrition Tracker</h2>
            
            <?php if (!empty($message)) echo $message; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="food_item">Food Item</label>
                    <input type="text" id="food_item" name="food_item" placeholder="e.g., Chicken Salad" required>
                </div>
                
                <div class="form-group">
                    <label for="calories">Calories</label>
                    <input type="number" id="calories" name="calories" placeholder="Enter calories" required>
                </div>
                
                <div class="form-group">
                    <label for="meal_time">Meal Time</label>
                    <select id="meal_time" name="meal_time" required>
                        <option value="">Select meal time</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Snack">Snack</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="meal_date">Date</label>
                    <input type="date" id="meal_date" name="meal_date" required>
                </div>
                
                <button type="submit"><i class="fas fa-save"></i> Save Entry</button>
            </form>
        </div>
        
        <?php if (!empty($food_logs)): ?>
            <div class="tracker-container">
                <h2><i class="fas fa-history"></i> Your Nutrition Log</h2>
                
                <table class="nutrition-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Meal Time</th>
                            <th>Food Item</th>
                            <th>Calories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total_calories = 0;
                        foreach ($food_logs as $log): 
                            $total_calories += $log['calories'];
                        ?>
                            <tr>
                                <td><?php echo date('M j, Y', strtotime($log['meal_date'])); ?></td>
                                <td><?php echo htmlspecialchars($log['meal_time']); ?></td>
                                <td><?php echo htmlspecialchars($log['food_item']); ?></td>
                                <td><?php echo number_format($log['calories']); ?></td>
                                <td>
                                    <button class="action-btn edit-btn" onclick="editEntry(<?php echo $log['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn delete-btn" onclick="deleteEntry(<?php echo $log['id']; ?>)">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="total-calories">
                    <i class="fas fa-fire"></i> Total Calories: <?php echo number_format($total_calories); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="tracker-container">
                <p style="text-align: center;">No nutrition entries found. Start tracking your meals!</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Edit entry function
        function editEntry(id) {
            if (confirm('Are you sure you want to edit this entry?')) {
                window.location.href = 'edit_entry.php?id=' + id;
            }
        }
        
        // Delete entry function
        function deleteEntry(id) {
            if (confirm('Are you sure you want to delete this entry?')) {
                window.location.href = 'delete_entry.php?id=' + id;
            }
        }
        
        // Set today's date as default
        document.getElementById('meal_date').valueAsDate = new Date();
    </script>
</body>
</html>