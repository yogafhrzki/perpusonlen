<?php
session_start();
include 'koneksi.php';
include 'template/header.php';

$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan daftar buku yang tersedia
$sqlBooks = "SELECT * FROM Books WHERE availability = 1"; 
$resultBooks = $conn->query($sqlBooks);

?>

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="borrowed_books.php" class="btn btn-primary"><i class="fa fa-list"></i> Lihat Buku yang Sedang Dipinjam</a>
        </div>
    </div>
    <h2 class="text-center mb-4">Daftar Buku Tersedia</h2>
    <div class="row">
        <?php
        if ($resultBooks->num_rows > 0) {
            while ($row = $resultBooks->fetch_assoc()) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm position-relative">
                        <img src="images/<?php echo $row['image_path']; ?>" class="card-img-top img-fluid rounded"
                            alt="Sampul Buku" data-toggle="modal" data-target="#exampleModal<?php echo $row['book_id']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text">Penulis: <?php echo $row['author']; ?></p>
                            <p class="card-text">Tersedia: <?php echo ($row['availability'] == 1) ? 'Ya' : 'Tidak'; ?></p>
                            <button class="btn btn-info btn-sm mb-2 btn-show-synopsis" data-toggle="modal"
                                data-target="#exampleModalSinopsis<?php echo $row['book_id']; ?>">
                                Lihat Sinopsis
                            </button>
                            <?php if ($row['availability'] == 1) : ?>
                                <form action="pinjam.php" method="post">
                                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                    <button type="submit" class="btn btn-primary btn-block" name="pinjam">
                                        <i class="fa fa-book"></i> Pinjam Buku
                                    </button>
                                </form>
                            <?php else : ?>
                                <button class="btn btn-secondary btn-block" disabled>
                                    Buku Sedang Dipinjam
                                </button>
                            <?php endif; ?>
                        </div>
                        <div class="overlay"></div>
                    </div>
                </div>

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
                <p class="text-center">Tidak ada buku yang tersedia saat ini.</p>
            </div>
            <?php
        }
        ?>
    </div>
</div>

<?php include 'template/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    body {
        background: url('images/bg.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Roboto', sans-serif;
        color: #fff;
        position: relative;
    }
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }
    .card {
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
        width: calc(100% - 30px);
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
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
        height: 400px;
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
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 10px;
        pointer-events: none; 
    }
    .card:hover .overlay {
        opacity: 1;
    }
    .modal-body,
    .modal-title {
        color: #000; 
    }
</style>
