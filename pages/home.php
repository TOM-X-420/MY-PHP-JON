<?php
$pageTitle = 'Home — ' . APP_NAME;
require_once INCLUDES_PATH . '/header.php';
require_once CONFIG_PATH . '/db.php';

// Fetch latest available properties (up to 6)
$properties = [];
try {
    $db   = getDB();
    $stmt = $db->prepare('SELECT * FROM properties WHERE status = :status ORDER BY created_at DESC LIMIT 6');
    $stmt->execute([':status' => 'available']);
    $properties = $stmt->fetchAll();
} catch (Exception $e) {
    error_log('Home page DB error: ' . $e->getMessage());
}
?>

<section class="hero">
    <h1>Find Your Perfect Rental</h1>
    <p>Browse our selection of quality rental properties across Bangladesh.</p>
    <a href="<?= BASE_URL ?>/listings" class="btn" style="margin-top:1.2rem">View All Listings</a>
</section>

<h2 class="section-title">Featured Properties</h2>

<?php if (empty($properties)): ?>
    <p>No properties available right now. Please check back soon.</p>
<?php else: ?>
<div class="cards-grid">
    <?php foreach ($properties as $p): ?>
    <div class="card">
        <div class="card-img">No Image</div>
        <div class="card-body">
            <h3><?= htmlspecialchars($p['title']) ?></h3>
            <p class="price">৳<?= number_format((float)$p['price'], 2) ?> / month</p>
            <p class="meta">
                📍 <?= htmlspecialchars($p['location'] ?? '') ?> &nbsp;|&nbsp;
                🛏 <?= (int)$p['bedrooms'] ?> bed
            </p>
            <span class="badge badge-<?= htmlspecialchars($p['status']) ?>">
                <?= htmlspecialchars($p['status']) ?>
            </span>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
