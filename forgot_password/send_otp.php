<?php
session_start();
require '../db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../src/PHPMailer.php';
require '../src/SMTP.php';
require '../src/Exception.php';

if (empty($_POST['email'])) {
    $_SESSION['msg'] = "<div class='msg error'>Email can not be empty!</div>";
    header("Location: email.php");
    exit();
}

$email = $_POST['email'];

$_SESSION['msg'] = "<div class='msg success'>If an account exists, a reset link has been sent!</div>";

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    //RATE LIMIT FOR OTP
    $check = $conn->prepare("SELECT created_at FROM password_reset WHERE email = ? AND created_at > NOW() - INTERVAL 1 MINUTE");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $_SESSION['msg'] = "<div class='msg error'>Please wait before requesting again!</div>";
        header("Location: email.php");
        exit();
    }

    $rawToken = bin2hex(random_bytes(32));
    $tokenHash = hash("sha256", $rawToken);
    $created_at = date("Y-m-d H:i:s");
    $expires_at = date("Y-m-d H:i:s", strtotime('+10 minutes'));

    $stmt = $conn->prepare("INSERT INTO password_reset (email, token_hash, created_at, expires_at) VALUES (?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE
      token_hash = VALUES(token_hash),
      created_at = VALUES(created_at),
      expires_at = VALUES(expires_at)");

    $stmt->bind_param("ssss", $email, $tokenHash, $created_at, $expires_at);
    $stmt->execute();

    $reset_link = "http://localhost/rinsera/forgot_password/reset.php?token=" . $rawToken;

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = MAIL_USER;
        $mail->Password = MAIL_PASS;

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom(MAIL_USER, 'Rinsera');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Your Password';
        $mail->Body = "<h3>Password Reset Request</h3>
                        <p>Click the link below to reset your password:</p>
                        <a href='$reset_link'>$reset_link</a>
                        <br><br>
                        <small>This link will expire in 10 minutes.</small>";

        $mail->Send();

    } catch (Exception $e) {
        $_SESSION['msg'] = "<div class='msg error'>Error: {$mail->ErrorInfo}</div>";
    }
}
header("Location: email.php");
exit();