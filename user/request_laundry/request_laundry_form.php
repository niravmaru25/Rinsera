<?php if ($showForm):
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class="laundry-request">
        <h1 class="common-heading">New Laundry Request</h1>
        <form method="post">
            <div class="cloth-container">

                <!-- topwear -->
                <div class="cloth-card <?php if(!empty($form['items']['topwear'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['topwear'])) echo 'checked'; ?>>
                    <img src="../assets/images/topwear.png" alt="topwear">
                    <div class="cloth_info">
                        <h4>Topwear</h4>
                        <p>₹ <?php echo $price[0]; ?></p>
                        <input type="number" name="items[topwear]" placeholder="Qty" min="1"
                            value="<?= $form['items']['topwear'] ?? ''; ?>"
                            <?php if(empty($form['items']['topwear'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <!-- bottomwear -->
                <div class="cloth-card <?php if(!empty($form['items']['bottomwear'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['bottomwear'])) echo 'checked'; ?>>
                    <img src="../assets/images/bottomwear.png" alt="bottomwear">
                    <div class="cloth_info">
                        <h4>Bottomwear</h4>
                        <p>₹ <?php echo $price[1]; ?></p>
                        <input type="number" name="items[bottomwear]" placeholder="Qty" min="1"
                           value="<?= $form['items']['bottomwear'] ?? ''; ?>"
                           <?php if(empty($form['items']['bottomwear'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <!-- outerwear -->
                <div class="cloth-card <?php if(!empty($form['items']['outerwear'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['outerwear'])) echo 'checked'; ?>>
                    <img src="../assets/images/outerwear.png" alt="outerwear">
                    <div class="cloth_info">
                        <h4>Outerwear</h4>
                        <p>₹ <?php echo $price[2]; ?></p>
                        <input type="number" name="items[outerwear]" placeholder="Qty" min="1"
                           value="<?= $form['items']['outerwear'] ?? ''; ?>"
                           <?php if(empty($form['items']['outerwear'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <!-- traditional_wear -->
                <div class="cloth-card <?php if(!empty($form['items']['traditional_wear'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['traditional_wear'])) echo 'checked'; ?>>
                    <img src="../assets/images/traditional_wear.png" alt="traditional_wear">
                    <div class="cloth_info">
                        <h4>Traditional wear</h4>
                        <p>₹ <?php echo $price[3]; ?></p>
                        <input type="number" name="items[traditional_wear]" placeholder="Qty" min="1"
                            value="<?= $form['items']['traditional_wear'] ?? ''; ?>"
                            <?php if(empty($form['items']['traditional_wear'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <!-- bedding -->
                <div class="cloth-card <?php if(!empty($form['items']['bedding'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['bedding'])) echo 'checked'; ?>>
                    <img src="../assets/images/bedding.png" alt="bedding">
                    <div class="cloth_info">
                        <h4>Bedding</h4>
                        <p>₹ <?php echo $price[4]; ?></p>
                        <input type="number" name="items[bedding]" placeholder="Qty" min="1"
                           value="<?= $form['items']['bedding'] ?? ''; ?>"
                           <?php if(empty($form['items']['bedding'])) echo 'disabled'; ?>>
                    </div>
                </div>

                <!-- accessories -->
                <div class="cloth-card <?php if(!empty($form['items']['accessories'])) echo 'active'; ?>">
                    <input type="checkbox" class="cloth-check" <?php if(!empty($form['items']['accessories'])) echo 'checked'; ?>>
                    <img src="../assets/images/accessories.png" alt="accessories">
                    <div class="cloth_info">
                        <h4>Accessories</h4>
                        <p>₹ <?php echo $price[5]; ?></p>
                        <input type="number" name="items[accessories]" placeholder="Qty" min="1"
                            value="<?= $form['items']['accessories'] ?? ''; ?>"
                            <?php if(empty($form['items']['accessories'])) echo 'disabled'; ?>>
                    </div>
                </div>
            </div>

            <div class="cloth-details">

                <h3>Delivery Details</h3>

                <div class="form-row">
                    <div>
                        <label class="required">Pick up date</label>
                        <input type="date" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+30 days')) ?>" name="pickup_date" value="<?= $form['pickup_date'] ?? ''; ?>" required>
                    </div>

                    <div>
                        <label class="required">Pickup Time</label>
                        <select name="pickup_time" required>
                            <option value="">Select Time</option>
                            <option value="morning" <?php if (($form['pickup_time'] ?? '') === 'morning') echo 'selected'; ?>>Morning (8AM - 12PM)</option>
                            <option value="afternoon" <?php if (($form['pickup_time'] ?? '') === 'afternoon') echo 'selected'; ?>>Afternoon (12PM - 4PM)</option>
                            <option value="evening" <?php if (($form['pickup_time'] ?? '') === 'evening') echo 'selected'; ?>>Evening (4PM - 8PM)</option>
                        </select>
                    </div>
                </div>

                <label class="required">Pick up address</label>
                <textarea name="pickup_address" rows="2" required><?= $form['pickup_address'] ?? ''; ?></textarea>

                <div class="form-row">
                    <label class="required">Delivery address</label>

                    <div class="checkbox-row">
                        <input type="checkbox" id="sameAddress" <?php if (!empty($form['pickup_address']) && ($form['pickup_address']) === $form['delivery_address'] ?? '') echo 'checked' ?>>
                        <label>Same as pickup address</label>
                    </div>
                </div>

                <textarea name="delivery_address" rows="2" required><?= $form['delivery_address'] ?? ''; ?></textarea>

                <label>Additional Details (other clothing info, if any)</label>
                <textarea name="additional_details" rows="2"><?= $form['additional_details'] ?? ''; ?></textarea>

                    <label class="required">Payment Method</label>
                    <div class="payment-box">
                        <label><input type="radio" name="payment" value="COD" <?php if ($form['payment'] ?? '' === 'COD') echo 'checked'; ?>> Cash on Delivery</label>
                        <label><input type="radio" name="payment" value="Online" <?php if ($form['payment'] ?? '' === 'Online') echo 'checked'; ?>> Online</label>
                    </div>

                    <div class="request-btn">
                        <button type="button" class="btn-reset" onclick="resetAll()">Clear details</button>
                        <button type="submit" class="btn-next" name="preview">Preview Order</button>
                    </div>
            </div>
        </form>
    </div>
<?php endif; ?>