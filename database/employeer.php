<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Database connection
    require_once 'database/connection.php';

    // Insert email and password into employers table
    $stmt = $conn->prepare("INSERT INTO employers (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        echo "<p>Employer has been registered successfully.</p>";
    } else {
        echo "<p>Failed to register employer. Please try again.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
