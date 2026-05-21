<?php
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>

<div class="reports">
    <h1 class="common-heading">Generate Report</h1>

    <form method="POST" class="report-form">
        <div class="form-row">
            <div>
                <label>Starting Date</label>
                <input type="date" name="from-date" value="<?= $from_date; ?>">
            </div>
            <div>
                <label>Ending Date</label>
                <input type="date" name="to-date" value="<?= $to_date; ?>">
            </div>
            <div>
                <label>Status</label>
                <select name="status">
                    <option value="all" <?= ($status == 'all') ? 'selected' : '' ?>>All (Processed)</option>
                    <option value="completed" <?= ($status == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= ($status == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div class="btn-box">
                <button type="submit" name="submit-date">Submit</button>
            </div>
        </div>
        <p>Note: All consist both completed and cancelled</p>
    </form>

    <?php if ($report): ?>
        <div class="reports-table">
        <table class="common-table">
            <tr>
                <th>Request Id</th>
                <th>Customer Info.</th>
                <th>Request Details</th>
                <th>Laundry Items</th>
                <th>Requested on</th>
                <th>Status</th>
            </tr>

            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['request_id']; ?></td>
                        <td class="customer-info">
                            <div class="info-box">
                                <div><span class="label">Name:</span> <?= $row['name']; ?></div>
                                <div><span class="label">Mobile:</span> <?= $row['mobile']; ?></div>
                                <div><span class="label">Email:</span> <?= $row['email']; ?></div>
                            </div>
                        </td>
                        <td><button onclick='openCustomerModal(<?= json_encode(date("d-m-Y", strtotime($row["pickup_date"]))); ?>,
                                                            <?= json_encode($row["pickup_time"]); ?>,
                                                            <?= json_encode($row["pickup_address"]); ?>,
                                                            <?= json_encode($row["delivery_address"]); ?>,
                                                            <?= json_encode($row["additional_details"]); ?>,
                                                            <?= json_encode($row["payment"]); ?>)'>
                                <i class="fa fa-user"></i></button></td>
                        <td><button type="button" onclick='openLaundryModal(<?= json_encode($row["request_id"]); ?>,
                                                          <?= json_encode($row["total"]); ?>)'><i
                                    class="fa fa-box"></i></button></td>
                        <td><?= date("d-m-Y H:i:s", strtotime($row['created_at'])); ?></td>
                        <td>
                            <span class="status <?= strtolower($row['status']); ?>">
                                <?= ucfirst($row["status"]); ?></span>
                        </td>
                    </tr>
                    <?php
                }
            } else { ?>
                <tr>
                    <td colspan='6'>
                        <div class="empty-state">
                            <i class="fa fa-box-open"></i>
                            <p>No records found for the selected date.</p>
                            <small>Please choose a different date or create a new request.</small>
                    </td>
                </tr>
            <?php } ?>
        </table>
        </div>
    <?php endif; ?>
</div>

<!-- CUSTOMER DETAIL POPUP -->
<?php include '../components/customerModal.php'; ?>

<!-- LAUNDRY DETAIL POPUP -->
<?php include '../components/laundryModal.php'; ?>