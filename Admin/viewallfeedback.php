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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Feedback</title>
    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
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
        .nav-links {
            text-align: center;
            margin-top: 20px;
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
    <h2>All Feedback</h2>
    <table>
        <tr>
            <th>Sl No</th>
            <th>Feedback ID</th>
            <th>User</th>
            <th>Feedback</th>
            <th>Date</th>
        </tr>
        <?php
        $i = 0;
        $selQry = "SELECT f.feedback_id, f.feedback_content, f.feedback_date, u.user_name 
                    FROM tbl_feedback f 
                    JOIN tbl_user u ON f.user_id = u.user_id";
        $result = $con->query($selQry);
        
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["feedback_id"]; ?></td>
                <td><?php echo $data["user_name"]; ?></td>
                <td><?php echo $data["feedback_content"]; ?></td>
                <td><?php echo $data["feedback_date"]; ?></td>
            </tr>
        <?php } ?>
    </table>\
    <div class="nav-links">
        <a href="adminhomepage.php">Home</a>
    </div>
</div>



</body>
</html>
<?php
include('Foot.php');
?>
