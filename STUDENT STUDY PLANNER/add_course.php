<?php include "db.php"; ?>

<?php
if (isset($_POST['add_course'])) {
    $course_name = $_POST['course_name'];
    $conn->query("INSERT INTO courses (course_name) VALUES ('$course_name')");
    header("Location: index.php"); // redirect back
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
</head>
<body>
    <h2>Add New Course</h2>
    <form method="POST">
        <input type="text" name="course_name" placeholder="Course Name" required>
        <button type="submit" name="add_course">Add</button>
    </form>
    <br>
    <a href="index.php">Go Back</a>
</body>
</html>
