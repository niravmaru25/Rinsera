<?php

if (isset($_POST["submit"])) {
    $name = trim($_POST["name"]);
    $mobile = trim($_POST["mobile"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $created_at = date("Y-m-d H:i:s");

    if (empty($name) || empty($mobile) || empty($email) || empty($password)) {
        $_SESSION['signup-msg'] = "<p style='color:red'>Enter all detail!</p>";
        $_SESSION["showModal"] = "signup";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if(!preg_match("/^[6-9]\d{9}$/", $mobile)) {
        $_SESSION['signup-msg'] = "<p style='color:red'>Enter valid mobile no.!</p>";
        $_SESSION["showModal"] = "signup";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['signup-msg'] = "<p style='color:red'>Enter valid email!</p>";
        $_SESSION["showModal"] = "signup";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['signup-msg'] = "<p style='color:red'>Password must contains atleast 6 character!</p>";
        $_SESSION["showModal"] = "signup";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO users (name, mobile, email, password, created_at) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $mobile, $email, $password, $created_at);
        $stmt->execute();
        $_SESSION["signup-msg"] = "<p style='color:green'>Registration done successfully! <br> Log in to continue..</p>";
        $_SESSION["showModal"] = "signup";

    } catch (mysqli_sql_exception $e) {
        if ($e->getcode() == 1062) {
            $_SESSION["signup-msg"] = "<p style='color:red'>Email already exists!</p>";
            $_SESSION["showModal"] = "signup";            
        } else {
            $_SESSION["signup-msg"] = "<p style='color:red'>Server Error! <br> Try again later...</p>";
            $_SESSION["showModal"] = "signup";
        }
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>