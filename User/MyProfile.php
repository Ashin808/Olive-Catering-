<?php
include('Head.php');


$SelUser = "SELECT u.*, p.place_name FROM tbl_user u 
             LEFT JOIN tbl_place p ON u.place_id = p.place_id 
             WHERE u.user_id = " . $_SESSION["uid"];
$resultUser = $con->query($SelUser);
$dataUser = $resultUser->fetch_assoc();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>User Profile</title>

    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 0 auto; 
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
        select {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f9;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <h2>User Profile</h2>
            <table width="200" border="1">
                <tr>
                    <td colspan="2" class="form-group">
                        <img src="../Asset/Files/User/Photo/<?php echo $dataUser['user_photo']; ?>" width="200" />
                    </td>
                </tr>
                <tr class="form-group">
                    <td><strong>Name</strong></td>
                    <td><?php echo $dataUser["user_name"]; ?></td>
                </tr>
                <tr class="form-group">
                    <td><strong>Email</strong></td>
                    <td><?php echo $dataUser["user_email"]; ?></td>
                </tr>
                <tr class="form-group">
                    <td><strong>Phone</strong></td>
                    <td><?php echo $dataUser["user_phone"]; ?></td>
                </tr>
                <tr class="form-group">
                    <td><strong>Place</strong></td>
                    <td><?php echo $dataUser["place_name"]; ?></td>
                </tr>
                <tr class="form-group">
                    <td><strong>Proof</strong></td>
                    <td><a href="../Asset/Files/User/Proof/<?php echo $dataUser['user_proof']; ?>" target='_blank'>View Proof</a></td>
                </tr>
                <!-- <tr class="form-group">
                    <td colspan="2" align="center"><a href="EditProfile.php">Edit Profile</a></td>
                </tr> -->
            </table>

            <div class="nav-links">
                <a href="Userhomepage.php">Home</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include('Foot.php');
?>
