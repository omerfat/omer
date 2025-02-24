<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_name'])) {
        
        $category_name = $_POST['category_name'];
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $category_name]);
    }
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategoriler Yönetimi</title>
</head>
<body>
    <h1>Kategoriler</h1>
    
    <div>
      
        <ul>
            <?php
            $categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($categories as $category):
            ?>
                <li><a href="?category=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <form method="POST">
        <input type="text" name="category_name" placeholder="Kategori Adı" required>
        <button type="submit">Ekle</button>
    </form>
    <ul>
        <?php foreach ($categories as $category): ?>
            <li>
                <?php echo htmlspecialchars($category['name']); ?>
                <!-- Kategori silme işlemi -->
                <a href="kategori_sil.php?id=<?php echo $category['id']; ?>">Sil</a>
                <a href="kategori_duzenle.php?id=<?php echo $category['id']; ?>">Sil</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
