<?php
require 'config.php';

// Alle Aufgaben abrufen
$stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .task { display: flex; justify-content: space-between; }
        .completed { text-decoration: line-through; color: gray; }
    </style>
</head>
<body>
<h1>To-Do List</h1>

<form action="add_task.php" method="POST">
    <input type="text" name="task" required placeholder="New task...">
    <button type="submit">Add Task</button>
</form>

<ul>
    <?php foreach ($tasks as $task): ?>
        <li class="task">
                <span class="<?php echo $task['completed'] ? 'completed' : ''; ?>">
                    <?php echo htmlspecialchars($task['task']); ?>
                </span>
            <span>
                    <?php if (!$task['completed']): ?>
                        <a href="complete_task.php?id=<?php echo $task['id']; ?>">Complete</a>
                    <?php endif; ?>
                    <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a>
                    <a href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </span>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
