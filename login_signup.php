<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="UTF-8">
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
            width: 300px;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome</h1>
        <p>Please choose an option:</p>
        <div class="buttons">
            <a href="login.php" class="button">Log In</a>
            <a href="index.php" class="button">Sign Up</a>
        </div>
    </div>
</body>
</html>
