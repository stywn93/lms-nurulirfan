<?php
// Koneksi ke database Moodle
$conn = new mysqli("localhost", "nurulirf_moodle", "@Gomoodle123!@#", "nurulirf_moodle");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

header('Content-Type: application/json');

// Ambil id course dari POST
$id_course = intval($_POST['id_course']);
$quizzes = [];

$sql = "SELECT id, name FROM mdl_quiz WHERE course = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_course);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
  $quizzes[] = $row;
}

echo json_encode($quizzes);