<?php include_once '../bootstrap/app.php'; ?>
<?php include_once './events.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Google Calendar Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-3">
            <?php if (isset($_SESSION['access_token'])): ?>
                <h3>Connected to Google Calendar</h3>
                <p>You are connected to Google Calendar. You can now add events to your Google Calendar and view
                    existing events from it. Click the logout button below to disconnect from Google Calendar.</p>
                <div class="mt-1 mb-3">
                    <a href="/logout.php" class="btn btn-danger">Logout</a>
                </div>
            <?php else: ?>
                <h3>Connect to Google Calendar</h3>
                <p>To begin, allow access to your Google Calendar account. Once authenticated, you'll be able to add
                    events to your Google Calendar and view existing events from it.</p>
                <div class="mt-1 mb-3">
                    <a href="/login.php" class="btn btn-primary">Login with Google</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Add Event</h2>
            <form action="/add-event.php" method="post">
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <input type="text" class="form-control" id="summary" name="summary" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <?php if (isset($_SESSION['access_token'])): ?>
                    <button type="submit" class="btn btn-primary">Add Event</button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary" disabled>Add Event</button>
                <?php endif; ?>
            </form>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= $_SESSION['success'] ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row mt-5 mb-5">
        <div class="col-md-12">
            <h2>Events</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Summary</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><a href="<?= $event->htmlLink ?>" target="_blank" referrerpolicy="no-referrer"><?= $event->summary ?></a></td>
                            <td><?= $event->location ?></td>
                            <td><?= $event->description ?></td>
                            <td><?= $event->start->dateTime ?></td>
                            <td><?= $event->end->dateTime ?></td>
                            <td class="text-center">
                                <form action="/delete-event.php" method="post">
                                    <input type="hidden" name="id" value="<?= $event->id ?>">
                                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No events found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
