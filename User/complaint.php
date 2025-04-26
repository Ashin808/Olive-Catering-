<?php
// session_start();
// include('../Asset/Connection/Connection.php');
include('Head.php');
$user_id = $_SESSION['uid'];
if(isset($_POST["btn_submit"]))
{
  $title = $_POST['txt_title'];
  $content = $_POST['txt_content'];
 
  $insQry = "insert into tbl_complaint(complaint_title,complaint_content,complaint_date,user_id)values('".$title."','".$content."',curdate(),'".$_SESSION['uid']."')";
  if($con -> query($insQry))
   {
        echo "<script>
        alert('Complaint added successfully');
        window.location.href = 'Userhomepage.php';
        </script>";
        exit; 
        } else {
        echo "Error: " . $con->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Form</title>
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
            max-width: 400px;
            width: 100%;
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
        .newcon {
          display: flex;
          justify-content: center;
          align-items: center;
        }
    </style>
</head>
<body>

<div class="newcon">
<div class="form-container">
    <h2>Submit Your Complaints</h2>
    <form id="form1" name="form1" method="post" action="">
        <div class="form-group">
            <label for="txt_title">Title</label>
            <input type="text" name="txt_title" id="txt_title" required />
        </div>
        <div class="form-group">
            <label for="txt_content">Content</label>
            <input type="text" name="txt_content" id="txt_content" required />
        </div>
        <div class="form-group">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </div>
    </form>
    <div class="nav-links">
        <a href="Userhomepage.php">Home</a>
    </div>
</div>
</div>

</body>
</html>

<?php
include('Foot.php');
?>