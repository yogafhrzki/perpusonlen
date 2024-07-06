<?php
include 'koneksi.php';
include 'template/header.php';

$message = ""; // Variabel untuk menyimpan pesan yang akan ditampilkan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Memeriksa apakah kunci array $_POST sudah terdefinisi
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    $sql = "INSERT INTO Members (first_name, last_name, email, phone, address) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "Anggota berhasil ditambahkan"; // Menyimpan pesan
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Tambah Anggota</h2>

<!-- Menampilkan pesan setelah form di-submit -->
<?php if (!empty($message)) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form action="add_member.php" method="post">
    <div class="form-group">
        <label for="first_name">Nama Depan</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>
    <div class="form-group">
        <label for="last_name">Nama Belakang</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" class="form-control" id="address" name="address" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Anggota</button>
</form>

<?php include 'template/footer.php'; ?>
