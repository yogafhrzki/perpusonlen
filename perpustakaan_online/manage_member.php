<?php
include 'koneksi.php';
include 'template/header.php';
?>

<h2>Kelola Anggota</h2>
<a href="add_member.php" class="btn btn-primary mb-2">Tambah Anggota</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM Members";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['member_id'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>
                    <a href='edit_member.php?id=" . $row['member_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete_member.php?id=" . $row['member_id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'template/footer.php'; ?>
