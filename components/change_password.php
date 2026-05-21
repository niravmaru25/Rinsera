<div class="change_password">

        <h1 class="common-heading">Change Password</h1>

    <form method="post">

        <div class="input-group">
            <label for="current_password">Current Password</label>

            <div class="input-field">
                <i class="fa-solid fa-key"></i>
                <input type="password" id="current_password" name="current_password" minlength="6" required>
            </div>
        </div>

        <div class="input-group">
            <label for="new_password">New Password</label>

            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="new_password" name="new_password" minlength="6" required>
            </div>
        </div>

        <div class="input-group">
            <label for="confirm_password">Confirm Password</label>

            <div class="input-field">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="confirm_password" name="confirm_password" minlength="6" required>
            </div>
        </div>

        <button type="submit" name="update">
            <i class="fa-solid fa-rotate"></i>
            Update Password
        </button>

    </form>
</div>