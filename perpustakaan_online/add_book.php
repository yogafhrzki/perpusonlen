<?php
include 'koneksi.php';
include 'template/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $category_id = $_POST['category_id'];
    $isbn = $_POST['isbn'];
    $year = $_POST['year'];

    
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    
    $check = getimagesize($_FILES["book_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<div class='alert alert-danger'>File bukan gambar.</div>";
        $uploadOk = 0;
    }

    
    if (file_exists($target_file)) {
        echo "<div class='alert alert-danger'>Maaf, file gambar sudah ada.</div>";
        $uploadOk = 0;
    }

    
    if ($_FILES["book_image"]["size"] > 5000000) {
        echo "<div class='alert alert-danger'>Maaf, ukuran file terlalu besar. Maksimal 5 MB.</div>";
        $uploadOk = 0;
    }

    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.</div>";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger'>Maaf, file Anda tidak terunggah.</div>";
    
    } else {
        if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
            $image_path = basename($_FILES["book_image"]["name"]);
            $sql = "INSERT INTO Books (title, author, publisher, category_id, isbn, year_of_publication, image_path) 
                    VALUES ('$title', '$author', '$publisher', $category_id, '$isbn', $year, '$image_path')";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Buku berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengunggah file Anda.</div>";
        }
    }
}
?>

<div class="container mt-4">
    <h2>Tambah Buku</h2>
    <form action="add_book.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="author">Pengarang</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <div class="form-group">
            <label for="publisher">Penerbit</label>
            <input type="text" class="form-control" id="publisher" name="publisher" required>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php
                $sql = "SELECT category_id, category_name FROM Categories";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
        </div>
        <div class="form-group">
            <label for="year">Tahun Terbit</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="book_image">Gambar Sampul Buku</label>
            <input type="file" class="form-control" id="book_image" name="book_image" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Buku</button>
    </form>
</div>

<?php include 'template/footer.php'; ?>
