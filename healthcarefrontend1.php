<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission (e.g., sending email or saving to a database)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Here you would typically process the form, like sending an email or saving it in the database
    // For now, just echoing the values to simulate the action
    echo "<p class='success'>Thank you, $name! Your message has been sent successfully.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpson's Health Sphere</title>
    <meta name="description" content="Health Sphere provides innovative healthcare solutions including telemedicine, EHR, and appointment scheduling.">
    
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <style>
        :root {
            --primary: #1a73e8;
            --primary-dark: #0d47a1;
            --primary-light: #e8f0fe;
            --secondary: #ff5722;
            --secondary-dark: #e64a19;
            --white: #ffffff;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --overlay: rgba(255, 255, 255, 0.85);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1), 0 5px 10px rgba(0,0,0,0.05);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('images/medical-bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--dark);
            line-height: 1.6;
            position: relative;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: var(--overlay);
            z-index: -1;
        }
        
        /* Typography */
        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            line-height: 1.2;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        /* Layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 1rem 0;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .logo i {
            font-size: 2rem;
            color: var(--white);
        }
        
        .logo h1 {
            font-size: 1.75rem;
            color: var(--white);
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        /* Navigation */
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .nav-links {
            display: flex;
            gap: 1rem;
            list-style: none;
        }
        
        .nav-links li a {
            color: var(--white);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .nav-links li a:hover, .nav-links li a.active {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }
        
        .nav-links li a i {
            font-size: 1rem;
        }
        
        /* Hero Section */
        .hero {
            text-align: center;
            padding: 5rem 2rem;
            background: linear-gradient(135deg, rgba(26, 115, 232, 0.9), rgba(13, 71, 161, 0.9));
            color: var(--white);
            border-radius: 12px;
            margin: 2rem 0;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/medical-pattern.png') center/cover;
            opacity: 0.1;
            z-index: -1;
        }
        
        .hero h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }
        
        .hero p {
            font-size: 1.25rem;
            max-width: 800px;
            margin: 0 auto 2rem;
            opacity: 0.9;
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 1.75rem;
            border-radius: 50px;
            font-weight: 600;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--white);
            color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: rgba(255, 255, 255, 0.9);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        /* Health Topics */
        .health-topics {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 2rem;
        }
        
        .topic-btn {
            padding: 0.5rem 1.25rem;
            background-color: rgba(255, 255, 255, 0.15);
            color: var(--white);
            border-radius: 50px;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .topic-btn:hover {
            background-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }
        
        /* Services Section */
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            color: var(--primary-dark);
            margin-bottom: 1rem;
        }
        
        .section-title p {
            color: var(--gray);
            max-width: 700px;
            margin: 0 auto;
        }
        
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }
        
        .service-card {
            background-color: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            position: relative;
            height: 350px;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }
        
        .service-img {
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        
        .service-img::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.5));
        }
        
        .service-content {
            padding: 1.5rem;
        }
        
        .service-content h3 {
            font-size: 1.5rem;
            margin-bottom: 0.75rem;
            color: var(--primary-dark);
        }
        
        .service-content p {
            color: var(--gray);
            margin-bottom: 1.5rem;
        }
        
        .service-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            font-weight: 600;
            transition: var(--transition);
        }
        
        .service-link i {
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }
        
        .service-link:hover {
            color: var(--primary-dark);
        }
        
        .service-link:hover i {
            transform: translateX(5px);
        }
        
        /* AI Assistant Section */
        .ai-assistant {
            background-color: var(--white);
            border-radius: 12px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
            text-align: center;
        }
        
        .ai-assistant h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }
        
        .ai-assistant p {
            color: var(--gray);
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .ai-form {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }
        
        .ai-form input {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid var(--light-gray);
            border-radius: 50px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .ai-form input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
        }
        
        .ai-form button {
            position: absolute;
            right: 5px;
            top: 5px;
            bottom: 5px;
            padding: 0 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .ai-form button:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            transform: translateY(-2px);
        }
        
        /* Nutrition Tracker */
        .nutrition-tracker {
            background-color: var(--white);
            border-radius: 12px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }
        
        .nutrition-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            max-width: 800px;
            margin: 0 auto 2rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
        }
        
        .nutrition-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            box-shadow: var(--shadow-sm);
        }
        
        .nutrition-table th, .nutrition-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--light-gray);
        }
        
        .nutrition-table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: 600;
        }
        
        .nutrition-table tr:nth-child(even) {
            background-color: var(--light);
        }
        
        .nutrition-table tr:hover {
            background-color: var(--light-gray);
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .edit-btn {
            background-color: var(--warning);
            color: var(--dark);
            border: none;
            margin-right: 0.5rem;
        }
        
        .delete-btn {
            background-color: var(--danger);
            color: var(--white);
            border: none;
        }
        
        /* Contact Section */
        .contact-section {
            background-color: var(--white);
            border-radius: 12px;
            padding: 3rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }
        
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .contact-form .form-group {
            margin-bottom: 1.5rem;
        }
        
        .contact-form textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--light-gray);
            border-radius: 8px;
            font-size: 1rem;
            min-height: 150px;
            resize: vertical;
            transition: var(--transition);
        }
        
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
        }
        
        /* Alerts */
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            text-align: left;
            margin-bottom: 2rem;
        }
        
        .footer-column h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            display: inline-block;
        }
        
        .footer-column h3::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--white);
        }
        
        .footer-column p, .footer-column a {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
            display: block;
            transition: var(--transition);
        }
        
        .footer-column a:hover {
            color: var(--white);
            transform: translateX(5px);
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
        }
        
        .social-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }
        
        .copyright {
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .hero h2 {
                font-size: 2.5rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .header-container {
                padding: 0 1rem;
            }
            
            .nav-toggle {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: linear-gradient(135deg, var(--primary), var(--primary-dark));
                flex-direction: column;
                align-items: center;
                padding: 2rem 0;
                transition: all 0.5s ease;
                gap: 1.5rem;
            }
            
            .nav-links.active {
                left: 0;
            }
            
            .hero {
                padding: 3rem 1rem;
            }
            
            .hero h2 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .btn-group {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 300px;
            }
            
            .health-topics {
                flex-direction: column;
                align-items: center;
            }
            
            .topic-btn {
                width: 100%;
                max-width: 200px;
                text-align: center;
            }
        }
        
        @media (max-width: 576px) {
            .logo h1 {
                font-size: 1.5rem;
            }
            
            .hero h2 {
                font-size: 1.75rem;
            }
            
            .section-title h2 {
                font-size: 1.75rem;
            }
            
            .nutrition-form {
                grid-template-columns: 1fr;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
        
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }
    </style>
</head>
<body>
    <!-- Database Error Display -->
    <?php if (isset($db_error)): ?>
        <div class="alert alert-danger container"><?php echo $db_error; ?></div>
    <?php endif; ?>
    
    <!-- Header -->
    <header>
        <div class="header-container container">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h1>Health Sphere</h1>
            </div>
            
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <ul class="nav-links" id="navLinks">
                <li><a href="home.php" class="active"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="appointment.php"><i class="fas fa-calendar-check"></i> Appointments</a></li>
                <li><a href="telemedicine.php"><i class="fas fa-video"></i> Telemedicine</a></li>
                <li><a href="ehr.php"><i class="fas fa-file-medical"></i> EHR</a></li>
                <li><a href="feedback.php"><i class="fas fa-comment-alt"></i> Feedback</a></li>
                <li><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                <li><a href="doctors.php"><i class="fas fa-user-md"></i> Doctors</a></li>
            </ul>
        </div>
    </header>
    
    <main class="container">
        <!-- Hero Section -->
        <section class="hero fade-in">
            <h2>Your Health, Our Priority</h2>
            <p>Comprehensive healthcare solutions tailored to your needs with cutting-edge technology and compassionate care.</p>
            
            <div class="btn-group">
                <a href="appointment.php" class="btn btn-primary">Book an Appointment</a>
                <a href="telemedicine.php" class="btn btn-secondary">Virtual Consultation</a>
            </div>
            
            <div class="health-topics">
                <a href="family_planning.php" class="topic-btn">Family Planning</a>
                <a href="hiv.php" class="topic-btn">HIV/AIDS</a>
                <a href="tuberculosis.php" class="topic-btn">Tuberculosis</a>
                <a href="antenatal.html" class="topic-btn">Antenatal Care</a>
                <a href="pediatrics.html" class="topic-btn">Pediatrics</a>
            </div>
        </section>
        
        <!-- Services Section -->
        <section>
            <div class="section-title fade-in">
                <h2>Our Services</h2>
                <p>Access a wide range of healthcare services designed to meet your needs</p>
            </div>
            
            <div class="services">
                <div class="service-card fade-in delay-1">
                    <div class="service-img" style="background-image: url('appoint.jpg');"></div>
                    <div class="service-content">
                        <h3>Appointments</h3>
                        <p>Schedule your health checkups and consultations with our specialists.</p>
                        <a href="appointment.php" class="service-link">Book Now <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="service-card fade-in delay-2">
                    <div class="service-img" style="background-image: url('tele.jpg');"></div>
                    <div class="service-content">
                        <h3>Telemedicine</h3>
                        <p>Consult with our doctors remotely through secure video calls from anywhere.</p>
                        <a href="telemedicine.php" class="service-link">Start Consultation <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                
                <div class="service-card fade-in delay-3">
                    <div class="service-img" style="background-image: url('ehr.jpg');"></div>
                    <div class="service-content">
                        <h3>Electronic Health Records</h3>
                        <p>Access and manage your complete medical history securely online.</p>
                        <a href="ehr.php" class="service-link">View Records <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- AI Assistant Section -->
        <section class="ai-assistant fade-in">
            <h2>Healthcare AI Assistant</h2>
            <p>Get instant answers to your health questions from our AI-powered assistant.</p>
            
            <form class="ai-form" method="POST" action="watson_ai.php">
                <input type="text" name="user_question" placeholder="Ask me anything about health..." required>
                <button type="submit"><i class="fas fa-paper-plane"></i> Ask</button>
            </form>
        </section>
        
        <!-- Nutrition Tracker Section -->
        <section class="nutrition-tracker fade-in">
            <div class="section-title">
                <h2>Nutrition Tracker</h2>
                <p>Monitor your daily nutrition intake for better health management</p>
            </div>
            
            <?php if (isset($nutrition_success)): ?>
                <div class="alert alert-success"><?php echo $nutrition_success; ?></div>
            <?php elseif (isset($nutrition_error)): ?>
                <div class="alert alert-danger"><?php echo $nutrition_error; ?></div>
            <?php endif; ?>
            
            <form class="nutrition-form" action="home.php" method="POST">
                <div class="form-group">
                    <label for="food-item">Food Item</label>
                    <input type="text" id="food-item" name="food_item" placeholder="e.g., Apple, Chicken Breast" required>
                </div>
                
                <div class="form-group">
                    <label for="calories">Calories (kcal)</label>
                    <input type="number" id="calories" name="calories" placeholder="250" required>
                </div>
                
                <div class="form-group">
                    <label for="meal-time">Meal Time</label>
                    <select id="meal-time" name="meal_time" required>
                        <option value="">Select meal time</option>
                        <option value="breakfast">Breakfast</option>
                        <option value="lunch">Lunch</option>
                        <option value="dinner">Dinner</option>
                        <option value="snack">Snack</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                
                <div class="form-group" style="grid-column: 1 / -1; text-align: center;">
                    <button type="submit" name="nutrition_tracker.php" class="btn btn-primary" style="padding: 0.75rem 2rem;">Track Nutrition</button>
                </div>
            </form>
            
            <div class="table-responsive">
                <table class="nutrition-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Food Item</th>
                            <th>Calories</th>
                            <th>Meal Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data - in real app this would come from database -->
                        <tr>
                            <td>2023-06-15</td>
                            <td>Grilled Chicken Salad</td>
                            <td>320</td>
                            <td>Lunch</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2023-06-15</td>
                            <td>Oatmeal with Berries</td>
                            <td>280</td>
                            <td>Breakfast</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>2023-06-14</td>
                            <td>Salmon with Vegetables</td>
                            <td>450</td>
                            <td>Dinner</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="action-btn delete-btn"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        
        <!-- Contact Section -->
        <section class="contact-section fade-in">
            <div class="section-title">
                <h2>Contact Us</h2>
                <p>Have questions or need assistance? Reach out to our team</p>
            </div>
            
            <?php if (isset($contact_success)): ?>
                <div class="alert alert-success"><?php echo $contact_success; ?></div>
            <?php elseif (isset($contact_error)): ?>
                <div class="alert alert-danger"><?php echo $contact_error; ?></div>
            <?php endif; ?>
            
            <form class="contact-form" action="home.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>
                </div>
                
                <div class="form-group" style="text-align: center;">
                    <button type="submit" name="contact_submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">Send Message</button>
                </div>
            </form>
        </section>
    </main>
    
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>Health Sphere</h3>
                    <p>Providing comprehensive healthcare solutions with cutting-edge technology and compassionate care.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="home.php">Home</a>
                    <a href="appointment.php">Appointments</a>
                    <a href="telemedicine.php">Telemedicine</a>
                    <a href="ehr.php">Medical Records</a>
                    <a href="doctors.php">Our Doctors</a>
                </div>
                
                <div class="footer-column">
                    <h3>Health Topics</h3>
                    <a href="family_planning.php">Family Planning</a>
                    <a href="hiv.php">HIV/AIDS</a>
                    <a href="tuberculosis.php">Tuberculosis</a>
                    <a href="antenatal.html">Antenatal Care</a>
                    <a href="pediatrics.html">Pediatrics</a>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Kakira, Kakira T/C - Jinja</p>
                    <p><i class="fas fa-phone"></i>  (256) 747-766-685</p>
                    <p><i class="fas fa-envelope"></i> info@healthsphere.com</p>
                    <p><i class="fas fa-clock"></i> Mon-Fri: 8AM-8PM, Sat: 9AM-4PM</p>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Health Sphere. All rights reserved.</p>
                <p>Developed by Irahari Samson. ™ simpsoncodes</p>
            </div>
        </div>
    </footer>
    
    <script>
        // Mobile Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');
        
        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
        
        // Form validation
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.style.borderColor = '#dc3545';
                        isValid = false;
                    } else {
                        field.style.borderColor = '#ced4da';
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        });
        
        // Animation on scroll
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        fadeElements.forEach(element => {
            element.style.opacity = 0;
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(element);
        });
    </script>
</body>
</html>