<?php
// include('../Asset/Connection/Connection.php');
include('Head.php');

$packagehead_id = $_GET['pid'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Details</title>


<style>
    .form-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
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
        margin: 20px auto;
        text-align: left;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 12px;
    }
    th {
        background-color: #f4f4f9;
    }
    td img {
        display: block;
        margin: 0 auto;
    }
    .total-row {
        font-weight: bold;
        text-align: right;
    }
</style>

</head>

<body>
    <div class="form-container">
        <h2>Package Details</h2>
        
        <div style="max-height: 400px; overflow-y: auto; overflow-x: auto; border: 1px solid #ccc; padding: 10px;">
            <table>
                <tr>
                    <th>SL no.</th>
                    <th>Food</th>
                    <th>Image</th>
                    <th>Price</th>
                    
                </tr>
                <?php
                $i = 0;
                $totalPrice = 0;
                $selQry = "SELECT f.food_name, f.food_photo, f.food_price 
                           FROM tbl_packagebody pb 
                           INNER JOIN tbl_food f ON pb.food_id = f.food_id 
                           WHERE pb.packagehead_id = '" . $packagehead_id . "'";
                $result = $con->query($selQry);
                while ($data = $result->fetch_assoc()) {
                    $i++;
                    $totalPrice += $data["food_price"];
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["food_name"]; ?></td>
                    <td style="text-align: center;">
                        <img src="../Asset/Files/User/Photo/<?php echo $data['food_photo']; ?>" width="100" height="100" />
                    </td>
                    <td><?php echo $data["food_price"]; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" class="total-row">Total Price:</td>
                    <td><?php echo $totalPrice; ?></td>
                   
                </tr>
            </table>
        </div>
        <div class="nav-links">
        <?php 
            
            if ($i > 0) {
                echo '<a href="reqpackage.php?pid=' . $packagehead_id . '">Request Order</a>';
            } else {
                echo 'No items in this package. Cannot request.';
            }
            ?>


        </div>
        <div class="nav-links">
            <a href="Userhomepage.php">Home</a>
        </div>
    </div>
</body>
</html>
<?php
include('Foot.php');
?>
