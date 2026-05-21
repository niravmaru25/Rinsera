<?php
session_start();
require '../db.php';

// CHECK TOKEN (GET REQUEST)
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $tokenHash = hash("sha256", $token);

    $stmt = $conn->prepare("SELECT email, expires_at FROM password_reset WHERE token_hash = ?");
    $stmt->bind_param("s", $tokenHash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (strtotime($row['expires_at']) > time()) {
            $_SESSION['reset_email'] = $row['email'];
            $_SESSION['reset_token'] = $tokenHash;
        } else {
            $_SESSION['msg'] = "<div class='msg error'>Reset link has been expired!</div>";
            header("Location: email.php");
            exit();
        }
    } else {
        $_SESSION['msg'] = "<div class='msg error'>Invalid token!</div>";
        header("Location: email.php");
        exit();
    }
} else {
    header("Location: email.php");
    exit();
}

// HANDLE FORM SUBMIT
if (isset($_POST['password'])) {
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $_SESSION['msg'] = "<div class='msg error'>Passwords do not match!</div>";
        header("Location: reset.php?token=" . $_GET['token']);
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['msg'] = "<div class='msg error'>Password must be at least 6 characters!</div>";
        header("Location: reset.php?token=" . $_GET['token']);
        exit();
    }

    if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_token'])) {
        $_SESSION['msg'] = "<div class='msg error'>Session expired. Try again!<div>";
        header("Location: email.php");
        exit();
    }

    $email = $_SESSION['reset_email'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();

    // DELETE TOKEN
    $stmt = $conn->prepare("DELETE FROM password_reset WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    unset($_SESSION['reset_email']);
    unset($_SESSION['reset_token']);

    $_SESSION["login-msg"] = "<p style='color:green'>Password Updated!</p>";
    $_SESSION["showModal"] = "login";
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/forgot_password.css">
</head>

<body>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <div class="container">
        <div class="icon"><i class="fa fa-lock"></i></div>
        <h2>Reset Password</h2>

        <p>Enter your new password and confirm it. After successful update, you will be redirected to the home page.</p>

        <form method="POST">
            <div class="input-box">
                <label>New Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-box">
                <label>Confirm Password</label>
                <input type="password" name="confirm" required>
            </div>

            <button type="submit">Update Password</button>
        </form>
    </div>

</body>

</html>