<?php
include('../Asset/Connection/Connection.php');
include('Head.php');
if (isset($_POST["pid"])) {
    $booking_amount = $_POST['booking_amount'];
    $upqry = "UPDATE tbl_booking SET booking_status=1, booking_amount='$booking_amount' WHERE booking_id=" . $_POST["pid"];
    if ($con->query($upqry)) {
        ?>
        <script>
            alert("Accepted");
            window.location = "Acceptedbooking.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Accepted Bookings</title>
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
            max-width: 1400px;
            margin: 20px auto;
            overflow-x: auto;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .nav-links {
            text-align: center;
            margin: 10px 0;
        }
        .nav-links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f9;
        }
        .action-links a {
            margin-right: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input[type="number"],
        .form-group input[type="submit"] {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-top: 5px;
        }
        .form-group input[type="submit"] {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }
        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

<div class="form-container">
    <h2>Accepted Bookings</h2>

    <div class="nav-links">
        <a href="viewbookingreq.php">View Pending Bookings</a> |
        <a href="Rejectedbooking.php">View Rejected/Cancelled Bookings</a>
    </div>

    <form id="form1" name="form1" method="post" action="">
        <table>
            <tr>
                <th>SL.no</th>
                <th>Booking ID</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Location</th>
                <th>Event Address</th>
                <th>Package Details</th>
                <th>Booking Details</th>
                <th>Booking Count</th>
                <th>Booking Service</th>
                <th>Booking Amount</th>
                <th>Payment Status</th>
                <th>Package Info</th>
                <th colspan="3">Action</th>
            </tr>

            <?php
            $i = 0;
            $selQry = "SELECT 
                        *
                        FROM 
                            tbl_booking bk
                            INNER JOIN tbl_packagehead ph ON ph.packagehead_id = bk.packagehead_id
                            INNER JOIN tbl_type t ON ph.type_id = t.type_id
                            INNER JOIN tbl_place p ON bk.place_id = p.place_id
                        WHERE 
                            bk.booking_status IN (1,3,5)";
            $result = $con->query($selQry);

            while ($data = $result->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["booking_id"]; ?></td>
                    <td><?php echo $data["booking_fordate"]; ?></td>
                    <td><?php echo $data["booking_fortime"]; ?></td>
                    <td><?php echo $data["place_name"]; ?></td>
                    <td><?php echo $data["booking_address"]; ?></td>
                    <td><?php echo $data["packagehead_details"]; ?></td>
                    <td><?php echo $data["booking_details"]; ?></td>
                    <td><?php echo $data["booking_count"]; ?></td>
                    <td>
                        <?php
                        
                        if ($data["booking_service"] == 1) {
                            echo "Added";
                        } else {
                            echo "Not Added";
                        }
                        ?>
                    </td>
                    <td><?php echo $data["booking_amount"]; ?></td>
                    <td> 
                        <?php if ($data["booking_status"] == 3) { echo "<span style='color: blue;'>Completed</span>"; }
                        elseif ($data["booking_status"] == 5) { echo "<span style='color: green;'>Delivered</span>"; }
                        elseif ($data["booking_status"] == 1) { echo "<span style='color: red;'>Pending</span>"; }
                        elseif ($data["booking_status"] == 4) { echo "<span style='color: red;'>Cancelled</span>"; }
                        elseif ($data["booking_status"] == 2) { echo "<span style='color: red;'>Rejected</span>"; }
                        else { echo "<span style='color: black;'>Unknown</span>"; } ?> 
                    </td>

                    <td>
                        <a href="viewpackageinfo.php?packagehead_id=<?php echo $data['packagehead_id']; ?>">View Package Details</a> 
                    </td>
                    <td>
                        <?php if ($data["booking_status"] == 1) { ?>
                        <form action="" method="post">
                        <input type="hidden" name="pid" value="<?php echo $data["booking_id"]; ?>" />
                        <input type="number" name="booking_amount" placeholder="Enter Amount" required />
                        <input type="submit" value="Accept" />
                        </form>
                        <?php } else {
                        if ($data["booking_status"] == 3) {
                        echo "Payment Completed";
                        } else {
                        echo "-";
                        }
                        } ?>
                    </td>

                    <td>
                        <?php 
                        
                        if ($data["booking_status"] != 5) { 
                        ?>
                            <a href="viewbookingreq.php?rid=<?php echo $data["booking_id"]; ?>">Reject</a>
                        <?php 
                        } else {
                            echo "-"; 
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($data["booking_status"] == 3) { 
                            $eventDate = $data["booking_fordate"];
                            $eventTime = $data["booking_fortime"];
                            $currentTime = date("Y-m-d H:i:s");
                            $eventDateTime = date("Y-m-d H:i:s", strtotime("$eventDate $eventTime"));

                            if ($currentTime >= $eventDateTime) { 
                                ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>" />
                                    <input type="submit" name="mark_as_delivered" value="Mark as Delivered" />
                                </form>
                                <?php
                            } else {
                                echo "Event has not started yet.";
                            }
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>






                </tr>
                <?php
            }
            ?>
        </table>
    </form>
    <div class="nav-links">
        <a href="adminhomepage.php">Home</a>
    </div>
</div>

</body>
</html>
<?php
include('Foot.php');


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pid"]) && isset($_POST["booking_amount"])) {
    $booking_id = $_POST["pid"];
    $booking_amount = $_POST["booking_amount"];
    $updateQry = "UPDATE tbl_booking SET booking_amount = '$booking_amount' WHERE booking_id = $booking_id";

    if ($con->query($updateQry)) {
        ?>
        <script>
            alert("Booking amount updated successfully.");
            window.location.href = "Acceptedbooking.php"; 
        </script>
        <?php
    } else {
        echo "<script>alert('Error updating booking amount: " . $con->error . "');</script>";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["mark_as_delivered"])) {
    $booking_id = $_POST["booking_id"];

    
    $selQry = "SELECT booking_fordate, booking_fortime FROM tbl_booking WHERE booking_id = '$booking_id'";
    $result = $con->query($selQry);
    $data = $result->fetch_assoc();

    $eventDate = $data["booking_fordate"];
    $eventTime = $data["booking_fortime"];
    $currentTime = date("Y-m-d H:i:s");
    $eventDateTime = date("Y-m-d H:i:s", strtotime("$eventDate $eventTime"));

    
    if ($currentTime >= $eventDateTime) {
        
        $checkStatusQry = "SELECT booking_status FROM tbl_booking WHERE booking_id = '$booking_id'";
        $result = $con->query($checkStatusQry);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            
            if ($row["booking_status"] == 3) {
                
                $updateQry = "UPDATE tbl_booking SET booking_status = 5 WHERE booking_id = '$booking_id'";

                if ($con->query($updateQry)) {
                    echo "<script>alert('Booking marked as Delivered'); window.location.href = 'Acceptedbooking.php';</script>";
                } else {
                    echo "<script>alert('Error in updating the booking: " . $con->error . "'); window.location.href = 'Acceptedbooking.php';</script>";
                }
            } else {
                echo "<script>alert('Booking payment is not completed yet. Cannot mark as Delivered.'); window.location.href = 'Acceptedbooking.php';</script>";
            }
        } else {
            echo "<script>alert('Booking not found or incorrect status'); window.location.href = 'Acceptedbooking.php';</script>";
        }
    } else {
        echo "<script>alert('Event has not started yet. Cannot mark as Delivered.'); window.location.href = 'Acceptedbooking.php';</script>";
    }
}





?>
