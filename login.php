<?php
require 'includes/db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if ($user['role'] === 'blocked') {
            $error = "Your account has been suspended by the administrator. Please contact support.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: dashboard.php");
            exit();
        }
    } else {
        $error = "Invalid email or password combination.";
    }
}

$pageTitle = 'Sign In to Your NetPlans Account';
$bodyClass = 'page-login';

require 'includes/header.php';
?>

<main class="auth-page-wrapper">
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-icon-circle">
                <i class="fa-solid fa-user-lock"></i>
            </div>
            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Sign in to manage your purchased network blueprints</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-info"></i> <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-envelope form-icon"></i>
                    <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="form-control-wrap">
                    <i class="fa-solid fa-lock form-icon"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-submit-full">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Sign In to Account
            </button>
        </form>

        <div style="text-align: center; margin-top: 24px; padding-top: 18px; border-top: 1px solid var(--border-subtle); font-size: 14px; color: var(--text-muted);">
            Don't have an enterprise account? 
            <a href="register.php" style="font-weight: 700; color: var(--color-primary-light);">Create Account</a>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>