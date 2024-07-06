<?php
include 'koneksi.php';
include 'template/header.php';
?>

<h2>Kelola Buku</h2>
<a href="add_book.php" class="btn btn-primary mb-2">Tambah Buku</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>ISBN</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT Books.*, Categories.category_name FROM Books LEFT JOIN Categories ON Books.category_id = Categories.category_id";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['book_id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author'] . "</td>";
            echo "<td>" . $row['publisher'] . "</td>";
            echo "<td>" . $row['year_of_publication'] . "</td>";
            echo "<td>" . $row['isbn'] . "</td>";
            echo "<td>" . $row['category_name'] . "</td>";
            echo "<td>
                    <a href='edit_book.php?book_id=" . $row['book_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete_book.php?book_id=" . $row['book_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'template/footer.php'; ?>
