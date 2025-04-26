<?php
include('../Asset/Connection/Connection.php');

session_start();
$user_id = $_SESSION['uid'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body> 



`<table width="600" border="1">
    <tr>
      <td>SiNo</td>
      <td>Title</td>
      <td>Content</td>
      <td>Date</td>
      <td>Reply</td>
    </tr>
    <?php
  $i=0;
  $selQry="SELECT * FROM tbl_complaint Where user_id = '".$_SESSION['uid']."'";

  $result=$con->query($selQry);
  while($data=$result->fetch_assoc())
  {
    $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data["complaint_title"] ?></td>
      <td><?php echo $data["complaint_content"] ?></td>
      <td><?php echo $data["complaint_date"] ?></td>
      <td><?php echo $data["complaint_reply"] ?></td>
     
    </tr>
    <?php
  }
  ?>
  </table>
  <table border="1">
   <tr>
        <td><a href="Userhomepage.php">Home</a></td>
   </tr>
</body>
</html>