<?php
include 'koneksi.php';
include 'template/header.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$sqlMembers = "SELECT COUNT(*) as totalMembers FROM Members";
$resultMembers = $conn->query($sqlMembers);
$rowMembers = $resultMembers->fetch_assoc();
$totalMembers = $rowMembers['totalMembers'];

$sqlBooks = "SELECT COUNT(*) as totalBooks FROM Books";
$resultBooks = $conn->query($sqlBooks);
$rowBooks = $resultBooks->fetch_assoc();
$totalBooks = $rowBooks['totalBooks'];

$sqlBorrowings = "SELECT DATE(borrow_date) as borrow_date, COUNT(*) as totalBorrowings 
                  FROM Borrowingrecords GROUP BY DATE(borrow_date)";
$resultBorrowings = $conn->query($sqlBorrowings);

$borrowDates = [];
$borrowCounts = [];
while ($row = $resultBorrowings->fetch_assoc()) {
    $borrowDates[] = $row['borrow_date'];
    $borrowCounts[] = $row['totalBorrowings'];
}
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Dashboard Admin</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Jumlah Anggota</h5>
                    <p class="card-text" style="font-size: 24px;"><?php echo $totalMembers; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book"></i> Jumlah Buku</h5>
                    <p class="card-text" style="font-size: 24px;"><?php echo $totalBooks; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chart-line"></i> Presentase Peminjam per Tanggal</h5>
                    <canvas id="borrowChart" style="height: 200px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-plus"></i> Tambah Buku</h5>
                    <a href="add_book.php" class="btn btn-light btn-block">Tambah Buku</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-user-plus"></i> Tambah Anggota</h5>
                    <a href="add_member.php" class="btn btn-light btn-block">Tambah Anggota</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-plus-circle"></i> Tambah Peminjaman</h5>
                    <a href="add_borrowing.php" class="btn btn-light btn-block">Tambah Peminjaman</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-book-open"></i> Kelola Buku</h5>
                    <a href="manage_book.php" class="btn btn-light btn-block">Kelola Buku</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users-cog"></i> Kelola Anggota</h5>
                    <a href="manage_member.php" class="btn btn-light btn-block">Kelola Anggota</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tasks"></i> Kelola Peminjaman</h5>
                    <a href="manage_borrowing.php" class="btn btn-light btn-block">Kelola Peminjaman</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'template/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('borrowChart').getContext('2d');
    const borrowChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($borrowDates); ?>,
            datasets: [{
                label: 'Jumlah Peminjam',
                data: <?php echo json_encode($borrowCounts); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<style>
    body {
        background: url('images/bg.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Roboto', sans-serif;
        color: #fff;
        position: relative; /* Menetapkan posisi relatif untuk lapisan transparan */
    }
    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Warna overlay transparan */
        z-index: -1; /* Menempatkan lapisan di belakang konten */
    }
    .card {
        transition: transform 0.3s;
    }
    .card:hover {
        transform: scale(1.05);
    }
    .card-title {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .btn-block {
        text-transform: uppercase;
        font-weight: bold;
    }
</style>
