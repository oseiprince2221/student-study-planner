<?php include "db.php"; ?>

<?php
// Get task details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $task = $conn->query("SELECT * FROM tasks WHERE task_id=$id")->fetch_assoc();
}

// Update task
if (isset($_POST['update_task'])) {
    $task_id = $_POST['task_id'];
    $course_id = $_POST['course_id'];
    $task_name = $_POST['task_name'];
    $study_date = $_POST['study_date'];
    $duration = $_POST['duration'];

    $conn->query("UPDATE tasks 
                  SET course_id='$course_id', task_name='$task_name', study_date='$study_date', duration='$duration' 
                  WHERE task_id=$task_id");

    header("Location: index.php");
}
$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
</head>
<body>
    <h2>Edit Task</h2>
    <form method="POST">
        <input type="hidden" name="task_id" value="<?= $task['task_id']; ?>">
        <select name="course_id" required>
            <?php while($row = $courses->fetch_assoc()): ?>
                <option value="<?= $row['course_id']; ?>" 
                    <?= ($row['course_id'] == $task['course_id']) ? "selected" : "" ?>>
                    <?= $row['course_name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="task_name" value="<?= $task['task_name']; ?>" required>
        <input type="date" name="study_date" value="<?= $task['study_date']; ?>" required>
        <input type="text" name="duration" value="<?= $task['duration']; ?>">
        <button type="submit" name="update_task">Update Task</button>
    </form>
    <br>
    <a href="index.php">Back</a>
</body>
</html>
