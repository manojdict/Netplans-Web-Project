<?php
require 'includes/db.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    header("Location: gallery.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM plans WHERE id = ?");
$stmt->execute([$id]);
$plan = $stmt->fetch();

if (!$plan) {
    die("Plan not found");
}

$pageTitle = htmlspecialchars($plan['title']) . ' - Network Architecture Specs';
$bodyClass = 'page-product-details';

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <a href="gallery.php">Gallery</a>
                <span>/</span>
                <span><?= htmlspecialchars($plan['title']) ?></span>
            </div>
            <h1><?= htmlspecialchars($plan['title']) ?></h1>
            <p>Verified Enterprise Blueprint • IEEE & Zero-Trust Architecture Compliant</p>
        </div>
    </section>

    <div class="container product-detail-wrap">
        <div class="product-detail-grid">
            <!-- Left: Interactive Preview Card -->
            <div class="product-preview-box">
                <div class="product-preview-media">
                    <img id="dynamicImage" 
                         src="<?= htmlspecialchars($plan['image']) ?>" 
                         onerror="this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=1200&auto=format&fit=crop'"
                         alt="<?= htmlspecialchars($plan['title']) ?>">
                </div>
                <div class="product-preview-bar">
                    <span><i class="fa-solid fa-magnifying-glass-plus"></i> High Resolution Topology Preview</span>
                    <span><i class="fa-solid fa-file-shield"></i> Verified Technical Diagram</span>
                </div>
            </div>

            <!-- Right: Details & Order Box -->
            <div class="product-info-panel">
                <span class="detail-category-pill">
                    <i class="fa-solid fa-layer-group"></i> <?= htmlspecialchars($plan['category'] ?? 'Enterprise Network') ?>
                </span>
                <h2 class="detail-title"><?= htmlspecialchars($plan['title']) ?></h2>

                <div class="detail-price-badge">
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-muted); text-transform: uppercase;">License Fee</span>
                    <span class="detail-price-amount">Rs. <?= number_format($plan['price'], 2) ?></span>
                </div>

                <div class="detail-desc-card">
                    <h4 style="font-size: 15px; font-weight: 700; color: var(--color-primary-dark); margin-bottom: 8px;">Architecture Summary</h4>
                    <p><?= nl2br(htmlspecialchars($plan['description'] ?? 'High quality standard-compliant enterprise network diagram designed for maximum throughput, redundancy, and scalable segmentation.')) ?></p>
                </div>

                <!-- Technical Specification Highlights -->
                <div class="spec-list-grid">
                    <div class="spec-box">
                        <i class="fa-solid fa-file-code"></i>
                        <div class="spec-box-content">
                            <strong>Deliverable Formats</strong>
                            <span>PDF, Visio (VSDX), Cisco PKT</span>
                        </div>
                    </div>
                    <div class="spec-box">
                        <i class="fa-solid fa-network-wired"></i>
                        <div class="spec-box-content">
                            <strong>IP Addressing Scheme</strong>
                            <span>CIDR & Subnet Allocation Table</span>
                        </div>
                    </div>
                    <div class="spec-box">
                        <i class="fa-solid fa-shield-halved"></i>
                        <div class="spec-box-content">
                            <strong>Security Design</strong>
                            <span>DMZ, Next-Gen FW & Access Control</span>
                        </div>
                    </div>
                    <div class="spec-box">
                        <i class="fa-solid fa-bolt"></i>
                        <div class="spec-box-content">
                            <strong>Delivery Speed</strong>
                            <span>Instant Digital Download</span>
                        </div>
                    </div>
                </div>

                <!-- Call to action buttons -->
                <div class="product-action-row">
                    <a href="checkout.php?plan_id=<?= $plan['id'] ?>" class="btn-buy-lg">
                        <i class="fa-solid fa-cart-shopping"></i> Purchase & Download
                    </a>
                    <a href="customize.php?plan_id=<?= $plan['id'] ?>" class="btn-customize-lg">
                        <i class="fa-solid fa-sliders"></i> Request Customization
                    </a>
                </div>

                <p style="font-size: 12px; color: var(--text-muted); margin-top: 14px; text-align: center;">
                    <i class="fa-solid fa-lock"></i> 256-Bit SSL Encrypted Checkout • 100% Satisfaction Guarantee
                </p>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>