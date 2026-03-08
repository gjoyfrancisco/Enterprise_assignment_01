<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<nav>
    <span class="brand">Student Info Management</span>
    <div class="nav-links">
        <span style="opacity:.85; font-size:.9rem;">
            Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
        </span>
        <a href="index.php?page=logout">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="card">

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <div class="table-actions">
            <h2>All Students</h2>
            <a href="index.php?page=students&action=create" class="btn btn-primary btn-sm">+ Add Student</a>
        </div>

        <?php if (empty($students)): ?>
            <p style="color:#888; font-size:.92rem;">No students found. Click <strong>+ Add Student</strong> to get started.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $index => $student): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['created_at']); ?></td>
                            <td>
                                <form action="index.php?page=students&action=delete" method="POST"
                                      onsubmit="return confirm('Delete this student?');">
                                    <input type="hidden" name="id" value="<?php echo (int) $student['id']; ?>" />
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
