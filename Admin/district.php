<?php
include('../Asset/Connection/Connection.php');
include('Head.php');


if (isset($_POST["btn_submit"])) {
    $district = trim($_POST['txt_Dis']); 

    
    $checkQry = "SELECT * FROM tbl_district WHERE district_name = '$district'";
    $result = $con->query($checkQry);

    if ($result->num_rows == 0) {
        
        $insQry = "INSERT INTO tbl_district(district_name) VALUES ('$district')";
        if ($con->query($insQry)) {
            echo "<script>window.location='district.php';</script>";
        } else {
            echo "<script>alert('Error while inserting district. Please try again.');</script>";
        }
    } else {
        
        echo "<script>alert('District already exists'); window.location='district.php';</script>";
    }
}

if (isset($_GET["did"])) {
    
    $delQry = "DELETE FROM tbl_district WHERE district_id = " . intval($_GET["did"]);
    if ($con->query($delQry)) {
        echo "<script>alert('Deleted successfully'); window.location='district.php';</script>";
    } else {
        echo "<script>alert('Error while deleting district. Please try again.');</script>";
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>District Management</title>
    <style>
        /* Your provided styles */
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
        .district-list {
            max-width: 400px;
            width: 100%;
            margin: 20px auto; 
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .district-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .district-list th, .district-list td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .district-list th {
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
        <h2>Add District</h2>
        <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_Dis">District</label>
            <input type="text" name="txt_Dis" id="txt_Dis" required title="Please enter the district name">
        </div>


            <div class="form-group">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </form>
    </div>

    <div class="district-list">
        <h2>District List</h2>
        <table>
            <tr>
                <th>SiNo</th>
                <th>District</th>
                <th>Action</th>
            </tr>
            <?php
            $i = 0;
            $selQry = "SELECT * FROM tbl_district";
            $result = $con->query($selQry);
            while ($data = $result->fetch_assoc()) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $data["district_name"] ?></td>
                    <td><a href="District.php?did=<?php echo $data["district_id"]; ?>">Delete</a></td>
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
