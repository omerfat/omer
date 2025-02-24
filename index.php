<?php
include 'db.php';

if (isset($_GET['category'])) {
    $category_id = $_GET['category'];
    $sql = "SELECT * FROM posts WHERE category_id = :category_id ORDER BY created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['category_id' => $category_id]);
} else {
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
    $stmt = $pdo->query($sql);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
</head>
<body>
<tr>
           
            <td colspan="2" style="text-align: left;">
                <a href="kategori.php">kategoriler</a>
            </td>
            <td colspan="2" style="text-align: left;">
                <a href="blog.php">Bloglar</a>
            </td>
        </tr>

    <h1>Blog Yazıları</h1>


    <ul>
    <?php

foreach ($posts as $post): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 600px; margin-bottom: 20px;">
        
        <tr>
            <th colspan="2">
                Başlık
            </th>
            <td colspan="2">
                metin
            </td>
            <td colspan="2" style="text-align: left;">
                Devamı
            </td>
        </tr>


        <tr>
            
            <th colspan="2">
                <?php echo htmlspecialchars($post['title']); ?>
            </th>
            <td colspan="2">
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            </td>
            <td colspan="2" style="text-align: left;">
                <a href="detay.php?id=<?php echo $post['id']; ?>">Devamını Oku</a>
            </td>
        </tr>
    

    </table>
<?php endforeach; ?>

    </ul>
</body>
</html>
