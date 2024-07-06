<?php
include 'koneksi.php';


$users = [
    ['yoga', 'yoga123', 'yoga@example.com', 'admin'],
    ['rizki', 'rizki123', 'rizki@example.com', 'member']
];

foreach ($users as $user) {
    $username = $user[0];
    $password = password_hash($user[1], PASSWORD_DEFAULT);
    $email = $user[2];
    $role = $user[3];

    $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $username, $password, $email, $role);

    if ($stmt->execute()) {
        echo "User $username berhasil ditambahkan\n";
    } else {
        echo "Error adding user $username: " . $stmt->error . "\n";
    }

    $stmt->close();
}

$conn->close();
?>
