<?php
include('Head.php');
include('../Asset/Connection/Connection.php');
if (isset($_POST["btn_search"])) {
    $type_id = $_POST['btn_type'];
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Search Package</title>

    <style>
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .package-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .package-item {
            border: 1px solid #ddd;
            padding: 20px;
            width: 250px;
            text-align: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .package-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .star-rating {
            font-size: 1em;
            color: #B8860B;
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
    <div class="form-container">
        <h2>Search Package</h2>
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="btn_type">Package Type</label>
                <select name="btn_type" id="btn_type">
                    <option value="">.....select....</option>
                    <?php
                    $selTypeQry = "SELECT type_id, type_name FROM tbl_type";
                    $resultType = $con->query($selTypeQry);

                    while ($row = $resultType->fetch_assoc()) {
                        echo "<option value='" . $row['type_id'] . "'>" . $row['type_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="btn_search" id="btn_search" value="Search" />
            </div>
        </form>

        <div class="package-container">
            <?php
            $selQry = "SELECT p.packagehead_id, p.packagehead_details,packagehead_image,t.type_name, AVG(r.review_rating) AS average_rating 
                        FROM tbl_packagehead p 
                        INNER JOIN tbl_type t ON p.type_id = t.type_id 
                        LEFT JOIN tbl_review r ON p.packagehead_id = r.packagehead_id 
                        WHERE p.user_id = 0";

            if (isset($type_id) && !empty($type_id)) {
                $selQry .= " AND p.type_id = '$type_id'";
            }

            $selQry .= " GROUP BY p.packagehead_id";
            $resultOne = $con->query($selQry);

            while ($dataOne = $resultOne->fetch_assoc()) {
                $averageRating = isset($dataOne['average_rating']) ? round($dataOne['average_rating'], 2) : 0;
                $stars = str_repeat('★', floor($averageRating));
                $emptyStars = str_repeat('☆', 5 - floor($averageRating));
                $reviewsLink = "viewreviews.php?pid=" . $dataOne["packagehead_id"];
            ?>
                <div class="package-item">
                    
                    <img src="../Asset/Files/user/photo/<?php echo !empty($dataOne['packagehead_image']) ? $dataOne['packagehead_image'] : 'default_image.jpg' ; ?>" alt="Package Image" width="250" height="150" />
                    <h4><?php echo $dataOne['packagehead_details']; ?></h4>
                    <p><h5><?php echo $dataOne['type_name']; ?><h5></p>
                    <div class="star-rating">
                        <?php echo $stars . $emptyStars; ?> (<?php echo $averageRating; ?> out of 5)
                    </div>
                    <a href="<?php echo $reviewsLink; ?>">View Detailed Reviews</a><br>
                    <div>
                        <a href="viewpackagebody.php?pid=<?php echo $dataOne["packagehead_id"]; ?>"
                        style="display: inline-block; background-color: yellow; color: black; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                        Book Now</a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>

        <div class="nav-links">
            <a href="Userhomepage.php">Home</a>
        </div>
    </div>
</body>

</html>

<?php
include('Foot.php');
?>
