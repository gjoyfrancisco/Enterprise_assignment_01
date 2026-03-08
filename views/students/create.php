<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<nav>
    <span class="brand">Student Info Management</span>
    <div class="nav-links">
        <span style="opacity:.85; font-size:.9rem;">
            Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
        </span>
        <a href="index.php?page=students">Students</a>
        <a href="index.php?page=logout">Logout</a>
    </div>
</nav>

<div class="container">
    <div class="card" style="max-width:520px; margin:0 auto;">
        <h2>Add New Student</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?page=students&action=create&submit=1" method="POST" novalidate>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name"
                       value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                       placeholder="Albus Dumbledore" required />
            </div>

            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id"
                       value="<?php echo htmlspecialchars($_POST['student_id'] ?? ''); ?>"
                       placeholder="e.g. S1234567" required />
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                       placeholder="a.dumbledore@example.com" required />
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn btn-primary">Save Student</button>
                <a href="index.php?page=students" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
