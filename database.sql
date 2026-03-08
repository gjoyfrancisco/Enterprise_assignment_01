-- Student Information Management Application
-- Database Schema

CREATE DATABASE IF NOT EXISTS student_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE student_app;

-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)  NOT NULL UNIQUE,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Students table
CREATE TABLE IF NOT EXISTS students (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    student_id  VARCHAR(20)  NOT NULL UNIQUE,
    email       VARCHAR(100) NOT NULL UNIQUE,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample Harry Potter themed students
INSERT IGNORE INTO students (name, student_id, email) VALUES
    ('Harry Potter',       'S1000001', 'harry.potter@hogwarts.edu'),
    ('Hermione Granger',   'S1000002', 'hermione.granger@hogwarts.edu'),
    ('Ron Weasley',        'S1000003', 'ron.weasley@hogwarts.edu'),
    ('Draco Malfoy',       'S1000004', 'draco.malfoy@hogwarts.edu'),
    ('Luna Lovegood',      'S1000005', 'luna.lovegood@hogwarts.edu'),
    ('Neville Longbottom', 'S1000006', 'neville.longbottom@hogwarts.edu');
