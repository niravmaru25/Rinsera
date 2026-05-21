<?php
$status = $_GET['status'] ?? 'all';
if (!isset($_GET['id'])):
?>

<div class="track-request">

    <div class="header-bar">
        <h1 class="common-heading">Track laundry request</h1>
        <form method="GET" class="filter-form">
            <input type="hidden" name="page" value="track_request">

            <select name="status" onchange="this.form.submit()">
                <option value="all" <?= ($status == 'all') ? 'selected' : ''; ?>>All</option>
                <option value="pending" <?= ($status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="processing" <?= ($status == 'processing') ? 'selected' : ''; ?>>Processing</option>
                <option value="completed" <?= ($status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                <option value="cancelled" <?= ($status == 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </form>
    </div>
    <div class="track-table">
    <table class="common-table">
        <thead>
            <tr>
                <th>Request Id</th>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Requested on</th>
                <th>Last Updated</th>
                <th>Status</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
                <?php
                $query = "SELECT * FROM laundry_requests WHERE user_id = ?";
                $type = 'i';
                $param[] = $id;

                if ($status != 'all') {
                    $query .= " AND status = ?";
                    $type .= 's';
                    $param[] = $status;
                }
                $query .= " ORDER BY created_at DESC";
                $stmt = $conn->prepare($query);
                $stmt->bind_param($type, ...$param);
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['request_id'] ?></td>
                        <td><?= date("d-m-Y", strtotime($row['pickup_date'])); ?></td>
                        <td><?= ucfirst($row['pickup_time']) ?></td>
                        <td><?= date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>
                        <td><?= date("d-m-Y H:i:s", strtotime($row['updated_at'])); ?></td>
                        <td><span class="status <?= strtolower($row['status']); ?>">
                                <?= ucfirst($row["status"]); ?></span></td>
                        <td> <a href="user.php?page=track_request&id=<?= $row['request_id'] ?>" style="text-decoration:none;">➜</a></td>
                    </tr>
                <?php }
                } else {
                    echo '<tr>
                <td colspan="7"><div class="empty-state">
                        <i class="fa fa-box-open"></i>
                        <p>No laundry requests yet</p>
                    </div></td>
                    </tr>';
                } ?>
            </tr>
        </tbody>
    </table>
    </div>
</div>

<?php endif; ?>