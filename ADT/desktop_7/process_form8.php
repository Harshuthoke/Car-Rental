<?php
// Database connection parameters
$hostname = 'localhost'; // Replace with your database server hostname
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'Billing_info'; // Replace with your database name

// Create a database connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Process the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickup_location = $_POST["pickup_location"];
    $pickup_date = $_POST["pickup_date"];
    $pickup_time = $_POST["pickup_time"];
    $dropoff_location = $_POST["dropoff_location"];
    $dropoff_date = $_POST["dropoff_date"];
    $dropoff_time = $_POST["dropoff_time"];

    // Insert data into the database
    $sql = "INSERT INTO rental_info (pickup_location, pickup_date, pickup_time, dropoff_location, dropoff_date, dropoff_time) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssssss", $pickup_location, $pickup_date, $pickup_time, $dropoff_location, $dropoff_date, $dropoff_time);
    
    if ($stmt->execute()) {
        // Data inserted successfully
        header("Location: index7.html"); // Redirect to a success page
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
