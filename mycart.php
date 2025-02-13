<?php
session_start();
include 'partials/_dbconnect.php'; // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link rel="stylesheet" href="styles/cart.css"> <!-- Add your CSS file path here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php include 'partials/_nav.php'; ?> <!-- Include navigation bar -->

    <div class="container">
        <?php
        // Fetch orders from the cart for the logged-in user (assuming user_id is stored in $_SESSION)
        $user_id = $_SESSION['id']; // Assuming user_id is stored in the session after login
        $sql = "SELECT * FROM user_cart WHERE id = '$user_id'";
        $result = mysqli_query($conn, $sql);

        // Check if orders are found in the cart
        if(mysqli_num_rows($result) > 0) {
            // Loop through each order in the cart
            while ($row = mysqli_fetch_assoc($result)) {
                // Obtain product_id for each order
                $product_id = $row['part_id'];
                $quantity = $row['quantity'];

                // Fetch product details from the models table based on product_id
                $product_sql = "SELECT * FROM company WHERE product_id = '$product_id'";
                $product_result = mysqli_query($conn, $product_sql);

                // Check if product details are found
                if(mysqli_num_rows($product_result) > 0) {
                    // Fetch product details as an associative array
                    $product = mysqli_fetch_assoc($product_result);

                    // Display product information for each order
                    echo "<div class='order-details'>";
                    echo "<h2>Order Details</h2>";
                    echo "<h3>Order for Product: " . $product['name'] . " - " . $product['model_name'] . "</h3>";
                    echo "<p>Model Name: " . $product['model_name'] . "</p>";
                    echo "<p>Type: " . $product['type'] . "</p>";
                    echo "<p>CC: " . $product['cc'] . "</p>";
                    echo "<p>Fuel Tank Capacity: " . $product['fuel_tank_capacity'] . "</p>";
                    echo "<p>Total: $" . ($product['price'] * $quantity) . "</p>";
                    // need to add product details for image_link, pic link, type, cc, fuel_tank_capacity
                    // Add additional product details here as needed
                    echo "</div>";
                } else {
                    // Product details not found
                    echo "<p class='error-message'>Product details not found for product ID: $product_id</p>";
                }
            }
        } else {
            // No orders found in the cart
            echo "<p class='no-orders'>No orders found in the cart.</p>";
        }
        ?>
    </div>
</body>
</html>
