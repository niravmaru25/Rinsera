<?php
if (isset($_SESSION["msg"])) {
    echo $_SESSION["msg"];
    unset($_SESSION["msg"]);
}
?>

<div class="reg-users">
    <h1 class="common-heading" style="margin-bottom:0;">Registered User Profile</h1>
    <div class="table-container">
    <table class="common-table" id="user_table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created at</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM users");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>

                    <tr>
                        <td><?= htmlspecialchars($row["id"]); ?></td>
                        <td><?= htmlspecialchars($row["name"]); ?></td>
                        <td><?= htmlspecialchars($row["mobile"]); ?></td>
                        <td><?= htmlspecialchars($row["email"]); ?></td>
                        <td><?= htmlspecialchars($row["role"]); ?></td>
                        <td><?= htmlspecialchars(date("d-m-Y H:i:s", strtotime($row['created_at']))); ?></td>
                        <td><?= htmlspecialchars($row["status"]); ?></td>

                        <td>
                            <button onclick='openRegUser(
                            <?= json_encode($row["id"]); ?>,
                            <?= json_encode($row["name"]); ?>,
                            <?= json_encode($row["mobile"]); ?>,
                            <?= json_encode($row["email"]); ?>,
                            <?= json_encode($row["role"]); ?>,
                            <?= json_encode($row["status"]); ?>
                        )'>
                                <i class="fas fa-pen"></i>
                            </button>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
    </div>
</div>

<div id="update_profile">
    <div class="update_profile">
        <h3 style="text-align:center;">Update details</h3>

        <form method="post">
            <input type="hidden" name="id" id="id">
            <input type="text" name="name" id="name" placeholder="Enter name">
            <input type="tel" name="mobile" id="mobile" placeholder="Enter mobile">
            <input type="email" name="email" id="email" placeholder="Enter email">
            <select name="role" id="role">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <select name="status" id="status">
                <option value="active">active</option>
                <option value="inactive">inactive</option>
            </select>

            <div class="btns">
                <button type="submit" name="update">Update</button>
                <button type="button" onclick="closeRegUser()">Cancel</button>
            </div>
        </form>
    </div>
</div>