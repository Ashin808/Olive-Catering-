<?php
include('../Asset/Connection/Connection.php');
include('Head.php');

if (isset($_POST["btn_submit"])) {
    $food = $_POST['btn_food'];
    $packagehead_id = $_GET['pid'];
  
    $insQry = "INSERT INTO tbl_packagebody(food_id, packagehead_id) VALUES ('".$food."', '".$packagehead_id."')";
    if ($con->query($insQry)) {
        
    }
}

if (isset($_GET["did"])) {
    $deleteId = $_GET["did"];
    $delQry = "DELETE FROM tbl_packagebody WHERE packagebody_id = '$deleteId'";
    if ($con->query($delQry)) {
        echo "<script>alert('Food item deleted successfully');</script>";
        echo "<script>window.location='packageitem.php?pid=".$_GET['pid']."';</script>";
    } else {
        echo "<script>alert('Error deleting food item: " . $con->error . "');</script>";
    }
}




$packageDetailsQry = "SELECT ph.packagehead_id, ph.packagehead_details AS package_details, t.type_name
                      FROM tbl_packagehead ph 
                      INNER JOIN tbl_type t ON ph.type_id = t.type_id 
                      WHERE ph.packagehead_id = '".$_GET['pid']."'";
$packageDetailsResult = $con->query($packageDetailsQry);
$packageDetails = $packageDetailsResult->fetch_assoc();







$categories = $con->query("SELECT * FROM tbl_category");
$selectedCategory = isset($_POST['btn_category']) ? $_POST['btn_category'] : '';


$foodQuery = "SELECT * FROM tbl_food";
if ($selectedCategory) {
    $foodQuery .= " WHERE category_id = '" . $selectedCategory . "'";
}
$resultFood = $con->query($foodQuery);
?>  

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Package Management</title>
<style>
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
    .form-group input[type="text"], .form-group select {
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
<form id="form1" name="form1" method="post" action="" class="form-container">
   
    <h3 align="center">Package Type: <?php echo $packageDetails['type_name']; ?></h3>
    <p align="center">Details: <?php echo $packageDetails['package_details']; ?></p>
  <table width="100%" border="1">
    <tr>
      <td>Category</td>
      <td>
        <label for="btn_category"></label>
        <select name="btn_category" id="btn_category" onchange="this.form.submit();">
          <option value="">.....select category....</option>
          <?php while ($cat = $categories->fetch_assoc()) { ?>
            <option value="<?php echo $cat['category_id']; ?>" <?php echo $selectedCategory == $cat['category_id'] ? 'selected' : ''; ?>>
                <?php echo $cat['category_name']; ?>
            </option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Food</td>
      <td>
        <label for="btn_food"></label>
        <select name="btn_food" id="btn_food">
          <option value="">.....select food....</option>
          <?php while ($data = $resultFood->fetch_assoc()) { ?>
            <option value="<?php echo $data["food_id"] ?>"> <?php echo $data["food_name"] ?> (<?php echo $data["food_price"] ?>)</option>
          <?php } ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </div>
      </td>
    </tr>
  </table>

  <table width="100%" border="1">
    <tr>
      <th>Sl No.</th>
      <!-- <th>Package Details</th> -->
      <!-- <th>Type Name</th> -->
      <!-- <th>Type Id</th> -->
      <th>Food Name</th>
      <th>Food Price</th>
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $selQry = "SELECT * from tbl_packagebody pb 
                INNER JOIN tbl_packagehead ph ON ph.packagehead_id = pb.packagehead_id
                INNER JOIN tbl_food f ON pb.food_id = f.food_id 
                INNER JOIN tbl_type t ON ph.type_id = t.type_id
                WHERE ph.packagehead_id = '".$_GET['pid']."'";
    $result = $con->query($selQry);
    while ($data = $result->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <!-- <td><?php echo $data["packagehead_details"] ?></td> -->
      <!-- <td><?php echo $data["type_name"] ?></td> -->
      <!-- <td><?php echo $data["type_id"] ?></td> -->
      <td><?php echo $data["food_name"] ?></td>
      <td><?php echo $data["food_price"] ?></td>
      <td><a href="packageitem.php?did=<?php echo $data["packagebody_id"];?>&pid=<?php echo $data['packagehead_id'] ?>">Delete</a></td> 
    </tr>
    <?php } ?>
  </table>
  <div class="nav-links">
    <a href="package.php">Back</a>
  </div>
  
</form>

</body>
</html>
<?php
include('Foot.php');
?>
