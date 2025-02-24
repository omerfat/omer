<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Yazıyı silme
    $sql = "DELETE FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);

    header('Location: blog.php');
    exit;
}
?>
