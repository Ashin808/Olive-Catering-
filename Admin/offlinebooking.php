<?php
include('../Asset/Connection/Connection.php');
include('Head.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $package_date = $con->real_escape_string($_POST['package_date']);
    $package_details = $con->real_escape_string($_POST['package_details']);
    $type_id = $con->real_escape_string($_POST['type_id']);

    
    $insertQuery = "INSERT INTO tbl_packagehead (packagehead_date, packagehead_status, packagehead_details, type_id) 
                    VALUES ('$package_date', 'offline', '$package_details', '$type_id')";

   
    if ($con->query($insertQuery) === TRUE) {
        ?>
        <script>
            alert('Offline booking added successfully!');
            window.location.href = "offlinebooking.php";
        </script>
        <?php
    } else {
        
        echo "<script>alert('Error: " . $con->error . "');</script>";
        
        echo "<script>alert('Query: " . $insertQuery . "');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Booking</title>
</head>
<body>

<div class="form-container">
    <h2>Offline Booking</h2>
    <form action="" method="post">
        <table>
            <tr>
                <td>Package Date:</td>
                <td><input type="date" name="package_date" required /></td>
            </tr>
            <tr>
                <td>Package Details:</td>
                <td><textarea name="package_details" rows="4" required></textarea></td>
            </tr>
            <tr>
                <td>Package Type:</td>
                <td>
                    <select name="type_id" required>
                        <option value="">Select Type</option>
                        <?php
                        
                        $typeQuery = "SELECT * FROM tbl_type";
                        $result = $con->query($typeQuery);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Add Booking" />
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
<?php
include('Foot.php');
?>
