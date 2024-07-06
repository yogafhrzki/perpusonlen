<?php
include 'koneksi.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    $sql = "INSERT INTO BorrowingRecords (book_id, member_id, borrow_date, return_date) 
            VALUES ($book_id, $member_id, '$borrow_date', '$return_date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Peminjaman berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Tambah Peminjaman</h2>
<form action="add_borrowing.php" method="post">
    <div class="form-group">
        <label for="book_id">Buku</label>
        <select class="form-control" id="book_id" name="book_id" required>
            <!-- Lakukan fetch dari tabel books -->
            <?php
            $sql = "SELECT book_id, title FROM Books"; // Perbaikan disini, ganti id menjadi book_id
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['book_id'] . "'>" . $row['title'] . "</option>"; // Perbaikan disini, ganti id menjadi book_id
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="member_id">Anggota</label>
        <select class="form-control" id="member_id" name="member_id" required>
            <!-- Lakukan fetch dari tabel members -->
            <?php
            $sql = "SELECT member_id, first_name, last_name FROM Members"; // Perbaikan disini, ganti id menjadi member_id
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['member_id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>"; // Perbaikan disini, ganti id menjadi member_id
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="borrow_date">Tanggal Peminjaman</label>
        <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
    </div>
    <div class="form-group">
        <label for="return_date">Tanggal Pengembalian</label>
        <input type="date" class="form-control" id="return_date" name="return_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Peminjaman</button>
</form>

<?php include 'template/footer.php'; ?>
