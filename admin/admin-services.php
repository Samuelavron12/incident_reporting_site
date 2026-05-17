
<?php
require_once "../config/database.php";
require_once "../includes/admin-header.php";

if(isset($_POST['add_service']))
{
    $name = $_POST['name'];
    $type = $_POST['type'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    $sql = "INSERT INTO emergency_services
            (service_name, service_type, phone, email, location)
            VALUES ('$name','$type','$phone','$email','$location')";

    mysqli_query($conn,$sql);
}
?>
<?php require_once("../includes/admin-check.php"); ?>


<!DOCTYPE html>
<html>
<head>
<title>Emergency Services</title>
<link rel="stylesheet" href="../assets/CSS/admin.css">
</head>
<body>

<div class="admin-content">

    <h1>Emergency Services Management</h1>

    <!-- ADD SERVICE CARD -->
    <div class="card">
        <h2>Add New Service</h2>

        <form method="POST">
            <input type="text" name="name" placeholder="Service Name" required>
            <input type="text" name="type" placeholder="Service Type (Hospital, Police…)" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="email" name="email" placeholder="Email Address">
            <input type="text" name="location" placeholder="Location" required>

            <button type="submit" name="add_service">Add Service</button>
        </form>
    </div>

    <!-- TABLE CARD -->
    <div class="card">
        <h2>Available Emergency Services</h2>

        <table>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Location</th>
                <th>Action</th>
            </tr>

            <?php
            $result = mysqli_query($conn,"SELECT * FROM emergency_services");

            while($row = mysqli_fetch_assoc($result))
            {
            echo "<tr>
            <td>{$row['service_name']}</td>
            <td>{$row['service_type']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['email']}</td>
            <td>{$row['location']}</td>
            <td><a class='dispatch-btn' href='dispatch.php?id={$row['id']}'>Dispatch Incident</a></td>
            </tr>";
            }
            ?>
        </table>

    </div>

</div>
</body>
</html>

