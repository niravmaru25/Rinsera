<?php

if (isset($_GET['laundry_id'])) {
    require_once '../db.php';
    $id = $_GET['laundry_id'];
    $stmt = $conn->prepare("SELECT * FROM laundry_request_items WHERE request_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                 <td>{$row['item_name']} (₹{$row['item_price']})</td>
                 <td>{$row['item_qty']}</td>
                 <td>₹{$row['item_total']}</td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No data found!</td></tr>";
    }
    exit;
}

?>