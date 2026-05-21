<?php

$result = $conn->query("SELECT status, COUNT(*) as total FROM laundry_requests GROUP BY status");
$statusCount = [];
while ($row = $result->fetch_assoc()) {
    $statusCount[$row['status']] = $row['total'];
}

?>

<div class="dashboard">

    <div class="all-status">

    <div class="status-card pending">
        <div class="card-top">
            <img src="../assets/images/new_request.png" alt="">
            <div class="status-card-info">
                <h4>Pending</h4>
                <p><?= $statusCount['pending'] ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="admin.php?page=laundry_requests&status=pending">
                View Pending ➜
            </a>
        </div>
    </div>

    <div class="status-card processing">
        <div class="card-top">
            <img src="../assets/images/in_progress.png" alt="">
            <div class="status-card-info">
                <h4>Processing</h4>
                <p><?= $statusCount['processing'] ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="admin.php?page=laundry_requests&status=processing">
                View Processing ➜
            </a>
        </div>
    </div>

    <div class="status-card completed">
        <div class="card-top">
            <img src="../assets/images/compeleted.png" alt="">
            <div class="status-card-info">
                <h4>Completed</h4>
                <p><?= $statusCount['completed'] ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="admin.php?page=laundry_requests&status=completed">
                View Completed ➜
            </a>
        </div>
    </div>

    <div class="status-card cancelled">
        <div class="card-top">
            <img src="../assets/images/canceled.png" alt="">
            <div class="status-card-info">
                <h4>Cancelled</h4>
                <p><?= $statusCount['cancelled'] ?></p>
            </div>
        </div>
        <div class="btn">
            <a href="admin.php?page=laundry_requests&status=cancelled">
                View Cancelled ➜
            </a>
        </div>
    </div>

</div>

     <div class="chart-card">
        <div>
        <h4>Last Month Revenue <i class="fa-solid fa-chart-line"></i></h4>
        <span>X-axis: Date | Y-axis: Revenue (₹)</span>
        </div>
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script src="../assets/chart/chart.umd.js"></script>

<script>
const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($dates) ?>,
        datasets: [{
            label: 'Revenue (Last Month)',
            data: <?= json_encode($revenues) ?>,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>