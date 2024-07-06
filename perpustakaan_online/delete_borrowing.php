<?php
include 'koneksi.php';

$id = $_GET['id'];
$sql = "DELETE FROM BorrowingRecords WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Peminjaman berhasil dihapus";
} else {
    echo "Error: " . $conn->error;
}

header("Location: manage_borrowings.php");
exit;
?>
