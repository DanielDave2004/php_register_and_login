<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" id="htmlRoot">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>McDollibee – Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;600;700;800;900&family=Boogaloo&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link rel="stylesheet" href="../assets/css/style.css"/>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-brand">
            <img src="../assets/mcdolibee_logo.png" alt="McDollibee Logo" class="nav-logo"/>
            <span class="brand-text">Mc<span class="brand-yellow">Dollibee</span></span>
        </div>
        <div class="nav-actions" style="margin-left: auto;">
            <span class="dash-user">
                <i class="fa-solid fa-user" style="color: var(--red); margin-right: 0.25rem;"></i>
                <?= htmlspecialchars($_SESSION['username']) ?>
            </span>
            <button id="themeToggle" class="theme-btn" title="Switch to Dark Mode">
                <i id="themeIcon" class="fa-solid fa-sun"></i>
            </button>
            <a href="?logout=1" class="btn-login">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </nav>

    <!-- WELCOME BANNER -->
    <main class="dashboard">
        <div class="dash-banner-text">
            <h1 class="dash-welcome">Welcome <span class="dash-name"><?= htmlspecialchars($_SESSION['username']) ?>!</span></h1>
            <p class="dash-welcome-sub">What are you craving today?</p>
        </div>
    </div>
    </main>

    <script src="../assets/js/script.js"></script>
</body>
</html>