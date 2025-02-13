<?php
include "partials/_auth.php";



// Include database connection
include 'partials/_dbconnect.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate user credentials and fetch user details from database

    // Assuming $user_id contains the ID of the logged-in user
    $user_id = ""; // Replace with actual user ID retrieved from the database

    // Store user ID in session variable
    $_SESSION['id'] = $user_id;

    // Redirect user to home page or any other page
    header("location: home.php");
    exit;
}


// Get the company name from the URL parameter
if (isset($_GET['company'])) {
    $company_name = $_GET['company'];
   
    // Fetch company details
    $sql_company = "SELECT * FROM company WHERE name = '$company_name'";
    $result_company = mysqli_query($conn, $sql_company);


    // Fetch models for the company
    $sql_models = "SELECT model_name, type, cc, fuel_tank_capacity, image_link, product_id, price FROM company WHERE name = '$company_name'";
    $result_models = mysqli_query($conn, $sql_models);
} else {
    // Redirect if company name is not provided
    header("location: bike.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Models</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles/models.css">
</head>


<body>
    <?php require 'partials/_nav.php' ?>
    <div class="container my-4">
        <h2>Models for <?php echo $company_name; ?></h2>
        <div class="row">
            <?php
            // Display company details
            if ($row_company = mysqli_fetch_assoc($result_company)) {
                echo '<div class="col-md-4">';
                echo '<div class="company-details">';
                echo '<img src="' . $row_company['pic_link'] . '" alt="' . $row_company['name'] . '" class="company-img">';
                echo '</div>';
                echo '</div>';
            }
           
            // Display models
            while ($row_models = mysqli_fetch_assoc($result_models)) {
                echo '<div class="col-md-4">';
                echo '<div class="model-details">';
                echo '<img src="' . $row_models['image_link'] . '" alt="' . $row_models['model_name'] . '" class="model-img">';
                echo '<p><strong>Model Name:</strong> ' . $row_models['model_name'] . '</p>';
                echo '<p><strong>Type:</strong> ' . $row_models['type'] . '</p>';
                echo '<p><strong>Product ID:</strong> ' . $row_models['product_id'] . '</p>';
                echo '<p><strong>Price:</strong> Tk.' . $row_models['price'] . '</p>';
                echo '<p><strong>CC:</strong> ' . $row_models['cc'] . '</p>';
                echo '<p><strong>Fuel Tank Capacity:</strong> ' . $row_models['fuel_tank_capacity'] . '</p>';



                // Form for adding the product to cart
                echo '<form action="add_to_cart.php" method="post">';
                echo '<input type="hidden" name="part_id" value="' . $row_models['product_id'] . '">';
                echo '<input type="hidden" name="price" value="' . $row_models['price'] . '">';
                echo '<label for="quantity">Quantity:</label>';
                echo '<input type="number" id="quantity" name="quantity" value="1" min="1">';
                echo '<input type="submit" name="add_to_cart" value="Add to Cart">';
                echo '</form>';



                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</body>


</html>
