<?php

if (isset($_POST["update"])) {
    $current_password = trim($_POST["current_password"]);
    $new_password = trim($_POST["new_password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    if (!(password_verify($current_password, $password))) {
        $_SESSION["msg"] = "<div class='msg error'>Enter valid current password!</div>";
        header('Location: admin.php?page=change_password');
        exit();
    }

    if ($new_password != $confirm_password) {
        $_SESSION["msg"] = "<div class='msg error'>New password must match!</div>";
        header('Location: admin.php?page=change_password');
        exit();
    }

    if ($current_password == $new_password) {
        $_SESSION["msg"] = "<div class='msg error'>New password must be different from previous one!</div>";
        header('Location: admin.php?page=change_password');
        exit();
    }

    if (strlen($new_password) < 6) {
        $_SESSION["msg"] = "<div class='msg error'>Password must contains atleast 6 character!</div>";
        header('Location: admin.php?page=change_password');
        exit();
    }

    $password = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $password, $id);

    if ($stmt->execute()) {
        $_SESSION["msg"] = "<div class='msg success'>Password updated successfully!</div>";
    } else {
        $_SESSION["msg"] = "<div class='msg error'>Something went wrong!</div>";
    }
    header('Location: admin.php?page=change_password');
    exit();
}

if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}

include '../components/change_password.php';

?>