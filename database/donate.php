<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $amount = $_POST['amount'];
    $custom_amount = $_POST['custom-amount'] ?? null;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $payment_method = $_POST['payment-method'];
    $message = $_POST['message'] ?? '';
    $recurring = isset($_POST['recurring']) ? 1 : 0;

    // Determine final amount
    if ($amount === 'custom' && !empty($custom_amount)) {
        $final_amount = $custom_amount;
    } else {
        $final_amount = $amount;
    }

    // Validate form data
    if (empty($name) || empty($email) || empty($final_amount)) {
        die("Please fill in all required fields.");
    }

    // Database connection
    require_once 'database/connection.php';

    // Insert donation data into donations table
    $stmt = $conn->prepare("INSERT INTO donations (amount, name, email, payment_method, message, recurring) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssssi", $final_amount, $name, $email, $payment_method, $message, $recurring);

    if ($stmt->execute()) {
        echo "<p>Thank you for your donation, $name! Your support is greatly appreciated.</p>";
    } else {
        echo "<p>Failed to process your donation. Please try again.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>


<!-- CREATE TABLE `donations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `message` text,
  `recurring` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
); -->
<!-- <?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP (usually empty)
$dbname = "your_database_name"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?> -->
