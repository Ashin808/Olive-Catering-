<?php

include('../Asset/connection/connection.php');
include('Head.php'); 


if (isset($_POST["btn_submit"])) {
    
    $category_name = $_POST['txt_name'];

    
    $insQry = "INSERT INTO tbl_category (category_name) VALUES ('$category_name')";

    
    if ($con->query($insQry)) {
        echo "<script>alert('Category inserted successfully.');</script>";
    } else {
        echo "Error: " . $con->error; 
    }
}


$con->close();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Category</title>
    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
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
    <h2>Add Category</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="txt_name">Category Name</label>
            <input type="text" name="txt_name" id="txt_name" required>
        </div>
        <div class="form-group">
            <input type="submit" name="btn_submit" value="Add Category">
        </div>
    </form>

    
    <div class="nav-links">
        <a href="adminhomepage.php">Home</a>
    </div>
</div>
</body>
</html>

<?php
include('Foot.php');
?>
