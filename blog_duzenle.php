<?php
include 'db.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        header('Location: blog.php');
        exit;
    }
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    $sql = "UPDATE posts SET title = :title, content = :content, category_id = :category_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'content' => $content,
        'category_id' => $category_id,
        'id' => $id
    ]);

    
    header('Location: blog.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yazıyı Düzenle</title>
</head>
<body>
    <h1>Yazıyı Düzenle</h1>
    
    <form method="POST">
        <label for="title">Başlık:</label><br>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>

        <label for="content">İçerik:</label><br>
        <textarea name="content" id="content" rows="4" cols="50" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

        <label for="category_id">Kategori:</label><br>
        <select name="category_id" id="category_id" required>
            <option value="">Kategori Seç</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>" 
                    <?php if ($category['id'] == $post['category_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Yazıyı Güncelle</button>
    </form>

    <a href="blog.php">Geri Dön</a>
</body>
</html>
