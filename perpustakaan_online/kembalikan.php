<?php
session_start();
include 'koneksi.php';

if (isset($_POST['kembalikan'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_POST['book_id'];
    
    // Lakukan proses pengembalian buku
    $return_date = date('Y-m-d'); // Tanggal pengembalian
    $status = 'returned'; // Ubah status menjadi 'returned'
    
    $updateSql = "UPDATE borrowingrecords 
                  SET return_date = '$return_date', status = '$status' 
                  WHERE book_id = '$book_id' AND user_id = '$user_id' AND status = 'borrowed'";
    
    if ($conn->query($updateSql) === TRUE) {
        // Update status buku menjadi tersedia lagi
        $updateBookSql = "UPDATE Books SET availability = 1 WHERE book_id = '$book_id'";
        if ($conn->query($updateBookSql) === TRUE) {
            header('Location: borrowed_books.php');
            exit();
        } else {
            echo "Error updating book availability: " . $conn->error;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header('Location: borrowed_books.php');
    exit();
}
?>
