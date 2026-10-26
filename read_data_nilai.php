<?php
//koneksi
require_once __DIR__ . "/connect.php";

$sql = "SELECT * FROM nilai_mahasiswa";
// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Process the result set
if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  //echo "<h3> Data MyGuest </h3>";
  echo "<table border=1 cellpadding=10> ";
  echo "<caption><h3>Data Nilai Mahasiswa</h3></caption>";
  echo "<tr>
            <th>Nim</th>
            <th>Nama</th>
            <th>Nilai Akhir</th>
            <th>Nilai Huruf</th>
            <th>Predikat</th>
            <th>Dibuat pada Tgl</th>
            <th>Diubah pada Tgl</th>
            <th>Aksi</th>

        </tr>";

  while($row = mysqli_fetch_assoc($result)) {
    //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " - Email: " . $row["email"]. " - Reg Date: " . $row["reg_date"]."<br>";
    echo "<tr>
            <td>".$row["nim"]."</td>
            <td>".$row["nama_mhsw"]."</td>
            <td>".$row["nilai_akhir"]."</td>
            <td>".$row["nilai_huruf"]."</td>
            <td>".$row["predikat"]."</td>
            <td>".$row["reg_date"]."</td>
            <td>".$row["modify_date"]."</td>
            <td><a href=#>Edit</a> | <a href=#>Delete</a></td>
        </tr>";
  }
  echo "</table><br>";
  echo "<a href = 'form_nilai.php'><button>Tambah Data</button></a>";
} else {
  echo "0 results";
}

mysqli_close($conn);
?>