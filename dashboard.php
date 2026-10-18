<?php
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT o.*, p.title, p.price, p.image FROM orders o JOIN plans p ON o.plan_id = p.id WHERE o.user_id = ? ORDER BY o.created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();

$pageTitle = 'Client Portal & Blueprint Downloads';
$bodyClass = 'page-dashboard';

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <span>My Dashboard</span>
            </div>
            <h1>Welcome back, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Engineer') ?></h1>
            <p>Access your purchased network topology blueprints, CAD drawings, and licensed documentation.</p>
        </div>
    </section>

    <div class="container dashboard-wrap">
        <!-- Stats Widgets -->
        <div class="dashboard-stats-grid">
            <div class="dash-stat-card">
                <div class="dash-stat-icon">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div class="dash-stat-info">
                    <h4><?= count($orders) ?></h4>
                    <p>Licensed Network Topologies</p>
                </div>
            </div>

            <div class="dash-stat-card">
                <div class="dash-stat-icon" style="background: #dcfce7; color: #16a34a;">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="dash-stat-info">
                    <h4>Rs. <?= number_format(array_sum(array_column($orders, 'price')), 2) ?></h4>
                    <p>Total Investment</p>
                </div>
            </div>
        </div>

        <!-- Downloads Table Card -->
        <div class="dashboard-table-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
                <h3 class="table-header-title" style="margin: 0;">
                    <i class="fa-solid fa-cloud-arrow-down" style="color: var(--color-primary-light);"></i> My Purchased Blueprints
                </h3>
                <a href="gallery.php" class="btn btn-primary-nav" style="font-size: 13px; padding: 8px 16px;">
                    <i class="fa-solid fa-plus"></i> Browse More Plans
                </a>
            </div>

            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Blueprint & Specification</th>
                            <th>Purchase Date</th>
                            <th>License Status</th>
                            <th>Price Paid</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 14px;">
                                        <div style="width: 44px; height: 44px; border-radius: var(--radius-sm); background: #0f172a; overflow: hidden; display: flex; align-items: center; justify-content: center; color: white;">
                                            <i class="fa-solid fa-network-wired"></i>
                                        </div>
                                        <div>
                                            <strong style="color: var(--color-primary-dark); font-size: 15px;"><?= htmlspecialchars($order['title']) ?></strong>
                                            <div style="font-size: 12px; color: var(--text-muted);">Formats: Visio / Packet Tracer / PDF</div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                <td>
                                    <span class="badge-status badge-confirmed">
                                        <i class="fa-solid fa-check"></i> Licensed & Verified
                                    </span>
                                </td>
                                <td><strong>Rs. <?= number_format($order['price'], 2) ?></strong></td>
                                <td style="text-align: right;">
                                    <a href="download.php?order_id=<?= $order['id'] ?>" class="btn btn-card-action" style="padding: 6px 14px; font-size: 13px; background: #16a34a;">
                                        <i class="fa-solid fa-download"></i> Download Package (.ZIP/SPEC)
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                    <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                                    You have not purchased any network blueprint packages yet.
                                    <div style="margin-top: 14px;">
                                        <a href="gallery.php" class="btn btn-hero-primary" style="font-size: 14px; padding: 10px 20px;">
                                            Explore Blueprints Gallery
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>