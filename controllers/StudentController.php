<?php
/**
 * StudentController
 * Handles listing, creating, and deleting students.
 */

require_once __DIR__ . '/../models/Student.php';

class StudentController
{
    private Student $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
    }

    // ------------------------------------------------------------------ //
    //  List
    // ------------------------------------------------------------------ //

    /** Show all students */
    public function index(): void
    {
        $students = $this->studentModel->getAll();
        $error    = $_SESSION['error']   ?? null;
        $success  = $_SESSION['success'] ?? null;
        unset($_SESSION['error'], $_SESSION['success']);

        require_once __DIR__ . '/../views/students/index.php';
    }

    // ------------------------------------------------------------------ //
    //  Create
    // ------------------------------------------------------------------ //

    /** Show create-student form */
    public function showCreate(): void
    {
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        require_once __DIR__ . '/../views/students/create.php';
    }

    /** Process create-student form submission */
    public function create(): void
    {
        $name      = trim($_POST['name']       ?? '');
        $studentId = trim($_POST['student_id'] ?? '');
        $email     = trim($_POST['email']      ?? '');

        if (empty($name) || empty($studentId) || empty($email)) {
            $_SESSION['error'] = 'All fields are required.';
            header('Location: index.php?page=students&action=create');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email address.';
            header('Location: index.php?page=students&action=create');
            exit;
        }

        $result = $this->studentModel->create($name, $studentId, $email);

        if ($result) {
            $_SESSION['success'] = 'Student added successfully.';
            header('Location: index.php?page=students');
        } else {
            $_SESSION['error'] = 'Student ID or email already exists.';
            header('Location: index.php?page=students&action=create');
        }
        exit;
    }

    // ------------------------------------------------------------------ //
    //  Delete
    // ------------------------------------------------------------------ //

    /** Process delete request */
    public function delete(): void
    {
        $id = (int) ($_POST['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'Invalid student ID.';
            header('Location: index.php?page=students');
            exit;
        }

        $result = $this->studentModel->delete($id);

        if ($result) {
            $_SESSION['success'] = 'Student deleted successfully.';
        } else {
            $_SESSION['error'] = 'Student not found.';
        }

        header('Location: index.php?page=students');
        exit;
    }
}
