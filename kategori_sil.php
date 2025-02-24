<?php
include 'db.php';


if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    
    $sql = "DELETE FROM categories WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $category_id]);

    
    header('Location: categories.php');
    exit;
} else {
  
    header('Location: kategoris.php');
    exit;
}
?>
