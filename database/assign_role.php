<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $role = $_POST['role'];

    // Simulate assigning role process
    // In real application, you would update the user's role in the database

    echo "<p>Role $role has been assigned to $username.</p>";
}
?>
