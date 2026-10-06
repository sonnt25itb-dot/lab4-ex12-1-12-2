\
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 12-2 - Task List Manager</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="container">
    <h1>Task List Manager</h1>

    <div class="session-info">
        <strong>Session ID:</strong>
        <?= htmlspecialchars(session_id()) ?>
        <br>
        <span>Tasks are stored in <code>$_SESSION['tasks']</code>.</span>
    </div>

    <h2>Tasks</h2>

    <?php if (empty($tasks)): ?>
        <p>No tasks.</p>
    <?php else: ?>
        <ol class="task-list">
            <?php foreach ($tasks as $index => $task): ?>
                <li>
                    <span><?= htmlspecialchars($task) ?></span>

                    <form method="post">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="task_index" value="<?= (int)$index ?>">
                        <button type="submit" class="danger">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

    <h2>Add Task</h2>

    <form method="post" class="add-form">
        <input type="hidden" name="action" value="add">
        <input type="text" name="task" placeholder="Enter new task..." required>
        <button type="submit">Add Task</button>
    </form>

    <form method="post" class="clear-form">
        <input type="hidden" name="action" value="clear">
        <button type="submit" class="danger">Clear All Tasks</button>
    </form>

    <div class="note">
        <p><strong>Exercise 12-2 requirements implemented:</strong></p>
        <ul>
            <li>Session lasts for 1 year.</li>
            <li>The task array is stored in the session.</li>
            <li>The task list is not stored as hidden HTML fields.</li>
            <li>Tasks remain after closing and reopening the browser while the cookie is valid.</li>
        </ul>
    </div>
</div>
</body>
</html>
