<?php

$result = $conn->query("SELECT * FROM laundry_requests WHERE status='pending' ORDER BY created_at DESC");

?>

<div class="all-notif">

    <div class="noti-heading">
        <div class="left">
            <div class="icon-box">
                <i class="fa-solid fa-bell"></i>
            </div>

            <div class="text">
                <h1>All Notifications</h1>
                <p>You have <?= $total ?> new notifications</p>
            </div>
        </div>
        <a href="admin.php?page=laundry_requests&status=pending">Take Action ➜</a>
    </div>

    <?php
    if ($result->num_rows > 0):
        while ($row = $result->fetch_assoc()): ?>

            <div class="notification-card">

                <!-- REQUEST -->
                <div class="notif-section">
                    <div class="icon blue">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div class="text-block">
                        <p class="request-title">
                            Laundry Request #<?= $row['request_id'] ?></p>
                        <span class="notif-status"><?= ucfirst($row['status']) ?></span>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- PICKUP -->
                <div class="notif-section">
                    <div class="icon green">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <div class="text-block">
                        <p class="label">Pickup</p>
                        <h4>
                            <?= date('d M Y', strtotime($row['pickup_date'])) ?>
                            (<?= ucfirst($row['pickup_time']) ?>)
                        </h4>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- AMOUNT -->
                <div class="notif-section">
                    <div class="icon purple">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <div class="text-block">
                        <p class="label">Amount</p>
                        <h4 class="amount">₹<?= $row['total'] ?></h4>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- REQUESTED TIME -->
                <div class="notif-section">
                    <div class="icon blue">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="text-block">
                        <p class="label">Requested</p>
                        <h4 class="time-text"><?= timeAgo($row['created_at']) ?></h4>
                    </div>
                </div>
            </div>

        <?php endwhile; else: ?>

        <div class="notification-card empty">
            <h2>No new notifications are available at this time. Please check back later for updates!</h2>
        </div>

    <?php endif; ?>

</div>