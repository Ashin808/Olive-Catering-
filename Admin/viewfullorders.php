<?php
include('../Asset/Connection/Connection.php');
session_start();
include('Head.php');
if (!isset($_SESSION['aid'])) {
    ?>
    <script>
        alert("You do not have permission to view this page."); 
        window.location.href = "../Guest/login.php";
    </script>
    <?php
    exit();
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM tbl_booking bk
                INNER JOIN tbl_packagehead ph ON ph.packagehead_id = bk.packagehead_id
                INNER JOIN tbl_type t ON ph.type_id = t.type_id
                INNER JOIN tbl_user u ON bk.user_id = u.user_id
                INNER JOIN tbl_place p ON bk.place_id = p.place_id";


if (!empty($search)) {
    $search = $con->real_escape_string($search);
    $query .= " WHERE
        u.user_name LIKE '%$search%' OR
        u.user_email LIKE '%$search%' OR
        bk.booking_date LIKE '%$search%' OR
        bk.booking_status LIKE '%$search%' OR
        bk.booking_amount LIKE '%$search%' OR
        bk.booking_amount LIKE '%$search%' OR
        bk.booking_fordate LIKE '%$search%' OR
        bk.booking_fortime LIKE '%$search%' OR
        u.user_phone LIKE '%$search%'";
}

$query .= " ORDER BY bk.booking_date DESC";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            padding: 20px;
            max-width: 1650px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-inline {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .custom-search-btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;
        }
        .btn-secondary{
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;

        }
        .btn {
            padding: .65rem 1.4rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 22px;
            border: none;
            cursor: pointer;
        }
        .form-control {
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: .6rem 1rem;
            width: 300px;
        }
        .table-responsive {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .clickable-row {
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>All Orders</h2>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="" class="form-inline">
            <input type="text" name="search" placeholder="Search" class="form-control" value="<?php echo htmlspecialchars($search); ?>" required>
            <button type="submit" class="btn custom-search-btn">Search</button>
            <a href="viewfullorders.php" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Order Date</th>
                    <th>Event Date</th>
                    <th>Location</th>
                    <th>Event Address</th>
                    <th>Package Details</th>
                    <th>Booking Details</th>
                    <th>Booking Count</th>
                    <th>Booking Service</th>
                    <th>Package Info</th>
                    <th>Status</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <?php
                        
                        $statusText = ''; 
                        switch ($row['booking_status']) {
                            case '1':
                                $statusText = "Pending!";
                                break;
                            case '2':
                                $statusText = "Rejected!";
                                break;
                            case '3':
                                $statusText = "Completed!";
                                break;
                            case '4':
                                $statusText = "Cancelled!";
                                break;
                            case '5':
                                $statusText = "Delivered!";
                                break;
                            default:
                                $statusText = "Unknown";
                        }
                    ?>
                    <tr class="clickable-row">
                        <td><?php echo $row['booking_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['user_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_fordate']); ?></td>
                        <td><?php echo htmlspecialchars($row['place_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_address']); ?></td>
                        <td><?php echo htmlspecialchars($row['packagehead_details']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_details']); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_count']); ?></td>

                        
                        <td>
                            <?php
                            $serviceLabel = $row['booking_service'] == 1 ? "Added" : "Not Added";
                            echo htmlspecialchars($serviceLabel);
                            ?>
                        </td>

                        <td>
                                <a href="viewpackageinfo.php?packagehead_id=<?php echo $row['packagehead_id']; ?>" >View Package Details</a>
                        </td>

                        <td><?php echo htmlspecialchars($statusText); ?></td>
                        <td><?php echo htmlspecialchars($row['booking_amount']); ?></td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div align="center">
        <a href="adminhomepage.php">Home</a>
    </div>
</div>

</body>
</html>
