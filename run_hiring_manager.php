<?php

$mysqli = require __DIR__ . "/database.php";

// Define the hiring manager email and password
$hiring_manager_email = 'hiringmanager@example.com';
$hiring_manager_password = password_hash('your_hiring_manager_password', PASSWORD_DEFAULT); // Replace 'your_hiring_manager_password' with the actual password

// Prepare the SQL query
$sql = "INSERT INTO users (name, email, password, role) VALUES ('Hiring Manager', ?, ?, 'hiring_manager')";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $hiring_manager_email, $hiring_manager_password);

if ($stmt->execute()) {
    echo "Hiring Manager user inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

?>
