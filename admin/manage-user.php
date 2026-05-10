<?php
session_start();
require_once "../config/database.php";
require_once "../includes/admin-header.php";

/* GET ALL USERS */
$result = $conn->query("SELECT id, fullname, email, created_at, status FROM users ORDER BY id DESC");
?>

<?php include "../includes/admin-header.php"; ?>

<div class="admin-content">
    <h1>Manage Users</h1>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Joined</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($user = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['fullname'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= date("d M Y", strtotime($user['created_at'])) ?></td>

            <td>
                <span class="status-user <?= $user['status'] ?>">
                    <?= ucfirst($user['status']) ?>
                </span>
            </td>

            <td>
                <!-- Block / Activate -->
                <form action="toggle-user.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <input type="hidden" name="current_status" value="<?= $user['status'] ?>">
                    <button class="resolve-btn">
                        <?= $user['status']=='active' ? 'Block' : 'Activate' ?>
                    </button>
                </form>

                <!-- Delete -->
                <form action="delete-user.php" method="POST" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button style="background:#ef4444">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<?php include "../includes/footer.php"; ?>