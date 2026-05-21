<?php
if (isset($_GET['id'])):

    $reqid = $_GET['id'];

    $query = "SELECT * FROM laundry_requests WHERE request_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $reqid);
    $stmt->execute();
    $request = $stmt->get_result()->fetch_assoc();

    $query2 = "SELECT * FROM laundry_request_items WHERE request_id = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("s", $reqid);
    $stmt2->execute();
    $items = $stmt2->get_result();

    ?>

    <div class="request-container">

        <a href="user.php?page=track_request" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

        <div class="card">
            <div class="detail-grid">

                <div class="detail-item id-status-item">
                    <div class="icon-circle ic-id">
                        <i class="fa-solid fa-hashtag"></i>
                    </div>
                    <div class="info">
                        <span>Request ID #<?= $request['request_id'] ?></span>
                        <p class="id-status-row">
                            <span class="status <?= strtolower($request['status']); ?>">
                                <?= ucfirst($request["status"]); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Pickup Date -->
                <div class="detail-item">
                    <div class="icon-circle ic-date">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="info">
                        <span>Pickup Date</span>
                        <p><?= date("d M Y", strtotime($request['pickup_date'])) ?></p>
                    </div>
                </div>

                <!-- Pickup Time -->
                <div class="detail-item">
                    <div class="icon-circle ic-time">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="info">
                        <span>Pickup Time</span>
                        <p><?= ucfirst($request['pickup_time']) ?></p>
                    </div>
                </div>

                <!-- Payment -->
                <div class="detail-item">
                    <div class="icon-circle ic-payment">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div class="info">
                        <span>Payment</span>
                        <p><?= ucfirst(($request['payment'])) ?></p>
                    </div>
                </div>
            </div>

            <!-- Pickup / Delivery Addresses -->
            <div class="address-grid">

                <div class="address-item">
                    <div class="icon-circle ic-pickup">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="info">
                        <span>Pickup Address</span>
                        <p><?= nl2br(($request['pickup_address'])) ?></p>
                    </div>
                </div>

                <div class="address-item">
                    <div class="icon-circle ic-delivery">
                        <i class="fa-solid fa-truck"></i>
                    </div>
                    <div class="info">
                        <span>Delivery Address</span>
                        <p><?= nl2br(($request['delivery_address'])) ?></p>
                    </div>
                </div>

            </div>

            <!-- Additional Details (optional) -->
            <?php if (!empty($request['additional_details'])): ?>
                <div class="note-box">
                    <div class="icon-circle ic-note">
                        <i class="fa-solid fa-note-sticky"></i>
                    </div>
                    <div class="info">
                        <span>Additional Details</span>
                        <p><?= nl2br(($request['additional_details'])) ?></p>
                    </div>
                </div>
            <?php endif; ?>

        </div>


        <div class="card">

            <h2 class="section-heading">Laundry Items</h2>
            <div class="table-scroll">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($item = $items->fetch_assoc()): ?>
                            <tr>
                                <td><?= $item['item_name'] ?></td>
                                <td>₹<?= $item['item_price'] ?></td>
                                <td><?= $item['item_qty'] ?></td>
                                <td class="total-col">₹<?= $item['item_total'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>

                    <tfoot>
                        <tr class="grand-total-row">
                            <td colspan="3">Grand Total</td>
                            <td class="total-col">₹<?= $request['total'] ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>

<?php endif; ?>