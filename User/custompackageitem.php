<?php
// include('../Asset/Connection/Connection.php');
// session_start();
include("Head.php");

if (isset($_GET['pid'])) {
    $packagehead_id = $_GET['pid'];

    if (isset($_POST["btn_submit"])) {
        $food = $_POST['btn_food'];

        $insQry = "INSERT INTO tbl_packagebody(food_id, packagehead_id) VALUES('" . $food . "', '" . $packagehead_id . "')";
        if ($con->query($insQry)) {
           
        } else {
            
        }
    }
}


if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_packagebody WHERE packagebody_id=" . $_GET["did"];
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("Deleted");
            window.location = "custompackageitem.php?pid=<?php echo $_GET['pid'] ?>";
        </script>
        <?php
    }
}


$categories = $con->query("SELECT * FROM tbl_category");
$selectedCategory = isset($_POST['btn_category']) ? $_POST['btn_category'] : '';


$foodQuery = "SELECT * FROM tbl_food";
if ($selectedCategory) {
    $foodQuery .= " WHERE category_id = '" . $selectedCategory . "'";
}
$resultFood = $con->query($foodQuery);
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Package Details</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
            width: 100%;
            margin-top: 20px;
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

        .scrollable-table {
            max-height: 500px; 
            overflow-y: auto; 
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
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

        .center-text {
            text-align: center;
        }
    </style>
</head>

<body>
    <form id="form1" name="form1" method="post" action="">
        <div class="form-container">
            <h2>Custom Package</h2>
            <?php
            
            $selQryPackage = "SELECT ph.packagehead_details, t.type_name 
                              FROM tbl_packagehead ph 
                              INNER JOIN tbl_type t ON ph.type_id = t.type_id 
                              WHERE ph.packagehead_id = '" . $packagehead_id . "'";
            $packageResult = $con->query($selQryPackage);
            $packageData = $packageResult->fetch_assoc();

            
            if ($packageData) {
                echo '<h3 class="center-text">' . $packageData["packagehead_details"] . ' - ' . $packageData["type_name"] . '</h3>';
            }
            ?>

            
            <div class="form-group">
                <label for="btn_category">Category</label>
                <select name="btn_category" id="btn_category" onchange="this.form.submit();">
                    <option value="">.....select category....</option>
                    <?php while ($cat = $categories->fetch_assoc()) { ?>
                        <option value="<?php echo $cat['category_id']; ?>" <?php echo $selectedCategory == $cat['category_id'] ? 'selected' : ''; ?>>
                            <?php echo $cat['category_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            
            <div class="form-group">
                <label for="btn_food">Food</label>
                <select name="btn_food" id="btn_food">
                    <option value="">.....select food....</option>
                    <?php while ($data = $resultFood->fetch_assoc()) { ?>
                        <option value="<?php echo $data["food_id"] ?>"> <?php echo $data["food_name"] ?> (<?php echo $data["food_price"] ?>)</option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
            </div>
        </div>

        <div class="form-container">
            <div class="scrollable-table">
                <table>
                    <tr>
                        <th>Sl No.</th>
                        <th>Food Photo</th>
                        <th>Food Name</th>
                        <th>Food Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i = 0;
                    $selQry = "SELECT pb.*, f.food_name, f.food_price, f.food_photo 
                               FROM tbl_packagebody pb 
                               INNER JOIN tbl_food f ON pb.food_id = f.food_id 
                               WHERE pb.packagehead_id = '" . $_GET['pid'] . "'";
                    $result = $con->query($selQry);
                    
                    while ($data = $result->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img src="../Asset/Files/User/Photo/<?php echo $data['food_photo']; ?>" width="100" height="100" /></td>
                            <td><?php echo $data["food_name"] ?></td>
                            <td><?php echo $data["food_price"] ?></td>
                            <td><a href="custompackageitem.php?did=<?php echo $data["packagebody_id"]; ?>&&pid=<?php echo $_GET['pid'] ?>"onclick="return confirm('Are you sure you want to delete this package?');">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <div class="nav-links center-text">
                <a href="reqpackage.php?pid=<?php echo $packagehead_id; ?>">Request Order</a>
            </div>
            <div class="nav-links center-text">   
                <a href="Userhomepage.php">Home</a>
            </div>
        </div>
        </div>
    </form>
</body>

</html>

<?php
include('Foot.php');
?>
