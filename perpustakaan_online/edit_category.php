<?php
include 'koneksi.php';
include 'template/header.php';

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT * FROM Categories WHERE category_id = '$category_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];

    $sql = "UPDATE Categories SET category_name='$category_name' WHERE category_id='$category_id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Kategori berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<h2>Edit Kategori</h2>
<form action="edit_category.php" method="post">
    <input type="hidden" name="category_id" value="<?php echo $row['category_id']; ?>">
    <label for="category_name">Nama Kategori:</label>
    <input type="text" id="category_name" name="category_name" value="<?php echo $row['category_name']; ?>" required><br>
    
    <button type="submit">Simpan Perubahan</button>
</form>

<?php include 'template/footer.php'; ?>
