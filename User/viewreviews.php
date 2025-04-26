<?php
include('../Asset/Connection/Connection.php');
session_start();

if (isset($_GET['pid'])) {
    $packagehead_id = $_GET['pid'];

    // Fetch the reviews for the specific package using direct query
    $query = "SELECT r.review_text, r.review_rating, u.user_name 
              FROM tbl_review r 
              INNER JOIN tbl_user u ON r.user_id = u.user_id 
              WHERE r.packagehead_id = '".$packagehead_id."'";

    $result = $con->query($query); // Execute the query directly
} else {
    // Redirect or show error if no package ID is provided
    header("Location: searchpackage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews for Package ID: <?php echo htmlspecialchars($packagehead_id); ?></title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        
        h2 {
            color: #333;
            font-size: 2em;
            margin-bottom: 20px;
            text-align: center;
        }

        
        .reviews-container {
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        
        .review {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.2s;
        }

        .review:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        
        .review h4 {
            margin: 0;
            font-size: 1.2em;
            color: #0056b3;
            font-weight: bold;
        }

        
        .stars {
            color: #ffcc00;
            font-size: 1.1em;
            margin: 8px 0;
        }

        
        .review p {
            color: #666;
            font-size: 1em;
            line-height: 1.5;
        }

        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #0056b3;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>

<h2>Reviews for Package ID: <?php echo htmlspecialchars($packagehead_id); ?></h2>

<div class="reviews-container">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rating = (int)$row['review_rating'];
        $userName = htmlspecialchars($row['user_name']);
        $reviewText = htmlspecialchars($row['review_text']);
        
        echo "<div class='review'>";
        echo "<h4>" . $userName . "</h4>";
        
        
        echo "<div class='stars'>";
        for ($i = 0; $i < 5; $i++) {
            echo $i < $rating ? "★" : "☆";
        }
        echo "</div>";
        
        echo "<p>" . $reviewText . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No reviews yet for this package.</p>";
}
?>
</div>

<a href="searchpackage.php" class="back-link">Back to Search</a>

</body>
</html>

