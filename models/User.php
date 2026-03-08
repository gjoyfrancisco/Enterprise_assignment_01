<?php
/**
 * User Model
 * Handles all database operations related to users (mysqli version).
 */

require_once __DIR__ . '/../config/database.php';

class User
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = getDBConnection();
    }

    /**
     * Register a new user.
     *
     * @param string $username
     * @param string $email
     * @param string $password  Plain-text password (will be hashed)
     * @return bool             True on success, false on duplicate
     */
    public function register(string $username, string $email, string $password): bool
    {
        // Check for existing username or email
        $stmt = mysqli_prepare(
            $this->db,
            'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1'
        );
        mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            mysqli_stmt_close($stmt);
            return false; // duplicate
        }
        mysqli_stmt_close($stmt);

        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = mysqli_prepare(
            $this->db,
            'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashed);
        $ok = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        return $ok;
    }

    /**
     * Authenticate a user by email and password.
     *
     * @param string $email
     * @param string $password  Plain-text password
     * @return array|null       User row on success, null on failure
     */
    public function login(string $email, string $password): ?array
    {
        $stmt = mysqli_prepare(
            $this->db,
            'SELECT id, username, email, password FROM users WHERE email = ? LIMIT 1'
        );
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user   = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // never keep hash in session
            return $user;
        }

        return null;
    }
}
