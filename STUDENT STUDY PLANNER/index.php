<?php include "db.php"; ?>

<?php
// Insert task
if (isset($_POST['add_task'])) {
    $course_id = $_POST['course_id'];
    $task_name = $_POST['task_name'];
    $study_date = $_POST['study_date'];
    $duration = $_POST['duration'];

    $sql = "INSERT INTO tasks (course_id, task_name, study_date, duration) 
            VALUES ('$course_id','$task_name','$study_date','$duration')";
    $conn->query($sql);
}

// Delete task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM tasks WHERE task_id=$id");
}

// Fetch data
$courses = $conn->query("SELECT * FROM courses");
$tasks = $conn->query("SELECT tasks.task_id, courses.course_name, task_name, study_date, duration 
                       FROM tasks JOIN courses ON tasks.course_id=courses.course_id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Study Planner</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        form { margin-bottom: 20px; }
        input, select, button { margin: 5px; padding: 8px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background: #ddd; }
        a.delete { color: red; text-decoration: none; }
        a.edit { color: blue; text-decoration: none; }
    </style>
</head>
<body>
    <h2>📘 Student Study Planner</h2>

    <form method="POST">
        <select name="course_id" required>
            <option value="">Select Course</option>
            <?php while($row = $courses->fetch_assoc()): ?>
                <option value="<?= $row['course_id']; ?>"><?= $row['course_name']; ?></option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="task_name" placeholder="Enter Task (e.g. Learn Syllabus)" required>
        <input type="date" name="study_date" required>
        <input type="text" name="duration" placeholder="e.g. 2 hours">
        <button type="submit" name="add_task">Add Task</button>
    </form>

    <a href="add_course.php">+ Add New Course</a>

    <h3>📅 Upcoming Tasks</h3>
    <table>
        <tr>
            <th>Course</th>
            <th>Task</th>
            <th>Date</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
        <?php while($task = $tasks->fetch_assoc()): ?>
        <tr>
            <td><?= $task['course_name']; ?></td>
            <td><?= $task['task_name']; ?></td>
            <td><?= $task['study_date']; ?></td>
            <td><?= $task['duration']; ?></td>
            <td>
                <a href="edit_task.php?id=<?= $task['task_id']; ?>" class="edit">Edit</a> | 
                <a href="index.php?delete=<?= $task['task_id']; ?>" class="delete">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
