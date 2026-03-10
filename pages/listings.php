<?php
$pageTitle = 'All Listings — ' . APP_NAME;
require_once INCLUDES_PATH . '/header.php';
require_once CONFIG_PATH . '/db.php';

// Filter by status if requested
$allowed = ['available', 'rented', 'maintenance'];
$filter  = isset($_GET['status']) && in_array($_GET['status'], $allowed, true)
           ? $_GET['status'] : null;

$properties = [];
try {
    $db = getDB();
    if ($filter !== null) {
        $stmt = $db->prepare('SELECT * FROM properties WHERE status = :status ORDER BY created_at DESC');
        $stmt->execute([':status' => $filter]);
    } else {
        $stmt = $db->query('SELECT * FROM properties ORDER BY created_at DESC');
    }
    $properties = $stmt->fetchAll();
} catch (Exception $e) {
    error_log('Listings page DB error: ' . $e->getMessage());
}
?>

<h2 class="section-title">All Rental Properties</h2>

<form method="get" action="<?= BASE_URL ?>/listings" style="margin-bottom:1.2rem">
    <label for="status" style="margin-right:.4rem;font-weight:600">Filter by status:</label>
    <select name="status" id="status" onchange="this.form.submit()" style="padding:.4rem .8rem;border-radius:6px;border:1px solid #c4cdd6">
        <option value="">All</option>
        <?php foreach (['available','rented','maintenance'] as $s): ?>
        <option value="<?= $s ?>" <?= $filter === $s ? 'selected' : '' ?>>
            <?= ucfirst($s) ?>
        </option>
        <?php endforeach; ?>
    </select>
</form>

<?php if (empty($properties)): ?>
    <p>No properties found.</p>
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
            <p style="margin-top:.5rem;font-size:.9rem;color:#555">
                <?php
                $desc   = $p['description'] ?? '';
                $trimFn = function_exists('mb_substr') ? 'mb_substr' : 'substr';
                $lenFn  = function_exists('mb_strlen') ? 'mb_strlen' : 'strlen';
                echo htmlspecialchars($trimFn($desc, 0, 100));
                echo $lenFn($desc) > 100 ? '…' : '';
                ?>
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
