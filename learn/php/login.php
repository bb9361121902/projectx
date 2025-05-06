<?php
session_start();
include '../login_page/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username']; // Store the username in the session
        $_SESSION['logged_in'] = true;
        echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
    } else {
        // Login failed
        echo json_encode(['status' => 'error', 'message' => 'Invalid email or password!']);
    }
}
?>