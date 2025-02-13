<?php
include "partials/_auth.php";

// Include database connection
include 'partials/_dbconnect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Get data from the form
    $service_id = $_POST['service_id'];
    $prod_type = 'service';
    $quantity = 1; // Assuming quantity is always 1 for now
    $user_id = $_SESSION['id']; // Assuming user_id is stored in session

    // Prepare SQL statement to insert into cart table
    $sql = "INSERT INTO cart (prod_id, prod_type, quantity, user_id) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $service_id, $prod_type, $quantity, $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Product added successfully
        header("Location: service.php"); // Redirect back to service.php after adding to cart
        exit();
    } else {
        // Error occurred while adding product
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Fetch service information from the database
$sql = "SELECT * FROM Service";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="styles/service.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <div class="container my-4">
        <div class="row">
            <?php
            // Loop through each row of the result set
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4">
                        <div class="service-box">
                            <img src="' . $row['service_pic'] . '" alt="' . $row['service_name'] . '" class="service-img">
                            <div class="service-overlay">
                                <h3 class="service-name">' . $row['service_name'] . '</h3>
                                <p class="service-charge">Charge: Tk.' . $row['service_charge'] . '</p>';
                                
                                // Form for adding the service to cart
                                echo '<form action="contact.php" method="post">';
                                echo '<input type="hidden" name="service_id" value="' . $row['service_id'] . '">';
                                echo '<input type="hidden" name="prod_type" value="service">';
                                echo '<button type="submit" name="contact">Contact us</button>';
                                echo '</form>';

                            echo '</div>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</body>
</html>
