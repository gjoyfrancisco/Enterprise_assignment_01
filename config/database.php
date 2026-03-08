<?php
/**
 * Database Configuration
 * Returns a shared mysqli connection instance.
 */

function getDBConnection(): mysqli
{
    static $conn = null;

    if ($conn === null) {
        $conn = mysqli_connect("localhost", "root", "", "student_app");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($conn, "utf8mb4");
    }

    return $conn;
}