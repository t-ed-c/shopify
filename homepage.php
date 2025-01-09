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
        <!-- Loop for 10 Products -->
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo '
            <div class="product-card">
                <img src="https://via.placeholder.com/200" alt="Product Image" class="product-image">
                <div class="product-info">
                    <p>Product ' . $i . '</p>
                    <p>KSh ' . number_format(rand(1000, 10000), 0) . '</p> <!-- Price in KSH -->
                    <button class="add-to-cart">Add to Cart</button>
                </div>
            </div>';
        }
        ?>
    </div>

    <!-- Footer with Logout Button -->
    <div class="footer">
        <a href="logout.php">Logout</a>
    </div>

</body>
</html>
