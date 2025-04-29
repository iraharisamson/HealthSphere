<?php
session_start();
require_once('db.php'); // Database connection

// Initialize variables
$errors = [];
$success = '';

// Register New User
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validation
    if (empty($username) || strlen($username) < 4) {
        $errors[] = "Username must be at least 4 characters";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // Check if username/email exists
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $errors[] = "Username or email already exists";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $success = "Registration successful! Please login.";
            $_POST = []; // Clear form
        } else {
            $errors[] = "Registration failed: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Login User
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errors[] = "Please enter both username and password";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect based on role
            $redirect = $user['role'] === 'doctor' ? 'doctor_dashboard.php' : 'patient_dashboard.php';
            header("Location: $redirect");
            exit;
        } else {
            $errors[] = "Invalid username or password";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthSphere | Login & Register</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --secondary: #10b981;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --danger: #ef4444;
            --success: #10b981;
            --warning: #f59e0b;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #dfe7f5);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            animation: fadeIn 0.6s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .welcome-section {
            flex: 1;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .welcome-section img {
            width: 150px;
            margin-bottom: 20px;
        }
        
        .welcome-section h1 {
            font-size: 2rem;
            margin-bottom: 15px;
        }
        
        .welcome-section p {
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .form-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .form-container {
            width: 100%;
        }
        
        .form-toggle {
            display: flex;
            margin-bottom: 30px;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .toggle-btn {
            flex: 1;
            padding: 12px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            color: var(--gray);
            transition: var(--transition);
            border-bottom: 3px solid transparent;
        }
        
        .toggle-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
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
            padding: 12px 15px;
            border: 1px solid var(--light-gray);
            border-radius: 8px;
            font-size: 16px;
            transition: var(--transition);
        }
        
        input:focus, select:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-secondary {
            background-color: var(--light);
            color: var(--primary);
            margin-top: 10px;
        }
        
        .btn-secondary:hover {
            background-color: var(--light-gray);
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }
        
        .hidden {
            display: none;
        }
        
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .welcome-section {
                padding: 30px 20px;
            }
            
            .form-section {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <img src="health.jpg" alt="HealthSphere Logo" class="logo">
            <h1>Welcome to HealthSphere</h1>
            <p>Your complete healthcare solution with secure access for doctors and patients.</p>
            <div class="features">
                <div style="margin-bottom: 15px;">
                    <i class="fas fa-user-md" style="margin-right: 10px;"></i>
                    <span>Doctor Portal</span>
                </div>
                <div style="margin-bottom: 15px;">
                    <i class="fas fa-user" style="margin-right: 10px;"></i>
                    <span>Patient Dashboard</span>
                </div>
                <div>
                    <i class="fas fa-shield-alt" style="margin-right: 10px;"></i>
                    <span>Secure Access</span>
                </div>
            </div>
        </div>
        
        <div class="form-section">
            <div class="form-toggle">
                <div class="toggle-btn active" id="login-toggle">Login</div>
                <div class="toggle-btn" id="register-toggle">Register</div>
            </div>
            
            <!-- Success Messages -->
            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <!-- Error Messages -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><i class="fas fa-exclamation-circle"></i> <?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="form-container">
                <!-- Login Form -->
                <form id="login-form" method="POST" action="">
                    <div class="form-group">
                        <label for="login-username">Username</label>
                        <input type="text" id="login-username" name="username" placeholder="Enter your username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('login-password')"></i>
                        </div>
                    </div>
                    
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="forgot_password.php" style="color: var(--primary); text-decoration: none;">Forgot password?</a>
                    </div>
                </form>
                
                <!-- Registration Form -->
                <form id="register-form" method="POST" action="" class="hidden">
                    <div class="form-group">
                        <label for="register-username">Username</label>
                        <input type="text" id="register-username" name="username" placeholder="Choose a username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="register-password" name="password" placeholder="Create a password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('register-password')"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="role">I am a:</label>
                        <select id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="doctor">Doctor</option>
                            <option value="patient">Patient</option>
                        </select>
                    </div>
                    
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                    
                    <div style="text-align: center; margin-top: 15px;">
                        <a href="#" id="show-login" style="color: var(--primary); text-decoration: none;">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle between login and register forms
        const loginToggle = document.getElementById('login-toggle');
        const registerToggle = document.getElementById('register-toggle');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const showLogin = document.getElementById('show-login');
        
        loginToggle.addEventListener('click', () => {
            loginToggle.classList.add('active');
            registerToggle.classList.remove('active');
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        });
        
        registerToggle.addEventListener('click', () => {
            registerToggle.classList.add('active');
            loginToggle.classList.remove('active');
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
        });
        
        showLogin.addEventListener('click', (e) => {
            e.preventDefault();
            loginToggle.click();
        });
        
        // Toggle password visibility
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling;
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
        
        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#ef4444';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#e9ecef';
                    }
                });
                
                // Password match validation for register form
                if (this.id === 'register-form') {
                    const password = document.getElementById('register-password');
                    const confirmPassword = document.getElementById('confirm-password');
                    
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.style.borderColor = '#ef4444';
                        isValid = false;
                        alert('Passwords do not match');
                    }
                }
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>