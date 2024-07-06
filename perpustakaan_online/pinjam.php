<?php
session_start();
include 'koneksi.php';

if (isset($_POST['pinjam'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    
    // Lakukan proses peminjaman buku ke dalam tabel `borrowingrecords`
    $borrow_date = date('Y-m-d'); // Tanggal peminjaman
    $status = 'borrowed'; // Status peminjaman
    
    $insertSql = "INSERT INTO borrowingrecords (book_id, member_id, borrow_date, status, user_id) 
                  VALUES ('$book_id', '$user_id', '$borrow_date', '$status', '$user_id')";
    
    if ($conn->query($insertSql) === TRUE) {
        // Update status buku menjadi tidak tersedia
        $updateSql = "UPDATE Books SET availability = 0 WHERE book_id = '$book_id'";
        if ($conn->query($updateSql) === TRUE) {
            header('Location: member_dashboard.php');
            exit();
        } else {
            echo "Error updating book availability: " . $conn->error;
        }
    } else {
        echo "Error inserting record: " . $conn->error;
    }
} else {
    header('Location: member_dashboard.php');
    exit();
}
?>
