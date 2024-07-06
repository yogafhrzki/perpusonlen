<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    

    $sqlImagePath = "SELECT image_path FROM Books WHERE book_id=$id";
    $resultImagePath = $conn->query($sqlImagePath);
    
    if ($resultImagePath->num_rows > 0) {
        $row = $resultImagePath->fetch_assoc();
        $imagePath = $row['image_path'];
        

        $path = 'images/' . $imagePath;
        if (file_exists($path)) {
            unlink($path);
        }
    }
    

    $sqlDeleteBook = "DELETE FROM Books WHERE book_id=$id";

    if ($conn->query($sqlDeleteBook) === TRUE) {
        echo "Buku berhasil dihapus";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID buku tidak ditemukan.";
}


header("Location: manage_book.php");
exit;
?>
