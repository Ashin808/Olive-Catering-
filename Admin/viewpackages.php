<?php
include('Head.php'); 
include('../Asset/Connection/Connection.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin: Search Packages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
        }

        .form-group select, .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .package-container {
            margin-top: 30px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px; 
            justify-content: flex-start;
        }

        .package-item {
            background-color: #ffffff;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 250px; 
        }

        .package-item img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .package-item h3 {
            margin: 0;
            color: #333;
            font-size: 20px;
        }

        .package-item p {
            margin: 5px 0;
            color: #666;
        }

        .action-links a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .action-links a:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Search Packages (Admin)</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="type_id">Select Package Type</label>
                <select name="type_id" id="type_id">
                    <option value="">Select Type</option>
                    <?php
                    $typeQuery = "SELECT type_id, type_name FROM tbl_type";
                    $typeResult = $con->query($typeQuery);

                    while ($typeRow = $typeResult->fetch_assoc()) {
                        echo "<option value='" . $typeRow['type_id'] . "'>" . $typeRow['type_name'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_search">Search</button>
            </div>
        </form>
    </div>

    <div class="package-container">
        <?php
        
        $selQry = "SELECT p.packagehead_id, p.packagehead_details, packagehead_image, t.type_name, AVG(r.review_rating) AS average_rating 
                    FROM tbl_packagehead p 
                    INNER JOIN tbl_type t ON p.type_id = t.type_id 
                    LEFT JOIN tbl_review r ON p.packagehead_id = r.packagehead_id 
                    WHERE p.user_id = 0"; 

        if (isset($_POST['btn_search']) && !empty($_POST['type_id'])) {
            $type_id = $_POST['type_id'];
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
               
                <img src="../Asset/Files/user/photo/<?php echo !empty($dataOne['packagehead_image']) ? $dataOne['packagehead_image'] : 'default_image.jpg'; ?>" alt="Package Image" />
                <h3><?php echo $dataOne['packagehead_details']; ?></h3>
                <p><strong>Type:</strong> <?php echo $dataOne['type_name']; ?></p>
                <div class="star-rating">
                    <?php echo $stars . $emptyStars; ?> (<?php echo $averageRating; ?> out of 5)
                </div>
                <a href="<?php echo $reviewsLink; ?>">View Detailed Reviews</a>
            </div>
        <?php
        }
        ?>
    </div>
</body>
</html>

<?php
include('Foot.php'); 
?>
