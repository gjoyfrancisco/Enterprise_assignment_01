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
        <h2>Create Account</h2>

        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="index.php?page=register&action=submit" method="POST" novalidate>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                       placeholder="e.g. johndoe" required />
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                       placeholder="e.g. john@example.com" required />
            </div>

            <div class="form-group">
                <label for="password">Password <small style="font-weight:400;color:#888">(min. 6 characters)</small></label>
                <input type="password" id="password" name="password" placeholder="••••••••" required />
            </div>

            <div class="form-group">
                <label for="confirm">Confirm Password</label>
                <input type="password" id="confirm" name="confirm" placeholder="••••••••" required />
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Register</button>
        </form>

        <p class="auth-link">Already have an account? <a href="index.php?page=login">Login here</a></p>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
