<?php
include 'koneksi.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_date = $_POST['borrow_date'];
    $return_date = $_POST['return_date'];

    $sql = "UPDATE BorrowingRecords SET book_id=$book_id, member_id=$member_id, borrow_date='$borrow_date', return_date='$return_date' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Peminjaman berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM BorrowingRecords WHERE id=$id";
    $result = $conn->query($sql);
    $borrowing = $result->fetch_assoc();
}
?>

<h2>Edit Peminjaman</h2>
<form action="edit_borrowing.php" method="post">
    <input type="hidden" name="id" value="<?php echo $borrowing['id']; ?>">
    <div class="form-group">
        <label for="book_id">Buku</label>
        <select class="form-control" id="book_id" name="book_id" required>
            <!-- Lakukan fetch dari tabel books -->
            <?php
            $sql = "SELECT id, title FROM Books";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $selected = $row['id'] == $borrowing['book_id'] ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['title'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="member_id">Anggota</label>
        <select class="form-control" id="member_id" name="member_id" required>
            <!-- Lakukan fetch dari tabel members -->
            <?php
            $sql = "SELECT id, name FROM Members";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
                $selected = $row['id'] == $borrowing['member_id'] ? 'selected' : '';
                echo "<option value='" . $row['id'] . "' $selected>" . $row['name'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="borrow_date">Tanggal Peminjaman</label>
        <input type="date" class="form-control" id="borrow_date" name="borrow_date" value="<?php echo $borrowing['borrow_date']; ?>" required>
    </div>
    <div class="form-group">
        <label for="return_date">Tanggal Pengembalian</label>
        <input type="date" class="form-control" id="return_date" name="return_date" value="<?php echo $borrowing['return_date']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<?php include 'template/footer.php'; ?>
