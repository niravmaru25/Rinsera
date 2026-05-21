<?php
$countResult = $conn->query("SELECT COUNT(*) as total FROM laundry_requests WHERE notification = 'unseen'");
$countRow = $countResult->fetch_assoc();
$total = $countRow['total'];

if ($total > 0): ?>
    <span class="notif-badge">
        <?= ($total < 10) ? $total : '9+' ?>
    </span>
<?php endif;

$result = $conn->query("SELECT request_id, name, created_at FROM laundry_requests WHERE status = 'pending' ORDER BY created_at DESC LIMIT 3");
function timeAgo($datetime)
{
    $time = time() - strtotime($datetime);
    if ($time < 60)
        return "Just now";
    elseif ($time < 3600)
        return floor($time / 60) . " min ago";
    elseif ($time < 86400)
        return floor($time / 3600) . " hrs ago";
    else
        return floor($time / 86400) . " days ago";
} ?>

<div class="notification" id="notifBox">

    <div class="notif-head">
        <h3>Notifications</h3>
        <a href="?mark_all_seen=true">Mark all as seen</a>
    </div>

    <div class="notif-body">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="notif-item">
                    <div class="notif-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div class="notif-text">
                        <p class="title">Laundry Request #<?= $row['request_id'] ?></p>
                        <p class="time"><?= timeAgo($row['created_at']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="notif-item empty">
                <p>No new notifications</p>
            </div>
        <?php endif; ?>
    </div>
    <div class="notif-footer">
        <a href="?page=notification">View all notifications</a>
    </div>
</div>