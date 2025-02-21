<?php
// Include the database connection file
require_once '../job_portal4/database/connection.php';

// Function to retrieve featured job listings
function getFeaturedJobs($conn) {
    $sql = "SELECT * FROM jobs WHERE featured = 1 LIMIT 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $featuredJobs = array();
        while ($row = $result->fetch_assoc()) {
            $featuredJobs[] = $row;
        }
        return $featuredJobs;
    }

    return false;
}

// Function to register a new user
function registerUser($conn, $username, $email, $password, $userType) {
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user
    $sql = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $userType);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
// Function to authenticate a user
function authenticateUser($conn, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}

// Function to retrieve all job listings
function getJobListings($conn) {
    $sql = "SELECT * FROM jobs";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $jobListings = array();
        while ($row = $result->fetch_assoc()) {
            $jobListings[] = $row;
        }
        return $jobListings;
    }

    return false;
}

// Function to retrieve job details
function getJobDetails($conn, $jobId) {
    $sql = "SELECT * FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
}

// Function to apply for a job
function applyForJob($conn, $jobId, $candidateId, $coverLetter, $resumeFile) {
    // Read the contents of the uploaded resume file
    $resumeContent = file_get_contents($resumeFile['tmp_name']);

    // Insert the job application with the resume content
    $sql = "INSERT INTO job_applications (job_id, candidate_id, cover_letter, resume_content) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $jobId, $candidateId, $coverLetter, $resumeContent);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

// Function to retrieve an employer's job listings
function getEmployerJobs($conn, $employerId) {
    $sql = "SELECT * FROM jobs WHERE employer_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employerJobs = array();
        while ($row = $result->fetch_assoc()) {
            $employerJobs[] = $row;
        }
        return $employerJobs;
    }

    return false;
}

// Function to post a new job listing
function postJobListing($conn, $employerId, $title, $company, $location, $description, $salary, $requirements) {
    $sql = "INSERT INTO jobs (employer_id, title, company, location, description, salary, requirements) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $employerId, $title, $company, $location, $description, $salary, $requirements);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}

// Function to retrieve user profile data
function getUserProfile($conn, $userId) {
    $sql = "SELECT username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
}

function isUserType($userType) {
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === $userType) {
        return true;
    }
    return false;
}

// Function to update user profile
function updateUserProfile($conn, $userId, $username, $email, $password) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $hashedPassword, $userId);

    if ($stmt->execute()) {
        return true;
    }

    return false;
}
function getCandidateApplications($conn, $candidateId) {
    $sql = "SELECT
                ja.id,
                ja.job_id,
                ja.cover_letter,
                ja.status,
                ja.created_at,
                j.title AS job_title,
                j.company,
                j.location
            FROM
                job_applications ja
            INNER JOIN
                jobs j ON ja.job_id = j.id
            WHERE
                ja.candidate_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $candidateId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $candidateApplications = array();
        while ($row = $result->fetch_assoc()) {
            $candidateApplications[] = $row;
        }
        return $candidateApplications;
    }

    return false;
}
function deleteJobListing($conn, $jobId) {
    $sql = "DELETE FROM jobs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);
    return $stmt->execute();
}


function updateJobListing($conn, $jobId, $title, $company, $location, $description, $salary, $requirements, $featured) {
    $sql = "UPDATE jobs SET title = ?, company = ?, location = ?, description = ?, salary = ?, requirements = ?, featured = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssii", $title, $company, $location, $description, $salary, $requirements, $featured, $jobId);
    return $stmt->execute();
}


function sendMessage($conn, $senderId, $receiverId, $jobId, $messageText) {
    // Validate if receiver exists
    $receiverCheck = $conn->prepare("SELECT id FROM users WHERE id = ?");
    $receiverCheck->bind_param("i", $receiverId);
    $receiverCheck->execute();
    $receiverResult = $receiverCheck->get_result();
    if ($receiverResult->num_rows === 0) {
        return false; // Receiver doesn't exist
    }

    // Insert the message
    $sql = "INSERT INTO messages (sender_id, receiver_id, job_id, message_text) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $senderId, $receiverId, $jobId, $messageText);
    return $stmt->execute();
}


function getNotifications($conn, $userId) {
    $sql = "SELECT m.id, m.sender_id, m.message_text, m.is_read, m.created_at, 
                   u.username AS sender_name 
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.receiver_id = ? AND m.is_read = FALSE
            ORDER BY m.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $notifications = [];
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row;
        }
        return $notifications;
    }
    return [];
}
function getMessages($conn, $userId) {
    $sql = "SELECT m.id, m.sender_id, m.message_text, m.is_read, m.created_at, 
                   u.username AS sender_name 
            FROM messages m
            JOIN users u ON m.sender_id = u.id
            WHERE m.receiver_id = ?
            ORDER BY m.created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        return $messages;
    }
    return [];
}


function markAsRead($conn, $messageId) {
    $sql = "UPDATE messages SET is_read = TRUE WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    return $stmt->execute();
}

function getJobApplications($conn, $jobId) {
    $sql = "SELECT ja.id, ja.status, ja.cover_letter, u.username AS candidate_name, u.id AS candidate_id
            FROM job_applications ja
            JOIN users u ON ja.candidate_id = u.id
            WHERE ja.job_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $jobId);
    $stmt->execute();
    $result = $stmt->get_result();

    $applications = [];
    while ($row = $result->fetch_assoc()) {
        $applications[] = $row;
    }

    return $applications;
}
