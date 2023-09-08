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
    $name = $_POST["name"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $town_city = $_POST["town_city"];

    // Insert data into the database
    $sql = "INSERT INTO contact_info (name, phone_number, address, town_city) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssss", $name, $phone_number, $address, $town_city);
    
    if ($stmt->execute()) {
        // Data inserted successfully, redirect to "index9.html"
        header("Location: index9.html");
        exit; // Terminate the script
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
