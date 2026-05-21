<?php if ($showSummary): ?>
    <div class="laundry-summary">

        <h1 class="common-heading">Confirm laundry request</h1>

        <!-- laundry summary left -->
        <div class="summary-wrapper">
            <div class="summary-left">
                <h3>Order Summary</h3>

                <table class="summary-table">
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>

                    <?php foreach ($summary as $item): ?>
                        <tr>
                            <td><?= $item['name']??''; ?> (₹<?= $item['itemPrice']??''; ?>)</td>
                            <td><?= $item['qty']??''; ?></td>
                            <td>₹<?= $item['itemTotal']??''; ?></td>
                        </tr>
                    <?php endforeach; ?>

                    <tr class="summary-total-row">
                        <td colspan="3">Total ₹<?= $total??''; ?></td>
                    </tr>
                </table>
            </div>

            <!-- customer Details right -->
            <div class="summary-right">
                <h3>Delivery Details</h3>

                <div class="summary-details">
                    <div><label>Pickup Date</label>
                        <p><?= date("d-m-Y", strtotime($form["pickup_date"]??'')) ?></p>
                    </div>
                    <div><label>Pickup Time</label>
                        <p><?= $form["pickup_time"]??''; ?></p>
                    </div>
                    <div><label>Pickup Address</label>
                        <p><?= $form["pickup_address"]??''; ?></p>
                    </div>
                    <div><label>Delivery Address</label>
                        <p><?= $form["delivery_address"]??''; ?></p>
                    </div>
                    <div><label>Additional Details</label>
                        <p><?= $form["additional_details"]??''; ?></p>
                    </div>
                    <div><label>Payment</label>
                        <p><?= $form["payment"]??''; ?></p>
                    </div>
                </div>

                <form method="post" class="summary-actions">
                    <button class="btn-edit" name="edit">Edit Details</button>
                    <button class="btn-confirm" name="confirm">Confirm Order</button>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>