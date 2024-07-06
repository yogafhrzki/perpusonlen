<?php
include 'koneksi.php';
include 'template/header.php';
?>

<h2>Kelola Peminjaman</h2>
<a href="add_borrowing.php" class="btn btn-primary mb-2">Tambah Peminjaman</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Buku</th>
            <th>Anggota</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT BorrowingRecords.record_id, Books.title AS book_title, Members.first_name, Members.last_name,
                BorrowingRecords.borrow_date, BorrowingRecords.return_date, BorrowingRecords.status
                FROM BorrowingRecords
                INNER JOIN Books ON BorrowingRecords.book_id = Books.book_id
                INNER JOIN Members ON BorrowingRecords.member_id = Members.member_id";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['record_id'] . "</td>";
                echo "<td>" . $row['book_title'] . "</td>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                echo "<td>" . $row['borrow_date'] . "</td>";
                echo "<td>" . $row['return_date'] . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "<td>
                        <a href='edit_borrowing.php?id=" . $row['record_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_borrowing.php?id=" . $row['record_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data peminjaman.</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'template/footer.php'; ?>
