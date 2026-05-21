<?php

    if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $new_name = trim($_POST["name"]);
    $new_email = trim($_POST["email"]);
    $new_mobile = trim($_POST["mobile"]);
    $new_role = trim($_POST["role"]);
    $new_status = trim($_POST["status"]);

    if (empty($new_name) || empty($new_email) || empty($new_mobile)) {
        $_SESSION["msg"] = "<div class='msg error'>Value can not be empty!</div>";
        header('Location: admin.php?page=registered_users');
        exit();
    }

    try {
        $stmt = $conn->prepare("UPDATE users SET name = ?, mobile = ?, email = ?, role = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $new_name, $new_mobile, $new_email, $new_role, $new_status, $id);
        $stmt->execute();
        $_SESSION["msg"] = "<div class='msg success'>Profile updated successfully!</div>";

    } catch (mysqli_sql_exception $e) {

        if ($e->getCode() == 1062) {
            $_SESSION["msg"] = "<div class='msg error'>Email already exists!</div>";
        } else {
            $_SESSION["msg"] = "<div class='msg error'>Something went wrong!</div>";
        }
    }
    header('Location: admin.php?page=registered_users');
    exit();
}

?>