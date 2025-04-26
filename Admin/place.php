<?php
include('../Asset/Connection/Connection.php');
include('Head.php');
if (isset($_POST["btn_add"])) {
    $name = $_POST['txt_place'];
    $district = $_POST['btn_district'];
    $insQry = "INSERT INTO tbl_place(place_name, district_id) VALUES ('$name', '$district')";
    if ($con->query($insQry)) {
        ?>
        <script>
         window.location="place.php";
        </script>
        <?php
 
    }
}

if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_place WHERE place_id=" . $_GET["did"];
    if ($con->query($delQry)) { ?>
        <script>
            alert("Deleted");
            window.location = "place.php";
        </script>
    <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Place Management</title>
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
        .place-list {
            max-width: 600px;
            width: 100%;
            margin: 20px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .place-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .place-list th, .place-list td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .place-list th {
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
        <h2>Add Place</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="btn_district">District</label>
                <select name="btn_district" id="btn_district">
                    <option>.....select....</option>
                    <?php
                    $selQryOne = "SELECT * FROM tbl_district";
                    $resultone = $con->query($selQryOne);
                    while ($data = $resultone->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $data["district_id"] ?>"><?php echo $data["district_name"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="txt_place">Place</label>
                <input type="text" name="txt_place" id="txt_place" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" 
                title="Please enter only letters for the place name">
            </div>

            <div class="form-group">
                <input type="submit" name="btn_add" id="btn_add" value="Add" />
            </div>
        </form>
    </div>

    <div class="place-list">
        <h2>Place List</h2>
        <table>
            <tr>
                <th>SiNo</th>
                <th>District</th>
                <th>Place</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_place p INNER JOIN tbl_district d ON d.district_id = p.district_id";
            $result = $con->query($selQry);
            while ($data = $result->fetch_assoc()) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data["district_name"] ?></td>
                    <td><?php echo $data["place_name"] ?></td>
                    <td><a href="place.php?did=<?php echo $data["place_id"]; ?>">Delete</a></td>
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