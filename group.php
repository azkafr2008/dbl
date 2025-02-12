<?php
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "user_management"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menghitung rata-rata gaji per departemen dengan rata-rata gaji lebih tinggi dari perusahaan
$sql = "SELECT department, AVG(salary) AS avg_salary
        FROM employees
        GROUP BY department
        HAVING AVG(salary) > (SELECT AVG(salary) FROM employees)";
$result = $conn->query($sql);

// Menampilkan hasil
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Departemen: " . $row['department'] . " - Rata-rata Gaji: " . number_format($row['avg_salary'], 2) . "<br>";
    }
} else {
    echo "Tidak ada departemen dengan rata-rata gaji di atas rata-rata perusahaan.";
}

// Menutup koneksi
$conn->close();
?>
