<?php

    if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $new_price = trim($_POST["price"]);
    $last_updated = date("Y-m-d H:i:s");

    if (empty($new_price)) {
        $_SESSION["msg"] = "<div class='msg error'>Price can not be empty!</div>";
        header('Location: admin.php?page=manage_prices');
        exit();
    }

    if (!is_numeric($new_price) || $new_price < 0) {
        $_SESSION["msg"] = "<div class='msg error'>Enter valid price!</div>";
        header('Location: admin.php?page=manage_prices');
        exit();
    }

    $stmt = $conn->prepare("UPDATE pricing SET price = ?, last_updated = ? WHERE id = ?");
    $stmt->bind_param("dsi", $new_price, $last_updated, $id);

    if ($stmt->execute()) {
        $_SESSION["msg"] = "<div class='msg success'>Price updated successfully!</div>";
    } else {
        $_SESSION["msg"] = "<div class='msg error'>Something went wrong!</div>";
    }
    header('Location: admin.php?page=manage_prices');
    exit();
}

?>