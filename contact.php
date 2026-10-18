<?php
require 'includes/db.php';

$success = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $subject, $message]);

    $success = "Thank you! Your message has been received by our engineering team. We will respond shortly.";
}

$pageTitle = 'Contact & Technical Consultation';
$bodyClass = 'page-contact';

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <span>Contact Us</span>
            </div>
            <h1>Get in Touch with our Network Engineers</h1>
            <p>Inquire about enterprise licenses, custom topology design, or get technical clarification.</p>
        </div>
    </section>

    <div class="container">
        <div class="contact-layout-grid">
            <!-- Left Info Panel -->
            <div class="contact-info-card">
                <h3 style="font-size: 22px; font-weight: 800; margin-bottom: 8px;">Direct Support Channels</h3>
                <p style="font-size: 14px; color: #cbd5e1; margin-bottom: 30px; line-height: 1.6;">
                    Our technical lead and network architects respond within 24 hours on all business days.
                </p>

                <div class="contact-info-item">
                    <div class="contact-icon-pill">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 14px; font-weight: 700; color: #ffffff; margin-bottom: 2px;">Headquarters</h4>
                        <p style="font-size: 13.5px; color: #94a3b8;">Colombo, Western Province, Sri Lanka</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon-pill">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 14px; font-weight: 700; color: #ffffff; margin-bottom: 2px;">Email Inquiries</h4>
                        <p style="font-size: 13.5px; color: #94a3b8;">manojchathurangaict5@gmail.com</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon-pill">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 14px; font-weight: 700; color: #ffffff; margin-bottom: 2px;">Hotline</h4>
                        <p style="font-size: 13.5px; color: #94a3b8;">+94 77 185 1680</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-icon-pill" style="color: #22c55e;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 style="font-size: 14px; font-weight: 700; color: #ffffff; margin-bottom: 2px;">WhatsApp Direct</h4>
                        <a href="https://wa.me/94771851680" target="_blank" style="font-size: 13.5px; color: #38bdf8;">Chat on WhatsApp →</a>
                    </div>
                </div>
            </div>

            <!-- Right Form Box -->
            <div class="checkout-box" style="padding: 36px;">
                <h3 style="margin-bottom: 20px;">
                    <i class="fa-solid fa-paper-plane" style="color: var(--color-primary-light);"></i> Send a Consultation Message
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
                            <input type="text" name="name" class="form-control" placeholder="e.g. Samantha Perera" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Corporate Email Address *</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-envelope form-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="samantha@company.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject / Topology Topic</label>
                        <div class="form-control-wrap">
                            <i class="fa-solid fa-tag form-icon"></i>
                            <input type="text" name="subject" class="form-control" placeholder="e.g. Enterprise Office Core/Spine Inquiry">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Project Details / Message *</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Describe your network requirements, user counts, or questions..." required></textarea>
                    </div>

                    <button type="submit" class="btn-submit-full">
                        <i class="fa-solid fa-paper-plane"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require 'includes/footer.php'; ?>