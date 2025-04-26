<?php

include('Head.php');

if (isset($_POST["btn_submit"])) {
    $currentpassword = $_POST["txt_CurrentPass"];
    $newpassword = $_POST["txt_NewPass"];
    $repassword = $_POST["txt_RePass"];

    $SelPassword = "SELECT * FROM tbl_user WHERE user_id=" . $_SESSION["uid"];
    $rePassword = $con->query($SelPassword);
    $dataPassword = $rePassword->fetch_assoc();

    if ($dataPassword["user_password"] == $currentpassword) {
        if ($newpassword == $repassword) {
            $upQry = "UPDATE tbl_user SET user_password= '$newpassword' WHERE user_id=" . $_SESSION['uid'];
            if ($con->query($upQry)) {
                $message = "Password updated successfully. Redirecting to Edit Profile...";
                header("refresh:2; url=EditProfile.php");
                exit();
            } else {
                $message = "Error updating password. Please try again.";
            }
        } else {
            $message = "New password and confirm password do not match.";
        }
    } else {
        $message = "Current password is incorrect.";
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Change Password</title>
   
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
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Change Password</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_CurrentPass">Current Password</label>
                <input type="text" name="txt_CurrentPass" id="txt_CurrentPass" required />
            </div>
            <div class="form-group">
                <label for="txt_NewPass">New Password</label>
                <input type="text" name="txt_NewPass" id="txt_NewPass" required />
            </div>
            <div class="form-group">
                <label for="txt_RePass">Re-enter New Password</label>
                <input type="text" name="txt_RePass" id="txt_RePass" required />
            </div>
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
include('Foot.php');
?>
