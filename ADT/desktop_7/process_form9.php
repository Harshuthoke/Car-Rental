<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $cardNumber = $_POST["card_number"];
    $cardHolder = $_POST["card_holder"];
    $expirationDate = $_POST["expiration_date"];
    $cvc = $_POST["cvc"];    
    $marketingAgreement = isset($_POST["marketing_agreement"]) ? 1 : 0;
    $termsAgreement = isset($_POST["terms_agreement"]) ? 1 : 0;

    // Insert payment method data into the database
    $sql = "INSERT INTO payment_methods (card_number, card_holder, expiration_date, cvc, marketing_agreement, terms_agreement) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssi", $cardNumber, $cardHolder, $expirationDate, $cvc, $marketingAgreement, $termsAgreement);

    if ($stmt->execute()) {
        header("Location: index10.html"); // Redirect to a success page
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
