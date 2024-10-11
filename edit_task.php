<?php
global $pdo;
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_task = $_POST['task'];
    $stmt = $pdo->prepare("UPDATE tasks SET task = :task WHERE id = :id");
    $stmt->execute(['task' => $new_task, 'id' => $_POST['id']]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
<h1>Edit Task</h1>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
    <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
    <button type="submit">Update</button>
</form>
</body>
</html>
