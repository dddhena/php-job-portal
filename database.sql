CREATE DATABASE abraham;
CREATE TABLE employee_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    skills VARCHAR(255),
    resume VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE interviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_name VARCHAR(255) NOT NULL,
    job_id INT NOT NULL,
    interview_date DATE NOT NULL,
    interview_time TIME NOT NULL
);
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    company VARCHAR(255),
    location VARCHAR(255),
    description TEXT,
    salary VARCHAR(255),
    requirements TEXT,
    featured INT,
    job_title VARCHAR(255)
);
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_name VARCHAR(255) DEFAULT NULL,
    job_id INT DEFAULT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT NULL,
    is_read TINYINT(1) DEFAULT NULL,
    application_id INT DEFAULT NULL,
    sender_role VARCHAR(255) DEFAULT NULL
);
CREATE TABLE report (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_type VARCHAR(255),
    file_name VARCHAR(255),
    uploaded_at DATETIME
);
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(255)
);
