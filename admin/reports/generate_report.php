<?php

$report = false;

$from_date = $_SESSION['form']['from-date'] ?? '';
$to_date = $_SESSION['form']['to-date'] ?? '';
$status = $_SESSION['form']['status'] ?? 'all';

/* ===================== HANDLE POST ===================== */
if (isset($_POST['submit-date'])) {

    $from_date = $_POST['from-date'] ?? '';
    $to_date = $_POST['to-date'] ?? '';
    $status = $_POST['status'] ?? 'all';

    if (empty($from_date) || empty($to_date)) {
        $_SESSION['form'] = $_POST;
        $_SESSION['msg'] = "<div class='msg error'>Please enter both dates!</div>";
        header("Location: admin.php?page=reports");
        exit();
    }

    if ($from_date > $to_date) {
        $_SESSION['form'] = $_POST;
        $_SESSION['msg'] = "<div class='msg error'>Starting date cannot be greater than Ending date!</div>";
        header("Location: admin.php?page=reports");
        exit();
    }

    $_SESSION['form'] = $_POST;
    header("Location: admin.php?page=reports&generated=1");
    exit();
}

/* ===================== HANDLE GET ===================== */
if (isset($_GET['generated']) && isset($_SESSION['form'])) {
    $from_date = $_SESSION['form']['from-date'];
    $to_date = $_SESSION['form']['to-date'];
    $status = $_SESSION['form']['status'];

    $query = "SELECT * FROM laundry_requests WHERE DATE(created_at) BETWEEN ? AND ?";

    if ($status == 'completed') {
        $query .= " AND status = 'completed'";
    } elseif ($status == 'cancelled') {
        $query .= " AND status = 'cancelled'";
    } elseif ($status == 'all') {
        $query .= " AND status IN ('completed','cancelled')";
    }

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $report = true;
}

?>