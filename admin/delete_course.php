<?php
require '../component/db_conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $course_id = (int) $_GET['id'];

   
    $stmt = $conn->prepare("DELETE FROM courses WHERE id = ?");
    $stmt->bind_param("i", $course_id);

    if ($stmt->execute()) {
        header("Location: allCourse.php");
        exit();
    } else {
        echo "Error deleting course: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid course ID.";
}

$conn->close();
