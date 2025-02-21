<?php

$mysqli = require __DIR__ . "/database.php";

// Define the HR staff email and password
$hr_email = 'hr2@example.com';
$hr_password = password_hash('your_hr_passwords', PASSWORD_DEFAULT); // Replace 'your_hr_password' with the actual password

// Prepare the SQL query
$sql = "INSERT INTO users (name, email, password, role) VALUES ('HR Staff', ?, ?, 'hr')";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $hr_email, $hr_password);

if ($stmt->execute()) {
    echo "HR staff user inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

?>
