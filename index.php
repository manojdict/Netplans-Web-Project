<?php
require 'includes/db.php';

$pageTitle = 'Enterprise Network Architecture & Blueprints';
$bodyClass = 'page-home';

$stmt = $pdo->query("SELECT * FROM plans WHERE is_active = 1 LIMIT 6");
$plans = $stmt->fetchAll();

require 'includes/header.php';
?>

<main>
    <!-- Enterprise Hero Section -->
    <section class="hero-enterprise">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-pill-badge">
                    <i class="fa-solid fa-sparkles"></i> High-Availability Network Topologies 2026/2027
                </div>
                <h1 class="hero-title">
                    Architect Your Infrastructure with <span class="gradient-text">Precision Blueprints</span>
                </h1>
                <p class="hero-lead">
                    Standard-compliant, editable network topology blueprints, rack diagrams, and enterprise security architectures. Download instantly or collaborate with certified network engineers.
                </p>
                <div class="hero-cta-group">
                    <a href="gallery.php" class="btn btn-hero-primary">
                        <i class="fa-solid fa-layer-group"></i> Explore Blueprints
                    </a>
                    <a href="customize.php" class="btn btn-hero-secondary">
                        <i class="fa-solid fa-sliders"></i> Request Custom Design
                    </a>
                </div>
                <div class="hero-specs-row">
                    <span class="spec-item"><i class="fa-solid fa-check"></i> 4K / Visio / Packet Tracer Ready</span>
                    <span class="spec-item"><i class="fa-solid fa-check"></i> Standard Compliant (IEEE / ISO)</span>
                    <span class="spec-item"><i class="fa-solid fa-check"></i> Instant Digital Delivery</span>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-visual-card">
                    <div class="hero-visual-header">
                        <div class="window-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span class="visual-badge">CORE-SPINE-LEAF-V4.NET</span>
                    </div>
                    <div class="hero-visual-body">
                        <img src="1767159733_1-basic-home-network-diagram.png" 
                             onerror="this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=1200&auto=format&fit=crop'" 
                             alt="Enterprise Network Topology Preview">
                    </div>
                    <div class="floating-stat-box">
                        <div class="stat-icon-wrap">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="stat-text">
                            <strong>Instant Deployment</strong>
                            <span>Tested architectures & IP schemes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Metrics & Trust Highlights Banner -->
    <section class="metrics-banner">
        <div class="container">
            <div class="metrics-grid">
                <div class="metric-item">
                    <div class="metric-icon">
                        <i class="fa-solid fa-network-wired"></i>
                    </div>
                    <div class="metric-details">
                        <div class="metric-value">500+</div>
                        <div class="metric-label">Verified Network Topologies</div>
                    </div>
                </div>
                <div class="metric-item">
                    <div class="metric-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="metric-details">
                        <div class="metric-value">99.9%</div>
                        <div class="metric-label">Zero-Trust Security Alignment</div>
                    </div>
                </div>
                <div class="metric-item">
                    <div class="metric-icon">
                        <i class="fa-solid fa-cloud-arrow-down"></i>
                    </div>
                    <div class="metric-details">
                        <div class="metric-value">Instant</div>
                        <div class="metric-label">Immediate Digital Access</div>
                    </div>
                </div>
                <div class="metric-item">
                    <div class="metric-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>
                    <div class="metric-details">
                        <div class="metric-value">24/7</div>
                        <div class="metric-label">Expert Engineering Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Packages Catalog -->
    <section class="catalog-section">
        <div class="container">
            <div class="section-header-wrap">
                <span class="section-pill-tag">
                    <i class="fa-solid fa-cubes"></i> Production-Ready Catalog
                </span>
                <h2 class="section-main-title">Featured Enterprise Network Packages</h2>
                <p class="section-sub-title">
                    Select from carefully engineered blueprints configured for scalability, redundancy, and modern protocol standards.
                </p>
            </div>

            <div class="plans-grid">
                <?php foreach ($plans as $plan): ?>
                <div class="blueprint-card">
                    <div class="card-media">
                        <img src="<?= htmlspecialchars($plan['image']) ?>" 
                             onerror="this.src='https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=800&auto=format&fit=crop'"
                             alt="<?= htmlspecialchars($plan['title']) ?>">
                        <span class="card-badge-format">
                            <i class="fa-regular fa-file-code"></i> PDF / Visio / PKT
                        </span>
                        <?php if (!empty($plan['category'])): ?>
                            <span class="card-category-badge"><?= htmlspecialchars($plan['category']) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h3 class="card-plan-title"><?= htmlspecialchars($plan['title']) ?></h3>
                        <ul class="card-features-list">
                            <li><i class="fa-solid fa-circle-check"></i> Layer 2 / Layer 3 Switching Architecture</li>
                            <li><i class="fa-solid fa-circle-check"></i> VLAN, Subnetting & IP Address Table</li>
                            <li><i class="fa-solid fa-circle-check"></i> Redundant Gateway & Firewall Placement</li>
                        </ul>
                        <div class="card-footer">
                            <div class="price-block">
                                <span class="price-currency">Blueprint Price</span>
                                <span class="price-amount">Rs. <?= number_format($plan['price'], 2) ?></span>
                            </div>
                            <a href="product-details.php?id=<?= $plan['id'] ?>" class="btn-card-action">
                                View Blueprint <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div style="text-align: center; margin-top: 50px;">
                <a href="gallery.php" class="btn btn-hero-primary" style="padding: 14px 36px;">
                    <i class="fa-solid fa-grid-2"></i> Browse Complete Blueprints Catalog (50+)
                </a>
            </div>
        </div>
    </section>

    <!-- 3-Step Process Workflow -->
    <section class="process-section">
        <div class="container">
            <div class="section-header-wrap">
                <span class="section-pill-tag">
                    <i class="fa-solid fa-route"></i> Streamlined Workflow
                </span>
                <h2 class="section-main-title">How NetPlans Delivers Infrastructure Clarity</h2>
                <p class="section-sub-title">From initial topology design to physical or cloud execution in three seamless stages.</p>
            </div>

            <div class="process-grid">
                <div class="process-card">
                    <div class="process-step-num">01</div>
                    <h3>Select Your Blueprint</h3>
                    <p>Browse our industry-focused library categorized for campuses, hospitals, data centers, hotels, and corporate offices.</p>
                </div>
                <div class="process-card">
                    <div class="process-step-num">02</div>
                    <h3>Instant Download or Customize</h3>
                    <p>Receive editable files immediately, or submit your specific hardware inventory and IP requirements for tailored adaptation.</p>
                </div>
                <div class="process-card">
                    <div class="process-step-num">03</div>
                    <h3>Deploy with Confidence</h3>
                    <p>Execute structured cabling, switch configuration, and firewall policies backed by certified network architecture standards.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require 'includes/footer.php'; ?>