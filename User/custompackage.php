<?php
// include('../Asset/connection/connection.php');
// session_start();
include('Head.php');

if (isset($_POST["btn_submit"])) {
    $type = $_POST['btn_type'];
    $insQry = "INSERT INTO tbl_packagehead(type_id, user_id, packagehead_details) VALUES ('" . $type . "', '" . $_SESSION['uid'] . "', 'Custom Package')";
    if ($con->query($insQry)) {
        // You may want to add a success message here
    }
}

if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_packagehead WHERE packagehead_id=" . $_GET["did"];
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("deleted");
            window.location = "custompackage.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Custom Package</title>
    
    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; 
            width: 100%;
            margin: 0 auto; 
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }

        .nav-links {
            text-align: center;
            margin-top: 10px;
        }

        .nav-links a {
            color: #007bff;
            text-decoration: none;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Create Custom Package</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="btn_type">Type</label>
                <select name="btn_type" id="btn_type">
                    <option value="">.....select....</option>
                    <?php
                    $selQryOne = "SELECT * FROM tbl_type";
                    $resultone = $con->query($selQryOne);
                    while ($data = $resultone->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $data["type_id"]; ?>"><?php echo $data["type_name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </form>

        <table>
            <tr>
                <th>Sl No.</th>
                <th>Packagehead ID</th>
                <th>Packagehead Details</th>
                <th>Type</th>
                <th>Type ID</th>
                <th>Actions</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT ph.packagehead_id, ph.packagehead_details, t.type_name, t.type_id
                        FROM tbl_packagehead ph
                        INNER JOIN tbl_type t ON ph.type_id = t.type_id
                        WHERE ph.user_id = '" . $_SESSION['uid'] . "'";

            $result = $con->query($selQry);
            while ($data = $result->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["packagehead_id"]; ?></td>
                    <td><?php echo $data["packagehead_details"]; ?></td>
                    <td><?php echo $data["type_name"]; ?></td>
                    <td><?php echo $data["type_id"]; ?></td>
                    <td><a href="custompackageitem.php?pid=<?php echo $data["packagehead_id"]; ?>">Add item</a>
                    |
                    <a href="?did=<?php echo $data["packagehead_id"]; ?>" onclick="return confirm('Are you sure you want to delete this package?');">Delete</a>
                </td>
                </tr>
                <?php
            }
            ?>
        </table>

        <div class="nav-links">
            <a href="Userhomepage.php">Home</a>
        </div>
    </div>
</body>

</html>

<?php
include('Foot.php');
?>
