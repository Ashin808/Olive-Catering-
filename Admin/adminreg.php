<?php
include('../Asset/connection/connection.php');

if (isset($_POST["btn_submit"])) {
    $name = $_POST['txt_name'];
    $email = $_POST['txt_email'];
    $password = $_POST['txt_pass'];
    
    // Hash the password 
    // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    $insQry = "INSERT INTO tbl_admin(admin_name, admin_email, admin_password) VALUES ('" . $name . "','" . $email . "','" . $hashedPassword . "')";
    if ($con->query($insQry)) {
        echo "inserted";
    }
}

if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_admin WHERE admin_id=" . $_GET["did"];
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("deleted");
            window.location = "adminreg.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table width="200" border="1">
        <tr>
            <td>Name</td>
            <td><label for="txt_name"></label>
                <input type="text" name="txt_name" id="txt_name"  pattern="[6-9]{1}[0-9]{9}" 
                title="Phone number with 6-9 and remaing 9 digit with 0-9"/></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><label for="txt_email"></label>
                <input type="text" name="txt_email" id="txt_email" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><label for="txt_pass"></label>
                <input type="password" name="txt_pass" id="txt_pass" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                </div>
            </td>
        </tr>
    </table>
    <table width="200" border="1">
        <tr>
            <td>sl.no</td>
            <td>Name</td>
            <td>Email</td>
            <td>Action</td>
        </tr>
        <?php
        $i = 0;
        $selQry = "SELECT * FROM tbl_admin";
        $result = $con->query($selQry);
        while ($data = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["admin_name"]; ?></td>
                <td><?php echo $data["admin_email"]; ?></td>
                <td><a href="adminreg.php?did=<?php echo $data["admin_id"]; ?>">delete</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</form>
</body>
</html>
