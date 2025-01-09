<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="homepage.css">
</head>
<body>

    <!-- Top Header with Greeting and Cart Icon -->
    <div class="header">
        <p>
            Hello <?php 
            if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $query = mysqli_query($conn, "SELECT users.* FROM `users` WHERE users.email='$email'");
                while ($row = mysqli_fetch_array($query)) {
                    echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']);
                }
            }
            ?> :)
        </p>
        <div class="cart-icon">&#128722; Cart</div>
    </div>

    <!-- Product Grid Section -->
    <div class="container">
        <?php
        // Fetch product data from the database
        $productQuery = "SELECT * FROM products";
        $productResult = mysqli_query($conn, $productQuery);

        if ($productResult) {
            while ($product = mysqli_fetch_assoc($productResult)) {
                echo '
                <div class="product-card">
                    <img src="' . htmlspecialchars($product['image_path']) . '" alt="Product Image" class="product-image">
                    <div class="product-info">
                        <p>' . htmlspecialchars($product['name']) . '</p>
                        <p>KSh ' . number_format($product['price'], 2) . '</p>
                        <button class="add-to-cart">Add to Cart</button>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No products available.</p>';
        }
        ?>
    </div>

    <!-- Footer with Logout Button -->
    <div class="footer">
        <a href="logout.php">Logout</a>
    </div>

</body>
</html>
