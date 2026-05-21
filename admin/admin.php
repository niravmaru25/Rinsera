<?php
ob_start();
session_start();

if (!isset($_SESSION["admin_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../index.php");
    exit();
}

require_once '../db.php';

/*MARK ALL NOTIFICATION AS SEEN*/
if (isset($_GET['mark_all_seen'])) {
    $conn->query("UPDATE laundry_requests
                  SET notification = 'seen'
                  WHERE notification = 'unseen'");
    header('Location: admin.php');
    exit();
}

if (isset($_GET['page']) && $_GET['page'] === 'notification') {
    $conn->query("UPDATE laundry_requests
                  SET notification = 'seen'
                  WHERE notification = 'unseen'");
}

$id = $_SESSION["admin_id"];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

$name = htmlspecialchars($admin["name"]);
$password = htmlspecialchars($admin["password"]);

include '../components/greeting.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/dataTables/dataTables.min.css">
    <link rel="stylesheet" href="../assets/css/common.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>

<body>
    <?php include '../components/logout.php'; ?>

    <header>
        <button class="menu-toggle" id="menuToggle">☰</button>
        <h3 class="header-title">
            <?php echo $greet . ', ' . $name . ' (Admin)'; ?>
        </h3>

        <div class="notification-wrapper">
            <i class="fa-solid fa-bell"></i>

            <!-- DROPDOWN -->
            <?php include 'notification/brief-notification.php'; ?>
        </div>
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
            <a href="?page=registered_users"><i class="fas fa-user"></i>Registered Users</a>
            <a href="?page=laundry_requests"><i class="fas fa-box"></i>Laundry Requests</a>
            <a href="?page=manage_prices"><i class="fas fa-tag"></i>Manage Prices</a>
            <a href="?page=reports"><i class="fas fa-clipboard-list"></i>Reports</a>
            <a href="?page=change_password"><i class="fas fa-lock"></i>Change Password</a>
            <a onclick="openlogout()"><i class="fas fa-sign-out-alt"></i>Log out</a>
        </div>
    </aside>

    <main>
        <?php
        $page = $_GET['page'] ?? 'dashboard';

        if ($page == 'dashboard') {
            include 'dashboard/getChart.php';
            include 'dashboard/dashboard.php';

        } else if ($page == 'registered_users') {
            include 'registered_users/update_users.php';
            include 'registered_users/view_users.php';

        } else if ($page == 'laundry_requests') {
            include 'laundry_requests/update_status.php';
            include 'laundry_requests/laundry_requests.php';

        } else if ($page == 'manage_prices') {
            include 'manage_prices/update_prices.php';
            include 'manage_prices/view_prices.php';

        } else if ($page == 'reports') {
            include 'reports/generate_report.php';
            include 'reports/show_report.php';

        } else if ($page == 'change_password') {
            include 'change_password/change_password.php';

        } else if ($page == 'notification') {
            include 'notification/notification.php';

        } else if ($page == 'logout') {
            session_unset();
            session_destroy();
            header("Location: ../");
            exit();
        } ?>
    </main>

    <script src="../assets/js/common.js"></script>
    <script src="../assets/js/admin.js"></script>
    <script src="../assets/dataTables/dataTables.min.js"></script>
    <script>
        new DataTable('#user_table', {
            pageLength: 10
        });

        new DataTable('#laundry_table', {
            pageLength: 10,
            order: [[0, 'desc']]
        });
    </script>
</body>

</html>