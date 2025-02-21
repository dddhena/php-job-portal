<?php

$mysqli = require __DIR__ . "/database.php";

// Define the admin email and password
$admin_email = 'hena1@example.com';
$admin_password = password_hash('henadmin1', PASSWORD_DEFAULT); // Replace 'your_admin_password' with the actual password

// Prepare the SQL query
$sql = "INSERT INTO users (name, email, password, role) VALUES ('Admin', ?, ?, 'admin')";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $admin_email, $admin_password);

if ($stmt->execute()) {
    echo "Admin user inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();

?>
