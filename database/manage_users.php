if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    // Simulate managing user process
    // In real application, you would perform actions like activating, deactivating, or deleting a user

    echo "<p>User management for $username completed.</p>";
}
?>
