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

if (isset($_POST["btn_reply"])) {
    $complaint_id = $_POST['complaint_id'];
    $complaint_reply = $_POST['txt_reply'];

    
    if (trim($complaint_reply) === '') {
        echo "<script>alert('Reply cannot be empty.');</script>";
    } else {
        $upQry = "UPDATE tbl_complaint SET complaint_reply='" . $complaint_reply . "' WHERE complaint_id='" . $complaint_id . "'";

        if ($con->query($upQry)) {
            echo "<script>alert('Reply sent successfully');</script>";
        } else {
            echo "<script>alert('Error sending reply');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Management</title>
    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
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
        textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Complaints Management</h2>
    <table>
        <tr>
            <th>Complaint ID</th>
            <th>Username</th>
            <th>Title</th>
            <th>Content</th>
            <th>Date</th>
            <th>Reply</th>
            <th>Action</th>
        </tr>
        <?php
        $selQry = "SELECT c.complaint_id, c.complaint_title, c.complaint_content, c.complaint_date, c.complaint_reply, u.user_name 
                    FROM tbl_complaint c 
                    JOIN tbl_user u ON c.user_id = u.user_id";
        $result = $con->query($selQry);
        
        while ($data = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $data['complaint_id']; ?></td>
                <td><?php echo $data['user_name']; ?></td>
                <td><?php echo $data['complaint_title']; ?></td>
                <td><?php echo $data['complaint_content']; ?></td>
                <td><?php echo $data['complaint_date']; ?></td>
                <td><?php echo $data['complaint_reply']; ?></td>
                <td>
                <form method="post" action="">
                    <input type="hidden" name="complaint_id" value="<?php echo $data['complaint_id']; ?>" required />
                    <textarea name="txt_reply" placeholder="Type your reply..." required oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"><?php echo $data['complaint_reply']; ?></textarea><br>
                    <input type="submit" name="btn_reply" value="Reply" class="form-group" />
                </form>

                </td>
            </tr>
        <?php } ?>
    </table>
    <div class="nav-links">
        <a href="adminhomepage.php">Home</a>
    </div>
</div>

</body>
</html>
<?php
include('Foot.php');
?>
