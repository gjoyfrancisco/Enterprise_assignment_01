<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<nav>
    <span class="brand">Student Info Management</span>
    <div class="nav-links">
        <a href="index.php?page=login">Login</a>
        <a href="index.php?page=register">Register</a>
    </div>
</nav>

<div class="container">
    <div class="card" style="max-width:440px; margin:0 auto;">
        <h2>Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form action="index.php?page=login&action=submit" method="POST" novalidate>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                       placeholder="m.weasley@example.com" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required />
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Login</button>
        </form>

        <p class="auth-link">Don't have an account? <a href="index.php?page=register">Register here</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
