<?php 
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM siswa
            WHERE 
            nis LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            presensi LIKE '%$keyword%'
            ";

$siswa = query($query);

?>
<table border="1" cellpadding="10" cellspacing="0">
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>Presensi</th>
    <th>Status Absen</th>
    <th>Aksi</th>
</tr>



<?php $i = 1; ?>
<?php foreach($siswa as $row) : ?>
<tr>
    <td><?= $i; ?></td>
    <td><?= $row["nis"]; ?></td>
    <td><?= $row["nama"]; ?></td>
    <td><?= $row["jurusan"]; ?></td>
    <td>
                <!-- Tombol Hadir, Izin, Alpa -->
                <button style="background-color: green; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                        onclick="konfirmasiPresensi('hadir', <?= $row['id']; ?>)">Hadir</button>
                <button style="background-color: orange; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                        onclick="konfirmasiPresensi('izin', <?= $row['id']; ?>)">Izin</button>
                <button style="background-color: red; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;" 
                onclick="konfirmasiPresensi('alpa', <?= $row['id']; ?>)">Alpa</button>
            </td>
     <td class="status-absen <?= strtolower($row["presensi"]); ?>">
         <!-- Menampilkan status absen -->
         <?= ucfirst($row["presensi"]); ?>
     </td>
    <td class="aksi">
        <a href="ubah.php?id=<?= $row['id']; ?>" 
        style="background-color: #4a90e2; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer;">Ubah</a> 
        <a href="hapus.php?id=<?= $row['id']; ?>" 
        onclick="return confirm('Yakin?');" 
        style="background-color: #e74c3c; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer;">Hapus</a>
    </td>

</tr>
<?php $i++; ?>
<?php endforeach;?>

</table>