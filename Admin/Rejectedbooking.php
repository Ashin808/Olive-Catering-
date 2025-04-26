<?php
include('../Asset/Connection/Connection.php');
include('Head.php');
if (isset($_GET["rid"])) {
    $upqry = "UPDATE tbl_booking SET booking_status=2 WHERE booking_id=" . $_GET["rid"];
    if ($con->query($upqry)) {
        ?>
        <script>
            alert("Rejected");
            window.location = "Rejectedbooking.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Rejected Bookings</title>
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
            max-width: 1100px;
            margin: 20px auto;
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
    </style>
</head>

<body>

<div class="form-container">
    <h2>Rejected Bookings</h2>

    <div class="nav-links">
        <a href="viewbookingreq.php">View Pending Bookings</a> | 
        <a href="Acceptedbooking.php">View Accepted Bookings</a>
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
                <th>Package Info</th>
                <th>Action</th>
                <th>Booking Status</th>
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
                            bk.booking_status IN (2, 4)";
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
                    
                    <td>
                        <a href="viewpackageinfo.php?packagehead_id=<?php echo $data['packagehead_id']; ?>">View Package Details</a> 
                        <td>
                        <?php echo $data["booking_status"] == 2 ? "Rejected" : "Canceled"; ?>
                    </td>
                    <td>
                        <?php 
                        if ($data["booking_status"] == 2) {
                            echo '<a href="viewbookingreq.php?pid=' . $data["booking_id"] . '">Accept</a>';
                        } else {
                            echo '<span style="color: gray;">Cannot Accept</span>';
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
?>