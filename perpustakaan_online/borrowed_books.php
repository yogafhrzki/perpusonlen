<?php
session_start();
include 'koneksi.php';
include 'template/header.php';

$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan daftar buku yang dipinjam oleh pengguna
$sqlBorrowedBooks = "SELECT * FROM Books 
                     INNER JOIN borrowingrecords ON Books.book_id = borrowingrecords.book_id 
                     WHERE borrowingrecords.user_id = '$user_id' AND borrowingrecords.status = 'borrowed'";

$resultBorrowedBooks = $conn->query($sqlBorrowedBooks);

?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Buku yang Sedang Dipinjam</h2>
    <div class="row">
        <?php
        if ($resultBorrowedBooks->num_rows > 0) {
            while ($row = $resultBorrowedBooks->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="images/<?php echo $row['image_path']; ?>" class="card-img-top img-fluid rounded"
                            alt="Sampul Buku" data-toggle="modal" data-target="#exampleModal<?php echo $row['book_id']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Penulis: <?php echo $row['author']; ?></p>
                            <p class="card-text">Status: Dipinjam</p>
                            <button class="btn btn-info btn-sm mb-2 btn-show-synopsis" data-toggle="modal"
                                data-target="#exampleModalSinopsis<?php echo $row['book_id']; ?>">
                                Lihat Sinopsis
                            </button>
                            <form action="kembalikan.php" method="post">
                                <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                <button type="submit" class="btn btn-warning btn-block" name="kembalikan">
                                    <i class="fa fa-undo"></i> Kembalikan Buku
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Gambar Sampul -->
                <div class="modal fade" id="exampleModal<?php echo $row['book_id']; ?>" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['title']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="images/<?php echo $row['image_path']; ?>" class="img-fluid rounded"
                                    alt="Sampul Buku">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Sinopsis -->
                <div class="modal fade" id="exampleModalSinopsis<?php echo $row['book_id']; ?>" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['title']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo $row['synopsis']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-md-12">
                <p class="text-center">Anda belum meminjam buku apapun saat ini.</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include 'template/footer.php'; ?>

<!-- Pastikan Anda sudah memuat jQuery dan Bootstrap JavaScript di bawah ini -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    body {
        background-color: #f8f9fa;
    }
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
    .card-title {
        font-size: 18px;
        font-weight: bold;
    }
    .btn-block {
        text-transform: uppercase;
        font-weight: bold;
    }
    .card-img-top {
        height: 300px; 
        object-fit: cover; 
        cursor: pointer; 
    }
    .modal-dialog {
        max-width: 800px; 
    }
    .modal-content {
        border: none; 
        border-radius: 10px; 
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
</style>
