<?php
include('../Asset/connection/connection.php');
include('Head.php');

if (isset($_POST["btn_submit"])) {
    $details = $_POST['txt_details'];  
    $type = $_POST['btn_type'];

   
    if (isset($_FILES['file_photo']) && $_FILES['file_photo']['error'] == 0) {
        $photo = $_FILES['file_photo']['name'];
        $tempphoto = $_FILES["file_photo"]["tmp_name"];
        $uploadDir = "../Asset/Files/user/photo/";
        
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        
        move_uploaded_file($tempphoto, $uploadDir . $photo);
    } else {
        $photo = ''; 
    }

    
    $insQry = "INSERT INTO tbl_packagehead (packagehead_details, type_id, packagehead_image) VALUES ('" . $details . "', '" . $type . "', '" . $photo . "')";
    if ($con->query($insQry)) {
        
    }
}

if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_packagehead WHERE packagehead_id=" . $_GET["did"];
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("deleted");
            window.location = "package.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Management</title>
<style>
    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: auto;
        width: 100%;
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
    .newcon {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .table img {
        width: 100px;
        height: 100px;
        object-fit: cover;  
    }

</style>
</head>

<body>
<div class="form-container">
    <h2>Package Management</h2>
    <form name="form1" method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txt_details">Details</label>
            <input type="text" name="txt_details" id="txt_details" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
        </div>

        <div class="form-group">
            <label for="btn_type">Type</label>
            <select name="btn_type" id="btn_type">
                <option>.....select....</option>
                <?php
                    $selQryOne = "SELECT * FROM tbl_type";
                    $resultone = $con->query($selQryOne);
                    while ($data = $resultone->fetch_assoc()) {
                ?>
                    <option value="<?php echo $data["type_id"] ?>"> 
                        <?php echo $data["type_name"] ?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="file_photo">Food Photo</label>
            <input type="file" name="file_photo" id="file_photo" accept="image/*" required>
        </div>

        <div class="form-group">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit">
        </div>
    </form>

    <table>
        <tr>
            <th>Sl No.</th>
            <th>Type ID</th>
            <th>Type Name</th>
            <th>Image</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
        <?php
        $i = 0;
        $selQry = "SELECT ph.*, t.type_name FROM tbl_packagehead ph 
                  INNER JOIN tbl_type t ON ph.type_id = t.type_id 
                  WHERE ph.user_id = 0";
        $result = $con->query($selQry);
        while ($data = $result->fetch_assoc()) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data["type_id"] ?></td>
            <td><?php echo $data["type_name"] ?></td>
            <td><?php echo $data["packagehead_details"] ?></td>
            <td>
                <img src="../Asset/Files/user/photo/<?php echo $data['packagehead_image']; ?>" width="100" height="100" style="object-fit: cover;">
            </td>

            <td>
                <a href="package.php?did=<?php echo $data["packagehead_id"]; ?>">Delete</a> |
                <a href="packageitem.php?pid=<?php echo $data["packagehead_id"]; ?>">Add item</a>
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
