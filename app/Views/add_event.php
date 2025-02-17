<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateForm(event) {
            event.preventDefault(); // Prevent form submission
            
            let title = document.getElementById('title').value.trim();
            let description = document.getElementById('description').value.trim();
            let startDate = document.getElementById('startDate').value;
            let endDate = document.getElementById('endDate').value;
            let errorMessage = '';
            
            if (!title || !description || !startDate || !endDate) {
                errorMessage = 'All fields are required.';
            } else if (new Date(startDate) >= new Date(endDate)) {
                errorMessage = 'Start date must be earlier than end date.';
            }
            
            if (errorMessage) {
                document.getElementById('error-message').innerText = errorMessage;
                document.getElementById('error-container').style.display = 'block';
            } else {
                document.getElementById('error-container').style.display = 'none';
                document.getElementById('eventForm').submit(); // Submit the form
            }
        }
    </script>
</head>
<body>
    <header class="bg-light py-3 mb-4 shadow-sm">
        <div class="container d-flex align-items-center">
            <img src="civicplus-logo.jpg" alt="CivicPlus Logo" height="50" class="me-3">
            <h2 class="mb-0">Ignacio Giampaoli - Coding Challenge</h2>
        </div>
    </header>
    
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-3">⬅ Back to Events</a>
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-primary">➕ Add New Event</h2>
                
                <div id="error-container" class="alert alert-danger" style="display: none;">
                    ❌ <span id="error-message"></span>
                </div>

                <?php if (!empty($success)): ?>
                    <div class="alert alert-success">✅ <?= htmlspecialchars($success) ?></div>
                <?php endif; ?>

                <form id="eventForm" method="POST" action="index.php?action=addEvent" onsubmit="validateForm(event)">
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="datetime-local" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="datetime-local" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-success">✅ Save Event</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
