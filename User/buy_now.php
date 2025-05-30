<?php
require "../component/db_conn.php";
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = (int)$_GET['id'];


$stmt = $conn->prepare("SELECT * FROM purchases WHERE user_id = ? AND course_id = ?");
$stmt->bind_param("ii", $user_id, $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {

    $stmt = $conn->prepare("INSERT INTO purchases (user_id, course_id, purchased_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $course_id);
    $stmt->execute();
}


header("Location: course_details.php?id=" . $course_id);
exit();
