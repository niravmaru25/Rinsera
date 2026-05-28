<?php

    if (isset($_POST["update"])) {
    $new_name = trim($_POST["name"]);
    $new_email = trim($_POST["email"]);
    $new_mobile = trim($_POST["mobile"]);

    if (empty($new_name) || empty($new_email) || empty($new_mobile)) {
        $_SESSION["msg"] = "<div class='msg error'>Details can not be empty!</div>";
        header('Location: user.php?page=update_profile');
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["msg"] = "<div class='msg error'>Enter valid email!</div>";
        header('Location: user.php?page=update_profile');
        exit();
    }

    if(!preg_match("/^[6-9]\d{9}$/", $mobile)) {
        $_SESSION["msg"] = "<div class='msg error'>Enter valid Mobile No.!</div>";
        header('Location: user.php?page=update_profile');
        exit();
    }

    try {
        $stmt = $conn->prepare("UPDATE users SET name = ?, mobile = ?, email = ? WHERE id = ?");
        $stmt->bind_param("sssi", $new_name, $new_mobile, $new_email, $id);
        $stmt->execute();
        $_SESSION["msg"] = "<div class='msg success'>Profile updated successfully!</div>";

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1062) {
            $_SESSION["msg"] = "<div class='msg error'>Email already exists!</div>";
        } else {
            $_SESSION["msg"] = "<div class='msg error'>Something went wrong!</div>";
        }
    }
    header('Location: user.php?page=update_profile');
    exit();
}

?>