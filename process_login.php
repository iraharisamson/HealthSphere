<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; // Use correct variable
    $password = md5($_POST['password']); // Hash input password using md5

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        header("Location: healthcarefrontend1.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Invalid username or password.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
