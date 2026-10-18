<?php
require 'includes/db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Passwords do not match! Please check again.";
    } else {
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $hashed]);
            $success = "Registration successful! Redirecting you to login...";
            header("Refresh: 2; url=login.php");
        } catch (PDOException $e) {
            $error = "An account with this email address already exists!";
        }
    }
}

$pageTitle = 'Create Your Enterprise NetPlans Account';
$bodyClass = 'page-register';

require 'includes/header.php';
?>

<main class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon-circle" style="background: #ecfdf5; color: #10b981;">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2 class="auth-title">Create an Account</h2>
            <p class="auth-subtitle">Join engineers accessing production-ready network blueprints</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-user form-icon"></i>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Kasun Fernando" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Corporate Email Address</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-envelope form-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="kasun@company.com" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-lock form-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="Minimum 6 characters" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-shield-halved form-icon"></i>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Re-type password" required>
                </div>
            </div>

            <button type="submit" class="btn-submit-full">
                <i class="fa-solid fa-user-check"></i> Register Account
            </button>
        </form>

        <div style="text-align: center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border-subtle); font-size: 14px; color: var(--text-muted);">
            Already have an account? 
            <a href="login.php" style="font-weight: 700; color: var(--color-primary-light);">Sign In Here</a>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>