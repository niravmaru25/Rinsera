<div class="pricing">
    <?php
    if (isset($_SESSION["msg"])) {
        echo $_SESSION["msg"];
        unset($_SESSION["msg"]);
    }
    ?>
    <h1 class="common-heading">Manage pricing of cloth</h1>

    <table class="common-table">

        <tr>
            <th>Id</th>
            <th>Cloth Type</th>
            <th>Price</th>
            <th>Last Updated</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM pricing");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>

                <tr>
                    <td><?= $row["id"]; ?></td>
                    <td><?= $row["cloth_type"]; ?></td>
                    <td>₹ <?= $row["price"]; ?></td>
                    <td><?= date("d-m-Y H:i:s", strtotime($row['last_updated'])); ?></td>

                    <td>
                        <button onclick='openPriceModal(
                            <?= json_encode($row["id"]); ?>,
                            <?= json_encode($row["cloth_type"]); ?>,
                            <?= json_encode($row["price"]); ?>,
                        )'>
                            <i class="fas fa-pen"></i>
                        </button>
                    </td>
                </tr>

            <?php }
        } ?>

    </table>
</div>

<div id="update_price">
    <div class="update_price">
        <h3 style="text-align:center;">Update Pricing</h3>

        <form method="post">
            <input type="hidden" name="id" id="id">
            <label for="price" id="cloth_type" style="font-weight:500;"></label>
            <input type="number" name="price" id="price" placeholder="Enter price">
    
            <div class="btns">
                <button type="submit" name="update">Update</button>
                <button type="button" onclick="closePriceModal()">Cancel</button>
            </div>
        </form>
    </div>
</div>