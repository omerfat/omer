<?php
include 'db.php';

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $category_id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        header('Location: categories.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];

    
    $sql = "UPDATE categories SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $category_name, 'id' => $category_id]);

    header('Location: categories.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategoriyi Düzenle</title>
</head>
<body>
    <h1>Kategoriyi Düzenle</h1>
    
    <form method="POST">
        <label for="category_name">Kategori Adı:</label>
        <input type="text" name="category_name" id="category_name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
        <button type="submit">Güncelle</button>
    </form>

    <a href="kategori.php">Geri Dön</a>
</body>
</html>
