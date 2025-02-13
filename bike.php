<?php
include "partials/_auth.php";

// Include database connection
include 'partials/_dbconnect.php';


// Fetch unique company names from the company table
$sql = "SELECT DISTINCT name, pic_link FROM company";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Companies</title>
    <link rel="stylesheet" href="styles/bike.css">
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
                        <a href="models.php?company=' . urlencode($row['name']) . '" class="company-link">
                            <div class="dashbox">
                                <img src="' . $row['pic_link'] . '" alt="' . $row['name'] . '" class="dashbox-img">
                                <div class="dashbox-overlay">
                                    <h3 class="company-name">' . $row['name'] . '</h3>
                                </div>
                            </div>
                        </a>
                    </div>';
            }
            ?>
        </div>
    </div>
</body>


</html>
