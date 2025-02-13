<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('image.jpg');
            background-size: cover; /* Adjusts the size of the background image */
            background-position: center; /* Centers the background image */
            opacity: 0.6; /* Adjust the opacity of the background image */
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Set a background color with opacity for the container */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php include 'partials/_nav.php'; ?>
    <div class="profile-container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <?php
            // Start the session
            session_start();

            // Check if the user is logged in
            if (!isset($_SESSION['id'])) {
                // Redirect to the login page if the user is not logged in
                header("location: login.php");
                exit(); // Stop further execution
            }

            // Include the database connection file
            include 'partials/_dbconnect.php';

            // Retrieve user information from the database using the user ID from the session
            $user_id = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);

            // Check if the query was successful
            if ($result) {
                // Fetch user data
                $user = mysqli_fetch_assoc($result);
                if ($user) {
                    // Extract user information
                    $first_name = $user['first_name'];
                    $last_name = $user['last_name'];
                    $email = $user['email'];
                    $address = $user['address'];
                    $contact = $user['contact'];

                    // Display user information
                    echo "<p><strong>First Name:</strong> $first_name</p>";
                    echo "<p><strong>Last Name:</strong> $last_name</p>";
                    echo "<p><strong>Email:</strong> $email</p>";
                    echo "<p><strong>Address:</strong> $address</p>";
                    echo "<p><strong>Contact:</strong> $contact</p>";
                } else {
                    echo "User not found.";
                }
            } else {
                echo "Error retrieving user information: " . mysqli_error($conn);
            }

            // Close database connection
            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
