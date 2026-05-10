<?php require_once("../includes/admin-check.php"); ?>

<?php
include("../config/database.php");
include("../includes/admin-header.php");
include("../admin/sidebar.php");
?>
<div class="admin-content">
    <h1>Manage Incidents</h1>

    <table class="admin-table">
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Title</th>
        <th>Location</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
        $query = "SELECT incidents.*, users.fullname 
        FROM incidents 
        JOIN users ON incidents.user_id = users.id
        ORDER BY incidents.id DESC";
        $result = mysqli_query($conn,$query);

        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['fullname']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['location']; ?></td>
            <td>
            <form action="../admin/update-status.php" method="POST">

        <!-- hidden id of the incident -->
        <input type="hidden" name="incident_id" value="<?= $row['id']; ?>">

        <!-- status dropdown -->
        <select name="status" onchange="this.form.submit()">

            <option value="Pending" 
            <?= $row['status']=='Pending'?'selected':''; ?>>
            Pending
            </option>

            <option value="In Progress" 
            <?= $row['status']=='In Progress'?'selected':''; ?>>
            In Progress
            </option>

            <option value="Resolved" 
            <?= $row['status']=='Resolved'?'selected':''; ?>>
            Resolved
            </option>

            <option value="Rejected" 
            <?= $row['status']=='Rejected'?'selected':''; ?>>
            Rejected
            </option>

        </select>

    </form>
</td>
<td>
    <a href="incident-details.php?id=<?= $row['id']; ?>" class="btn-view">View</a>
</td> 
        </tr>
        <?php } ?>
    </table>
</div>

<?php include("../includes/footer.php"); ?>