<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header('Location: ../index.php');
    exit();
}

require_once '../db.php';

$id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$name = htmlspecialchars($user["name"]);
$mobile = htmlspecialchars($user["mobile"]);
$email = htmlspecialchars($user["email"]);
$password = htmlspecialchars($user["password"]);
$created_at = htmlspecialchars($user['created_at']);

include '../components/greeting.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/user.css">
</head>

<body>

    <?php include '../components/logout.php'; ?>

    <header>
        <button class="menu-toggle" id="menuToggle">☰</button>
        <h3><?php echo $greet.', '.$name; ?></h3>
    </header>

    <aside class="sidebar">
        <div class="cross-btn" id="closeSidebar">
            <i class="fas fa-xmark"></i>
            </div>
        <div class="head">
            <img src="../assets/images/logo.png" alt="logo" id="logo">
            <h2>Rinsera</h2>
        </div>

        <div class="nav-links">
            <a href="?page=dashboard"><i class="fas fa-gauge"></i>Dashboard</a>
            <a href="?page=request_laundry"><i class="fas fa-box"></i>Request Laundry</a>
            <a href="?page=track_request"><i class="fas fa-magnifying-glass"></i>Track Request</a>
            <a href="?page=update_profile"><i class="fas fa-user"></i>Update Profile</a>
            <a href="?page=change_password"><i class="fas fa-lock"></i>Change password</a>
            <a onclick="openlogout()"><i class="fas fa-sign-out-alt"></i>Log out</a>
        </div>
    </aside>

    <main>
        <?php
        $page = $_GET['page'] ?? 'dashboard';

        if ($page == 'dashboard') {
            include 'dashboard/dashboard.php';

        } else if ($page == 'request_laundry') {
            include 'request_laundry/process_laundry.php';
            include 'request_laundry/confirm_summary.php';
            include 'request_laundry/request_laundry_form.php';
            include 'request_laundry/view_summary.php';

        } else if ($page == 'track_request') {
            include 'track_request/track_request.php';
            include 'track_request/view_request.php';

        } else if ($page == 'update_profile') {
            include 'update_profile/update_profile.php';
            include 'update_profile/view_profile.php';

        } else if ($page == 'change_password') {
            include 'change_password/change_password.php';
        
        } elseif ($page == 'logout') {
            session_unset();
            session_destroy();
            header("Location: ../");
            exit();
        } ?>

    </main>

    <script src="../assets/js/common.js"></script>
    <script src="../assets/js/user.js"></script>
</body>
</html>