<?php
require 'includes/db.php';

$pageTitle = 'About Us - Engineering Enterprise Network Solutions';
$bodyClass = 'page-about';

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <span>About NetPlans</span>
            </div>
            <h1>Engineered for Enterprise Network Precision</h1>
            <p>Empowering network architects, system engineers, and businesses with production-grade topology blueprints.</p>
        </div>
    </section>

    <div class="container">
        <!-- Story / Mission Section -->
        <section class="about-hero-grid">
            <div class="about-text-content">
                <span class="section-pill-tag">
                    <i class="fa-solid fa-compass"></i> Our Mission
                </span>
                <h2 class="section-main-title" style="text-align: left;">Bridging Complexity & Infrastructure Clarity</h2>
                <p style="font-size: 16px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 18px;">
                    NetPlans was created to address a critical pain point in enterprise IT: undocumented networks and poorly designed topologies that cause costly downtime, routing loops, and security vulnerabilities.
                </p>
                <p style="font-size: 15px; color: var(--text-secondary); line-height: 1.7; margin-bottom: 24px;">
                    Whether you are orchestrating a multi-building university campus, a high-redundancy healthcare data network, or an office LAN with redundant ISP links, our blueprints provide the exact hardware placements, subnet allocations, and security boundaries required for seamless execution.
                </p>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 18px;"></i>
                        <span style="font-weight: 700; font-size: 14px; color: var(--color-primary-dark);">Cisco & Mikrotik Certified</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check" style="color: #10b981; font-size: 18px;"></i>
                        <span style="font-weight: 700; font-size: 14px; color: var(--color-primary-dark);">Zero-Trust Frameworks</span>
                    </div>
                </div>
            </div>

            <div class="about-img-frame">
                <img src="images/network.jpg" 
                     onerror="this.src='https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=1200&auto=format&fit=crop'" 
                     alt="NetPlans Architecture Lab">
            </div>
        </section>

        <!-- Value Proposition Deck -->
        <div class="section-header-wrap" style="margin-bottom: 40px;">
            <span class="section-pill-tag"><i class="fa-solid fa-star"></i> Our Principles</span>
            <h2 class="section-main-title">Why Industry Leaders Rely on NetPlans</h2>
            <p class="section-sub-title">Every diagram is drafted and verified following strict international IT engineering standards.</p>
        </div>

        <section class="features-deck-grid">
            <div class="feature-deck-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-chart-diagram"></i>
                </div>
                <h4>High Precision Diagrams</h4>
                <p>Vector-clean diagrams engineered with exact port designations, trunk allocations, and layer definitions.</p>
            </div>

            <div class="feature-deck-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h4>Instant Deliverables</h4>
                <p>Get instant access to downloadable Visio, Packet Tracer (.pkt), and 4K vector PDF blueprints the moment you check out.</p>
            </div>

            <div class="feature-deck-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h4>24/7 Architect Support</h4>
                <p>Our network team is available around the clock to assist you with customization, routing tables, and BOM inquiries.</p>
            </div>

            <div class="feature-deck-card">
                <div class="feature-icon-box">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4>Enterprise Compliance</h4>
                <p>Built according to ISO/IEC 27001 security standards, IEEE 802.1Q VLAN specifications, and modern redundancy protocols.</p>
            </div>
        </section>
    </div>
</main>

<?php require 'includes/footer.php'; ?>