<?php
include('db.php');

if (isset($_POST['send'])) {
    $user_id = $_SESSION['user_id'];
    $message = $_POST['message'];
    $receiver_id = 1; // For simplicity, we'll send it to user with ID = 1 (You can dynamically set this based on chat partner)

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$user_id', '$receiver_id', '$message')";
    if (mysqli_query($conn, $sql)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
