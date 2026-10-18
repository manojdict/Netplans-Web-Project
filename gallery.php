<?php
require 'includes/db.php';

$pageTitle = 'Network Blueprints & Architecture Gallery';
$bodyClass = 'page-gallery';

// Define categories
$categories = [
    'Hospital' => ['title' => 'Hospital & Healthcare Networks', 'icon' => 'fa-hospital'],
    'School' => ['title' => 'Campus & Educational Institutions', 'icon' => 'fa-graduation-cap'],
    'Hotel' => ['title' => 'Hotel & Hospitality Infrastructures', 'icon' => 'fa-hotel'],
    'Enterprise' => ['title' => 'Enterprise & Corporate Offices', 'icon' => 'fa-building'],
    'Home Lab' => ['title' => 'Home Lab & Data Center Topologies', 'icon' => 'fa-server']
];

$plans_by_category = [];

foreach ($categories as $key => $info) {
    $stmt = $pdo->prepare("SELECT * FROM plans WHERE category = ? AND is_active = 1 ORDER BY created_at DESC");
    $stmt->execute([$key]);
    $plans_by_category[$key] = $stmt->fetchAll();
}

require 'includes/header.php';
?>

<main>
    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container page-banner-content">
            <div class="breadcrumb-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <span>/</span>
                <span>Blueprints Gallery</span>
            </div>
            <h1>Professional Network Plans Gallery</h1>
            <p>Browse our industry-standard topology diagrams, structured cabling layouts, and high-availability network designs.</p>
        </div>
    </section>

    <div class="container" style="padding-top: 30px; padding-bottom: 70px;">
        <!-- Live Search Input -->
        <div style="margin-bottom: 24px; max-width: 600px;">
            <div class="form-control-wrap" style="box-shadow: var(--shadow-sm); border-radius: var(--radius-md);">
                <i class="fa-solid fa-magnifying-glass form-icon" style="color: var(--color-primary-light);"></i>
                <input type="text" id="blueprintSearchInput" class="form-control" placeholder="Search blueprints by name or keyword (e.g. Hospital, Cisco, Core, VLAN)..." onkeyup="filterBlueprints()" style="padding: 14px 14px 14px 44px; font-size: 15px; border-radius: var(--radius-md);">
            </div>
        </div>

        <!-- Category Fast-Filter Tabs -->
        <div class="gallery-filter-bar">
            <a href="#all" class="filter-tab active" onclick="showAllCategories(event)"><i class="fa-solid fa-border-all"></i> All Categories</a>
            <?php foreach ($categories as $cat_key => $cat_data): ?>
                <?php if (!empty($plans_by_category[$cat_key])): ?>
                    <a href="#cat-<?= htmlspecialchars($cat_key) ?>" class="filter-tab">
                        <i class="fa-solid <?= $cat_data['icon'] ?>"></i> <?= htmlspecialchars($cat_key) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Categorized Plans Showcase -->
        <?php foreach ($categories as $cat_key => $cat_data): ?>
            <?php if (!empty($plans_by_category[$cat_key])): ?>
            <section id="cat-<?= htmlspecialchars($cat_key) ?>" style="margin-bottom: 60px; scroll-margin-top: 100px;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid var(--border-subtle);">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 38px; height: 38px; border-radius: var(--radius-md); background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                            <i class="fa-solid <?= $cat_data['icon'] ?>"></i>
                        </div>
                        <h2 style="font-size: 22px; font-weight: 800; color: var(--color-primary-dark); margin: 0;">
                            <?= htmlspecialchars($cat_data['title']) ?>
                        </h2>
                    </div>
                    <span style="font-size: 13px; font-weight: 600; color: var(--text-muted); background: #f1f5f9; padding: 4px 12px; border-radius: var(--radius-full);">
                        <?= count($plans_by_category[$cat_key]) ?> Blueprints
                    </span>
                </div>

                <div class="plans-grid">
                    <?php foreach ($plans_by_category[$cat_key] as $plan): ?>
                    <div class="blueprint-card">
                        <div class="card-media">
                            <img src="<?= htmlspecialchars($plan['image']) ?>" 
                                 onerror="this.src='https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=800&auto=format&fit=crop'"
                                 alt="<?= htmlspecialchars($plan['title']) ?>">
                            <span class="card-badge-format">
                                <i class="fa-regular fa-file-code"></i> PDF / Visio / PKT
                            </span>
                            <span class="card-category-badge"><?= htmlspecialchars($cat_key) ?></span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-plan-title"><?= htmlspecialchars($plan['title']) ?></h3>
                            <ul class="card-features-list">
                                <li><i class="fa-solid fa-circle-check"></i> Standard-Compliant Topology</li>
                                <li><i class="fa-solid fa-circle-check"></i> Complete Hardware BOM & IP Scheme</li>
                                <li><i class="fa-solid fa-circle-check"></i> High Resolution Vector Export</li>
                            </ul>
                            <div class="card-footer">
                                <div class="price-block">
                                    <span class="price-currency">Blueprint Price</span>
                                    <span class="price-amount">Rs. <?= number_format($plan['price'], 2) ?></span>
                                </div>
                                <a href="product-details.php?id=<?= $plan['id'] ?>" class="btn-card-action">
                                    View Details <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</main>

<script>
function filterBlueprints() {
    const query = document.getElementById('blueprintSearchInput').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.blueprint-card');
    const sections = document.querySelectorAll('section[id^="cat-"]');

    cards.forEach(card => {
        const title = card.querySelector('.card-plan-title')?.textContent.toLowerCase() || '';
        const category = card.querySelector('.card-category-badge')?.textContent.toLowerCase() || '';
        if (title.includes(query) || category.includes(query)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });

    // Hide empty sections during search
    sections.forEach(section => {
        const visibleCards = section.querySelectorAll('.blueprint-card:not([style*="display: none"])');
        section.style.display = visibleCards.length > 0 ? 'block' : 'none';
    });
}

function showAllCategories(e) {
    e.preventDefault();
    document.getElementById('blueprintSearchInput').value = '';
    filterBlueprints();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>

<?php require 'includes/footer.php'; ?>