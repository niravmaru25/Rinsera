<?php
$status = $_GET['status'] ?? 'all';
?>

<div class="laundry-request">
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <h1 class="common-heading" style="margin-bottom:0;">Laundry Requests</h1>
    <div class="table-container">
        <table class="common-table" id="laundry_table">
            <thead>
                <tr>
                    <th>Request Id</th>
                    <th>Customer Info</th>
                    <th>Request Details</th>
                    <th>Laundry Items</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM laundry_requests";

                if ($status != 'all') {
                    $query .= " WHERE status = '$status'";
                }
                $result = $conn->query($query);

                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['request_id'] ?></td>
                            <td class="customer-info">
                                <div class="info-box">
                                    <div><span class="label">Name:</span><?= $row['name']; ?></div>
                                    <div><span class="label">Mobile:</span><?= $row['mobile']; ?></div>
                                    <div><span class="label">Email:</span><?= $row['email']; ?></div>
                                </div>
                            </td>
                            <td>
                                <button type="button" onclick='openCustomerModal(<?= json_encode(date("d-m-Y", strtotime($row["pickup_date"]))); ?>,
                                                            <?= json_encode($row["pickup_time"]); ?>,
                                                            <?= json_encode($row["pickup_address"]); ?>,
                                                            <?= json_encode($row["delivery_address"]); ?>,
                                                            <?= json_encode($row["additional_details"]); ?>,
                                                            <?= json_encode($row["payment"]); ?>)'>
                                    <i class="fa fa-user"></i></button>
                            </td>
                            <td>
                                <button type="button" onclick='openLaundryModal(<?= json_encode($row["request_id"]); ?>,
                                                          <?= json_encode($row["total"]); ?>)'><i
                                        class="fa fa-box"></i></button>
                            </td>
                            <td><?= date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>
                            <td><?= date("d-m-Y H:i:s", strtotime($row['updated_at'])); ?></td>
                            <td>
                                <div class="status-box">
                                    <span class="status <?= strtolower($row['status']); ?>">
                                        <?= ucfirst($row["status"]); ?></span>
                                    <button type="button" onclick='openStatusModal(<?= json_encode($row["request_id"]); ?>,
                                                        <?= json_encode($row["status"]); ?>)'>
                                        <i class="fas fa-pen"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile;
                endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CUSTOMER DETAIL POPUP -->
<?php include '../components/customerModal.php'; ?>

<!-- LAUNDRY DETAIL POPUP -->
<?php include '../components/laundryModal.php'; ?>

<!-- STATUS POPUP -->
<div id="statusModal">
    <div class="statusModal">
        <form method="POST">
            <h4>Update Status</h4>
            <input type="hidden" id="id" name="id">
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <div class="status-btn">
                <button type="submit" name="update-status">Update</button>
                <button type="button" onclick="closeStatusModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>