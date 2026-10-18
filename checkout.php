<?php
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?msg=Please login to checkout");
    exit();
}

$plan_id = $_GET['plan_id'] ?? 0;
if ($plan_id == 0) {
    header("Location: gallery.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
$stmt->execute([$plan_id]);
$plan = $stmt->fetch();

if (!$plan) {
    die("Plan not found");
}

$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $total_price = $plan['price'];

    $stmt = $pdo->prepare("INSERT INTO orders (user_id, plan_id, total_price, status) VALUES (?, ?, ?, 'confirmed')");
    $stmt->execute([$user_id, $plan_id, $total_price]);

    $success = "Payment Verified! Your digital blueprint license has been unlocked. Redirecting to your dashboard...";
    header("Refresh: 2; url=dashboard.php");
}

$pageTitle = 'Secure Checkout - ' . htmlspecialchars($plan['title']);
$bodyClass = 'page-checkout';

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <a href="product-details.php?id=<?= $plan['id'] ?>"><?= htmlspecialchars($plan['title']) ?></a>
                <span>/</span>
                <span>Checkout</span>
            </div>
            <h1>Secure Enterprise Checkout</h1>
            <p><i class="fa-solid fa-lock"></i> 256-Bit SSL Encrypted Transaction • Instant Blueprint License</p>
        </div>
    </section>

    <div class="container checkout-section">
        <div class="checkout-grid">
            <!-- Left: Billing & Payment Information -->
            <div class="checkout-box">
                <h3><i class="fa-solid fa-credit-card" style="color: var(--color-primary-light);"></i> Billing & Payment Details</h3>

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
                            <input type="text" class="form-control" value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address (Deliverable Target)</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-envelope form-icon"></i>
                            <input type="email" class="form-control" value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <h4 style="font-size: 15px; font-weight: 700; color: var(--color-primary-dark); margin: 24px 0 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle);">
                        Payment Card Information
                    </h4>

                    <div class="form-group">
                        <label class="form-label">Card Number</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-credit-card form-icon"></i>
                            <input type="text" class="form-control" placeholder="4532 •••• •••• 8892" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div class="form-group">
                            <label class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" placeholder="MM / YY" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Security CVC / CVV</label>
                            <input type="text" class="form-control" placeholder="CVC" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit-full" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);">
                        <i class="fa-solid fa-lock"></i> Authorize & Complete Order (Rs. <?= number_format($plan['price'], 2) ?>)
                    </button>
                </form>
            </div>

            <!-- Right: Order Summary Card -->
            <div class="checkout-box" style="align-self: flex-start;">
                <h3><i class="fa-solid fa-receipt" style="color: var(--color-primary-light);"></i> Order Summary</h3>

                <div class="order-summary-item">
                    <img src="<?= htmlspecialchars($plan['image']) ?>" 
                         onerror="this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=400&auto=format&fit=crop'"
                         alt="<?= htmlspecialchars($plan['title']) ?>" 
                         class="order-thumb">
                    <div class="order-meta">
                        <h4><?= htmlspecialchars($plan['title']) ?></h4>
                        <p><i class="fa-solid fa-check"></i> Standard License + Vector Files</p>
                    </div>
                </div>

                <div class="order-totals-row">
                    <span>Blueprint License</span>
                    <strong>Rs. <?= number_format($plan['price'], 2) ?></strong>
                </div>
                <div class="order-totals-row">
                    <span>Tax & Processing Fee</span>
                    <span>Rs. 0.00</span>
                </div>
                <div class="order-totals-row grand-total">
                    <span>Total Due</span>
                    <span>Rs. <?= number_format($plan['price'], 2) ?></span>
                </div>

                <div style="margin-top: 24px; padding: 16px; background: #f8fafc; border-radius: var(--radius-md); font-size: 13px; color: var(--text-muted); display: flex; flex-direction: column; gap: 8px;">
                    <div><i class="fa-solid fa-shield-halved" style="color: #10b981;"></i> 30-Day Money-Back Guarantee</div>
                    <div><i class="fa-solid fa-bolt" style="color: #2563eb;"></i> Instant File Access inside User Dashboard</div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>