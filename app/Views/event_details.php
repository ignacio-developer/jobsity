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
    <div class="container mt-4">
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
