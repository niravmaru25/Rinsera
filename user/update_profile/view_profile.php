<?php
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>

<div class="profile">
    <h1 class="common-heading">User Profile</h1>
    <table class="common-table">

        <tr>
            <th><i class="fa-solid fa-user"></i>Name</th>
            <td>
                <?= $name; ?>
            </td>
        </tr>

        <tr>
            <th><i class="fa-solid fa-phone"></i>Mobile</th>
            <td>
                <?= $mobile; ?>
            </td>
        </tr>

        <tr>
            <th><i class="fa-solid fa-envelope"></i>Email</th>
            <td>
                <?= $email; ?>
            </td>
        </tr>

        <tr>
            <th><i class="fa-solid fa-user-plus"></i>Joined on</th>
            <td><?= date('d-M-Y', strtotime($created_at)); ?></td>
        </tr>

        <tr>
            <th><i class="fa-solid fa-user-pen"></i>Action</th>
            <td>
                <button onclick='openUpdate(
                    <?= json_encode($name); ?>,
                    <?= json_encode($mobile); ?>,
                    <?= json_encode($email); ?>
                        )'>
                    <i class="fas fa-pen"></i>
                </button>
            </td>
        </tr>
    </table>
</div>

<div id="update_profile">
    <div class="update_profile">
        <h3 style="text-align:center;">Update details</h3>

        <form method="post">
            <input type="text" name="name" id="name" placeholder="Enter name">
            <input type="tel" name="mobile" id="mobile" placeholder="Enter mobile">
            <input type="email" name="email" id="email" placeholder="Enter email">

            <div class="btns">
                <button type="submit" name="update">Update</button>
                <button type="button" onclick="closeUpdate()">Cancel</button>
            </div>
        </form>
    </div>
</div>