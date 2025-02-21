<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        form label {
            display: block;
            margin-top: 10px;
        }
        form input[type="email"],
        form select,
        form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        <form action="manage_users.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="action">Action:</label>
            <select id="action" name="action" required>
                <option value="delete">Delete</option>
            </select>

            <button type="submit">Manage User</button>
        </form>
    </div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $action = $_POST['action'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'abraham');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($action == 'delete') {
        // SQL query to delete user
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "User deleted successfully.";
        } else {
            echo "Error deleting user: " . $conn->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>
