<?php


declare(strict_types=1);

session_start();

// Auto-load controllers 
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/StudentController.php';


// Authentication

function requireAuth(): void
{
    if (empty($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }
}


// Redirect guests away from auth pages when already logged in

function redirectIfLoggedIn(): void
{
    if (!empty($_SESSION['user'])) {
        header('Location: index.php?page=students');
        exit;
    }
}


//  Routing

$page   = $_GET['page']   ?? 'login';
$action = $_GET['action'] ?? 'index';
$method = $_SERVER['REQUEST_METHOD'];

$authController    = new AuthController();
$studentController = new StudentController();

switch ($page) {

    // ---- Default / Home ----
    case '':
    case 'home':
        header('Location: index.php?page=login');
        exit;

    // ---- Register ----
    case 'register':
        redirectIfLoggedIn();
        if ($method === 'POST' && $action === 'submit') {
            $authController->register();
        } else {
            $authController->showRegister();
        }
        break;

    // ---- Login ----
    case 'login':
        redirectIfLoggedIn();
        if ($method === 'POST' && $action === 'submit') {
            $authController->login();
        } else {
            $authController->showLogin();
        }
        break;

    // ---- Logout ----
    case 'logout':
        $authController->logout();
        break;

    // ---- Students ----
    case 'students':
        requireAuth();

        if ($action === 'create') {
            if ($method === 'POST' && isset($_GET['submit'])) {
                $studentController->create();
            } else {
                $studentController->showCreate();
            }
        } elseif ($action === 'delete' && $method === 'POST') {
            $studentController->delete();
        } else {
            $studentController->index();
        }
        break;

    // ---- 404 ----
    default:
        http_response_code(404);
        echo '<h1>404 – Page Not Found</h1>';
        echo '<p><a href="index.php?page=login">Go to Login</a></p>';
        break;
}
