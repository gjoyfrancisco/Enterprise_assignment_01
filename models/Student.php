<?php
/**
 * Student Model
 * Handles all database operations related to students (mysqli version).
 */

require_once __DIR__ . '/../config/database.php';

class Student
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    /**
     * Retrieve all students ordered by creation date (newest first).
     *
     * @return array
     */
    public function getAll(): array
    {
        $result = mysqli_query(
            $this->db,
            'SELECT id, name, student_id, email, created_at FROM students ORDER BY created_at DESC'
        );
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    /**
     * Create a new student record.
     *
     * @param string $name
     * @param string $studentId  Unique student ID string
     * @param string $email
     * @return bool              True on success, false if student_id or email duplicates
     */
    public function create(string $name, string $studentId, string $email): bool
    {
        // Check uniqueness
        $stmt = mysqli_prepare(
            $this->db,
            'SELECT id FROM students WHERE student_id = ? OR email = ? LIMIT 1'
        );
        mysqli_stmt_bind_param($stmt, 'ss', $studentId, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return false;
        }
        mysqli_stmt_close($stmt);

        $stmt = mysqli_prepare(
            $this->db,
            'INSERT INTO students (name, student_id, email) VALUES (?, ?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'sss', $name, $studentId, $email);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $ok;
    }

    /**
     * Delete a student by primary key.
     *
     * @param int $id
     * @return bool  True if a row was deleted
     */
    public function delete(int $id): bool
    {
        $stmt = mysqli_prepare($this->db, 'DELETE FROM students WHERE id = ?');
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $affected = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $affected > 0;
    }

    /**
     * Find student by primary key.
     *
     * @param int $id
     * @return array|null
     */
    public function findById(int $id): ?array
    {
        $stmt = mysqli_prepare(
            $this->db,
            'SELECT id, name, student_id, email FROM students WHERE id = ? LIMIT 1'
        );
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row    = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $row ?: null;
    }
}
