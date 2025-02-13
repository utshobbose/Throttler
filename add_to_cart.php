<?php
// Start session to access session variables
include "partials/_auth.php";


// Include database connection
include 'partials/_dbconnect.php';

// Check if the form is submitted   
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the product ID and quantity are set
    if (isset($_POST['part_id']) && isset($_POST['quantity'])) {
        // Retrieve the product ID and quantity from the form submission
        $product_id = $_POST['part_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        var_dump($price);

        $updated_price = $quantity * $price;

        $email = $_SESSION['email'];

        // var_dump($email);
        $sql = "Select * from users where email = '$email'";
        $result = mysqli_query($conn, $sql)or die(mysqli_error($conn));
        
        $num = mysqli_num_rows($result);
    if ($num == 1){
        $row = mysqli_fetch_assoc($result);
        $first_name = $row['first_name'];
        $user_id = $row['id'];

        // var_dump($first_name);
        // var_dump($user_id);
    }

        // Insert the selected product into the user's cart
        $insert_query = "INSERT INTO user_cart (id, part_id, quantity, price) VALUES ('$user_id', '$product_id', '$quantity', '$updated_price')";
        $insert_result = mysqli_query($conn, $insert_query);

        var_dump($insert_query);
        var_dump($insert_result);
        
        if ($insert_result) {
            // Redirect to a success page or display a success message
            header("location: mycart.php");
            exit;
        } else {
            // Handle insertion error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle error: missing form data
        echo "Error: Missing form data.";
    }
}
?>
