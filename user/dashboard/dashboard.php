<?php

$stmt = $conn->prepare("
    SELECT status, COUNT(*) as total 
    FROM laundry_requests 
    WHERE user_id = ?
    GROUP BY status
");

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$statusCount = [];

while ($row = $result->fetch_assoc()) {
    $statusCount[$row['status']] = $row['total'];
}

?>

<div class="dashboard">

<h2 class="dashboard-heading">My Orders</h2>
    <div class="all-status">

    <div class="status-card pending">
        <div class="card-top">
            <img src="../assets/images/new_request.png" alt="">
            <div class="status-card-info">
                <h4>Pending</h4>
                <p><?= $statusCount['pending']??'0' ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="user.php?page=track_request&status=pending">
                View Pending ➜
            </a>
        </div>
    </div>

    <div class="status-card processing">
        <div class="card-top">
            <img src="../assets/images/in_progress.png" alt="">
            <div class="status-card-info">
                <h4>Processing</h4>
                <p><?= $statusCount['processing']??'0' ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="user.php?page=track_request&status=processing">
                View Processing ➜
            </a>
        </div>
    </div>

    <div class="status-card completed">
        <div class="card-top">
            <img src="../assets/images/compeleted.png" alt="">
            <div class="status-card-info">
                <h4>Completed</h4>
                <p><?= $statusCount['completed']??'0' ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="user.php?page=track_request&status=completed">
                View Completed ➜
            </a>
        </div>
    </div>

    <div class="status-card cancelled">
        <div class="card-top">
            <img src="../assets/images/canceled.png" alt="">
            <div class="status-card-info">
                <h4>Cancelled</h4>
                <p><?= $statusCount['cancelled']??'0' ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="user.php?page=track_request&status=cancelled">
                View Cancelled ➜
            </a>
        </div>
    </div>
</div>

<?php include 'dashboard/slider.php'; ?>

</div>