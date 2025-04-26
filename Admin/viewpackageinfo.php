<?php
include('Head.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Package Details</title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        } */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
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
        .newcon {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    include('../Asset/Connection/Connection.php');

    if (isset($_GET['packagehead_id'])) {
        $packagehead_id = $_GET['packagehead_id'];

        
        $packageQuery = "SELECT * FROM tbl_packagehead WHERE packagehead_id = $packagehead_id";
        $packageResult = $con->query($packageQuery);
        $packageData = $packageResult->fetch_assoc();

       
        $foodQuery = "SELECT f.food_name, f.food_price 
                      FROM tbl_packagebody pb
                      INNER JOIN tbl_food f ON pb.food_id = f.food_id
                      WHERE pb.packagehead_id = $packagehead_id";
        $foodResult = $con->query($foodQuery);
    }
    ?>
    
    <div class="form-container"align="center" >
        <h2>Package Details</h2>

        <?php if ($packageData) { ?>
            <p><strong>Package ID:</strong> <?php echo $packageData['packagehead_id']; ?></p>
            <p><strong>Package Name:</strong> <?php echo $packageData['packagehead_details']; ?></p>
            
            <h3>Food Items:</h3>
            <table border="1" width="100%">
                <tr>
                    <th>SL.No</th>
                    <th>Food Name</th>
                    <th>Price (₹)</th>
                </tr>
                <?php
                $totalCost = 0;
                $i = 0;
                while ($food = $foodResult->fetch_assoc()) {
                    $i++;
                    $totalCost += $food['food_price'];
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $food['food_name']; ?></td>
                        <td><?php echo $food['food_price']; ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"><strong>Total Cost</strong></td>
                    <td><strong>₹<?php echo $totalCost; ?></strong></td>
                </tr>
            </table>
        <?php } else { ?>
            <p>Package details not found.</p>
        <?php } ?>
        
        <br>
        <div class="nav-links">
            <a href="javascript:history.back();">Back</a>
        </div>
    </div>
</body>
</html>
<?php
include('Foot.php');
?>