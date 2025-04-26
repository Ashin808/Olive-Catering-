<?php
include('../Asset/connection/connection.php');
include('Head.php');


if (isset($_POST["btn_submit"])) {
    $name = $_POST['txt_name'];
    $photo = $_FILES['file_photo']['name'];
    $tempphoto = $_FILES["file_photo"]["tmp_name"];
    move_uploaded_file($tempphoto, "../Asset/Files/user/photo/" . $photo);
    $price = $_POST['txt_price'];
    $category_id = $_POST['category_id']; 

    
    $insQry = "INSERT INTO tbl_food (food_name, food_photo, food_price, category_id) 
               VALUES ('$name', '$photo', '$price', '$category_id')";

    if ($con->query($insQry)) {
        echo "<script>alert('Food item added successfully.');</script>";
    } else {
        echo "Error: " . $con->error; 
    }
}


$categoryQry = "SELECT * FROM tbl_category";
$categories = $con->query($categoryQry);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Add Food Item</title>
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
    </style>
</head>

<body>
<div class="form-container">
    <h2>Add Food Item</h2>
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="txt_name">Food Name</label>
        <input type="text" name="txt_name" id="txt_name" required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')">
    </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id"  required>
                <option value="">--- Select Category ---</option>
                <?php while ($row = $categories->fetch_assoc()) { ?>
                    <option value="<?php echo $row['category_id']; ?>">
                        <?php echo $row['category_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="file_photo">Food Photo</label>
            <input type="file" name="file_photo" id="file_photo" accept="image/*" required>
        </div>
       <div class="form-group">
            <label for="txt_price">Food Price</label>
            <input type="text" name="txt_price" id="txt_price" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
        </div>

        <div class="form-group">
            <input type="submit" name="btn_submit" value="Add Food">
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
