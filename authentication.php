<?php
header("Content-Type: application/json");
require_once 'db.php';
use \Firebase\JWT\JWT;

$secretKey = "your_secret_key";

$data = json_decode(file_get_contents("php://input"));

if (isset($data->username) && isset($data->password)) {
    $username = $data->username;
    $password = $data->password;

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $payload = array(
            "user_id" => $user['id'],
            "username" => $user['username'],
            "iat" => time(),
            "exp" => time() + 3600 /
        );

        $jwt = JWT::encode($payload, $secretKey);
        echo json_encode(array("token" => $jwt));
    } else {
        echo json_encode(array("message" => "Invalid credentials"));
    }
} else {
    echo json_encode(array("message" => "Username and password required"));
}
?>
