<?php
include('../Asset/connection/connection.php');
include('Head.php');
if (isset($_POST["btn_submit"])) {
    $type = $_POST['txt_type'];

    $insQry = "INSERT INTO tbl_type(type_name) VALUES ('$type')";
    if ($con->query($insQry)) {
        
    }
}

if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_type WHERE type_id=" . $_GET["did"];
    if ($con->query($delQry)) { ?>
        <script>
            alert("Deleted");
            window.location = "type.php";
        </script>
    <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Type Management</title>
    <style>
       
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 20px auto; 
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
        .form-group input[type="text"] {
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
        .type-list {
            max-width: 600px;
            width: 100%;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .type-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .type-list th, .type-list td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .type-list th {
            background-color: #f4f4f9;
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
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Add Type</h2>
        <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_type">Type</label>
            <input type="text" name="txt_type" id="txt_type" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
        </div>

            <div class="form-group">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </form>
    </div>

    <div class="type-list">
        <h2>Type List</h2>
        <table>
            <tr>
                <th>SiNo</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_type";
            $result = $con->query($selQry);
            while ($data = $result->fetch_assoc()) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data["type_name"] ?></td>
                    <td>
                        <a href="type.php?did=<?php echo $data["type_id"]; ?>">Delete</a> 
                        <!-- <a href="package.php">Add</a> -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div class="nav-links">
        <a href="adminhomepage.php">Home</a>
    </div>
    </div>

    
</body>
</html>
<?php
include('Foot.php');
?>