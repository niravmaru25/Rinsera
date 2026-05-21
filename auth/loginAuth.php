<?php

if (isset($_POST["login-submit"])) {
    $email = trim($_POST["login-email"]);
    $password = trim($_POST["login-password"]);

    if (empty($email) || empty($password)) {
        $_SESSION['login-msg'] = "<p style='color:red'>Enter all detail!</p>";
        $_SESSION["showModal"] = "login";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['login-msg'] = "<p style='color:red'>Enter valid email!</p>";
        $_SESSION["showModal"] = "login";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['login-msg'] = "<p style='color:red'>Password must contains atleast 6 character!</p>";
        $_SESSION["showModal"] = "login";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify($password, $user["password"])){
        if ($user["role"] === "admin") {
            $_SESSION["admin_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];
            header('Location: admin/admin.php?page=dashboard');
            exit();
        } else if($user["status"] === 'active'){
            $_SESSION["user_id"] = $user["id"];
            header('Location: user/user.php?page=dashboard');
            exit();
        }
        else {
             $_SESSION["login-msg"] = "<p style='color:red'>Account deactivated ! <br> Contact admin for support !</p>";
             $_SESSION["showModal"] = "login";
        }
    }else {
        $_SESSION["login-msg"] = "<p style='color:red'>Wrong Password !</p>";
        $_SESSION["showModal"] = "login";
    }
    } else {
        $_SESSION["login-msg"] = "<p style='color:red'>User not found !</p>";
        $_SESSION["showModal"] = "login";
    }
}

?>