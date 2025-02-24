<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title'], $_POST['content'], $_POST['category_id'])) {
        
        $title = $_POST['title'];
        $content = $_POST['content'];
        $category_id = $_POST['category_id'];

        $sql = "INSERT INTO posts (title, content, category_id) VALUES (:title, :content, :category_id)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'content' => $content, 'category_id' => $category_id]);
    }
}

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Yazılar Yönetimi</title>
</head>
<body>
    <h1>Yazılar</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Başlık" required>
        <textarea name="content" placeholder="İçerik" required></textarea>
        <select name="category_id" required>
            <option value="">Kategori Seç</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Yazıyı Ekle</button>
    </form>

    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <p>Kategori: <?php echo $post['category_id']; ?></p>
                <a href="blog_duzenle.php?id=<?php echo $post['id']; ?>">Düzenle</a> |
                <a href="blog_sil.php?id=<?php echo $post['id']; ?>">Sil</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
