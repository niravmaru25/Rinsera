<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Password</title>
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
        <div class="icon"><i class="fa fa-envelope"></i></div>
        <h2>Forgot Password?</h2>

        <p>Enter your registered email address and we will send you a verification link to reset your password.</p>

        <form method="POST" action="send_otp.php">
            <div class="input-box">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <button type="submit">Send Verification Code</button>
        </form>

        <div class="divider">
            <span>OR</span>
        </div>

        <a class="back" href="../">&larr; Back to Home</a>
    </div>

</body>
</html>