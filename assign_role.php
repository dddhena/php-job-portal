<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Roles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 50%;
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container input[type="text"], .container input[type="email"], .container input[type="password"], .container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assign Roles</h1>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Gmail" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="hr">HR Staff</option>
                <option value="Hiring_manager">Hiring Staff</option>
            </select>
            <button type="submit" name="assign_role">Assign Role</button>
        </form>
        <?php
        if (isset($_POST['assign_role'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'abraham');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to insert user with role
            $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                echo "<p>Role assigned successfully.</p>";
            } 
            else {
                // echo "user gmail is already exists";
                echo "<p>Error assigning role: " . $conn->error . "</p>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
