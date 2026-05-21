<?php

if (isset($_POST['update-status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $updated_at = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("UPDATE laundry_requests SET status = ?, updated_at = ? WHERE request_id = ?");
    $stmt->bind_param("ssi", $status, $updated_at, $id);

    if($stmt->execute()) {
        $_SESSION["msg"] = "<div class='msg success'>Status Updated Successfully!</div>";
    }
    else {
        $_SESSION["msg"] = "<div class='msg error'>Status not updated!</div>";
    }
    header('Location: admin.php?page=laundry_requests');
    exit();
}

?>