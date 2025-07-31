<?php
$conn = new mysqli("localhost", "nurulirf_moodle", "@Gomoodle123!@#", "nurulirf_moodle");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$quiz_id = intval($_POST['quiz_id']);

$sql = "
SELECT 
  c.id AS course_id,
  c.fullname AS course_name,
  q.id AS quiz_id,
  q.name AS quiz_name,
  u.id AS user_id,
  CONCAT(u.firstname, ' ', u.lastname) AS user_fullname,
  qa.attempt AS attempt_number,
  ROUND(qa.sumgrades,0) AS raw_score,
  ROUND(qg.grade,0) AS final_grade,
  FROM_UNIXTIME(qa.timefinish) AS time_finished
FROM mdl_course c
JOIN mdl_quiz q ON q.course = c.id
JOIN mdl_quiz_attempts qa ON qa.quiz = q.id
JOIN mdl_user u ON u.id = qa.userid
LEFT JOIN mdl_quiz_grades qg ON qg.quiz = q.id AND qg.userid = u.id
WHERE qa.state = 'finished' AND q.id = ?
ORDER BY qg.grade DESC, qa.timefinish ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);