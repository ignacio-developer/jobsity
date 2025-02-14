<?php
if (!$event) {
    die("Event not found");
}

$start = new DateTime($event->startDate);
$end = new DateTime($event->endDate);
$now = new DateTime();
$status = ($now < $start) ? "Upcoming" : (($now > $end) ? "Past" : "Ongoing");
$statusClass = ($status === "Upcoming") ? "info" : (($status === "Ongoing") ? "warning" : "secondary");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($event->title) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-light py-3 mb-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <img src="civicplus-logo.jpg" alt="CivicPlus Logo" height="50" class="me-3">
            <h2 class="mb-0">Ignacio Giampaoli - Coding Challenge</h2>
        </div>
    </header>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">⬅ Back to Events</a>
        <div class="card shadow-sm">
            <div class="card-header bg-<?= $statusClass ?> text-white">
                <?= htmlspecialchars($status) ?>
            </div>
            <div class="card-body">
                <h2 class="card-title text-primary">📌 <?= htmlspecialchars($event->title) ?></h2>
                <p class="card-text text-muted">📝 <?= htmlspecialchars($event->description) ?></p>
                <p><strong>🗓 Start:</strong> <?= $start->format('D, M j, Y H:i') ?></p>
                <p><strong>🚀 End:</strong> <?= $end->format('D, M j, Y H:i') ?></p>
            </div>
        </div>
    </div>
</body>
</html>
