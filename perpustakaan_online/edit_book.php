<?php
include 'koneksi.php';
include 'template/header.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];
    
    // Query untuk mengambil informasi buku berdasarkan book_id
    $sql = "SELECT * FROM Books WHERE book_id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Buku tidak ditemukan.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>ID buku tidak disediakan.</div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $category_id = $_POST['category_id'];
    $isbn = $_POST['isbn'];
    $year = $_POST['year'];
    $synopsis = $_POST['synopsis']; 

   
    $image_path = $book['image_path'];

    
    if ($_FILES['book_image']['name']) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["book_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        
        $check = getimagesize($_FILES["book_image"]["tmp_name"]);
        if ($check !== false) {
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

       
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<div class='alert alert-danger'>Maaf, hanya file JPG, JPEG, PNG, & GIF yang diizinkan.</div>";
            $uploadOk = 0;
        }

       
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["book_image"]["tmp_name"], $target_file)) {
                $image_path = basename($_FILES["book_image"]["name"]);
            } else {
                echo "<div class='alert alert-danger'>Maaf, terjadi kesalahan saat mengunggah file Anda.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Maaf, file Anda tidak terunggah.</div>";
        }
    }

    
    $sql = "UPDATE Books SET 
            title='$title', 
            author='$author', 
            publisher='$publisher', 
            category_id=$category_id, 
            isbn='$isbn', 
            year_of_publication=$year,
            synopsis='$synopsis', 
            image_path='$image_path' 
            WHERE book_id=$book_id";

   
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Buku berhasil diperbarui</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<div class="container mt-4">
    <h2>Edit Buku</h2>
    <form action="edit_book.php?book_id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $book['title']; ?>" required>
        </div>
        <div class="form-group">
            <label for="author">Pengarang</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo $book['author']; ?>" required>
        </div>
        <div class="form-group">
            <label for="publisher">Penerbit</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="<?php echo $book['publisher']; ?>" required>
        </div>
        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <?php
               
                $sql = "SELECT category_id, category_name FROM Categories";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    $selected = $row['category_id'] == $book['category_id'] ? 'selected' : '';
                    echo "<option value='" . $row['category_id'] . "' $selected>" . $row['category_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $book['isbn']; ?>" required>
        </div>
        <div class="form-group">
            <label for="year">Tahun Terbit</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo $book['year_of_publication']; ?>" required>
        </div>
        <div class="form-group">
            <label for="synopsis">Sinopsis</label>
            <textarea class="form-control" id="synopsis" name="synopsis" rows="5"><?php echo $book['synopsis']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="book_image">Gambar Sampul Buku</label>
            <input type="file" class="form-control" id="book_image" name="book_image">
            <p>Gambar saat ini: <img src="images/<?php echo $book['image_path']; ?>" alt="Sampul Buku" width="100"></p>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui Buku</button>
    </form>
</div>

<?php include 'template/footer.php'; ?>
