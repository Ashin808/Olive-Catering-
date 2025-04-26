<?php
ob_start(); // Start output buffering
// include("../Asset/Connection/Connection.php");

// session_start();
include('Head.php');

$selQry = "SELECT u.*, p.place_name FROM tbl_user u 
             LEFT JOIN tbl_place p ON u.place_id = p.place_id 
             WHERE u.user_id = " . $_SESSION["uid"];
$resultUser = $con->query($selQry);
$dataUser = $resultUser->fetch_assoc();

if (isset($_POST["btn_submit"])) {
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $phone = $_POST["txt_phone"];
    $place_id = $_POST["btn_place"];

    $upQry = "UPDATE tbl_user SET user_name='$name', user_email='$email', user_phone='$phone', place_id='$place_id' 
              WHERE user_id=" . $_SESSION['uid'];
    
    if ($con->query($upQry) === TRUE) {
        $message = "Profile updated successfully. Redirecting to My Profile...";
        header("refresh:2; url=MyProfile.php"); 
        exit();
    } else {
        $message = "Error updating profile: " . $con->error; 
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Edit Profile</title>
    
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
            margin: 20px 0;
        }

        table, th, td {
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
        <h2>Edit Profile</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input type="text" name="txt_name" id="txt_name" value="<?php echo $dataUser["user_name"]; ?>" />
            </div>
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input type="text" name="txt_email" id="txt_email" value="<?php echo $dataUser["user_email"]; ?>" />
            </div>
            <div class="form-group">
                <label for="txt_phone">Phone</label>
                <input type="text" name="txt_phone" id="txt_phone" value="<?php echo $dataUser["user_phone"]; ?>" />
            </div>
            <div class="form-group">
                <label for="btn_place">Place</label>
                <select name="btn_place" id="btn_place">
                    <option value="">Select Place</option>
                    <?php
                    
                    $placeQuery = "SELECT * FROM tbl_place";
                    $placeResult = $con->query($placeQuery);
                    while ($place = $placeResult->fetch_assoc()) {
                        $selected = ($place['place_id'] == $dataUser['place_id']) ? 'selected' : '';
                        echo "<option value='{$place['place_id']}' $selected>{$place['place_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- <div class="form-group" align="center">
                <a href="ChangePassword.php">Change Password</a>
            </div> -->
            <div class="form-group">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                <div class="nav-links">
                    <a href="Userhomepage.php">Home</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>

<?php
ob_end_flush(); 
include('Foot.php');
?>
