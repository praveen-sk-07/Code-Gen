<?php
include 'config.php'; // Make sure to include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Redirect to the desired URL after successful login
        header("Location: https://code-deck.vercel.app/");
        exit(); // Stop executing the script after the redirect
    } else {
        // If login fails, you might want to send a response or redirect to an error page
        echo json_encode(['message' => 'Invalid credentials']);
    }
}
?>
