<?php

if (isset($_POST["confirm"])) {
    $pickup_date = $form["pickup_date"];
    $pickup_time = $form["pickup_time"];
    $pickup_address = $form["pickup_address"];
    $delivery_address = $form["delivery_address"];
    $additional_details = $form["additional_details"];
    $payment = $form["payment"];
    $created_at = date("Y-m-d H:i:s");

    $conn->begin_transaction();

    if (!isset($_SESSION['form'], $_SESSION['summary'], $_SESSION['total'])) {
        header("Location: user.php?page=request_laundry");
        exit;
    }

    try {
        $stmt = $conn->prepare("INSERT INTO laundry_requests (user_id, name, mobile, email, pickup_date, pickup_time, pickup_address, delivery_address, additional_details, payment, total, created_at, updated_at) 
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssssssdss", $id, $name, $mobile, $email, $pickup_date, $pickup_time, $pickup_address, $delivery_address, $additional_details, $payment, $total, $created_at, $created_at);
        $stmt->execute();

        $request_id = $stmt->insert_id;
        $stmt2 = $conn->prepare("INSERT INTO laundry_request_items (request_id, item_name, item_price, item_qty, item_total) VALUES(?, ?, ?, ?, ?)");
        foreach ($summary as $item) {
            $item_name = $item['name'];
            $item_price = $item['itemPrice'];
            $item_qty = $item['qty'];
            $item_total = $item['itemTotal'];

            $stmt2->bind_param("isdid", $request_id, $item_name, $item_price, $item_qty, $item_total);
            $stmt2->execute();

        }
        $conn->commit();
        $_SESSION['msg'] = "<div class='msg success'>Laundry order placed successfully!</div>";
        $showForm = true;
        $showSummary = false;
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['msg'] = "<div class='msg error'>Failed to place an order!</div>" . $e->getMessage();
        $showForm = false;
        $showSummary = true;
    }
    unset($_SESSION['form']);
    header("Location: user.php?page=request_laundry");
    exit;
}

?>