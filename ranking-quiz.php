<?php
// Koneksi ke database (ganti sesuai konfigurasi Anda)
$conn = new mysqli("localhost", "nurulirf_moodle", "@Gomoodle123!@#", "nurulirf_moodle");
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ranking Page LMS Nurul Irfan Jember</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Halaman Ranking LMS Nurul Irfan Jember</h1>
    <p>Silahkan pilih course dan quiz yang ingin dilihat</p>
  </div>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-6">
        <select class="form-select" id="courseSelect">
          <option selected>Pilih course...</option>
          <!-- PHP code to fetch courses from mdl_course table -->
          <?php
            $sql = "SELECT id, fullname FROM mdl_course";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo '<option value="' . $row["id"] . '">' . htmlspecialchars($row["fullname"]) . '</option>';
              }
            }
            $conn->close();
          ?>
        </select>
      </div>
     
      <div class="col-md-6">
        <select class="form-select" id="quizSelect">
          <option selected>Pilih quiz...</option>
          <option value="1">Quiz 1</option>
          <option value="2">Quiz 2</option>
          <option value="3">Quiz 3</option>
        </select>
      </div>
      
      <div class="mt-4" id="rankingSection" style="display: none;">
          <h3>Ranking Peserta</h3>
          <table class="table table-striped" id="rankingTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Nama Peserta</th>
                <th>Nilai</th>
                <th>Waktu Selesai</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#courseSelect').on('change', function() {
        var courseId = $(this).val();
        $('#quizSelect').html('<option>Loading...</option>');
    
        if (courseId !== '') {
          $.ajax({
            url: 'get_quiz_by_course.php',
            type: 'POST',
            data: { id_course: courseId },
            dataType: 'json',
            success: function(data) {
              var options = '<option selected>Pilih quiz...</option>';
              $.each(data, function(index, quiz) {
                options += '<option value="' + quiz.id + '">' + quiz.name + '</option>';
              });
              $('#quizSelect').html(options);
            },
            error: function() {
              $('#quizSelect').html('<option selected>Gagal memuat quiz</option>');
            }
          });
        } else {
          $('#quizSelect').html('<option selected>Pilih quiz...</option>');
        }
      });
      
      $('#quizSelect').on('change', function() {
          var quizId = $(this).val();
        
          if (quizId !== '') {
            $.ajax({
              url: 'get_ranking_by_quiz.php',
              type: 'POST',
              data: { quiz_id: quizId },
              dataType: 'json',
              success: function(data) {
                var tbody = '';
                if (data.length > 0) {
                  $.each(data, function(index, item) {
                    tbody += '<tr>';
                    tbody += '<td>' + (index + 1) + '</td>';
                    tbody += '<td>' + item.user_fullname + '</td>';
                    tbody += '<td>' + item.final_grade + '</td>';
                    tbody += '<td>' + item.time_finished + '</td>';
                    tbody += '</tr>';
                  });
                } else {
                  tbody = '<tr><td colspan="6">Tidak ada data ranking.</td></tr>';
                }
        
                $('#rankingTable tbody').html(tbody);
                $('#rankingSection').show();
              },
              error: function() {
                $('#rankingTable tbody').html('<tr><td colspan="6">Gagal memuat data ranking.</td></tr>');
                $('#rankingSection').show();
              }
            });
          } else {
            $('#rankingSection').hide();
          }
        });
    });
    
    
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>