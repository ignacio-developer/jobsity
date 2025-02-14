<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>
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
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-primary">📅 Events Calendar</h2>
            <a href="index.php?action=addEvent" class="btn btn-success">➕ Add Event</a>
        </div>

        <?php if (!empty($events)): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($events as $event): ?>
                    <?php
                        $start = new DateTime($event->startDate);
                        $end = new DateTime($event->endDate);
                        $now = new DateTime();
                        $status = ($now < $start) ? "Upcoming" : (($now > $end) ? "Past" : "Ongoing");
                        $statusClass = ($status === "Upcoming") ? "info" : (($status === "Ongoing") ? "warning" : "secondary");
                    ?>
                    <div class="col">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-<?= $statusClass ?> text-white">
                                <?= htmlspecialchars($status) ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event->title) ?></h5>
                                <p class="card-text text-muted"><?= htmlspecialchars($event->description) ?></p>
                                <a href="index.php?action=viewEvent&id=<?= $event->id ?>" class="btn btn-primary">📌 View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">⚠ No events available.</div>
        <?php endif; ?>
    </div>
</body>
</html>
