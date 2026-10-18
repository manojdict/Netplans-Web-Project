<?php
require 'includes/db.php';

$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $changes = trim($_POST['changes']);

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, 'Customization Request', ?)");
    $stmt->execute([$name, $email, $changes]);

    $success = "Request Received! Our senior network architect will review your specifications and email you a tailored proposal and quotation.";
}

$pageTitle = 'Request Custom Topology Architecture';
$bodyClass = 'page-customize';

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
                <span>Customization Request</span>
            </div>
            <h1>Bespoke Network Blueprint Engineering</h1>
            <p>Tailored topologies for your specific server equipment, building layouts, and security policies.</p>
        </div>
    </section>

    <div class="container" style="padding: 60px 20px;">
        <div class="checkout-grid" style="max-width: 1000px; margin: 0 auto;">
            <!-- Left: Request Form -->
            <div class="checkout-box">
                <h3 style="margin-bottom: 22px;">
                    <i class="fa-solid fa-sliders" style="color: var(--color-primary-light);"></i> Custom Topology Consultation Form
                </h3>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i> <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-user form-icon"></i>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Ruwan Silva" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-envelope form-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="ruwan@enterprise.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Customization Specifications & Project Scope *</label>
                        <textarea name="changes" class="form-control" rows="6" placeholder="Specify your desired changes (e.g. Add 2 FortiGate firewalls in HA mode, 4 building distribution switches, Cisco Nexus core, 500 endpoint subnets, VoIP VLAN isolation...)" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-full">
                        <i class="fa-solid fa-paper-plane"></i> Submit Architecture Request
                    </button>
                    <p style="font-size: 13px; color: var(--text-muted); text-align: center; margin-top: 14px;">
                        <i class="fa-solid fa-clock"></i> We evaluate your scope and send a milestone schedule & quotation within 24 hours.
                    </p>
                </form>
            </div>

            <!-- Right: Consultation Process Info -->
            <div class="contact-info-card" style="align-self: flex-start;">
                <h3 style="font-size: 20px; font-weight: 800; margin-bottom: 12px;">What We Provide</h3>
                <ul class="card-features-list" style="margin-bottom: 24px;">
                    <li style="color: #cbd5e1;"><i class="fa-solid fa-check" style="color: #38bdf8;"></i> Precise BOM (Bill of Materials) list</li>
                    <li style="color: #cbd5e1;"><i class="fa-solid fa-check" style="color: #38bdf8;"></i> Subnetting & IP allocation workbook</li>
                    <li style="color: #cbd5e1;"><i class="fa-solid fa-check" style="color: #38bdf8;"></i> High-availability failover architecture</li>
                    <li style="color: #cbd5e1;"><i class="fa-solid fa-check" style="color: #38bdf8;"></i> Packet Tracer & Visio editable source</li>
                </ul>

                <div style="padding-top: 18px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    <h4 style="font-size: 14px; font-weight: 700; color: #ffffff; margin-bottom: 6px;">Need urgent advice?</h4>
                    <p style="font-size: 13px; color: #94a3b8; margin-bottom: 14px;">Reach our network architect immediately via WhatsApp:</p>
                    <a href="https://wa.me/94771851680" target="_blank" class="btn btn-hero-secondary" style="width: 100%; justify-content: center;">
                        <i class="fa-brands fa-whatsapp" style="color: #22c55e;"></i> WhatsApp Direct Chat
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>