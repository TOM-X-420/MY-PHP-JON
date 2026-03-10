<?php
$pageTitle = 'Contact Us — ' . APP_NAME;
require_once INCLUDES_PATH . '/header.php';
require_once CONFIG_PATH . '/db.php';

$success = isset($_GET['sent']) && $_GET['sent'] === '1';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === '') {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        try {
            $db   = getDB();
            $stmt = $db->prepare(
                'INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)'
            );
            $stmt->execute([':name' => $name, ':email' => $email, ':message' => $message]);
            // PRG pattern: redirect to avoid duplicate submission on refresh
            header('Location: ' . BASE_URL . '/contact?sent=1');
            exit;
        } catch (Exception $e) {
            error_log('Contact form DB error: ' . $e->getMessage());
            $error = 'Something went wrong. Please try again later.';
        }
    }
}
?>

<h2 class="section-title">Contact Us</h2>

<?php if ($success): ?>
    <div class="alert alert-success">Your message has been sent! We will get back to you soon.</div>
<?php endif; ?>
<?php if ($error !== ''): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post" action="<?= BASE_URL ?>/contact" style="max-width:560px">
    <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" required
               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required
               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea id="message" name="message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn">Send Message</button>
</form>

<?php require_once INCLUDES_PATH . '/footer.php'; ?>
