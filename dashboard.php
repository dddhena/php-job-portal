<?php
require_once '../job_portal4/session.php';
require_once '../job_portal4/database/connection.php';
require_once '../job_portal4/database/functions.php';

// Check if the user is an employer
if (!isUserType('hr staff')) {
    header('Location: hr_role.php');
    exit;
}

// Fetch employer's job listings and applications
$employerJobs = getEmployerJobs($conn, $_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employer Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <header>
        <h1>Employer Dashboard</h1>
        <nav>
            <a href="post-job.php">Post New Job</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <?php if (isset($message)): ?>
            <p class="success-message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>

        <section>
            <h2>Your Job Listings</h2>
            <?php if ($employerJobs): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Company</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employerJobs as $job): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($job['title']); ?></td>
                                <td><?php echo htmlspecialchars($job['location']); ?></td>
                                <td><?php echo htmlspecialchars($job['company']); ?></td>
                                <td>
                                    <a href="edit-job.php?id=<?php echo $job['id']; ?>">Edit</a>
                                    <a href="dashboard.php?delete_job_id=<?php echo $job['id']; ?>" onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <h3>Applications for <?php echo htmlspecialchars($job['title']); ?></h3>
                                    <?php 
                                    $applications = getJobApplications($conn, $job['id']); 
                                    if ($applications): ?>
                                        <ul>
                                            <?php foreach ($applications as $application): ?>
                                                <li>
                                                    Candidate: <?php echo htmlspecialchars($application['candidate_name']); ?> - Status: <?php echo htmlspecialchars($application['status']); ?>
                                                    <!-- Message Button Start -->
                                                    <form action="send-message.php" method="POST" style="display:inline;">
                                                        <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">
                                                        <input type="hidden" name="receiver_id" value="<?php echo $application['candidate_id']; ?>">
                                                        <textarea name="message_text" placeholder="Type your message here..."></textarea>
                                                        <button type="submit">Send Message</button>
                                                    </form>
                                                    <!-- Message Button End -->
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>No applications yet.</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have no job listings. <a href="post-job.php">Post a new job</a> now!</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
