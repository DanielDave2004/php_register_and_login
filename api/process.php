<?php
session_start();
require_once 'databasehandler/dbh.php';

$action = $_POST['action'] ?? '';

// ══════════════════════════════════════
//  REGISTER
// ══════════════════════════════════════
if ($action === 'register') {
    $username         = trim($_POST['username'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $phone            = trim($_POST['phone'] ?? '');
    $password         = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (!$username || !$email || !$password || !$confirm_password) {
        redirect('index.php', 'register', 'Please fill in all required fields.');
    } elseif ($password !== $confirm_password) {
        redirect('index.php', 'register', 'Passwords do not match.');
    } elseif (strlen($password) < 6) {
        redirect('index.php', 'register', 'Password must be at least 6 characters.');
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $email]);

        if ($stmt->fetch()) {
            redirect('index.php', 'register', 'Username or email already exists.');
        } else {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $insert = $pdo->prepare('INSERT INTO users (username, email, phone_number, password) VALUES (?, ?, ?, ?)');
            $insert->execute([$username, $email, $phone, $hashed]);

            $_SESSION['user_id']  = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            header('Location: pages/dashboard.php');
            exit;
        }
    }
}

// ══════════════════════════════════════
//  LOGIN
// ══════════════════════════════════════
elseif ($action === 'login') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        redirect('index.php', 'login', 'Please enter your username and password.');
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? OR email = ?');
        $stmt->execute([$username, $username]);
        $found = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($found && password_verify($password, $found['password'])) {
            $_SESSION['user_id']  = $found['id'];
            $_SESSION['username'] = $found['username'];
            header('Location: pages/dashboard.php');
            exit;
        } else {
            redirect('index.php', 'login', 'Invalid username or password.');
        }
    }
}

// ══════════════════════════════════════
//  HELPER
// ══════════════════════════════════════
function redirect($page, $panel, $error) {
    $params = http_build_query(['panel' => $panel, 'error' => $error]);
    header("Location: $page?$params");
    exit;
}
?>