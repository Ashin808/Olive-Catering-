<?php
session_start();
include('../Asset/Connection/Connection.php');  


if (!isset($_SESSION['uid'])) {
    header("Location: ../Guest/login.php");
    exit();
}

$user_id = $_SESSION['uid'];  


if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
} else {
    echo "Booking ID not provided.";
    exit();
}


$query_user = "SELECT user_name, user_email, user_phone FROM tbl_user WHERE user_id = '$user_id'";
$result_user = mysqli_query($con, $query_user);
$user = mysqli_fetch_assoc($result_user);


$query_booking = "SELECT b.booking_id, b.booking_date, b.booking_time, b.booking_fordate, b.booking_fortime, 
                         b.booking_address, b.booking_amount, b.booking_details, b.booking_status, 
                         b.booking_count, b.booking_service, b.transaction_id
                  FROM tbl_booking b
                  WHERE b.booking_id = '$booking_id'";
$result_booking = mysqli_query($con, $query_booking);
$booking = mysqli_fetch_assoc($result_booking);


$query_food = "
    SELECT f.food_name, f.food_price, c.category_name, b.booking_count AS quantity
    FROM tbl_food f
    INNER JOIN tbl_packagebody pb ON f.food_id = pb.food_id
    INNER JOIN tbl_booking b ON b.packagehead_id = pb.packagehead_id
    INNER JOIN tbl_category c ON f.category_id = c.category_id
    WHERE b.booking_id = '$booking_id'";
$result_food = mysqli_query($con, $query_food);


$bookingStatus = "";
switch ($booking['booking_status']) {
    case '1':
        $bookingStatus = "Pending";
        break;
    case '2':
        $bookingStatus = "Rejected";
        break;
    case '3':
        $bookingStatus = "Completed";
        break;
}

$bookingDate = date('Y-m-d', strtotime($booking['booking_date'])); 
$bookingTime = $booking['booking_time']; 


$foodCategories = [];
while ($food = mysqli_fetch_assoc($result_food)) {
    $foodCategories[$food['category_name']][] = $food;
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>User Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .invoice-container {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .header-table h2 {
            margin: 0;
        }
        .header-table img {
            max-width: 175px;
            max-height: 158px;
            display: block;
            margin-right: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        .status {
            font-weight: bold;
            margin: 10px 0;
            color: #d9534f; 
        }
        .footer {
            margin-top: 20px;
            text-align: center;
        }
        .invoice-info {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        h3 {
            border-bottom: 2px solid #e7e7e7;
            padding-bottom: 5px;
        }
        .nav-links {
        text-align: center;
            margin-top: 20px;
        }
        .nav-links a {
            color: #007bff;
        }
    </style>
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
</head>
<body>

<div class="invoice-container">
    
    <table class='header-table'>
        <tr>
            <td>
                <h2 align="center">Olive Caterings</h2>
                <p>Nehru Street, Nehru Park Junction,<br> Velloorkunnam, Muvattupuzha,<br> Kerala 686673 </p> 
                <p>Contact: +91-6238124486,+91-7592834486<br> Email: olivecatering@gmail.com</p>
           </td>
           <td><img align="center" src="../Asset/Templates/Main/img/invo.png" alt="Invoice Logo" style="margin-bottom:60px " ></td>
        </tr>
    </table>

    
    <div class='invoice-info'>
        <p><strong>User Information:</strong><br>
            Name: <?php echo htmlspecialchars($user['user_name']); ?><br>
            Email: <?php echo htmlspecialchars($user['user_email']); ?><br>
            Phone: <?php echo htmlspecialchars($user['user_phone']); ?>
        </p>
        <p>
            <strong>Invoice #:</strong> INV<?php echo $booking['booking_id']; ?><br>
            <strong>Transaction ID:</strong> <?php echo htmlspecialchars($booking['transaction_id']); ?><br>
            <strong>Booking Date:</strong> <?php echo $bookingDate; ?><br>
            <strong>Booking Time:</strong> <?php echo htmlspecialchars($bookingTime); ?><br>
        </p>
    </div>

   
    <h3>Booking Details</h3>
    <table>
        <thead>
            <tr>
                <th>Event Date</th>
                <th>Time</th>
                <th>Address</th>
                <th>Count</th>
                <th>Service</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo htmlspecialchars($booking['booking_fordate']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_fortime']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_address']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_count']); ?></td>
                <td><?php echo $booking['booking_service'] == 1 ? 'Needed' : 'Not Needed'; ?></td>
                <td>₹ <?php echo htmlspecialchars($booking['booking_amount']); ?></td>
            </tr>
        </tbody>
    </table>

    <div class='status'>
        <p><strong>Status:</strong> <?php echo $bookingStatus; ?></p>
    </div>

    
    <h3>Food Items in the Package</h3>
    <?php 
    $grandTotal = 0; 
    foreach ($foodCategories as $category => $items): ?>
        <table>
            <thead>
                <tr>
                    <th><?php echo htmlspecialchars($category); ?></th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $categoryTotal = 0; 
                if (!empty($items)): ?>
                    <?php foreach ($items as $item): 
                        $itemTotal = $item['food_price'] * $item['quantity']; 
                        $categoryTotal += $itemTotal; 
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['food_name']); ?></td>
                            <td>₹ <?php echo htmlspecialchars($item['food_price']); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>₹ <?php echo htmlspecialchars($itemTotal); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td><strong>₹ <?php echo htmlspecialchars($categoryTotal); ?></strong></td>
                    </tr>
                    <?php $grandTotal += $categoryTotal;  ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No items in this category.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    
    <div style="font-weight: bold; font-size: 18px;">
        <p align="right">Grand Total: ₹ <?php echo htmlspecialchars($grandTotal); ?></p>
    </div>

    
    <div class='footer'>
        <p>Thank you for choosing Olive Caterings!</p>
    </div>

    
    <div style="text-align: center;">
        <button onclick="printInvoice()" style="padding: 10px 20px; font-size: 16px;">Print Invoice</button>
    </div>
    <div class="nav-links">
                <a href="Mybookings.php">Back</a>
    </div>
</div>

</body>
</html>
