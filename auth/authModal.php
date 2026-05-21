    <div id="form-container">
        <div class="form-box">
            <a onclick="closeModal()" class="close-btn">✖</a>

            <div class="btn">
                <a onclick="openlogin()" class="log-in">Log in</a>
                <a onclick="opensignup()" class="sign-in">Sign up</a>
            </div>

            <!-- LOGIN MODAL -->
            <div class="login">
                <form method="post">
                    <div class="form-control">
                        <input type="email" id="login-email" name="login-email" placeholder=" " required>
                        <label>Email</label>
                    </div>

                    <div class="form-control">
                        <input type="password" id="login-password" name="login-password" placeholder=" " minlength="6" required>
                        <label>Password</label>
                    </div>
                    <button type="submit" name="login-submit" class="submit">Submit</button><br>
                    <div class="forgot-wrap">
                        <a class="forgot-password" href="forgot_password/email.php">Forgot your password?</a>
                    </div>
                </form>
                <?php
                if (isset($_SESSION["login-msg"])) {
                    echo $_SESSION['login-msg'];
                    unset($_SESSION["login-msg"]);
                }
                ?>
            </div>

            <!-- SIGNUP MODAL -->
            <div class="signup">
                <form method="post">
                    <div class="form-control">
                        <input type="text" id="name" name="name" placeholder=" " required>
                        <label>Name</label>
                    </div>

                    <div class="form-control">
                        <input type="tel" name="mobile" placeholder=" " required maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        <label>Mobile</label>
                    </div>

                    <div class="form-control">
                        <input type="email" id="email" name="email" placeholder=" " required>
                        <label>Email</label>
                    </div>

                    <div class="form-control">
                        <input type="password" id="password" name="password" placeholder=" " minlength="6" required>
                        <label>Password</label>
                    </div>
                    <button type="submit" name="submit" class="submit">Submit</button>
                </form>

                <?php
                if (isset($_SESSION["signup-msg"])) {
                    echo $_SESSION['signup-msg'];
                    unset($_SESSION["signup-msg"]);
                }
                ?>
            </div>
        </div>
    </div>