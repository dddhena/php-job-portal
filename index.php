<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mysqli = require __DIR__ . "/database.php";

    // Validate and sanitize user inputs
    $name = $mysqli->real_escape_string($_POST["name"]);
    $email = $mysqli->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $mysqli->real_escape_string($_POST["role"]);

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    } else {
        $stmt->bind_param("ssss", $name, $email, $password, $role);

        try {
            $stmt->execute();
            echo "User registered successfully";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                echo "Error: The email address you provided is already registered. Please use a different email or log in.";
            } else {
                echo "Error: " . $e->getMessage();
            }
        }

        $stmt->close();
    }

    $mysqli->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Sign Up</h1>
    
    <form method="post" action="process-signup.php">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Sign Up</button>
    </form>

</body>
</html>