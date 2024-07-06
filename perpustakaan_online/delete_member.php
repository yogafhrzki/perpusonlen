<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    $sql = "DELETE FROM Members WHERE member_id = $member_id";

    if ($conn->query($sql) === TRUE) {
        echo "Anggota berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Redirect kembali ke halaman sebelumnya atau halaman lain setelah proses delete
header("Location: manage_member.php");
exit();

?>
