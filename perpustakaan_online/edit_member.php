<?php
include 'koneksi.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE Members SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Anggota berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Members WHERE id=$id";
    $result = $conn->query($sql);
    $member = $result->fetch_assoc();
}
?>

<h2>Edit Anggota</h2>
<form action="edit_member.php" method="post">
    <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
    <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']; ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $member['email']; ?>" required>
    </div>
    <div class="form-group">
        <label for="phone">Telepon</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $member['phone']; ?>" required>
    </div>
    <div class="form-group">
        <label for="address">Alamat</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $member['address']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>

<?php include 'template/footer.php'; ?>
