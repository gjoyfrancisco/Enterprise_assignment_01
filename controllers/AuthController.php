<?php
/**
 * AuthController
 * Handles user registration and login/logout.
 */

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // ------------------------------------------------------------------ //
    //  Register
    // ------------------------------------------------------------------ //

    /** Show registration form */
    public function showRegister(): void
    {
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);

        require_once __DIR__ . '/../views/auth/register.php';
    }

    /** Process registration form submission */
    public function register(): void
    {
        $username = trim($_POST['username'] ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';
        $confirm  = $_POST['confirm']       ?? '';

        // Validation
        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: index.php?page=register');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email address.';
            header('Location: index.php?page=register');
            exit;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters.';
            header('Location: index.php?page=register');
            exit;
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            header('Location: index.php?page=register');
            exit;
        }

        $result = $this->userModel->register($username, $email, $password);

        if ($result) {
            $_SESSION['success'] = 'Account created! You can now log in.';
            header('Location: index.php?page=login');
        } else {
            $_SESSION['error'] = 'Username or email already in use.';
            header('Location: index.php?page=register');
        }
        exit;
    }

    // ------------------------------------------------------------------ //
    //  Login / Logout
    // ------------------------------------------------------------------ //

    /** Show login form */
    public function showLogin(): void
    {
        $error   = $_SESSION['error']   ?? null;
        $success = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);

        require_once __DIR__ . '/../views/auth/login.php';
    }

    /** Process login form submission */
    public function login(): void
    {
        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email and password are required.';
            header('Location: index.php?page=login');
            exit;
        }

        $user = $this->userModel->login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php?page=students');
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
            header('Location: index.php?page=login');
        }
        exit;
    }

    /** Logout the current user */
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
